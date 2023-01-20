<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AsuransiModel;
use App\Models\DataHotelModel;
use App\Models\DataProviderModel;
use App\Models\HotelModel;
use App\Models\JamaahModel;
use App\Models\LevelPetugasModel;
use App\Models\MuassahModel;
use App\Models\PaketModel;
use App\Models\PetugasManModel;
use App\Models\PetugasModel;
use App\Models\ProviderModel;

class LevelPetugasController extends BaseController
{
    public function level_petugas()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $level = new LevelPetugasModel();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Level Petugas",
            'level' =>  $level->findAll(),
            'petugas'   =>  $petugas_man->where("travel_id",session()->get("travel_id"))->findAll(),
        ];
        return view("admin/level_petugas/index",$data);
    }
    public function data_asuransi()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $level = new LevelPetugasModel();
        $asuransi = new AsuransiModel();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Asuransi",
            'level' =>  $level->findAll(),
            'petugas'   =>  $petugas_man->where("travel_id",session()->get("travel_id"))->findAll(),
            'asuransi'  => $asuransi->findAll(),
        ];
        return view("admin/asuransi_data/index",$data);
    }
    public function data_mussahah()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $level = new LevelPetugasModel();
        $asuransi = new AsuransiModel();
        $muasahah = new MuassahModel();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Muassahah",
            'level' =>  $level->findAll(),
            'petugas'   =>  $petugas_man->where("travel_id",session()->get("travel_id"))->findAll(),
            'asuransi'  => $asuransi->findAll(),
            'muassahah' =>  $muasahah->findAll()
        ];
        return view("admin/mussahah/index",$data);
    }
    public function data_hotel()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $level = new LevelPetugasModel();
        $asuransi = new AsuransiModel();
        $muasahah = new MuassahModel();
        $hotel = new DataHotelModel();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Hotel",
            "hotel" =>  $hotel->findAll(),
            'level' =>  $level->findAll(),
            'petugas'   =>  $petugas_man->where("travel_id",session()->get("travel_id"))->findAll(),
            'asuransi'  => $asuransi->findAll(),
            'muassahah' =>  $muasahah->findAll()
        ];
        return view("admin/hotel/index",$data);
    }

    public function add_hotel()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $hotel = new DataHotelModel();
        $hotel->insert([
            'nama'  =>  $this->request->getvar("nama"),
            'lokasi'    =>  $this->request->getVar("lokasi")
        ]);

        return redirect()->back()->with("success","Data Berhasil Ditambahkan");
    }

    public function hapus_hotel($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $result_dua = new DataHotelModel();
        $result = new HotelModel();
        $satu = $result_dua->where("id",$id)->first();
        $check_tiga = $result->where("hotel",$satu['nama'])->first();
        if($check_tiga) {
            return redirect()->back()->with("error","Data Ini Tidak Boleh Dihapus Karena Sudah Berelasi");
        }

        $hotel = new DataHotelModel();
        $hotel->delete($id);

        return redirect()->back()->with("success","Data Berhasil Dihapus");
    }

    public function edit_hotel($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $hotel = new DataHotelModel();
        $hotel->update($id,[
            'nama'  =>  $this->request->getVar("nama"),
            'lokasi'    =>  $this->request->getVar("lokasi")
        ]);

        return redirect()->back()->with("success","Data Berhasil Diupdate");
    }

    public function add_muasahah()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $muasahah = new MuassahModel();
        $muasahah->insert([
                'nama_muassasah'    =>  $this->request->getVar('nama')
        ]);

        return redirect()->back()->with("success","Data Berhasil Ditambahkan");
    }

    public function hapus_muassahah($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $muasahah_baru = new MuassahModel();
        $check_satu = $muasahah_baru->where("id",$id)->first();
        $result = new JamaahModel();
        $check_dua = $result->where("muassasah",$check_satu['nama_muassasah'])->first();
        
        if($check_dua) {
            return redirect()->back()->with("error","Data Ini Tidak Boleh Dihapus Karena Sudah Berelasi");
        }

        $muasahah = new MuassahModel();
        $muasahah->delete($id);
        return redirect()->back()->with("success","Data Berhasil Dihapus");
    }

    public function edit_muassahah($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $muasahah = new MuassahModel();
        $muasahah->update($id,[
            'nama_muassasah'    =>  $this->request->getVar('nama')
        ]);
        return redirect()->back()->with("success","Data Berhasil Diupdate");
    }

    public function add_asuransi()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $asuransi = new AsuransiModel();
        $asuransi->insert([
            'nama'  =>  $this->request->getVar("nama")
        ]);

        return redirect()->to("data_asuransi")->with("success","Data Berhasil Di Tambahkan");
    }

    public function edit_asuransi_data($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $asuransi = new AsuransiModel();
        $asuransi->update($id,[
            'nama'  =>  $this->request->getVar('nama'),
        ]);

        return redirect()->back()->with("success","Data Berhasil Diupdate");
    }

    public function hapus_asuransi_data($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $asuransi = new AsuransiModel();
        $asuransi->delete($id);
        return redirect()->back()->with("success","Data Berhasil Dihapus");
    }
    public function data_provider()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $level = new LevelPetugasModel();
        $provider = new DataProviderModel();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Provider",
            'level' =>  $level->findAll(),
            'petugas'   =>  $petugas_man->where("travel_id",session()->get("travel_id"))->findAll(),
            'provider'  =>  $provider->findAll()
        ];
        return view("admin/provider/index",$data);
    }

    public function add_level()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $level = new LevelPetugasModel();
        $level->insert([
            'nama'  =>$this->request->getVar('nama')
        ]);
        return redirect()->to("level_users")->with("success",'Data Berhasil Ditambahkan');
    }

    public function add_provider()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $level = new LevelPetugasModel();
        $provider = new DataProviderModel();
        $provider->insert([
            'nama_provider' =>  $this->request->getVar("nama"),
        ]);
        return redirect()->to("data_provider")->with("success",'Data Berhasil Ditambahkan');
    }

    public function hapus_provider($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $provider = new DataProviderModel();

        $check_satu = $provider->where("id",$id)->first();
        $result = new JamaahModel();
        $result_dua = new PaketModel();
        $check_tiga = $result->where("provider",$check_satu['nama_provider'])->first();
        $check_empat = $result_dua->where("provider",$check_satu['nama_provider'])->first();
        if($check_tiga || $check_empat) {
            return redirect()->back()->with('error',"Data Ini Tidak Boleh Dihapus Karena Sudah Berelasi");
        }


        $provider->delete($id);
        return redirect()->to("data_provider")->with("success",'Data Berhasil Dihapus');
    }

    public function edit_provider($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $provider= new DataProviderModel();
        $provider->update($id,[
            'nama_provider' =>  $this->request->getVar('nama')
        ]);

        return redirect()->to("data_provider")->with("success","Data Berhasil Ditambahkan");
    }

    public function edit_level($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $level = new LevelPetugasModel();
        $level->update($id,[
            'nama'  =>  $this->request->getVar("nama")
        ]);
        return redirect()->to("level_users")->with("success",'Data Berhasil Diupdate');
    }

    public function hapus_level($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $level = new LevelPetugasModel();

        $petugas = new PetugasModel();
        $result = $level->where("id",$id)->first();
        $result_dua = $petugas->where("type",$result['nama'])->first(); 
        if($result_dua) {
            return redirect()->back()->with('error','Data Ini Tidak Boleh Dihapus Karena Sudah Berelasi');
        }
        
        $level->delete($id);
        return redirect()->to("level_users")->with("success",'Data Berhasil Dihapus');
    }
}
