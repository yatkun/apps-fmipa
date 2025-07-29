<?php

namespace App\Livewire\Edokumen\Tendik\Persuratan;

use Livewire\Component;
use App\Models\Template;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Element\Text;     // Import class Text
use PhpOffice\PhpWord\Element\Table;    // Import class Table
use PhpOffice\PhpWord\Element\TextRun; // Import class TextRun
use PhpOffice\PhpWord\Element\Paragraph; // Import class Paragraph

class UploadTemplate extends Component
{
    use WithFileUploads;

    public $name;
    public $templateFile;
    public $dynamicTableMarker;
    public $uploadedTemplate = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'templateFile' => 'required|file|mimes:docx|max:10240',
        'dynamicTableMarker' => 'nullable|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        $filePath = $this->templateFile->store('templates', 'public');

        list($generalPlaceholders, $tablePlaceholders) = $this->extractAndSeparatePlaceholders($filePath, $this->dynamicTableMarker);

        // --- TAMBAHKAN LOG INI UNTUK DEBUGGING ---

        // --- AKHIR LOG DEBUGGING ---

        $template = Template::create([
            'name' => $this->name,
            'file_path' => $filePath,
            'placeholders' => $generalPlaceholders ?? [],     // Pastikan ini selalu array, meskipun kosong
            'dynamic_table_marker' => $this->dynamicTableMarker,
            'table_placeholders' => $tablePlaceholders ?? [], // Juga pastikan ini selalu array
            'placeholder_hints' => [],
        ]);

        $this->uploadedTemplate = $template;
        session()->flash('message', 'Template berhasil diunggah!');

        $this->reset(['name', 'templateFile', 'dynamicTableMarker']);
    }

    private function extractAndSeparatePlaceholders(string $filePath, ?string $dynamicTableMarker): array
    {
        $fullPath = Storage::disk('public')->path($filePath);
        $allPlaceholdersFound = [];
        $tablePlaceholders = [];
        $generalPlaceholders = [];
  
        try {
            $phpWord = IOFactory::load($fullPath);

            // potentialTablePlaceholders akan diisi langsung dari recursive calls
            $potentialTablePlaceholders = [];

            foreach ($phpWord->getSections() as $section) {
                // Pastikan dynamicTableMarker selalu diteruskan
                $this->scanElementsForPlaceholders($section->getElements(), $allPlaceholdersFound, $dynamicTableMarker, $potentialTablePlaceholders);

                foreach ($section->getHeaders() as $header) {
                    $this->scanElementsForPlaceholders($header->getElements(), $allPlaceholdersFound, $dynamicTableMarker, $potentialTablePlaceholders);
                }
                foreach ($section->getFooters() as $footer) {
                    $this->scanElementsForPlaceholders($footer->getElements(), $allPlaceholdersFound, $dynamicTableMarker, $potentialTablePlaceholders);
                }
            }
        } catch (\Exception $e) {

            session()->flash('error', 'Gagal membaca atau memisahkan placeholder dari template: ' . $e->getMessage());
            return [[], []];
        }

        $allUniquePlaceholders = array_unique($allPlaceholdersFound);
        $potentialTablePlaceholders = array_unique($potentialTablePlaceholders);

        foreach ($allUniquePlaceholders as $ph) {
            // Placeholder umum adalah semua yang ditemukan MINUS placeholder tabel
            // dan MINUS dynamicTableMarker itu sendiri (jika dynamicTableMarker ada)
            if (!in_array($ph, $potentialTablePlaceholders) && $ph !== $dynamicTableMarker) {
                $generalPlaceholders[] = $ph;
            }
        }

        // Placeholder tabel adalah yang terdeteksi bersama dynamicTableMarker
        // dan bukan dynamicTableMarker itu sendiri
        foreach ($potentialTablePlaceholders as $ph) {
            if ($ph !== $dynamicTableMarker) {
                $tablePlaceholders[] = $ph;
            }
        }

        return [array_values($generalPlaceholders), array_values($tablePlaceholders)];
    }

    private function scanElementsForPlaceholders(array $elements, array &$allPlaceholdersFound, ?string $dynamicTableMarker, array &$potentialTablePlaceholders)
    {
        foreach ($elements as $element) {
            if ($element instanceof TextRun || $element instanceof Text) {
                $text = $element->getText();
                preg_match_all('/\$\{(.*?)\}/', $text, $matches);
                $placeholdersInThisElement = [];

                foreach ($matches[1] as $match) {
                    $trimmedMatch = trim($match);
                    $allPlaceholdersFound[] = $trimmedMatch;
                    $placeholdersInThisElement[] = $trimmedMatch;
                }

                // Jika dynamicTableMarker ditemukan di elemen teks ini,
                // semua placeholder lain di elemen ini (kecuali marker itu sendiri)
                // dianggap sebagai potentialTablePlaceholders.
                if ($dynamicTableMarker && in_array($dynamicTableMarker, $placeholdersInThisElement)) {
                    foreach ($placeholdersInThisElement as $ph) {
                        if ($ph !== $dynamicTableMarker) {
                            $potentialTablePlaceholders[] = $ph; // Langsung tambahkan ke array global
                        }
                    }
                }
            } elseif ($element instanceof Table) {
                foreach ($element->getRows() as $row) {
                    $rowContainsDynamicTableMarker = false;
                    $placeholdersInThisRow = []; // Akumulator placeholder untuk baris ini

                    foreach ($row->getCells() as $cell) {
                        // Panggil rekursif untuk sel.
                        // *PENTING*: Lewatkan $potentialTablePlaceholders utama, BUKAN array sementara.
                        $this->scanElementsForPlaceholders($cell->getElements(), $allPlaceholdersFound, $dynamicTableMarker, $potentialTablePlaceholders);

                        // Setelah rekursi sel, kumpulkan placeholder dari teks sel itu sendiri
                        // untuk menentukan apakah baris ini memiliki dynamicTableMarker
                        // dan placeholder yang terkait dengannya.
                        $cellText = '';
                        foreach ($cell->getElements() as $cellElement) {
                            if ($cellElement instanceof TextRun || $cellElement instanceof Text) {
                                $cellText .= $cellElement->getText();
                            }
                        }
                        preg_match_all('/\$\{(.*?)\}/', $cellText, $cellMatches);
                        foreach ($cellMatches[1] as $cellMatch) {
                            $trimmedCellMatch = trim($cellMatch);
                            $placeholdersInThisRow[] = $trimmedCellMatch;
                            if ($dynamicTableMarker && $trimmedCellMatch === $dynamicTableMarker) {
                                $rowContainsDynamicTableMarker = true;
                            }
                        }
                    }

                    // Jika dynamicTableMarker ditemukan di baris ini,
                    // maka semua placeholder lain di baris ini (kecuali marker itu sendiri)
                    // dianggap sebagai potentialTablePlaceholders.
                    if ($rowContainsDynamicTableMarker) {
                        foreach (array_unique($placeholdersInThisRow) as $ph) {
                            if ($ph !== $dynamicTableMarker) {
                                $potentialTablePlaceholders[] = $ph; // Langsung tambahkan ke array global
                            }
                        }
                    }
                }
            }
            // Tambahkan elemen lain yang mungkin mengandung teks jika diperlukan (misalnya Image, Drawing)
        }
    }

    public function render()
    {
        return view('livewire.edokumen.tendik.persuratan.upload-template');
    }
}
