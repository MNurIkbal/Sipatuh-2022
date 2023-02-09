<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BankModel;
use App\Models\DataBank;
use App\Models\ProfileModel;

class DataBankController extends BaseController
{
    public function index()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $profile = new ProfileModel();
        $bank = new DataBank();
        $data = [
            'title' =>  "Bank",
            'bank'  =>  $bank->findAll(),
            'profile'   =>  $profile->where("id",session()->get("travel_id"))->first(),
        ];
        return view("admin/bank/index",$data);
    }

    public function add_data_bank()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        if(!$this->validate([
            'kode' => [
                "rules" =>  "is_unique[bank.kode_bank]"
            ],
            'nama'  =>  [
                "rules" =>  "is_unique[bank.nama_bank]"
            ]
        ])) {
            session()->setFlashdata('error',$this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $bank = new DataBank();
        $bank->insert([
            'nama_bank' =>  $this->request->getVar('nama'),
            'kode_bank' =>  $this->request->getVar('kode'),
        ]);

        return redirect()->to("data_bank")->with("success","Data Berhasil Ditambahkan");    
    }

    public function hapus_data_bank($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $result = new DataBank();
        $query = $result->where("id",$id)->first();
        $check = new BankModel();
        $chek_satu = $check->where("bank",$query['nama_bank'])->first();
        if($chek_satu) {
            return redirect()->back()->with('error',"Data Ini Tidak Boleh Dihapus Karena Sudah Berelasi");
        }

        $bank = new DataBank();
        $bank->where('id',$id)->delete();
        return redirect()->to("data_bank")->with("success","Data Berhasil Dihapus");    
    }

    public function edit_data_bank($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $bank = new DataBank();
        $kode_bank = $this->request->getVar("kode");
        $nama = $this->request->getVar("nama");
        $bank->update($id,[
            'nama_bank' =>  $nama,
            'kode_bank' =>  $kode_bank
        ]);

        return redirect()->to("data_bank")->with("success",'Data Berhasil Diupdate');
    }
}
