<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BankModel;
use App\Models\BannerModel;
use App\Models\DataBank;
use App\Models\ProfileModel;

class BannerController extends BaseController
{
    public function index()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $profile = new ProfileModel();
        $bank = new DataBank();
        $banner = new BannerModel();
        $data = [
            'title' =>  "Banner",
            'bank'  =>  $bank->findAll(),
            'banner'    =>  $banner->findAll(),
            'profile'   =>  $profile->where("id",session()->get("travel_id"))->first(),
        ];
        return view("admin/banner/index",$data);
    }

    public function add_banner()
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

        $expired = date("Y-m-d",strtotime($this->request->getVar("expired")));
        $now = date("Y-m-d");
        $start = date("Y-m-d",strtotime($this->request->getVar("start")));
        if($expired <= $start) {
            return redirect()->back()->with("error","Expired Tidak Boleh Kurang Atau Sama Dengan Dari Waktu Mulai");
        }
        $dataBerkas = $this->request->getFile('file');
        $fileName = $dataBerkas->getRandomName();
        $foto = $fileName;
        $dataBerkas->move('assets/upload/', $fileName);

        $banner = new BannerModel();
        $banner->insert([
            'created_at'    =>  date("Y-m-d"),
            'expired'   =>  $this->request->getVar("expired"),
            'foto'  =>  $foto,
            'star'  =>  $this->request->getVar("start")
        ]);

        return redirect()->to("banner")->with("success",'Data Berhasil Ditambahkan');
    }
    public function edit_banner($id)
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

        $expired = date("Y-m-d",strtotime($this->request->getVar("expired")));
        $now = date("Y-m-d",strtotime($this->request->getvar("start")));
        if($expired <= $now) {
            return redirect()->back()->with("error","Expired Tidak Boleh Kurang Atau Sama Dengan Dari Waktu Mulai");
        }
        $dataBerkas = $this->request->getFile('file');
        if($dataBerkas->getError() === 4) {
            $foto = $this->request->getVar("file_lama");
         } else{
             $fileName = $dataBerkas->getRandomName();
             $foto = $fileName;
             $dataBerkas->move('assets/upload/', $fileName);
         }

        $banner = new BannerModel();
        $banner->update($id,[
            'created_at'    =>  date("Y-m-d"),
            'expired'   =>  $this->request->getVar("expired"),
            'foto'  =>  $foto,
            'star'  =>  $this->request->getVar("start")
        ]);

        return redirect()->to("banner")->with("success",'Data Berhasil Diupdate');
    }

    public function hapus_banner($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $banner = new BannerModel();
        $banner->delete($id);
        return redirect()->to("banner")->with("success",'Data Berhasil Dihapus');
    }
}
