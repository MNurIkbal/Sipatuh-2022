<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfileModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $sesi = session()->get("login");
        // dd($sesi);
        $travel_id = session()->get('travel_id');
        if(!isset($sesi)) {
            return redirect()->to("/");
            exit;
        } elseif(!isset($travel_id)) {
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
        
        

        if(session()->get("level_id") == "cabang") {
            return redirect()->to("paket");
        }

        $profile = new ProfileModel();
        $data = [
            'title' =>  "Aplikasi Sipatuh",
            'profile'   =>  $profile->where("id",session()->get("travel_id"))->first(),
        ];
        return view("jamaah/dashboard",$data);
    }
}
