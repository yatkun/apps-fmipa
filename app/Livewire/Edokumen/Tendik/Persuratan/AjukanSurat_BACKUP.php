<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan;

use App\Models\Letter;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Services\TelegramNotificationService;

class AjukanSurat extends Component
{
    public $templateId;
    public $customTitle;
    public $customContent;
    public $catatan;
    public $templates;
    public $formData = [];
    public $placeholderHints = [];
    public $tableData = [];
    public $templateSelected = false;
    public $dosenPlaceholders = [];
    public $tendikPlaceholders = [];

    protected $telegramService;

    public function boot()
    {
        $this->telegramService = new TelegramNotificationService();
    }

    public function mount($templateId = null)
    {
        $this->templates = \App\Models\Template::all();
        $this->tableData = [];
        
        // Ensure telegram service is initialized
        if (!$this->telegramService) {
            $this->telegramService = new TelegramNotificationService();
        }
        
        // Handle route parameter for template selection
        if ($templateId && is_numeric($templateId)) {
            $templateExists = $this->templates->where('id', $templateId)->first();
            if ($templateExists) {
                $this->templateId = $templateId;
                $this->processSelectedTemplate();
                $this->templateSelected = true;
                // Dispatch event to update frontend select
                $this->dispatch('template-selected', ['templateId' => $templateId]);
            }
        } elseif ($templateId === 'custom') {
            // Handle custom template
            $this->templateId = 'custom';
            $this->templateSelected = true;
            $this->dispatch('template-selected', ['templateId' => 'custom']);
        }
    }

    public function pilihTemplate()
    {
        // Validasi apakah templateId sudah ada
        if (!$this->templateId) {
            $this->templateSelected = false;
            return; // Tidak ada template yang dipilih
        }

        // Simpan templateId untuk mencegah reset
        $selectedTemplateId = $this->templateId;
        
        // Reset data yang spesifik saja, jangan reset templateId
        $this->formData = [];
        $this->placeholderHints = [];
        $this->tableData = [];
        $this->dosenPlaceholders = [];
        $this->tendikPlaceholders = [];
        $this->templateSelected = false;
        
        // Restore templateId
        $this->templateId = $selectedTemplateId;
        
        // Proses template yang sudah dipilih
        $this->processSelectedTemplate();
        
        // Set template sebagai terpilih
        $this->templateSelected = true;
        
        // Force re-render by dispatching browser event
        $this->dispatch('template-changed', ['templateId' => $this->templateId]);
     
    }

    public function processSelectedTemplate()
    {
        if ($this->templateId && $this->templateId !== 'custom') {
            $template = \App\Models\Template::find($this->templateId);
            if ($template && $template->placeholders) {
                $permissions = $template->placeholder_permissions ?? [];
                // Pisahkan placeholder berdasarkan permission
                foreach ($template->placeholders as $placeholder) {
                    $permission = $permissions[$placeholder] ?? 'dosen';
                    
                    // Skip placeholder sistem (qr_code, ttd) - tidak ditampilkan ke user
                    if ($permission === 'system') {
                        continue; // Tidak ditambahkan ke form input manapun
                    }
                    
                    if ($permission === 'dosen') {
                        $this->dosenPlaceholders[] = $placeholder;
                        $this->formData[$placeholder] = '';
                    } else {
                        $this->tendikPlaceholders[] = $placeholder;
                    }
                }
            }
            
            $this->placeholderHints = $template->placeholder_hints ?? [];
            
            // Inisialisasi table dinamis jika ada
            if ($template && $template->dynamic_table_marker && !empty($template->table_placeholders)) {
                $initialRow = [];
                foreach ($template->table_placeholders as $ph) {
                    $initialRow[$ph] = '';
                }
                if (!empty($initialRow)) {
                    $this->tableData = [$initialRow];
                } else {
                    $this->tableData = [];
                }
            } else {
                $this->tableData = [];
            }
            $this->templateSelected = true;
        } elseif ($this->templateId === 'custom') {
            $this->templateSelected = true;
        }
    }

    public function submit()
    {
        if ($this->templateId === 'custom') {
            $this->validate([
                'customTitle' => 'required|string|max:255',
                'customContent' => 'required|string',
            ]);
            
            // Untuk surat custom, buat dengan status 'draft' atau 'waiting_template'
            $letter = new \App\Models\Letter();
            $letter->title = $this->customTitle;
            $letter->file_path = '';
            $letter->user_id = Auth::id();
            $letter->status = 'waiting_template'; // Status khusus untuk menunggu template dari Tendik
            $dataFilled = $this->formData;
            $dataFilled['custom_content'] = $this->customContent;
            $dataFilled['catatan'] = $this->catatan;
            $letter->data_filled = $dataFilled;
            $letter->save();

            // Kirim notifikasi ke Tendik untuk membuat template
            $dosen = Auth::user();
            $message = 'Permintaan surat custom dari Dosen: ' . $dosen->name . ', judul: ' . $letter->title;

            $phone_id = '698591980013677';
            $recipient = '6285155103646'; // Nomor Tendik
            $token = env('META_LONG_LIVED_TOKEN');
            
            try {
                $response = Http::withToken($token)
                    ->post('https://graph.facebook.com/v22.0/' . $phone_id . '/messages', [
                        'messaging_product' => 'whatsapp',
                        'to' => $recipient,
                        'type' => 'text',
                        'text' => [
                            'body' => "📋 *PERMINTAAN SURAT CUSTOM*\n\n" .
                                    "Dosen: {$dosen->name}\n" .
                                    "Judul: {$letter->title}\n" .
                                    "Detail: {$this->customContent}\n\n" .
                                    "Silahkan buat template dokumen dengan placeholder \${qr_code} dan upload ke sistem."
                        ]
                    ]);
                
                // Log response untuk debugging
                Log::info('WhatsApp notification sent for custom letter', [
                    'letter_id' => $letter->id,
                    'response' => $response->json()
                ]);
            } catch (\Exception $e) {
                // Jika gagal kirim notifikasi, tetap lanjutkan proses
                Log::error('Failed to send WhatsApp notification for custom letter', [
                    'letter_id' => $letter->id,
                    'error' => $e->getMessage()
                ]);
            }

            session()->flash('success', 'Permintaan surat custom berhasil dikirim. Tendik akan membuat template dokumen dan surat akan muncul di daftar menunggu persetujuan setelah template selesai.');
            return redirect()->route('dosen.persuratan.list-pending-letters');
        } else {
            $template = \App\Models\Template::find($this->templateId);
            if (!$template) {
                session()->flash('error', 'Template surat tidak ditemukan.');
                return;
            }
            
            // Validasi hanya placeholder yang diizinkan untuk dosen
            $rules = [];
            if ($template->placeholders) {
                $placeholderPermissions = $template->placeholder_permissions ?? [];
                
                foreach ($template->placeholders as $ph) {
                    // Hanya validasi jika permission adalah 'dosen' atau tidak ada permission (default dosen)
                    $permission = $placeholderPermissions[$ph] ?? 'dosen';
                    if ($permission === 'dosen') {
                        $rules['formData.' . $ph] = 'required|string';
                    }
                }
            }
            
            // Validasi table dinamis jika ada
            if ($template->dynamic_table_marker && !empty($template->table_placeholders)) {
                foreach ($this->tableData as $idx => $row) {
                    foreach ($template->table_placeholders as $ph) {
                        $rules['tableData.' . $idx . '.' . $ph] = 'required|string';
                    }
                }
            }
            
            $this->validate($rules);
            $letter = new \App\Models\Letter();
            $letter->template_id = $template->id;
            $letter->title = $template->name;
            $letter->user_id = Auth::id();
            $letter->status = 'verification_tendik';
            $letter->file_path = '';
            $dataFilled = $this->formData;
            $dataFilled['table_data'] = $this->tableData;
            $dataFilled['catatan'] = $this->catatan;
            $letter->data_filled = $dataFilled;
            $letter->save();

            // Send Telegram notification for new letter submission
            if ($this->telegramService) {
                $this->telegramService->notifyLetterSubmitted($letter);
            } else {
                Log::warning('Telegram service not available for notification', [
                    'letter_id' => $letter->id
                ]);
            }

            // Generate file surat dari template docx
            try {
                $templateSourcePath = Storage::disk('public')->path($template->file_path);
                if (!Storage::disk('public')->exists($template->file_path)) {
                    throw new \Exception("File template tidak ditemukan: " . $templateSourcePath);
                }
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templateSourcePath);
                // Isi placeholder umum
                foreach ($dataFilled as $placeholder => $value) {
                    if ($placeholder !== 'table_data' && $placeholder !== 'catatan') {
                        $templateProcessor->setValue($placeholder, (string) $value);
                    }
                }
                // Tabel dinamis
                if ($template->dynamic_table_marker && !empty($template->table_placeholders)) {
                    $filledTableData = array_filter($this->tableData, function ($item) {
                        foreach ($item as $value) {
                            if (!empty($value)) return true;
                        }
                        return false;
                    });
                    if (!empty($filledTableData)) {
                        $templateProcessor->cloneRow($template->dynamic_table_marker, count($filledTableData));
                        foreach ($filledTableData as $index => $rowData) {
                            $templateProcessor->setValue('i#' . ($index + 1), (string) ($index + 1));
                            foreach ($template->table_placeholders as $colPlaceholder) {
                                if ($colPlaceholder === 'i') continue;
                                $value = $rowData[$colPlaceholder] ?? '';
                                $templateProcessor->setValue($colPlaceholder . '#' . ($index + 1), (string) $value);
                            }
                        }
                    }
                }
                
                // Simpan ke storage lokal terlebih dahulu
                $slug = \Illuminate\Support\Str::slug($letter->title);
                $timestamp = time();
                $fileName = 'surat_' . $slug . '_' . $timestamp . '.docx';
                $outputPathRelative = 'generated_letters/' . $fileName;
                $fullOutputPath = Storage::disk('public')->path($outputPathRelative);

                // Pastikan direktori output ada
                $outputDirectory = dirname($fullOutputPath);
                if (!file_exists($outputDirectory)) {
                    mkdir($outputDirectory, 0755, true);
                }

                // Simpan dokumen Word yang sudah diisi ke storage lokal
                $templateProcessor->saveAs($fullOutputPath);
                
                // Update path di database (simpan path relatif untuk storage lokal)
                $letter->file_path = $outputPathRelative;
                $letter->save();
            } catch (\Exception $e) {
                // Jika gagal generate file, file_path tetap kosong
            }
        }

        // Hanya kirim notifikasi untuk surat dengan template (bukan custom)
        // if ($this->templateId !== 'custom') {
        //     $dosen = Auth::user();
        //     $message = 'Surat baru telah diajukan oleh Dosen: ' . $dosen->name . ', judul: ' . ($this->formData['title'] ?? $letter->title);

        //     // WhatsApp Business API Meta - kirim pesan pakai template hello_world sesuai curl user
        //     $phone_id = '698591980013677';
        //     $recipient = '6285155103646';
        //     $token = env('META_LONG_LIVED_TOKEN');
        //     $response = Http::withToken($token)
        //         ->post('https://graph.facebook.com/v22.0/' . $phone_id . '/messages', [
        //             'messaging_product' => 'whatsapp',
        //             'to' => $recipient,
        //             'type' => 'template',
        //             'template' => [
        //                 'name' => 'ajukan_surat',
        //                 'language' => [ 'code' => 'id' ],
        //                 'components' => [
        //                     [
        //                         'type' => 'body',
        //                         'parameters' => [
        //                             ['type' => 'text', 'text' => 'Tendik'], // {{1}} Nama penerima
        //                             ['type' => 'text', 'text' => $dosen->name], // {{2}} Nama pengaju
        //                             ['type' => 'text', 'text' => $letter->title], // {{3}} Judul surat
        //                             ['type' => 'text', 'text' => date('d-m-Y')], // {{4}} Tanggal surat
        //                         ],
        //                     ],
        //                 ]
        //             ]
        //         ]);
           
        //     // Optional: log response jika perlu
        //     // \Log::info('WA Business response: ', $response->json());
        //     dd($response->json()); // Hapus ini jika tidak ingin melihat response
            
            session()->flash('success', 'Surat berhasil diajukan.');
        
        
        return redirect()->route('dosen.persuratan.list-pending-letters');
    }

    public function render()
    {
        return view('livewire.EDOKUMEN.tendik.persuratan.ajukan-surat', [
            'templates' => $this->templates,
            'templateId' => $this->templateId,
            'formData' => $this->formData,
            'placeholderHints' => $this->placeholderHints,
        ]);
    }

    public function addTableRow()
    {
        $template = \App\Models\Template::find($this->templateId);
        if ($template && $template->table_placeholders) {
            $newRow = [];
            foreach ($template->table_placeholders as $ph) {
                $newRow[$ph] = '';
            }
            $this->tableData[] = $newRow;
        }
    }
    public function removeTableRow($idx)
    {
        if (count($this->tableData) > 1) {
            array_splice($this->tableData, $idx, 1);
        } else {
            // Kosongkan baris jika hanya satu
            foreach ($this->tableData[0] as $ph => $val) {
                $this->tableData[0][$ph] = '';
            }
        }
    }
}
