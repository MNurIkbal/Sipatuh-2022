<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JamaahModel;
use App\Models\KloterModel;
use App\Models\PaketModel;
use App\Models\PetugasModel;

class KloterController extends BaseController
{
    public function add_kloter()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $kloter = new KloterModel();
        $paket = new PaketModel();
        
        $kloter->insert([
            'nama'  =>  $this->request->getVar("kloter"),
            'paket_id'  =>  $this->request->getVar("id_paket"),
            'created_at'  =>  date("Y-m-d"),
            'status'  =>  $this->request->getVar("status"),
            'batas_jamaah'  =>  $this->request->getVar("batas")
        ]);

        $chek_dua = $kloter->where("paket_id",$this->request->getVar("id_paket"))->where("status",'Aktif')->first();
        if($chek_dua) {
            $paket->update($this->request->getVar("id_paket"),[
                'kelengkapan'   =>  'sudah'
            ]);
        }
        return redirect()->to("detail_paket/" . $this->request->getVar("id_paket"))->with("success","Data Berhasil Ditambahkan");
    }

    public function edit_kloter()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $kloter = new KloterModel();
        $kloter->update($this->request->getVar("id"),[
            'nama'  =>  $this->request->getVar("kloter"),
            'status'  =>  $this->request->getVar("status"),
            'batas_jamaah'  =>  $this->request->getVar("batas")
        ]);
        return redirect()->to("detail_paket/" . $this->request->getVar("id_paket"))->with("success","Data Berhasil Diupdate");
    }

    public function hapus_kloter()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $result = new JamaahModel();
        $kloter = new KloterModel();
        $petugas = new PetugasModel();
        $check_dua = $petugas->where("kloter_id",$this->request->getVar("id"))->first();
        $check_satu = $result->where("kloter_id",$this->request->getVar("id"))->first();
        if($check_satu || $check_dua) {
            return redirect()->back()->with("error","Data Ini Tidak Boleh Dihapus Karena Sudah Berelasi");
        }
        $kloter->delete($this->request->getVar("id"));
        $paket = new PaketModel();
        $chek_dua = $kloter->where("paket_id",$this->request->getVar("id_paket"))->where("status",'Aktif')->first();
        if(!$chek_dua) {
            $paket->update($this->request->getVar("id_paket"),[
                'kelengkapan'   =>  null
            ]);
        }
        return redirect()->to("detail_paket/" . $this->request->getVar("id_paket"))->with("success","Data Berhasil Dihapus");
    }
}
