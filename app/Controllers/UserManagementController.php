<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AsuransiModel;
use App\Models\BankModel;
use App\Models\BannerModel;
use App\Models\BuktiModel;
use App\Models\DataBank;
use App\Models\JamaahModel;
use App\Models\PaketModel;
use App\Models\ProfileModel;

class UserManagementController extends BaseController
{
    public function index()
    {
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $now = date("Y-m-d");
        $banner = new BannerModel();
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $pakets = new PaketModel();
        $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
        $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 10 ")->getResultArray();

        $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
        $count = count($st);
        $tes =  $jamaah->where("id",session()->get("jamaah_id"))->first();
        $check_paket = $pakets->where("id",$tes['paket_id'])->first();
        $check_travel = $travel->where("id",$check_paket['travel_id'])->first();
        $profile= new ProfileModel();
        $data = [
            'paket_dua' =>  $paket_dua,
            'count' =>  $count,
            'baru'    =>  $st,
            'profile'   =>  $profile->where('id',$check_travel['id'])->first(),
            'jamaah'    =>  $jamaah->where("id",session()->get("jamaah_id"))->first(),
            'title' =>  'Travel-Q',
            'db'    =>  $db,
            'pakets'    => $pakets->where("id",$tes['paket_id'])->first(),
            // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];
        // dd($data['pakets']);
        
        return view("user/dashboard",$data);
    }
    public function pindah_paket_jamaah()
    {
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $now = date("Y-m-d");
        $banner = new BannerModel();
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $pakets = new PaketModel();
        $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
        $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 10 ")->getResultArray();

        $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
        $count = count($st);
        $paket = new PaketModel();
        $tes =  $jamaah->where("id",session()->get("jamaah_id"))->first();
        $check_paket = $pakets->where("id",$tes['paket_id'])->first();
        $check_travel = $travel->where("id",$check_paket['travel_id'])->first();
        $profile= new ProfileModel();
        $data = [
            'paket_dua' =>  $paket_dua,
            'count' =>  $count,
            'id'    =>  session()->get("id"),
            'baru'    =>  $st,
            'id_paket'  =>  $check_paket['id'],
            'id_kloter' =>  $tes['kloter_id'],
            'profile'   =>  $profile->where('id',$check_travel['id'])->first(),
            'jamaah'    =>  $jamaah->where("id",session()->get("jamaah_id"))->first(),
            'title' =>  'Pindah Paket',
            'db'    =>  $db,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'pemberangkatan'    => null
            ])->findAll(),
            'check_paket'   =>  $check_paket,
            'pakets'    => $pakets->where("id",$tes['paket_id'])->first(),
            // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];
        // dd($data['pakets']);
        
        return view("user/pindah_paket",$data);
    }
    public function asuransi_jamaah()
    {
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $now = date("Y-m-d");
        $banner = new BannerModel();
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $pakets = new PaketModel();
        $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
        $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 10 ")->getResultArray();

        $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
        $count = count($st);
        $paket = new PaketModel();
        $tes =  $jamaah->where("id",session()->get("jamaah_id"))->first();
        $check_paket = $pakets->where("id",$tes['paket_id'])->first();
        $check_travel = $travel->where("id",$check_paket['travel_id'])->first();
        $profile= new ProfileModel();
        $asuransi = new AsuransiModel();
        $data = [
            'paket_dua' =>  $paket_dua,
            'count' =>  $count,
            'id'    =>  session()->get("id"),
            'baru'    =>  $st,
            'asuransi'  =>  $asuransi->findAll(),
            'id_paket'  =>  $check_paket['id'],
            'id_kloter' =>  $tes['kloter_id'],
            'profile'   =>  $profile->where('id',$check_travel['id'])->first(),
            'jamaah'    =>  $jamaah->where("id",session()->get("jamaah_id"))->first(),
            'title' =>  'Pindah Paket',
            'db'    =>  $db,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'pemberangkatan'    => null
            ])->findAll(),
            'check_paket'   =>  $check_paket,
            'pakets'    => $pakets->where("id",$tes['paket_id'])->first(),
            // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];
        // dd($data['pakets']);
        
        return view("user/asuransi",$data);
    }
    public function pembayaran_jamaah()
    {
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $now = date("Y-m-d");
        $banner = new BannerModel();
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $pakets = new PaketModel();
        $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
        $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 10 ")->getResultArray();

        $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
        $count = count($st);
        $paket = new PaketModel();
        $tes =  $jamaah->where("id",session()->get("jamaah_id"))->first();
        $check_paket = $pakets->where("id",$tes['paket_id'])->first();
        $check_travel = $travel->where("id",$check_paket['travel_id'])->first();
        $profile= new ProfileModel();
        $bank = new BankModel();
        $data = [
            'bank'  =>  $bank->findAll(),
            'paket_dua' =>  $paket_dua,
            'count' =>  $count,
            'bukti' =>  new BuktiModel(),
            'id'    =>  session()->get("jamaah_id"),
            'baru'    =>  $st,
            'id_paket'  =>  $check_paket['id'],
            'id_kloter' =>  $tes['kloter_id'],
            'profile'   =>  $profile->where('id',$check_travel['id'])->first(),
            'main'    =>  $jamaah->where("id",session()->get("jamaah_id"))->first(),
            'title' =>  'Pindah Paket',
            'db'    =>  $db,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'pemberangkatan'    => null
            ])->findAll(),
            'check_paket'   =>  $check_paket,
            'paket'    => $pakets->where("id",$tes['paket_id'])->first(),
            // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];
        
        
        return view("user/pembayaran",$data);
    }
}
