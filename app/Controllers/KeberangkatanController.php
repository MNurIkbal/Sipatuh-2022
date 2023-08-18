<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Keberangkatan;
use App\Models\PaketModel;
use PHPUnit\Framework\MockObject\DuplicateMethodException;

class KeberangkatanController extends BaseController
{
    public function tambah_keberangkatan()
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        // if (session()->get('level_id') !== "jamaah") {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException();
        // }
        // cara membuat kondisi
        try {
            $pakets_baru = new PaketModel();
            $paket_tes = $pakets_baru->where('id', $this->request->getVar("id"))->first();
            $time_waktu = $this->request->getVar('tgl_berangkat');
            $parts = explode(' - ', $time_waktu);
            $tanggalWaktuPertama = $parts[0]; // "18/09/2023 17:00"
            $tanggalWaktuKedua = $parts[1];
            $tgl_pertaman = explode(' ', $tanggalWaktuPertama);

            // waktu pertaman
            $time_satu = $tgl_pertaman[0];
            $time_dua = $tgl_pertaman[1];
            list($day, $month, $year) = explode('/', $time_satu);
            $newDateFormat = sprintf('%04d-%02d-%02d', $year, $month, $day);

            $tgl_two = explode(' ', $tanggalWaktuKedua);

            //waktu kedua
            $time_lima  = $tgl_two[0];
            $time_enam = $tgl_two[1];
            list($haris, $bulans, $tahuns) = explode('/', $time_lima);
            $newDateFormat_dua = sprintf('%04d-%02d-%02d', $tahuns, $bulans, $haris);

            
            $keberangkatan = new Keberangkatan();
            $keberangkatan->insert([
                'maskapai'  =>  $this->request->getVar("maskapai"),
                'nomor'  =>  $this->request->getVar("nomor"),
                'nama_bandara'  =>  $this->request->getVar("bandara_berangkat"),
                'tgl_berangkat'  =>  $newDateFormat,
                'jam_berangkat'  =>  $time_dua,
                'bandara_tiba'  =>  $this->request->getVar("bandara_tiba"),
                'tgl_bandara_tiba'  =>  $newDateFormat_dua,
                'jam_tiba'  =>  $time_enam,
                'paket_id'  =>  $this->request->getVar("id"),
                'created_at'  =>  date("Y-m-d"),
                'update_at'  =>  date("Y-m-d"),
                'kategori' =>   'perencanaan'
            ]);

            return redirect()->to("detail_paket/" . $this->request->getVar("id"))->with("success", "Data Berhasil Ditambahkan");
        } catch (\Throwable $th) {
            return redirect()->to("detail_paket/" . $this->request->getVar("id"))->with("error", "Data Gagal Ditambahkan");
            //throw $th;
        }
    }

    public function edit_keberangkatan()
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        // if (session()->get('level_id') !== "jamaah") {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException();
        // }
        $pakets_baru = new PaketModel();
        $time_waktu = $this->request->getVar('tgl_berangkat');
        $parts = explode(' - ', $time_waktu);
        $tanggalWaktuPertama = $parts[0]; // "18/09/2023 17:00"
        $tanggalWaktuKedua = $parts[1];
        $tgl_pertaman = explode(' ', $tanggalWaktuPertama);

        // waktu pertaman
        $time_satu = $tgl_pertaman[0];
        $time_dua = $tgl_pertaman[1];
        list($day, $month, $year) = explode('/', $time_satu);
        $newDateFormat = sprintf('%04d-%02d-%02d', $year, $month, $day);


        $tgl_two = explode(' ', $tanggalWaktuKedua);

        //waktu kedua
        $time_lima  = $tgl_two[0];
        $time_enam = $tgl_two[1];
        list($hari, $bulan, $tahun) = explode('/', $time_lima);
        $newDateFormat_dua = sprintf('%04d-%02d-%02d', $tahun, $bulan, $hari);

        $keberangkatan = new Keberangkatan();
        $keberangkatan->update($this->request->getVar("id"), [
            'maskapai'  =>  $this->request->getVar("maskapai"),
            'nomor'  =>  $this->request->getVar("nomor"),
            'nama_bandara'  =>  $this->request->getVar("bandara_berangkat"),
            'tgl_berangkat'  =>  $newDateFormat,
            'jam_berangkat'  =>  $time_dua,
            'bandara_tiba'  =>  $this->request->getVar("bandara_tiba"),
            'tgl_bandara_tiba'  =>  $newDateFormat_dua,
            'jam_tiba'  =>  $time_enam,
            'created_at'  =>  date("Y-m-d"),
            'update_at'  =>  date("Y-m-d"),
        ]);

        return redirect()->to("detail_paket/" . $this->request->getVar("id_paket"))->with("success", "Data Berhasil Diupdate");
    }

    public function hapus_keberangkatan()
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        // if (session()->get('level_id') !== "jamaah") {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException();
        // }
        $keberangkatan = new Keberangkatan();
        $keberangkatan->delete($this->request->getVar("id"));
        return redirect()->to("detail_paket/" . $this->request->getVar("id_paket"))->with("success", "Data Berhasil Dihapus");
    }
}
