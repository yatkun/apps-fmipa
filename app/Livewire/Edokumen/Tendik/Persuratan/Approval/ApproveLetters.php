<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan\Approval;

use App\Models\Letter;

use Livewire\Component;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding; // Ditambahkan
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label; // Ditambahkan (walaupun tidak akan digunakan secara default)
use Endroid\QrCode\Logo\Logo;   // Ditambahkan (walaupun tidak akan digunakan secara default)
use Endroid\QrCode\RoundBlockSizeMode; // Ditambahkan
use Endroid\QrCode\Writer\PngWriter;

class ApproveLetters extends Component
{
    public $letterId;
    public $letter;
    public $rejectionReason;

    public function mount($letterId)
    {
        $this->letterId = $letterId;
        $this->letter = Letter::with('template', 'approver')->findOrFail($letterId);

        // Pastikan hanya surat 'pending' yang bisa disetujui/ditolak
        if ($this->letter->status !== 'pending') {
            session()->flash('error', 'Surat ini sudah diproses.');
            return redirect()->route('list.pending.letters');
        }

        // Contoh: Batasi akses hanya untuk Dekan
        // if (!auth()->user()->hasRole('dekan')) {
        //     abort(403, 'Anda tidak memiliki akses untuk menyetujui surat.');
        // }
    }

    public function approveLetter()
    {
        try {
            // Lakukan validasi tambahan jika diperlukan
            if ($this->letter->status !== 'pending') {
                session()->flash('error', 'Surat ini sudah tidak dalam status menunggu persetujuan.');
                return;
            }

            // Panggil method untuk menyisipkan TTD/Barcode
            $this->insertDigitalSignatureOrBarcode();

            $this->letter->status = 'approved';
            $this->letter->approved_by_user_id = Auth::user()->id; // Asumsi user yang login adalah approver
            $this->letter->approved_at = now();
            $this->letter->save();

            session()->flash('message', 'Surat berhasil disetujui dan ditandatangani!');
            return redirect()->route('list.pending.letters');

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyetujui surat: ' . $e->getMessage());
           
        }
    }

    public function rejectLetter()
    {
        $this->validate([
            'rejectionReason' => 'required|string|min:10', // Alasan penolakan wajib diisi
        ]);

        try {
            if ($this->letter->status !== 'pending') {
                session()->flash('error', 'Surat ini sudah tidak dalam status menunggu persetujuan.');
                return;
            }

            $this->letter->status = 'rejected';
            $this->letter->rejection_reason = $this->rejectionReason;
            $this->letter->approved_by_user_id = Auth::user()->id; // Asumsi user yang login adalah penolak auth()->id(); // Siapa yang menolak
            $this->letter->approved_at = now(); // Waktu penolakan
            $this->letter->save();

            session()->flash('success', 'Surat berhasil ditolak.');
            return redirect()->route('list.pending.letters');

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menolak surat: ' . $e->getMessage());
           
        }
    }

    /**
     * Metode untuk menyisipkan TTD atau Barcode ke dokumen Word.
     * Ini adalah bagian yang paling kompleks dan mungkin memerlukan library tambahan.
     * Contoh ini akan menyisipkan Barcode QR.
     */
    // ... (property, mount, approveLetter, rejectLetter methods tetap sama) ...

    /**
     * Metode untuk menyisipkan TTD atau Barcode ke dokumen Word.
     * Menggunakan Endroid\QrCode.
     */
    private function insertDigitalSignatureOrBarcode()
    {
        // Pastikan dokumen asli ada
        $originalFilePath = Storage::disk('public')->path($this->letter->file_path);
        if (!file_exists($originalFilePath)) {
            throw new \Exception("File surat asli tidak ditemukan untuk penyisipan TTD/Barcode.");
        }

        // Buat salinan untuk dimodifikasi agar tidak merusak file asli
        $modifiedFilePath = str_replace('.docx', '_approved.docx', $originalFilePath);
        // Pastikan direktori 'generated_letters' sudah ada
        $outputDirectory = dirname($modifiedFilePath);
        if (!file_exists($outputDirectory)) {
            mkdir($outputDirectory, 0755, true);
        }
        copy($originalFilePath, $modifiedFilePath);


        try {
            $templateProcessor = new TemplateProcessor($modifiedFilePath);

            // --- Logika untuk menyisipkan QR Code menggunakan Endroid\QrCode ---
            $qrPlaceholder = 'qr_code'; // Nama placeholder di template Anda untuk QR Code
            $signaturePlaceholder = 'tanda_tangan_dekan'; // Nama placeholder di template Anda untuk TTD

            // Data yang akan di-encode di QR Code (URL ke detail surat ini)
            $qrData = route('view.approved.letter', $this->letter->id);

            // Inisialisasi Writer
            $writer = new PngWriter();

            // Buat QR code dengan named arguments
            $qrCode = new QrCode(
                data: $qrData, // Data yang akan di-encode
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::High, // Menggunakan High untuk keamanan data
                size: 250, // Ukuran QR Code dalam piksel
                margin: 10, // Margin di sekitar QR Code
                roundBlockSizeMode: RoundBlockSizeMode::Margin, // Mode pembulatan blok
                foregroundColor: new Color(0, 0, 0), // Warna foreground (hitam)
                backgroundColor: new Color(255, 255, 255) // Warna background (putih)
            );

            // Optional: Tambahkan logo di tengah QR Code (jika Anda memiliki logo)
            // Contoh menggunakan logo:
            
            $logo = null;
            if (file_exists(public_path('assets/images/logo_usb.png'))) {
                $logo = new Logo(
                    path: public_path('assets/images/logo_usb.png'),
                    resizeToWidth: 50, // Ukuran logo di QR Code
                    punchoutBackground: true
                );
            }
        

            // Optional: Tambahkan label di bawah QR Code
            
            // $label = null;
            // $label = new Label(
            //     text: 'Validasi Surat', // Teks label
            //     textColor: new Color(0, 0, 0) // Warna teks label
            // );
            

            // Generate QR Code ke string
            // Jika Anda tidak menggunakan logo atau label, parameter bisa dihilangkan
            $result = $writer->write($qrCode , $logo); // Hanya $qrCode jika tidak ada logo/label
            $qrCodeImageContent = $result->getString();

            // Simpan QR Code sementara
            $qrCodeTempPath = storage_path('app/public/temp_qr_' . $this->letter->id . '.png');
            file_put_contents($qrCodeTempPath, $qrCodeImageContent);

            // Sisipkan QR Code ke dalam dokumen Word
            $templateProcessor->setImageValue($qrPlaceholder, [
                'path' => $qrCodeTempPath,
                'width' => 100, // Ukuran tampilan di Word
                'height' => 100,
                'ratio' => true,
            ]);

            // --- Logika untuk menyisipkan TTD (jika ada) ---
            $signatureImagePath = public_path('images/ttd_dekan.png'); // Ganti dengan path TTD asli
            if (file_exists($signatureImagePath)) {
                $templateProcessor->setImageValue($signaturePlaceholder, [
                    'path' => $signatureImagePath,
                    'width' => 150, // Ukuran TTD
                    'height' => 80,
                    'ratio' => true,
                ]);
            }

            // Simpan dokumen yang sudah dimodifikasi
            $templateProcessor->saveAs($modifiedFilePath);

            // Update path di database ke file yang sudah disetujui
            $this->letter->file_path = str_replace(Storage::disk('public')->path(''), '', $modifiedFilePath);
            $this->letter->save();

            // Hapus file QR Code sementara
            unlink($qrCodeTempPath);

        } catch (\Exception $e) {
           
            throw new \Exception("Gagal menyisipkan TTD/Barcode ke surat. Error: " . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.edokumen.tendik.persuratan.approval.approve-letters');
    }
}
