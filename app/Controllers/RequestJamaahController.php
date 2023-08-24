<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BankModel;
use App\Models\BannerModel;
use App\Models\DaftarJamaahModel;
use App\Models\DashboardAdmin;
use App\Models\JamaahModel;
use App\Models\KloterModel;
use App\Models\LevelPetugasModel;
use App\Models\PaketModel;
use App\Models\PetugasManModel;

class RequestJamaahController extends BaseController
{
    public function index()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $db      = \Config\Database::connect();
        $travel = session()->get("travel_id");
        $petugas_man  = new PetugasManModel();
        $level = new LevelPetugasModel();
        $jamaah = new JamaahModel();
        $kloter = new KloterModel();
        $bank  = new BankModel();
        $data = [
            'kloter'    =>  $kloter,
            'level' =>  $level->findAll(),
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Request Jamaah",
            'petugas'   =>  $petugas_man->where("travel_id",session()->get("travel_id"))->findAll(),
            'jamaah'    =>  $db->query("SELECT
                            jamaah.nama as nama_jamaah,
                            jamaah.kloter_id,
                            jamaah.paket_id,
                            jamaah.foto,
                            jamaah.no_identitas,
                            jamaah.tempat_lahir,
                            jamaah.tgl_lahir,
                            jamaah.no_pasti_umrah,
                            jamaah.no_hp,
                            jamaah.id,

                            jamaah.title,
                            jamaah.nama,
                            jamaah.nama_paspor,
                            jamaah.ayah,
                            jamaah.jenis_identitas,
                            jamaah.provinsi,
                            jamaah.kabupaten,
                            jamaah.kecamatan,
                            jamaah.kelurahan,
                            jamaah.alamat,
                            jamaah.no_telp,
                            jamaah.kewargannegaraan,
                            jamaah.status_pernikahan,
                            jamaah.jenis_pendidikan,
                            jamaah.jenis_pekerjaan,
                            jamaah.provider,
                            jamaah.asuransi,
                            jamaah.no_paspor,
                            jamaah.no_identitas,
                            jamaah.rekening_penampung,
                            jamaah.status_bayar,
                            jamaah.nomor_polis,
                            jamaah.tgl_input,
                            jamaah.tgl_awal,
                            jamaah.tgl_akhir,
                            jamaah.nomor_visa,
                            jamaah.tgl_awal_visa,
                            jamaah.tgl_akhir_visa,
                            jamaah.muassasah,
                            jamaah.no_registrasi,
                            jamaah.user_id,
                            jamaah.status_vaksin,
                            jamaah.tgl_vaksin,
                            jamaah.jenis_vaksin,

                            paket.travel_id,
                            paket.rekening_penampung_id,
                            paket.travel_id,
                            paket.id as id_paket,
                            paket.nama as nama_paket
            FROM jamaah INNER JOIN paket ON jamaah.paket_id = paket.id WHERE paket.travel_id = '$travel' AND jamaah.kloter_id IS NULL ORDER BY jamaah.id DESC")->getResultArray(),
            'bank'  =>  $bank
        ];


        return view("jamaah/request_jamaah/index",$data);
    }
    public function detail_jamaah_lokasi($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $db      = \Config\Database::connect();
        $travel = session()->get("travel_id");
        $petugas_man  = new PetugasManModel();
        $level = new LevelPetugasModel();
        $jamaah = new JamaahModel();
        $kloter = new KloterModel();
        $bank  = new BankModel();
        $check = $jamaah->where('id',$id)->first();
        if(!$check) {
            return redirect()->to('request_jamaah');
        }
        $data = [
            'kloter'    =>  $kloter,
            'main'  =>  $jamaah->where('id',$id)->first(),
            'level' =>  $level->findAll(),
            'dbs'    =>  \Config\Database::connect(),
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Request Jamaah",
            'petugas'   =>  $petugas_man->where("travel_id",session()->get("travel_id"))->findAll(),
            'jamaah'    =>  $db->query("SELECT
                            jamaah.nama as nama_jamaah,
                            jamaah.kloter_id,
                            jamaah.paket_id,
                            jamaah.foto,
                            jamaah.no_identitas,
                            jamaah.tempat_lahir,
                            jamaah.tgl_lahir,
                            jamaah.no_pasti_umrah,
                            jamaah.no_hp,
                            jamaah.id,

                            jamaah.title,
                            jamaah.nama,
                            jamaah.nama_paspor,
                            jamaah.ayah,
                            jamaah.jenis_identitas,
                            jamaah.provinsi,
                            jamaah.kabupaten,
                            jamaah.kecamatan,
                            jamaah.kelurahan,
                            jamaah.alamat,
                            jamaah.no_telp,
                            jamaah.kewargannegaraan,
                            jamaah.status_pernikahan,
                            jamaah.jenis_pendidikan,
                            jamaah.jenis_pekerjaan,
                            jamaah.provider,
                            jamaah.asuransi,
                            jamaah.no_paspor,
                            jamaah.no_identitas,
                            jamaah.rekening_penampung,
                            jamaah.status_bayar,
                            jamaah.nomor_polis,
                            jamaah.tgl_input,
                            jamaah.tgl_awal,
                            jamaah.tgl_akhir,
                            jamaah.nomor_visa,
                            jamaah.tgl_awal_visa,
                            jamaah.tgl_akhir_visa,
                            jamaah.muassasah,
                            jamaah.no_registrasi,
                            jamaah.user_id,
                            jamaah.status_vaksin,
                            jamaah.tgl_vaksin,
                            jamaah.jenis_vaksin,

                            paket.travel_id,
                            paket.rekening_penampung_id,
                            paket.travel_id,
                            paket.id as id_paket,
                            paket.nama as nama_paket
            FROM jamaah INNER JOIN paket ON jamaah.paket_id = paket.id WHERE paket.travel_id = '$travel' AND jamaah.kloter_id IS NULL ORDER BY jamaah.id DESC")->getResultArray(),
            'bank'  =>  $bank
        ];


        return view("jamaah/request_jamaah/detail",$data);
    }

    public function pilih_kloter()
    {
        $id_jamaah = $this->request->getVar("id_jamaah");

        $jamaah = new JamaahModel();
        $kloter = new KloterModel();
        $data_kloter = $kloter->where('id',$this->request->getVar('kloter'))->first();
        if($data_kloter['batas_jamaah'] <= 0) {
            return redirect()->back()->with('error','Kuota Jamaah Sudah Habis');
        }

        $check = $jamaah->where("kloter_id",$this->request->getVar('kloter'))->first();
        if($check) {
            return redirect()->back()->with('error','Jamaah Ini Sudah Pernah Terdaftar');
        }
        $jamaah->update($id_jamaah,[
            'kloter_id' =>  $this->request->getVar("kloter")
        ]);

        $kloter->update($this->request->getVar('kloter'),[
            'batas_jamaah'  =>  $data_kloter['batas_jamaah'] - 1
        ]);

        $res = $jamaah->where("id",$id_jamaah)->first();
        $pakets = new PaketModel();
        $rt = $pakets->where("id",$res['paket_id'])->first();

        $daftar = new DaftarJamaahModel();
        $now = date("Y-m-d");
        $che = $daftar->where('travel_id',$rt['travel_id'])->where('date(bulan)',$now)->orderby('id','desc')->first();
        if($che) {
            // $daftar
            $yy = $daftar->where("travel_id",$rt['travel_id'])->orderBy('id','desc')->first();
            $daftar->update($yy['id'],[
                'jamaah'    =>  $yy['jamaah'] + 1
            ]);
        } else {
            $daftar->insert([
                'bulan' =>  date("Y-m-d"),
                'jamaah'    =>  1,
                'travel_id' =>  $rt['travel_id']
            ]);
        }

        return redirect()->back()->with('success','Data Berhasil Diupdate');
    }

    public function dash_admin()
    {
        $jamaah = new JamaahModel();
        $baner = new BannerModel();
        $db      = \Config\Database::connect();
        $daftar = new DaftarJamaahModel();
        $dash = new DashboardAdmin();
        $data = [
            'total_jamaah'    =>  $db->query("SELECT * FROM jamaah")->getNumRows(),
            'aktif_jamaah'    =>  $db->query("SELECT * FROM jamaah WHERE status_approve  IS NULL ")->getNumRows(),
            'sudah_berangkat'    =>  $db->query("SELECT * FROM jamaah WHERE status_approve  IS NOT NULL")->getNumRows(),
            'paket'    =>  $db->query("SELECT * FROM paket WHERE status = 'aktif'")->getNumRows(),
            'profile'    =>  $db->query("SELECT * FROM profile")->getNumRows(),
            'banners'    =>  $db->query("SELECT * FROM banner")->getNumRows(),
            'cabang_travel'    =>  $db->query("SELECT * FROM data_cabang_travel WHERE status = 'aktif'")->getNumRows(),
            'kasus'    =>  $db->query("SELECT * FROM kasus ")->getNumRows(),
            'db'    =>  $db,
            'banner'    =>  $baner->findAll(),
            'daftar'    =>  $daftar->groupBy('bulan')->findAll(),
            'dash'  =>  $dash->myJoinQuery(),
            'title' =>  'Dashboard'
        ];
        return view('admin/dashboard',$data);
    }
}