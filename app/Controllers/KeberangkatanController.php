<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Keberangkatan;
use App\Models\PaketModel;

class KeberangkatanController extends BaseController
{
    public function tambah_keberangkatan()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        // cara membuat kondisi
        $pakets_baru = new PaketModel();
        $paket_tes = $pakets_baru->where('id',$this->request->getVar("id"))->first();
        $star_waktu = date("Y-m-d",strtotime($paket_tes['tgl_berangkat']));
        $end_waktu = date("Y-m-d",strtotime($paket_tes['tgl_pulang']));
        $awal  = date("Y-m-d",strtotime($this->request->getVar("tgl_berangkat")));
        $end =  date("Y-m-d",strtotime($this->request->getVar("tgl_tiba")));
        if($awal < $star_waktu) {
            return redirect()->back()->with("error","Waktu Berangkat Kurang Dari Waktu Keberangkatan Paket");
        } elseif($end > $end_waktu) {
            return redirect()->back()->with("error","Waktu Kepulangan Melebihi Dari Waktu Pulang  Paket");
        } 
        if($end <= $awal) {
            return redirect()->back()->with("error","Waktu Pulang Tidak Boleh Kurang Atau Sama Dengan Waktu Keberangkatan");
        }
        $keberangkatan = new Keberangkatan();
        $keberangkatan->insert([
            'maskapai'  =>  $this->request->getVar("maskapai"),
            'nomor'  =>  $this->request->getVar("nomor"),
            'nama_bandara'  =>  $this->request->getVar("bandara_berangkat"),
            'tgl_berangkat'  =>  $this->request->getVar("tgl_berangkat"),
            'jam_berangkat'  =>  $this->request->getVar("jam_berangkat"),
            'bandara_tiba'  =>  $this->request->getVar("bandara_tiba"),
            'tgl_bandara_tiba'  =>  $this->request->getVar("tgl_tiba"),
            'jam_tiba'  =>  $this->request->getVar("jam_tiba"),
            'paket_id'  =>  $this->request->getVar("id"),
            'created_at'  =>  date("Y-m-d"),
            'update_at'  =>  date("Y-m-d"),
            'kategori' =>   'perencanaan'
        ]);

        return redirect()->to("detail_paket/" . $this->request->getVar("id"))->with("success","Data Berhasil Ditambahkan");
    }

    public function edit_keberangkatan()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $pakets_baru = new PaketModel();
        $paket_tes = $pakets_baru->where('id',$this->request->getVar("id_paket"))->first();
        $star_waktu = date("Y-m-d",strtotime($paket_tes['tgl_berangkat']));
        $end_waktu = date("Y-m-d",strtotime($paket_tes['tgl_pulang']));
        $awal  = date("Y-m-d",strtotime($this->request->getVar("tgl_berangkat")));
        $end =  date("Y-m-d",strtotime($this->request->getVar("tgl_tiba")));
        if($awal < $star_waktu) {
            return redirect()->back()->with("error","Waktu Berangkat Kurang Dari Waktu Keberangkatan Paket");
        } elseif($end > $end_waktu) {
            return redirect()->back()->with("error","Waktu Kepulangan Melebihi Dari Waktu Pulang  Paket");
        } 
        if($end <= $awal) {
            return redirect()->back()->with("error","Waktu Pulang Tidak Boleh Kurang Atau Sama Dengan Waktu Keberangkatan");
        }
        $keberangkatan = new Keberangkatan();
        $keberangkatan->update($this->request->getVar("id"),[
            'maskapai'  =>  $this->request->getVar("maskapai"),
            'nomor'  =>  $this->request->getVar("nomor"),
            'nama_bandara'  =>  $this->request->getVar("bandara_berangkat"),
            'tgl_berangkat'  =>  $this->request->getVar("tgl_berangkat"),
            'jam_berangkat'  =>  $this->request->getVar("jam_berangkat"),
            'bandara_tiba'  =>  $this->request->getVar("bandara_tiba"),
            'tgl_bandara_tiba'  =>  $this->request->getVar("tgl_tiba"),
            'jam_tiba'  =>  $this->request->getVar("jam_tiba"),
            'created_at'  =>  date("Y-m-d"),
            'update_at'  =>  date("Y-m-d"),
        ]);

        return redirect()->to("detail_paket/" . $this->request->getVar("id_paket"))->with("success","Data Berhasil Diupdate");
    }

    public function hapus_keberangkatan()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $keberangkatan = new Keberangkatan();
        $keberangkatan->delete($this->request->getVar("id"));
        return redirect()->to("detail_paket/" . $this->request->getVar("id_paket"))->with("success","Data Berhasil Dihapus");
    }
}
