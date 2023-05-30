<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CabangModel;
use App\Models\JamaahModel;
use App\Models\PaketModel;
use App\Models\ProfileCompany;
use App\Models\ProfileModel;
use App\Models\SliderCompany;

class CompanyController extends BaseController
{
    public function index($id)
    {
        $profile = new ProfileModel();
        $result = $profile->where('website',$id)->first();
        if(!$result) {
            return redirect()->to('/');
        }
        $travel =   new ProfileCompany();
        $check  = $travel->where("travel_id",$result['id'])->first();
        $slider = new SliderCompany();
        $slid = $slider->where("travel_id",$result['id'])->countAllResults();
         if(!$result || !$check || !$slid)  {
            return redirect()->to('/');
        }
        
        
        $slide = $slider->where("travel_id",$result['id'])->get()->getResult();
        $paket = new PaketModel();
        $check_paket = $paket->where("status","aktif")->orWhere('status_approve','sudah')->countAllResults();
        $jamaah = new JamaahModel();
        $count_jamaah = $jamaah->getPaketCount($result['id']);
        $cabang = new CabangModel();
        $count_cabang = $cabang->where("travel_id",$result['id'])->countAllResults();
        $paket = new PaketModel();
        
        $new_paket = $paket->where('travel_id',$result['id'])->where('status','aktif')->where('pemberangkatan',NULL)->orderBy('id','desc')->limit(10)->get()->getResult();
        $data = [
            'title' =>  $result['nama_travel_umrah'],
            'profile'   =>  $result,
            'check' =>  $check,
            'slider'    =>  $slide,
            'count_paket'   =>  $check_paket,
            'count_jamaah'  =>  $count_jamaah,
            'count_cabang'  =>  $count_cabang,
            'paket' =>  $new_paket
        ];
        return view('company/index',$data);
    }
}
