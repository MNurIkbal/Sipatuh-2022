<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BankModel;
use App\Models\BuktiModel;
use App\Models\DataBank;
use App\Models\JamaahModel;
use App\Models\KloterModel;
use App\Models\PaketModel;
use App\Models\PetugasManModel;

class RekeningPenampungController extends BaseController
{
    public function index()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $rekening = new BankModel();
        $data_bank = new DataBank();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Rekening Penampung",
            'bank'  =>  $data_bank->orderby('nama_bank','asc')->findAll(),
            'petugas'   =>  $petugas_man->findAll(),
            'rekening'  =>  $rekening->where("travel_id",session()->get("travel_id"))->orderBy("bank","ASC")->findAll()
        ];
        return view("jamaah/rekening_penampung/index",$data);
    }

    public function pembayaran($id,$id_paket,$id_kloter)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $rekening = new BankModel();
        $data_bank = new DataBank();
        $jamaah = new JamaahModel();
        $kloter = new KloterModel();
        $bank = new BankModel();
        $bukti = new BuktiModel();
        $result_paket = $paket->where("id",$id_paket)->first();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Pembayaran",
            'id_jamaah'    =>  $id,
            'kloter'  =>  $kloter->where('id',$id_kloter)->first(),
            'id_kloter' =>  $id_kloter,
            'main'    =>  $jamaah->where("id",$id)->first(),
            'id_paket'  =>  $id_paket,
            'paket' =>  $paket->where("id",$id_paket)->first(),
            // 'bank'  =>  $rekening->findAll(),
            'bank'  =>  $bank->where("id",$result_paket['rekening_penampung_id'])->first(),
            'petugas'   =>  $petugas_man->findAll(),
            'bukti' =>  $bukti->where("jamaah_id",$id)->where("paket_id",$id_paket)->where('kloter_id',$id_kloter)->findAll(),
            
            'rekening'  =>  $rekening->where("travel_id",session()->get("travel_id"))->findAll()
        ];
        
        return view("jamaah/pendaftaran/pembayaran",$data);
    }

    public function bayar_cicil($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        
        $id_paket  = $this->request->getVar("id_paket");
        $id_kloter = $this->request->getVar("id_kloter");
        $biaya = str_replace(".", "", $this->request->getVar("nominal"));

        $paket = new PaketModel();
        $kloter = new KloterModel();
        
        if(!$this->validate([
            'file' => [
                "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
            ],
            ])) {
            session()->setFlashdata('error',$this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        
        $data_paket = $paket->where("id",$id_paket)->first();
        if($biaya > $data_paket['biaya']) {
            return redirect()->back()->with('error','Nominal Melebihi biaya paket');
        }
        

        $jamaah = new JamaahModel();

        $detail_jamaah = $jamaah->where("id",$id)->first();
        $sisa = $detail_jamaah['sisa_pembayaran'];
        if($biaya > $sisa) {
            return redirect()->back()->with('error','Nominal Melebihi Sisa Pembayaran');
        }

        $dataBerkas = $this->request->getFile('file');
        $fileName = $dataBerkas->getRandomName();
        $foto = $fileName;
        $dataBerkas->move('assets/upload/', $fileName);
        $harga = $sisa - $biaya;

        $bukti = new BuktiModel();
        $bukti->insert([
            'nominal'   =>  $biaya,
            'sisa'  =>  $harga,
            'bukti' =>  $foto,
            'created'   =>  date("Y-m-d"),
            'jamaah_id' =>  $id,
            'rekening_penampung'    =>  $this->request->getVar('rekening'),
            'keterangan'    =>  $this->request->getVar('keterangan'),
            'paket_id'  =>  $id_paket,
            'kloter_id' =>  $id_kloter
        ]);

        if($harga == 0) {
            $jamaah->update($id,[
                'status_bayar' =>  "lunas",
                'sisa_pembayaran' =>    $harga,
            ]);
        } else {
            $jamaah->update($id,[
                'sisa_pembayaran' =>    $harga,
            ]);
        }

        if(session()->get("level_id") == "user") {
            return redirect()->back()->with('success',"Data Berhasil Ditambahkan");
        } else {
            return redirect()->to("tambah_pendaftaran/" . $id_kloter . '/' . $id_paket)->with('success',"Data Berhasil Ditambahkan");
        }

    }

    public function tambah_rekening()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $rekening = new BankModel();

        $rekening->insert([
            'bank'  =>  $this->request->getVar("bank"),
            'alamat'    =>  $this->request->getVar("alamat"),
            'no_rekening'   =>  $this->request->getVar("no_rekening"),
            'nama'  =>  $this->request->getVar("nama_pemilik"),
            'status'    =>  $this->request->getVar("status"),
            'created_at'    =>  date("Y-m-d"),
            'user_id'   =>  session()->get("id"),
            'travel_id' =>  session()->get("travel_id"),
        ]);

        return redirect()->to("rekening_penampung")->with("success","Data Berhasil Ditambahkan");
    }

    public function edit_rekening()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $id = $this->request->getVar("id");

        $rekening = new BankModel();
        $rekening->update($id,[
            'bank'  =>  $this->request->getVar("bank"),
            'alamat'    =>  $this->request->getVar("alamat"),
            'no_rekening'   =>  $this->request->getVar("no_rekening"),
            'nama'  =>  $this->request->getVar("nama_pemilik"),
            'status'    =>  $this->request->getVar("status")
        ]);
        return redirect()->to("rekening_penampung")->with("success","Data Berhasil Diupdate");
    }

    public function hapus_rekening()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $id = $this->request->getVar("id");

        $rekening = new BankModel();
        $rekening->delete($id);
        return redirect()->to("rekening_penampung")->with("success","Data Berhasil Dihapus");
    }
}
