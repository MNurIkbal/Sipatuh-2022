<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaketModel;
use App\Models\PetugasManModel;
use App\Models\ProfileModel;
use App\Models\TravelModel;
use Config\Database;

class ProfilController extends BaseController
{
    public function index()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $db = Database::connect();
        $profil = new ProfileModel();
        $perusahaan = new TravelModel();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Profil",
            'petugas'   =>  $petugas_man->findAll(),
            'db'    =>  $db,
            'perusahaan'    =>  $perusahaan->orderby('nama_travel','asc')->findAll(),
            'provinsi'  =>  $db->query("SELECT * FROM provinces")->getResultArray(),
            'profil'    =>  $profil->where("id",session()->get("travel_id"))->first(),
        ];
        return view("jamaah/profil/index",$data);
    }

    public function update_profile()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $id = $this->request->getVar("id_user");
        $profile = new ProfileModel();
        $result = $profile->where("user_id",$id)->first();
        $dataBerkas = $this->request->getFile('file');
        if($dataBerkas->getError() === 4) {
            $gambar = $this->request->getVar("foto_lama");
        }  else {
            $fileName = $dataBerkas->getRandomName();
            $gambar = $fileName;
            $dataBerkas->move('assets/upload/', $fileName);
        }

        $dataBerkasDua = $this->request->getFile('file_logo');
        if($dataBerkasDua->getError() === 4) {
            $gambar_dua = $this->request->getVar("foto_lama_logo");
        }  else {
            $fileName_dua = $dataBerkasDua->getRandomName();
            $gambar_dua = $fileName_dua;
            $dataBerkasDua->move('assets/upload/', $fileName_dua);
        }



        $profile->update(session()->get("travel_id"),[
            'nama_perusahaan' => $this->request->getVar("nama_perusahaan"),
            'nama_travel_umrah' => $this->request->getVar("nama_travel"),
            'npwp' => $this->request->getVar("npwp"),
            'no_sk' => $this->request->getVar("no_sk"),
            'tgl_sk' => $this->request->getVar("tgl_sk"),
            'tgl_berakhir_sk' => $this->request->getVar("akhir_sk"),
            'no_telp' => $this->request->getVar("no_telp"),
            'no_hp' => $this->request->getVar("no_hp"),
            'email' => $this->request->getVar("email"),
            'alamat_mekkah' => $this->request->getVar("alamat_mekkah"),
            'no_telp_mekkah' => $this->request->getVar("no_telp_mekkah"),
            'alamat_madinah' => $this->request->getVar("alamat_madinah"),
            'no_telp_madinah' => $this->request->getVar("no_telp_madinah"),
            'foto_kantor' => $gambar,
            'logo_travel'   =>  $gambar_dua,
            // 'banner'    =>  $gambar_duaBanner
        ]);
        // if($result) {
        // } else {
        //     $profile->insert([
        //         'nama_perusahaan' => $this->request->getVar("nama_perusahaan"),
        //         'nama_travel_umrah' => $this->request->getVar("nama_travel"),
        //         'npwp' => $this->request->getVar("npwp"),
        //         'no_sk' => $this->request->getVar("no_sk"),
        //         'tgl_sk' => $this->request->getVar("tgl_sk"),
        //         'tgl_berakhir_sk' => $this->request->getVar("akhir_sk"),
        //         'no_telp' => $this->request->getVar("no_telp"),
        //         'no_hp' => $this->request->getVar("no_hp"),
        //         'email' => $this->request->getVar("email"),
        //         'website' => $this->request->getVar("website"),
        //         'provinsi' => $this->request->getVar("provinsi"),
        //         'kabupaten' => $this->request->getVar("kabupaten"),
        //         'kecamatan' => $this->request->getVar("kecamatan"),
        //         'alamat' => $this->request->getVar("alamat"),
        //         'alamat_mekkah' => $this->request->getVar("alamat_mekkah"),
        //         'no_telp_mekkah' => $this->request->getVar("no_telp_mekkah"),
        //         'alamat_madinah' => $this->request->getVar("alamat_madinah"),
        //         'no_telp_madinah' => $this->request->getVar("no_telp_madinah"),
        //         'foto_kantor' => $gambar,
        //         'logo_travel'   =>  $gambar_dua,
        //         // 'banner'    =>  $gambar_duaBanner
        //     ]);
        // }
        return redirect()->to("profil")->with("success","Data Berhasil update");
    }
}
