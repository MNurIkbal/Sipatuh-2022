<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LevelPetugasModel;
use App\Models\PaketModel;
use App\Models\PetugasManModel;
use App\Models\PetugasModel;

class PetugasController extends BaseController
{
    public function index()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $level = new LevelPetugasModel();
        $data = [
            'level' =>  $level->findAll(),
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Petugas",
            'petugas'   =>  $petugas_man->where("travel_id",session()->get("travel_id"))->findAll(),
        ];
        return view("jamaah/petugas/index",$data);
    }

    public function add_petugas()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        if(!$this->validate([
            'file' => [
                "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
            ],
        ])) {
            session()->setFlashdata('error',$this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $dataBerkas = $this->request->getFile('file');
        $fileName = $dataBerkas->getRandomName();
        $foto = $fileName;
        $dataBerkas->move('assets/upload/', $fileName);
        $petugas = new PetugasManModel();

        $ch = $petugas->where("nama",$this->request->getVar("nama"))->first();
        $ch1 = $petugas->where("no_ktp",$this->request->getVar("no_ktp"))->first();
        if($ch || $ch1) {
            return redirect()->back()->with('error','Nama Atau No KTP Sudah Ada ');
        }

        $petugas->insert([
            'nama'  =>  $this->request->getVar("nama"),
            'no_ktp'  =>  $this->request->getVar("no_ktp"),
            'no_paspor'  =>  $this->request->getVar("no_paspor"),
            'tipe_petugas'  =>  $this->request->getVar("type"),
            'no_hp_satu'  =>  $this->request->getVar("hp_satu"),
            'no_hp_dua'  =>  $this->request->getVar("hp_dua"),
            'tgl_lahir'  =>  $this->request->getVar("tgl_lahir"),
            'email'  =>  $this->request->getVar("email"),
            'alamat'  =>  $this->request->getVar("alamat"),
            'aktif'  =>  $this->request->getVar("aktif"),
            'user_id'   =>  session()->get("id"),
            'travel_id' =>  session()->get("travel_id"),
            'foto'  =>  $foto
        ]);


        return redirect()->to("petugas")->with("success","Data Berhasil Ditambahkan");
    }

    public function edit_petugas_baru($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        if(!$this->validate([
            'file' => [
                "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
            ],
        ])) {
            session()->setFlashdata('error',$this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $dataBerkas = $this->request->getFile('file');
        if($dataBerkas->getError() === 4) {
            $foto  = $this->request->getVar("foto_lama");
        } else {
            $fileName = $dataBerkas->getRandomName();
            $foto = $fileName;
            $dataBerkas->move('assets/upload/', $fileName);
        }
        $petugas = new PetugasManModel();
        $petugas->update($id,[
            'nama'  =>  $this->request->getVar("nama"),
            'no_ktp'  =>  $this->request->getVar("no_ktp"),
            'no_paspor'  =>  $this->request->getVar("no_paspor"),
            'tipe_petugas'  =>  $this->request->getVar("type"),
            'no_hp_satu'  =>  $this->request->getVar("hp_satu"),
            'no_hp_dua'  =>  $this->request->getVar("hp_dua"),
            'tgl_lahir'  =>  $this->request->getVar("tgl_lahir"),
            'email'  =>  $this->request->getVar("email"),
            'alamat'  =>  $this->request->getVar("alamat"),
            'aktif'  =>  $this->request->getVar("aktif"),
            'foto'  =>  $foto
        ]);
        return redirect()->to("petugas")->with("success","Data Berhasil Diupdate");
    }

    public function hapus_petugas_baru($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $petugas = new PetugasManModel();
        $check_result = $petugas->where("id",$id)->first();
        $result = new PetugasModel();
        $check = $result->where("nama",$check_result['nama'])->first();
        if($check) {
            return redirect()->back()->with("error","Data Ini Tidak Boleh Dihapus Karena Sudah Berelasi");
        }

        $petugas->delete($id);
        return redirect()->to("petugas")->with("success","Data Berhasil Dihapus");
    }
}
