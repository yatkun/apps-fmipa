<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan;

use IntlDateFormatter;
use Livewire\Component;
use App\Models\Template;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\Letter; // Untuk menyimpan riwayat surat
use Symfony\Component\HttpFoundation\StreamedResponse; // Untuk download file


class GenerateLetter extends Component
{
    public $templateId;
    public $template;
    public $formData = [];
    public $generatedFilePath = null;
    public $tableData = [[]];
    public $placeholderHints = [];
 
    protected $rules = [];

    public function mount($templateId)
    {
        $this->templateId = $templateId;
        $this->template = Template::findOrFail($templateId);

        // Inisialisasi formData untuk placeholder umum
        if ($this->template->placeholders) {
            foreach ($this->template->placeholders as $placeholder) {
                $this->formData[$placeholder] = '';
            }
        }

        // Inisialisasi tableData jika ada marker tabel dan placeholder tabel
        if ($this->template->dynamic_table_marker && !empty($this->template->table_placeholders)) {
            $initialRow = [];
            foreach ($this->template->table_placeholders as $ph) {
                $initialRow[$ph] = '';
            }
            $this->tableData = [$initialRow];
        } else {
            $this->tableData = [[]];
        }

        // Muat placeholder hints
        $this->placeholderHints = $this->template->placeholder_hints ?? [];

 
        
    }



    // Method untuk menambah baris input tabel dinamis
    public function addTableRow()
    {
        $newRow = [];
        if (!empty($this->template->table_placeholders)) {
            foreach ($this->template->table_placeholders as $ph) {
                $newRow[$ph] = '';
            }
        }
        $this->tableData[] = $newRow;
    }

    // Method untuk menghapus baris input tabel dinamis
    public function removeTableRow($index)
    {
        if (count($this->tableData) > 1) {
            unset($this->tableData[$index]);
            $this->tableData = array_values($this->tableData); // Re-index array
        } else {
            // Jika hanya satu baris, kosongkan saja inputnya
            $emptyRow = [];
            if (!empty($this->template->table_placeholders)) {
                foreach ($this->template->table_placeholders as $ph) {
                    $emptyRow[$ph] = '';
                }
            }
            $this->tableData[0] = $emptyRow;
        }
    }

    /**
     * Public method to generate the letter based on template and user input.
     * This method handles both general placeholders and dynamic table data.
     */
    public function generate()
    {

        $processedData = $this->formData;
        $processedData['qr_code'] = '${qr_code}';
        if (isset($processedData['tanggal_surat']) && !empty($processedData['tanggal_surat'])) {
            try {
                // Buat objek Carbon dari string tanggal (misal: "2025-07-29")
                $date = Carbon::parse($processedData['tanggal_surat']);

                // Buat formatter untuk bahasa Indonesia (id_ID)
                $formatter = new IntlDateFormatter(
                    'id_ID', // Locale untuk bahasa Indonesia
                    IntlDateFormatter::LONG, // Format panjang (contoh: "29 Juli 2025")
                    IntlDateFormatter::NONE // Tidak ada waktu
                );

                // Format tanggal
                $formattedDate = $formatter->format($date->timestamp);

                // Timpa nilai tanggal_surat di processedData dengan format baru
                $processedData['tanggal_surat'] = $formattedDate;

            } catch (\Exception $e) {
            
                // Tetap gunakan format asli atau berikan pesan error ke user
                session()->flash('error', 'Gagal memformat tanggal: ' . $e->getMessage());
                // Anda bisa memilih untuk menghentikan proses atau melanjutkan dengan format mentah
            }
        }
       
        try {
            // 1. Dapatkan path lengkap file template dari storage
            $templateSourcePath = Storage::disk('public')->path($this->template->file_path);

            // Periksa apakah file template ada
            if (!Storage::disk('public')->exists($this->template->file_path)) {
                throw new \Exception("File template tidak ditemukan: " . $templateSourcePath);
            }

            // 2. Buat instance TemplateProcessor dari PhpOffice/PhpWord
            $templateProcessor = new TemplateProcessor($templateSourcePath);

            // 3. Isi placeholder umum (non-tabel) dengan data dari formData
            foreach ($processedData as $placeholder => $value) {
                $templateProcessor->setValue($placeholder, (string) $value);
            }

            // 4. Logika untuk Tabel Dinamis: Hanya dijalankan jika marker tabel ada
            if ($this->template->dynamic_table_marker && !empty($this->template->table_placeholders)) {
                // Filter data tabel yang sudah diisi (bukan baris kosong inisialisasi)
                $filledTableData = array_filter($this->tableData, function($item) {
                    // Cek apakah ada setidaknya satu nilai di baris ini
                    foreach ($item as $value) {
                        if (!empty($value)) return true;
                    }
                    return false;
                });

                if (!empty($filledTableData)) {
                    // Kloning baris tabel menggunakan 'dynamic_table_marker' (yang sekarang adalah 'row_idx')
                    // 'cloneRow' akan secara otomatis menghapus marker ini dari dokumen hasil.
                    $templateProcessor->cloneRow($this->template->dynamic_table_marker, count($filledTableData));

                    // Isi data untuk setiap baris yang dikloning
                    foreach ($filledTableData as $index => $rowData) {
                        // Mengisi kolom 'i' secara manual dengan nomor urut
                        // Ini memastikan outputnya adalah '1', '2', dst., bukan '${i#1}'
                        // Asumsi 'i' adalah nama placeholder untuk nomor urut
                        $templateProcessor->setValue('i#' . ($index + 1), (string) ($index + 1));
                        
                        foreach ($this->template->table_placeholders as $colPlaceholder) {
                            // Lewati 'i' karena sudah diisi di atas
                            if ($colPlaceholder === 'i') {
                                continue;
                            }
                            $value = $rowData[$colPlaceholder] ?? '';
                            $templateProcessor->setValue($colPlaceholder . '#' . ($index + 1), (string) $value);
                        }
                    }
                } else {
                    // Jika tidak ada data tabel yang diisi, Anda bisa menghapus block tabel.
                    // Ini hanya berfungsi jika template Anda mendefinisikan block (misal ${table_block} ... ${/table_block})
                    // Jika dynamic_table_marker Anda digunakan hanya untuk cloneRow di baris,
                    // maka baris kosong dengan marker itu akan tetap ada jika tidak diisi.
                    // Jika ingin tabelnya hilang, Anda perlu membungkus tabel di template dengan block.
                    // Untuk saat ini, kita biarkan baris kosong muncul jika tidak ada data yang diisi.
                }
            }

            // 5. Tentukan nama file output dan path-nya
            $outputFileName = 'surat_' . Str::slug($this->template->name) . '_' . time() . '.docx';
            $outputPathRelative = 'generated_letters/' . $outputFileName;
            $fullOutputPath = Storage::disk('public')->path($outputPathRelative);

            // 6. Pastikan direktori output ada, buat jika belum ada
            $outputDirectory = dirname($fullOutputPath);
            if (!file_exists($outputDirectory)) {
                mkdir($outputDirectory, 0755, true);
            }

            // 7. Simpan dokumen Word yang sudah diisi
            $templateProcessor->saveAs($fullOutputPath);

            // 8. Simpan path file yang dihasilkan ke properti Livewire untuk diunduh
            $this->generatedFilePath = $outputPathRelative;

            // 9. Simpan informasi surat yang dibuat ke database (Model Letter)
            $dataToSave = $this->formData; // Mulai dengan data umum
            if ($this->template->dynamic_table_marker) {
                $dataToSave['table_data'] = $this->tableData;
            }

            Letter::create([
                'template_id' => $this->template->id,
                'file_path' => $outputPathRelative,
                'data_filled' => $dataToSave,
                'user_id' => \Illuminate\Support\Facades\Auth::user()->id,
                'status' => 'verification_tendik', // Status awal untuk verifikasi Tendik
                // 'user_id' => auth()->id(), // Uncomment jika Anda melacak user
            ]);

            

            // Beri tahu pengguna bahwa surat berhasil dibuat
            session()->flash('message', 'Surat berhasil dibuat dan menunggu persetujuan!'); // Ubah pesan

        } catch (\Exception $e) {
            // Tangani error jika terjadi selama proses pembuatan surat
            session()->flash('error', 'Gagal membuat surat: ' . $e->getMessage());
        }
    }

    public function downloadLetter()
    {
        if ($this->generatedFilePath && Storage::disk('public')->exists($this->generatedFilePath)) {
            return Storage::download($this->generatedFilePath);
        }

        session()->flash('error', 'File tidak ditemukan untuk diunduh.');
        return redirect()->back();
    }


    public function render()
    {
        return view('livewire.edokumen.tendik.persuratan.generate-letter');
    }
}