<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BankModel;
use App\Models\DataProviderModel;
use App\Models\JamaahModel;
use App\Models\KloterModel;
use App\Models\MuassahModel;
use App\Models\PaketModel;

class TiketController extends BaseController
{
    public function index()
    {


        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $db      = \Config\Database::connect();
        $travel_id = session()->get("travel_id");
        if(session()->get("level_id") == "jamaah") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang'    =>  NULL,
                'kelengkapan' =>    'sudah',
                'status'    =>  "aktif",
                'verifikasi'    =>  'sudah'
            ])->findAll();
        } elseif(session()->get("level_id") == "cabang") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang_id' =>  session()->get('cabang_id'),
                'cabang'    =>  "cabang",
                'status'    =>  "aktif",
                'kelengkapan' =>    'sudah',
                'verifikasi'    =>  'sudah'
            ])->findAll();
        }
        $data = [
            // 'result'    =>  $db->query("SELECT paket.nama,paket.tgl_berangkat,paket.tgl_pulang,paket.biaya,paket.id FROM paket INNER JOIN kloter ON paket.id = kloter.paket_id WHERE paket.travel_id = '$travel_id' AND kloter.keberangkatan = 'sudah' ")->getResultArray(),


            // 'result'    =>  $db->query("SELECT paket.nama,paket.tgl_berangkat,paket.tgl_pulang,paket.biaya,paket.id FROM kloter RIGHT JOIN paket ON paket.id = kloter.paket_id WHERE travel_id = '$travel_id' AND kloter.keberangkatan = 'sudah' AND paket.status = 'aktif' AND paket.kelengkapan = 'sudah' ")->getResultArray(),


            // 'result'    =>  $paket->where("user_id",session()->get("id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Tiket",
            // 'result'    =>  $paket->where([
            //     'status'    =>  "aktif",
            //     'travel_id'   =>  session()->get("travel_id"),
            //     'kelengkapan'   =>  'sudah',
            // ])->findAll(),
            'result'    =>  $datapaket,
        ];  
        return view("jamaah/tiket/index",$data);
    }

    public function detail_tiket($id_kloter,$id_paket)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $jamaah = new JamaahModel();
        $muasah = new MuassahModel();
        $paket = new PaketModel();
        $kloter = new KloterModel();
        $bank = new BankModel();
        $provider = new DataProviderModel();
        $db      = \Config\Database::connect();
        $chek = $paket->where('id',$id_paket)->first();
        $check_dua = $kloter->where('id',$id_kloter)->first();
        if(!$chek || !$check_dua) {
            return redirect()->to('tiket');
        }
            $finish = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id_paket' 
            AND tgl_bayar IS NOT NULL
            AND rekening_penampung IS NOT NULL 
            AND status_bayar = 'lunas'
            AND keterangan_bayar IS NOT NULL 
            AND nomor_polis  IS NOT NULL
            AND tgl_input IS NOT NULL
            AND tgl_awal IS NOT NULL
            AND tgl_akhir IS NOT NULL
            AND nomor_visa IS NOT NULL
            AND tgl_awal_visa IS NOT NULL
            AND tgl_akhir_visa IS NOT NULL
            AND muassasah IS NOT NULL
            AND status_vaksin IS NOT NULL
            AND tgl_vaksin  IS NOT NULL
            AND jenis_vaksin IS NOT NULL
            AND kloter_id = '$id_kloter'
            ")->getResult();
            $counts = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id_paket' AND kloter_id = '$id_kloter'")->getResult();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->first(),
            'title' =>  "Tiket",
            'count' =>  count($counts),
            'paket' =>  $paket->where([
                'id'    =>  $id_paket
            ])->first(),
            'id_kloter' =>  $id_kloter,
            'id'    =>  $id_paket,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif'
            ])->findAll(),
            'muasah'    =>  $muasah->where("status",1)->orderby('nama_muassasah','asc')->findAll(),
            'id'    =>  $id_paket,
            'provider'  =>  $provider->orderBy('nama_provider','asc')->findAll(),
            'bank'  =>  $bank->findAll(),
            'finish'    =>  count($finish),
            'jamaah'    =>  $jamaah->where([
                'paket_id'  =>  $id_paket,
                'kloter_id' =>  $id_kloter
            ])->findAll(),
            'kloters'   =>  $kloter->where('id',$id_kloter)->first(),
        ];
        return view("jamaah/tiket/detail",$data);
    }

    public function edit_tikets($id_jamaah,$id_paket,$id_kloter)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        
        $paket = new PaketModel();
        $jamaah = new JamaahModel();
        $muasah = new MuassahModel();
        $paket = new PaketModel();
        $bank = new BankModel();
        $provider = new DataProviderModel();
        $db      = \Config\Database::connect();
        $kloter = new KloterModel();
        $check_satu = $paket->where('id',$id_paket)->first();
        $check_dua = $jamaah->where('id',$id_jamaah)->first();
        $check_kloter = $kloter->where('id',$id_kloter)->first();
        if(!$check_dua || !$check_satu || !$check_kloter) {
            return redirect()->to('tiket');
        }
            $finish = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id_paket' 
            AND tgl_bayar IS NOT NULL
            AND rekening_penampung IS NOT NULL 
            AND status_bayar = 'lunas'
            AND keterangan_bayar IS NOT NULL 
            AND nomor_polis  IS NOT NULL
            AND tgl_input IS NOT NULL
            AND tgl_awal IS NOT NULL
            AND tgl_akhir IS NOT NULL
            AND nomor_visa IS NOT NULL
            AND tgl_awal_visa IS NOT NULL
            AND tgl_akhir_visa IS NOT NULL
            AND muassasah IS NOT NULL
            AND status_vaksin IS NOT NULL
            AND tgl_vaksin  IS NOT NULL
            AND jenis_vaksin IS NOT NULL
            AND kloter_id = '$id_kloter'
            ")->getResult();
            $counts = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id_paket' AND kloter_id = '$id_kloter'")->getResult();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->first(),
            'title' =>  "Tiket",
            'count' =>  count($counts),
            'kloters'   =>  $kloter->where('id',$id_kloter)->first(),
            'paket' =>  $paket->where([
                'id'    =>  $id_paket
            ])->first(),
            'id_kloter' =>  $id_kloter,
            'id'    =>  $id_paket,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif'
            ])->findAll(),
            'muasah'    =>  $muasah->where("status",1)->orderby('nama_muassasah','asc')->findAll(),
            'id'    =>  $id_paket,
            'provider'  =>  $provider->orderBy('nama_provider','asc')->findAll(),
            'bank'  =>  $bank->findAll(),
            'finish'    =>  count($finish),
            'main'    =>  $jamaah->where([
                'id'    =>  $id_jamaah,
                'paket_id'  =>  $id_paket,
                'kloter_id' =>  $id_kloter
            ])->first(),
        ];
        return view("jamaah/tiket/edit_tiket",$data);
    }

    public function detail_kloter_tiket($id,$id_paket)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $jamaah = new JamaahModel();
        $muasah = new MuassahModel();
        $paket = new PaketModel();
        $kloter = new KloterModel();
        $bank = new BankModel();
        $provider = new DataProviderModel();
        $check = $paket->where('id',$id)->first();
        // $check_dua = $kloter->where('id',$id_kloter)->first();
        if(!$check) {
            return redirect()->to('tiket');
        }
        $db      = \Config\Database::connect();
            $finish = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id' 
            AND tgl_bayar IS NOT NULL
            AND rekening_penampung IS NOT NULL 
            AND status_bayar = 'lunas'
            AND keterangan_bayar IS NOT NULL 
            AND nomor_polis  IS NOT NULL
            AND tgl_input IS NOT NULL
            AND tgl_awal IS NOT NULL
            AND tgl_akhir IS NOT NULL
            AND nomor_visa IS NOT NULL
            AND tgl_awal_visa IS NOT NULL
            AND tgl_akhir_visa IS NOT NULL
            AND muassasah IS NOT NULL
            ")->getResult();
            $counts = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id'")->getResult();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->first(),
            'title' =>  "Tiket",
            'count' =>  count($counts),
            'paket' =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'id'    =>  $id,
            'id_paket'    =>  $id,
            'kloter'    =>  $kloter->where("paket_id",$id)->where("status","Aktif")->findAll(),
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif'
            ])->findAll(),
            'muasah'    =>  $muasah->where("status",1)->findAll(),
            'id'    =>  $id,
            'provider'  =>  $provider->findAll(),
            'bank'  =>  $bank->findAll(),
            'finish'    =>  count($finish),
            'jamaah'    =>  $jamaah->where([
                'paket_id'  =>  $id,
            ])->findAll(),
        ];
        return view("jamaah/kloter_tiket/index",$data);
    }

    public function kloter_detail_tiket($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $jamaah = new JamaahModel();
        $muasah = new MuassahModel();
        $paket = new PaketModel();
        $kloter = new KloterModel();
        $bank = new BankModel();
        $check = $paket->where('id',$id)->first();
        if(!$check) {
            return redirect()->to('tiket');
        }
        $provider = new DataProviderModel();
        $db      = \Config\Database::connect();
            $finish = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id' 
            AND tgl_bayar IS NOT NULL
            AND rekening_penampung IS NOT NULL 
            AND status_bayar = 'lunas'
            AND keterangan_bayar IS NOT NULL 
            AND nomor_polis  IS NOT NULL
            AND tgl_input IS NOT NULL
            AND tgl_awal IS NOT NULL
            AND tgl_akhir IS NOT NULL
            AND nomor_visa IS NOT NULL
            AND tgl_awal_visa IS NOT NULL
            AND tgl_akhir_visa IS NOT NULL
            AND muassasah IS NOT NULL
            ")->getResult();
            $counts = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id'")->getResult();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->first(),
            'title' =>  "Tiket",
            'count' =>  count($counts),
            'paket' =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'id'    =>  $id,
            'id_paket'    =>  $id,
            'kloter'    =>  $kloter->where("paket_id",$id)->where("status","Aktif")->where("keberangkatan","sudah")->where("done",NULL)->findAll(),
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif'
            ])->findAll(),
            'muasah'    =>  $muasah->where("status",1)->findAll(),
            'id'    =>  $id,
            'provider'  =>  $provider->findAll(),
            'bank'  =>  $bank->findAll(),
            'finish'    =>  count($finish),
            'jamaah'    =>  $jamaah->where([
                'paket_id'  =>  $id,
            ])->findAll(),
        ];
        return view("jamaah/kloter_tiket/index",$data);
    }

    public function update_tiket($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $id_paket = $this->request->getVar("id_paket");
        $id_kloter = $this->request->getVar("id_kloter");
        $kursi = $this->request->getVar("no_kursi");

        $jamaah = new  JamaahModel();
        $jamaah->update($id,[
            'nama_paspor'   =>  $this->request->getVar("nama_paspor"),
            'no_paspor'   =>  $this->request->getVar("nomor_paspor"),
            'nomor_visa'   =>  $this->request->getVar("nomor_visa"),
            'tgl_awal_visa'   =>  $this->request->getVar("tgl_berlaku_visa"),
            'tgl_akhir_visa'   =>  $this->request->getVar("tgl_habis_visa"),
            'muassasah'   =>  $this->request->getVar("muassasah"),
            'tiket_cgk_med' =>  $this->request->getVar("tiket_berangkat"),
            'tiket_med_gk'  =>  $this->request->getVar("tiket_pulang"),
            'tgl_keluar_paspor'   =>  $this->request->getVar("tgl_keluar_paspor"),
            'tgl_habis_paspor'   =>  $this->request->getVar("tgl_habis_paspor"),
            'kota_paspor'   =>  $this->request->getVar("kota_paspor"),
            'no_tiket'   =>  "M" . date("Y") . rand(11,99) . date("d"),
            'no_kursi'  =>  $kursi
        ]);

        $db      = \Config\Database::connect();
        $check_satu = $db->query("SELECT * FROM jamaah
        WHERE paket_id = '$id_paket'
        AND kloter_id = '$id_kloter'
        AND tiket_cgk_med IS NOT NULL
        AND tiket_med_gk IS NOT NULL
        AND kota_paspor IS NOT NULL
        AND tgl_keluar_paspor IS NOT NULL
        AND tgl_habis_paspor IS NOT NULL")->getNumRows();

        $check_dua =  $db->query("SELECT * FROM jamaah
        WHERE paket_id = '$id_paket'
        AND kloter_id = '$id_kloter'")->getNumRows();
        if($check_satu == $check_dua)  {
            $paket = new PaketModel();
            $paket->update($id_paket,[
                'tiket' =>  'sudah'
            ]);
            $kloter = new KloterModel();
            $kloter->update($id_kloter,[
                'status_realisasi'  =>  'sudah'
            ]);
        }

        return redirect()->to("detail_kloter_tiket/$id_kloter" . '/' . $id_paket)->with("success","Data Berhasil Diupdate");
    }
}
