<?php

namespace App\Livewire\Forms;

use App\Models\Ikulima;
use Livewire\Form;
use App\Models\Ikusatu;
use App\Models\Ikutiga;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class IkulimaForm extends Form
{
    #[Validate(['required'])]
    public string $nama = '';

    #[Validate(['required'])]
    public string $kriteria = '';

    #[Validate(['required'])]
    public string $jenis_karya = '';

    #[Validate(['required'])]
    public string $tanggal = '';

    #[Validate(['required'])]
    public string $keterangan = '';


    protected $listeners = [
        'jenis_karya',
    ];

    public $ikulima_id;

    public function jk($value)
    {
        $this->jenis_karya = $value;
    }

    public function store()
    {

        $validate = $this->validate();

        if ($validate['kriteria'] == 'Buku referensi' || $validate['kriteria'] == 'Jurnal internasional bereputasi' || $validate['kriteria'] == 'Buku nasional/internasional yang mempunyai ISBN') {
            $validate['bobot'] = 0.8;
        } elseif (
            $validate['kriteria'] == 'Buku nasional/internasional yang mempunyai ISBN' || $validate['kriteria'] == 'Book chapter internasional' ||
            $validate['kriteria'] == 'Jurnal nasional berbahasa inggris atau bahasa resmi PBB terindeks pada DOAJ' ||
            $validate['kriteria'] == 'Prosiding internasional dalam seminar internasional, dalam bentuk monograf, atau ' ||
            $validate['kriteria'] == 'Hasil penelitian kerjasama industri termasuk penugasan dari kementerian atau
                LPNK yang tidak dipublikasikan'
        ) {
            $validate['bobot'] = 0.6;
        } elseif (
            $validate['kriteria'] == 'Untuk Karya Tulis Ilmiah yang tidak masuk dalam Kriteria di atas'
        ) {
            $validate['bobot'] = 0.4;
        } elseif (
            $validate['kriteria'] == 'Karya Terapan yang diterapkan/digunakan/diaplikasikan pada Dunia Usaha dan Dunia Industri atau Masyarakat pada tingkat internasional atau Nasional; atau' ||
            $validate['kriteria'] == 'Hasil Rancangan Teknologi/Seni yang dipatenkan secara internasional'
        ) {
            $validate['bobot'] = 1.0;
        } elseif (
            $validate['kriteria'] == 'Karya Terapan yang belum diterapkan tetapi sudah mendapatkan ijin edar atau sudah terstandarisasi' ||
            $validate['kriteria'] == 'Hasil Rancangan Teknologi/Seni yang dipatenkan secara Nasional; atau melaksanakan pengembangan hasil pendidikan dan penelitian'
        ) {
            $validate['bobot'] = 0.8;
        } elseif (
            $validate['kriteria'] == 'Melaksanakan dan/atau menghasilkan karya seni atau kegiatan seni pada tingkat internasional'
        ) {
            $validate['bobot'] = 0.9;
        } elseif (
            $validate['kriteria'] == 'Melaksanakan dan/atau menghasilkan karya seni atau kegiatan seni pada tingkat Nasional' ||
            $validate['kriteria'] == 'Membuat rancangan karya seni atau kegiatan seni tingkat internasional; atau melaksanakan penelitian di bidang seni yang dipatenkan atau dipublikasikan dalam seminar nasional'
        ) {
            $validate['bobot'] = 0.7;
        } elseif (
            $validate['kriteria'] == 'Melaksanakan dan/atau menghasilkan karya seni atau kegiatan seni pada tingkat lokal' ||
            $validate['kriteria'] == 'Membuat rancangan karya seni atau kegiatan seni tingkat nasional; atau melaksanakan penelitian di bidang seni yang tidak dipatenkan atau dipublikasikan'
        ) {
            $validate['bobot'] = 0.5;
        }


        Ikulima::create($validate);
    }


    public function update()
    {
        $validate = $this->validate();

        if ($validate['kriteria'] == 'Buku referensi' || $validate['kriteria'] == 'Jurnal internasional bereputasi' || $validate['kriteria'] == 'Buku nasional/internasional yang mempunyai ISBN') {
            $validate['bobot'] = 0.8;
        } elseif (
            $validate['kriteria'] == 'Buku nasional/internasional yang mempunyai ISBN' || $validate['kriteria'] == 'Book chapter internasional' ||
            $validate['kriteria'] == 'Jurnal nasional berbahasa inggris atau bahasa resmi PBB terindeks pada DOAJ' ||
            $validate['kriteria'] == 'Prosiding internasional dalam seminar internasional, dalam bentuk monograf, atau ' ||
            $validate['kriteria'] == 'Hasil penelitian kerjasama industri termasuk penugasan dari kementerian atau
                LPNK yang tidak dipublikasikan'
        ) {
            $validate['bobot'] = 0.6;
        } elseif (
            $validate['kriteria'] == 'Untuk Karya Tulis Ilmiah yang tidak masuk dalam Kriteria di atas'
        ) {
            $validate['bobot'] = 0.4;
        } elseif (
            $validate['kriteria'] == 'Karya Terapan yang diterapkan/digunakan/diaplikasikan pada Dunia Usaha dan Dunia Industri atau Masyarakat pada tingkat internasional atau Nasional; atau' ||
            $validate['kriteria'] == 'Hasil Rancangan Teknologi/Seni yang dipatenkan secara internasional'
        ) {
            $validate['bobot'] = 1.0;
        } elseif (
            $validate['kriteria'] == 'Karya Terapan yang belum diterapkan tetapi sudah mendapatkan ijin edar atau sudah terstandarisasi' ||
            $validate['kriteria'] == 'Hasil Rancangan Teknologi/Seni yang dipatenkan secara Nasional; atau melaksanakan pengembangan hasil pendidikan dan penelitian'
        ) {
            $validate['bobot'] = 0.8;
        } elseif (
            $validate['kriteria'] == 'Melaksanakan dan/atau menghasilkan karya seni atau kegiatan seni pada tingkat internasional'
        ) {
            $validate['bobot'] = 0.9;
        } elseif (
            $validate['kriteria'] == 'Melaksanakan dan/atau menghasilkan karya seni atau kegiatan seni pada tingkat Nasional' ||
            $validate['kriteria'] == 'Membuat rancangan karya seni atau kegiatan seni tingkat internasional; atau melaksanakan penelitian di bidang seni yang dipatenkan atau dipublikasikan dalam seminar nasional'
        ) {
            $validate['bobot'] = 0.7;
        } elseif (
            $validate['kriteria'] == 'Melaksanakan dan/atau menghasilkan karya seni atau kegiatan seni pada tingkat lokal' ||
            $validate['kriteria'] == 'Membuat rancangan karya seni atau kegiatan seni tingkat nasional; atau melaksanakan penelitian di bidang seni yang tidak dipatenkan atau dipublikasikan'
        ) {
            $validate['bobot'] = 0.5;
        }




        Ikulima::where('id', $this->ikulima_id)->update($validate);
    }
}
