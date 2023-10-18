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
        $rt =  $profil->where("id",session()->get("travel_id"))->first();
        $id_provinsi = $rt['provinsi'];
        $kabs = $rt['kabupaten'];
        $kab = $db->query("SELECT * FROM regencies WHERE name = '$kabs'")->getRowArray();
        $kecs = $rt['kecamatan'];
        
        $kec = $db->query("SELECT * FROM districts WHERE name = '$kecs'")->getRowArray();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Update Profile",
            'petugas'   =>  $petugas_man->findAll(),
            'db'    =>  $db,
            'kab'   =>  $kab,
            'kec'   =>  $kec,
            'id_provinsi'   =>  $db->query("SELECT * FROM provinces WHERE name = '$id_provinsi'")->getRowArray(),
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


            if($this->request->getVar('akhir_sk')) {
                $t = $this->request->getVar('akhir_sk');
            } else {
                $t = null;
            }
            if($this->request->getVar('tgl_sk')) {
                $y = $this->request->getVar('tgl_sk');
            } else {
                $y = null;
            }

            try {
                $db = \Config\Database::connect();
                $provinsi = $this->request->getVar('provinsi');
                $results = $db->query("SELECT * FROM provinces WHERE id = '$provinsi' ORDER BY name ASC")->getRowArray();
                $kabupaten = $this->request->getVar("kabupaten");
                $kecamatan = $this->request->getVar('kecamatan');
                $hasil_kab = explode("-",$kabupaten);
                $hasil_kec = explode('-',$kecamatan);
                $result_kab = $hasil_kab[1];
                $result_kec = $hasil_kec[1];
                
            $profile->update(session()->get("travel_id"),[
                'nama_perusahaan' => $this->request->getVar("nama_perusahaan"),
                'nama_travel_umrah' => $this->request->getVar("nama_travel"),
                'npwp' => $this->request->getVar("npwp"),
                'no_sk' => $this->request->getVar("no_sk"),
                'tgl_sk' => $y,
                'tgl_berakhir_sk' => $t,
                'no_telp' => $this->request->getVar("no_telp"),
                'no_hp' => $this->request->getVar("no_hp"),
                'email' => $this->request->getVar("email"),
                'provinsi'  =>  $results['name'],
                'kabupaten' =>  $result_kab,
                'kecamatan' =>  $result_kec,
                'alamat_mekkah' => $this->request->getVar("alamat_mekkah"),
                'no_telp_mekkah' => $this->request->getVar("no_telp_mekkah"),
                'alamat_madinah' => $this->request->getVar("alamat_madinah"),
                'no_telp_madinah' => $this->request->getVar("no_telp_madinah"),
                'foto_kantor' => $gambar,
                'logo_travel'   =>  $gambar_dua,
                'longtitude'    =>  $this->request->getVar('long'),
                'latitude'    =>  $this->request->getVar('lat')
            ]);
            
            return redirect()->to("profil")->with("success","Data Berhasil update");
        } catch (\Throwable $th) {
                return redirect()->to("profil")->with("error","Data Gagal update");
                //throw $th;
            }
    }
}
