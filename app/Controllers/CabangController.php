<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BannerModel;
use App\Models\CabangModel;
use App\Models\DataBank;
use App\Models\ProfileModel;
use App\Models\Users;
use Myth\Auth\Entities\User;

class CabangController extends BaseController
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
        $cabang = new CabangModel();
        $data = [
            'title' =>  "Cabang",
            'cabang'    =>  $cabang->where("travel_id",session()->get("travel_id"))->findAll(),
            'bank'  =>  $bank->findAll(),
            'banner'    =>  $banner->findAll(),
            'profile'   =>  $profile->where("id",session()->get("travel_id"))->first(),
        ];
        return view("jamaah/cabang/index",$data);
    }
    public function profile_cabang($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $profile = new ProfileModel();
        $bank = new DataBank();
        $banner = new BannerModel();
        $cabang = new CabangModel();
        $user = new Users();
        $data = [
            'title' =>  "Cabang",
            'cabang'    =>  $cabang->where("id",$id)->first(),
            'bank'  =>  $bank->findAll(),
            'user'  =>  $user->where("cabang_id",$id)->findAll(),
            'banner'    =>  $banner->findAll(),
            'id_cabang' =>  $id,
            'profile'   =>  $profile->where("id",session()->get("travel_id"))->first(),
        ];
        return view("jamaah/cabang/users",$data);
    }

    public function tambah_cabang()
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

        $profile = new ProfileModel();
        $bank = new DataBank();
        $banner = new BannerModel();
        $cabang = new CabangModel();
        $cabang->insert([
            'nama'  =>  $this->request->getVar("nama"),
            'travel_id' =>  session()->get("travel_id"),
            'created_at'    =>date("Y-m-d"),
            'status'    =>  $this->request->getVar("status"),
            'foto'  =>  $foto,
            'alamat'    =>  $this->request->getVar("alamat"),
            'no_hp' =>  $this->request->getVar("no_hp"),
            'email' =>  $this->request->getVar("email"),
        ]);
        return redirect()->to("cabang")->with("success","Data Berhasil Ditambahkan");
    }

    public function edit_cabang()
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
            $foto = $this->request->getVar("file_lama");
        } else {
            $fileName = $dataBerkas->getRandomName();
            $foto = $fileName;
            $dataBerkas->move('assets/upload/', $fileName);
        }

        $profile = new ProfileModel();
        $bank = new DataBank();
        $banner = new BannerModel();
        $cabang = new CabangModel();
        $cabang->update($this->request->getVar('id'),[
            'nama'  =>  $this->request->getVar("nama"),
            'travel_id' =>  session()->get("travel_id"),
            'created_at'    =>date("Y-m-d"),
            'status'    =>  $this->request->getVar("status"),
            'foto'  =>  $foto,
            'alamat'    =>  $this->request->getVar("alamat"),
            'no_hp' =>  $this->request->getVar("no_hp"),
            'email' =>  $this->request->getVar("email"),
        ]);
        return redirect()->to("cabang")->with("success","Data Berhasil Diupdate");
    }

    public function hapus_cabang()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $user = new Users();
        $result = $user->where("cabang_id",$this->request->getVar('id'))->where("level_id",'cabang')->first();
        if($result) {
            return redirect()->back()->with('error','Data Sudah Berelasi Tidak Boleh Dihapus');
        }
        
        $cabang= new CabangModel();
        $cabang->delete($this->request->getVar("id"));
        return redirect()->to("cabang")->with("success","Data Berhasil Dihapus");
    }

    public function tambah_user_cabang()
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
        $user = new Users();

        $result = $user->where("username",$this->request->getVar('username'))->first();
        if($result) {
            return redirect()->back()->with('error','User Sudah Ada');
        }
        $user->insert([
            'nama'  =>  $this->request->getVar("nama"),
            'username'  =>  $this->request->getVar("username"),
            'password'  =>  password_hash($this->request->getVar("password"),PASSWORD_DEFAULT),
            'level_id'  =>  'cabang',
            'created_at'    =>  date("Y-m-d"),
            'img'   =>  $foto,
            'email' =>  $this->request->getVar('username'),
            'no_hp' =>  $this->request->getVar("no_hp"),
            'kelengkapan'   =>  'sudah',
            'cabang_id' =>  $this->request->getVar('id_cabang')
        ]);

        return redirect()->back()->with("success","Data Berhasil Ditambahkan");
    }

    public function edit_user_cabang()
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
            $foto = $this->request->getVar("file_lama");
        } else {
            $fileName = $dataBerkas->getRandomName();
            $foto = $fileName;
            $dataBerkas->move('assets/upload/', $fileName);
        }
        $user = new Users();


        $user->update($this->request->getVar("id"),[
            'nama'  =>  $this->request->getVar("nama"),
            'username'  =>  $this->request->getVar("username"),
            'img'   =>  $foto,
            'email' =>  $this->request->getVar('username'),
            'no_hp' =>  $this->request->getVar("no_hp"),
        ]);

        return redirect()->back()->with("success","Data Berhasil Diupdate");
    }

    public function hapus_user_cabang()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $user = new Users();
        $id_cabang = $this->request->getVar('id_cabang');
        $check = $user->where("level_id","cabang")->where("cabang_id",$id_cabang)->countAllResults();
        if($check == 1) {
            return redirect()->back()->with('error','Minimal User 1');
        }
        $user->delete($this->request->getVar('id'));
        return redirect()->back()->with("success","Data Berhasil Dihapus");
    }
}
