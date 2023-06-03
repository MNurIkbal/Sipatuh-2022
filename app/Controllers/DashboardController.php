<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CabangModel;
use App\Models\DaftarJamaahModel;
use App\Models\PaketModel;
use App\Models\ProfileModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $sesi = session()->get("login");
        // dd($sesi);
        $travel_id = session()->get('travel_id');
        if (!isset($sesi)) {
            return redirect()->to("/");
            exit;
        } elseif (!isset($travel_id)) {
            session()->destroy();
            session()->remove("login");
            session()->remove("id");
            session()->remove("level_id");
            session()->remove("email");
            session()->remove("no_hp");
            session()->remove("username");
            session()->remove("nama");
            session()->remove("created_at");
            session()->remove("updated_at");
            session()->remove("travel_id");
            return redirect()->to("/masuk");
        }
        // die;



        if (session()->get("level_id") == "cabang") {
            return redirect()->to("paket");
        }

        $profile = new ProfileModel();
        $data = [
            'title' =>  "Profile Perusahaan",
            'profile'   =>  $profile->where("id", session()->get("travel_id"))->first(),
        ];
        return view("jamaah/dashboard", $data);
    }
    public function dash()
    {
        $sesi = session()->get("login");
        // dd($sesi);
        $travel_id = session()->get('travel_id');
        if (!isset($sesi)) {
            return redirect()->to("/");
            exit;
        } elseif (!isset($travel_id)) {
            session()->destroy();
            session()->remove("login");
            session()->remove("id");
            session()->remove("level_id");
            session()->remove("email");
            session()->remove("no_hp");
            session()->remove("username");
            session()->remove("nama");
            session()->remove("created_at");
            session()->remove("updated_at");
            session()->remove("travel_id");
            return redirect()->to("/masuk");
        }

        if (session()->get("level_id") == "cabang") {
            return redirect()->to("paket");
        }
        $cabang = new CabangModel();
        $db      = \Config\Database::connect();
        $paket  = new PaketModel();

        $profile = new ProfileModel();
        $daftar = new DaftarJamaahModel();
        $s = session()->get('travel_id');
        $data = [
            'title' =>  "Dashboard",
            'profile'   =>  $profile->where("id", session()->get("travel_id"))->first(),
            'paket' => $db->query("SELECT * FROM paket WHERE travel_id = '$s' AND status = 'aktif'")->getNumRows(),
            'cabang'   => $db->query("SELECT * FROM data_cabang_travel WHERE travel_id = '$s' AND status = 'aktif'")->getNumRows(),
            'jamaah' => $db->query("SELECT * FROM jamaah 
            INNER JOIN paket ON jamaah.paket_id = paket.id 
            INNER JOIN profile ON paket.travel_id = profile.id
            WHERE profile.id = '$s' AND jamaah.kloter_id IS NOT NULL")->getNumRows(),
            'jamaah_aktif' => $db->query("SELECT * FROM jamaah 
            INNER JOIN paket ON jamaah.paket_id = paket.id 
            INNER JOIN profile ON paket.travel_id = profile.id
            WHERE profile.id = '$s' AND jamaah.kloter_id IS NOT NULL AND jamaah.status_approve IS NOT NULL")->getNumRows(),
            'daftar'    =>  $daftar->where("travel_id", session('travel_id'))->findAll(),
        ];
        return view("jamaah/dashboard_travel", $data);
    }
}