<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfileModel;

class CompanyController extends BaseController
{
    public function index($id)
    {
        $profile = new ProfileModel();
        $result = $profile->where('website',$id)->first();
        if(!$result) {
            return redirect()->to('/');
        }
        $data = [
            'title' =>  $result['nama_travel_umrah'],
            'profile'   =>  $result,
        ];
        return view('company/index',$data);
    }
}
