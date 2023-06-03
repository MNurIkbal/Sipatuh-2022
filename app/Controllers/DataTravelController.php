<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataBank;
use App\Models\ProfileModel;
use App\Models\TravelModel;
use Config\Database;
use Myth\Auth\Entities\User;

class DataTravelController extends BaseController
{
    public function index()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $profile = new ProfileModel();
        $bank = new DataBank();
        $travel  = new TravelModel();
        $data = [
            'title' =>  "Perusahaan",
            'bank'  =>  $bank->findAll(),
            'profile'   =>  $profile->where("id",session()->get("travel_id"))->first(),
            'travel'    =>  $travel->findAll()
        ];
        return view("admin/travel/index",$data);
    }

    public function add_data_travel()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        if(!$this->validate([
            'nama'  =>  [
                "rules" =>  "is_unique[travel_agen.nama_travel]"
            ]
        ])) {
            session()->setFlashdata('error',$this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $travel = new TravelModel();
        $travel->insert([
            'nama_travel'   =>  $this->request->getVar('nama')
        ]);

        return redirect()->to("data_travel")->with("success","Data Berhasil Ditambahkan");
    }

    public function hapus_data_travel($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $db = Database::connect();
        $result = new TravelModel();
        $satu = $result->where("id",$id)->first();
        $check = $db->query("SELECT * FROM profile WHERE nama_perusahaan = '$satu[nama_travel]'")->getNumRows();
        if($check) {
            return redirect()->back()->with("error","Data Ini Tidak Boleh Dihapus Karena Sudah Berelasi");
        }

        $travel = new TravelModel();
        $travel->delete($id);
        return redirect()->to("data_travel")->with("success","Data Berhasil Dihapus");
    }

    public function edit_data_travel($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $travel = new TravelModel();
        $travel->update($id,[
            'nama_travel'   =>  $this->request->getVar("nama")
        ]);

        return redirect()->to("data_travel")->with("success","Data Berhasil Diupdate");
    }
}
