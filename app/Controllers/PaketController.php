<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AsuransiModel;
use App\Models\BandaraModel;
use App\Models\BankModel;
use App\Models\CabangModel;
use App\Models\DataHotelModel;
use App\Models\DataProviderModel;
use App\Models\HotelModel;
use App\Models\JamaahModel;
use App\Models\Keberangkatan;
use App\Models\KepulanganModel;
use App\Models\KloterModel;
use App\Models\Maskapai;
use App\Models\MuassahModel;
use App\Models\PaketDashboardTravelModel;
use App\Models\PaketModel;
use App\Models\PetugasManModel;
use App\Models\PetugasModel;
use App\Models\ProfileModel;
use App\Models\ProviderModel;
use CodeIgniter\Database\Database;
use Config\Database as ConfigDatabase;

class PaketController extends BaseController
{
    public function index()
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        // if(session()->get('level_id') != "cabang" ) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException();
        // } elseif(session()->get('level_id') != "jamaah") {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException();
        // }
        $paket = new PaketModel();
        $jamaah = new JamaahModel();
        $provider = new ProviderModel();
        $data_provider = new DataProviderModel();
        $asuransi = new AsuransiModel();
        $kloter = new KloterModel();
        $petugas = new PetugasManModel();
        $rekening_penampung = new BankModel();
        $done = [
            'selesai'
        ];



        if (session()->get("level_id") == "jamaah") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang'    =>  NULL,
                'status !=' =>  'selesai'
            ])->orderBy('id', 'desc')->findAll();
        } elseif (session()->get("level_id") == "cabang") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang_id' =>  session()->get('cabang_id'),
                'cabang'    =>  "cabang",
                'status !=' =>  'selesai'
                // 'status_approve'    =>  'sudah'
            ])->orderBy('id', 'desc')->findAll();
        }

        $data = [
            'title' =>  "Paket",
            'rekening_penampung'    => $rekening_penampung->where("travel_id", session()->get("travel_id"))->where("status", "aktif")->findAll(),
            'kloter'    =>  $kloter->findAll(),
            'result'    =>  $datapaket,
            'provider'  =>  $data_provider->orderBy('nama_provider', 'ASC')->findAll(),
            'asuransi'  =>  $asuransi->orderby('nama', "ASC")->findAll(),
            'petugas'   =>  $petugas->where("aktif", "aktif")->where("travel_id", session()->get('travel_id'))->orderby('nama', "ASC")->findAll()
        ];
        if (session()->get("level_id") == "jamaah") {
            return view("jamaah/paket/index", $data);
        } else {
            return view("jamaah/paket/paket_cabang", $data);
        }
    }

    public function tambah_pakets()
    {
        $paket = new PaketModel();
        $jamaah = new JamaahModel();
        $provider = new ProviderModel();
        $data_provider = new DataProviderModel();
        $asuransi = new AsuransiModel();
        $kloter = new KloterModel();
        $petugas = new PetugasManModel();
        $rekening_penampung = new BankModel();
        $data = [
            'title' =>  "Paket",
            'rekening_penampung'    => $rekening_penampung->where("travel_id", session()->get("travel_id"))->where("status", "aktif")->findAll(),
            'kloter'    =>  $kloter->findAll(),
            
            'provider'  =>  $data_provider->orderBy('nama_provider', 'ASC')->findAll(),
            'asuransi'  =>  $asuransi->orderby('nama', "ASC")->findAll(),
            'petugas'   =>  $petugas->where("aktif", "aktif")->where("travel_id", session()->get('travel_id'))->orderby('nama', "ASC")->findAll()
        ];

        return view("jamaah/paket/tambah", $data);
    }

    public function show_update($id)
    {
        $data_provider = new DataProviderModel();
        $asuransi = new AsuransiModel();
        $paket = new PaketModel();
        $kloter = new KloterModel();
        $petugas = new PetugasManModel();
        $rekening_penampung = new BankModel();
        $datapaket = $paket->where([
            'id'    =>  $id
        ])->orderBy('id', 'desc')->first();
        if(!$datapaket) {
            return redirect()->to('paket');
        }
        $data = [
            'title' =>  "Paket",
            'main'  =>  $datapaket, 
            'rekening_penampung' => $rekening_penampung->where("travel_id", session()->get("travel_id"))->where("status", "aktif")->findAll(),
            'kloter'    =>  $kloter->findAll(),
            'provider'  =>  $data_provider->orderBy('nama_provider', 'ASC')->findAll(),
            'asuransi'  =>  $asuransi->orderby('nama', "ASC")->findAll(),
            'petugas'   =>  $petugas->where("aktif", "aktif")->where("travel_id", session()->get('travel_id'))->orderby('nama', "ASC")->findAll()
        ];

        return view("jamaah/paket/edit", $data);
    }

    public function tambah_paket()
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        try {
        //code...
        $kode = random_int(1111, 99999999);
        $paket  = new PaketModel();
        $waktus = $this->request->getVar('waktu_berangkat');
        $biaya = str_replace(".", "", $this->request->getVar("biaya"));
        $dateParts = explode(" - ", $waktus);

        $startDate = date("Y-m-d",strtotime($dateParts[0]));
        $endDate = date("Y-m-d",strtotime($dateParts[1]));
        // $awal = date("Y-m-d",strtotime($this->request->getVar("waktu_berangkat")));
        // $end = date("Y-m-d",strtotime($this->request->getVar("waktu_pulang")));
        // if($end <= $awal) {
        //     session()->setFlashdata('error','Waktu pulang tidak boleh kurang atau sama dengan waktu berangkat');
        //     return redirect()->back();
        // }
        if (!$this->validate([
            'file' => [
                "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $dataBerkas = $this->request->getFile('file');
        $fileName = $dataBerkas->getRandomName();
        $foto = $fileName;
        $dataBerkas->move('assets/upload/', $fileName);
        if (session()->get("level_id") == "cabang") {
            $cabang = session()->get("cabang_id");
            $cabang_baru = "cabang";
            $newcabang = new CabangModel();
            $firstcabang = $newcabang->where("id", session()->get("cabang_id"))->first();
            $travel_ids = $firstcabang['travel_id'];
            $approve = 'sudah';
            $status_paket = null;
        } else {
            $travel_ids = session()->get("travel_id");
            $approve = 'sudah';
            $status_paket = 'sudah';
            $cabang = null;
            $cabang_baru = null;
        }

        $status = $this->request->getVar('status');
        if (isset($status)) {
            $aktif = 'aktif';
        } else {
            $aktif = 'belum aktif';
        }

        $paket->insert([
            'nama'  =>  $this->request->getVar("nama_paket"),
            'biaya'  =>  $biaya,
            'status'  =>  $aktif,
            'tahun'  =>  $this->request->getVar("tahun"),
            'tgl_berangkat'  =>  $startDate,
            'tgl_pulang'  =>  $endDate,
            'provider'  =>  $this->request->getVar("provider"),
            'asuransi'  =>  $this->request->getVar("asuransi"),
            'ket_berangkat'  =>  $this->request->getVar("ket_berangkat"),
            'ket_pulang'  =>  $this->request->getVar("ket_pulang"),
            'kode_paket'    => $kode,
            'user_id'   => session()->get("id"),
            'travel_id' =>  $travel_ids,
            'poster'    =>  $foto,
            'tour_leader'   =>  $this->request->getVar('leader'),
            'cabang_id' =>  $cabang,
            'status_paket_cabang'   =>  $status_paket,
            'cabang'    =>  $cabang_baru,
            'status_approve'    =>  $approve,
            'rekening_penampung_id' =>  $this->request->getVar('rekening_penampung')
        ]);


        return redirect()->to("/paket")->with("success", "Data Berhasil Ditambahkan");
        } catch (\Throwable $th) {
            return redirect()->to("/paket")->with("error","Data Gagal Ditambahkan");
            //throw $th;
        }
    }
    public function edit_paket($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        if (!$this->validate([
            'file' => [
                "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
            ],
            'kode'  =>  [
                'rules' =>  'is_unique[paket.kode_paket]'
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        try {
            $dataBerkas = $this->request->getFile('file');
        if ($dataBerkas->getError() === 4) {
            $foto = $this->request->getVar("file_lama");
        } else {
            $fileName = $dataBerkas->getRandomName();
            $foto = $fileName;
            $dataBerkas->move('assets/upload/', $fileName);
        }
        $paket  = new PaketModel();
        $biaya = str_replace(".", "", $this->request->getVar("biaya"));
        $waktus = $this->request->getVar('waktu_berangkat');
        $dateParts = explode(" - ", $waktus);

        $startDate = date("Y-m-d",strtotime($dateParts[0]));
        $endDate = date("Y-m-d",strtotime($dateParts[1]));
        // $awal = date("Y-m-d", strtotime($this->request->getVar("waktu_berangkat")));
        // $end = date("Y-m-d", strtotime($this->request->getVar("waktu_pulang")));
        // if ($end <= $awal) {
        //     session()->setFlashdata('error', 'Waktu pulang tidak boleh kurang atau sama dengan waktu berangkat');
        //     return redirect()->back();
        // }
        $staus = $this->request->getVar('status');
        if (isset($staus)) {
            $aktif = 'aktif';
        } else {
            $aktif = 'belum aktif';
        }
        $paket->update($id, [
            'nama'  =>  $this->request->getVar("nama_paket"),
            'biaya'  =>  $biaya,
            'status'  =>  $aktif,
            'tahun'  =>  $this->request->getVar("tahun"),
            'tgl_berangkat'  =>  $startDate,
            'tgl_pulang'  =>  $endDate,
            'provider'  =>  $this->request->getVar("provider"),
            'asuransi'  =>  $this->request->getVar("asuransi"),
            'ket_berangkat'  =>  $this->request->getVar("ket_berangkat"),
            'ket_pulang'  =>  $this->request->getVar("ket_pulang"),
            'poster'    =>  $foto,
        ]);

        return redirect()->to("/paket")->with("success", "Data Berhasil Diupdate");
    } catch (\Throwable $th) {
            return redirect()->to("/paket")->with("error", "Data Gagal Diupdate");
            //throw $th;
        }
    }

    public function hapus_paket($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas = new PetugasModel();
        $check_satu = $petugas->where("paket_id", $id)->first();
        $keberangkatan = new Keberangkatan();
        $check_dua = $keberangkatan->where("paket_id", $id)->first();
        $hotel = new HotelModel();
        $check_tiga = $hotel->where("paket_id", $id)->first();
        $kloter = new KloterModel();
        $check_empat = $kloter->where("paket_id", $id)->first();
        $kepulangan = new KepulanganModel();
        $check_lima = $kepulangan->where("paket_id", $id)->first();
        $jamaah = new JamaahModel();
        $check_enam = $jamaah->where("paket_id", $id)->first();
        if ($check_satu || $check_dua || $check_tiga || $check_empat || $check_lima || $check_enam) {
            return redirect()->back()->with("error", "Data Ini Tidak Boleh Dihapus Karena Sudah Berelasi");
        }
        $paket->delete($id);
        return redirect()->to("/paket")->with("success", "Data Berhasil Dihapus");
    }

    public function detail_paket($id)
    {

        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $check = $paket->where([
            'id'    =>  $id
        ])->first();
        if(!$check) {
            return redirect()->to('paket');
        }
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $maskapai = new Maskapai();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kloter = new KloterModel();
        $petugas_umrah = new PetugasManModel();
        $bandara = new BandaraModel();
        $muasah = new MuassahModel();
        $data_hotel = new DataHotelModel();
        $profile = new ProfileModel();
        $data = [
            'data_hotel'    =>  $data_hotel->findAll(),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'title' =>  "Paket",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'kloter'    =>  $kloter->where('paket_id', $id)->orderBy('id', 'desc')->findAll(),
            'bandara'   =>  $bandara->findAll(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'maskapai'  =>  $maskapai->where("status", 1)->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'hotel' => $hotel->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("aktif", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'nama_travel'   => $profile->where('id',$check['travel_id'])->first()
        ];

        return view("jamaah/paket/detail", $data);
    }

    public function tambah_hotel_paket($id)
    {

        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $check = $paket->where([
            'id'    =>  $id
        ])->first();
        if(!$check) {
            return redirect()->to('paket');
        }
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $maskapai = new Maskapai();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kloter = new KloterModel();
        $petugas_umrah = new PetugasManModel();
        $bandara = new BandaraModel();
        $muasah = new MuassahModel();
        $data_hotel = new DataHotelModel();
        $profile = new ProfileModel();
        $data = [
            'data_hotel'    =>  $data_hotel->orderby('nama','asc')->findAll(),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'title' =>  "Paket",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'kloter'    =>  $kloter->where('paket_id', $id)->orderBy('id', 'desc')->findAll(),
            'bandara'   =>  $bandara->findAll(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'maskapai'  =>  $maskapai->where("status", 1)->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'hotel' => $hotel->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("aktif", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'nama_travel'   => $profile->where('id',$check['travel_id'])->first()
        ];

        return view("jamaah/paket/tambah_hotel", $data);
    }

    public function tambah_pulang($id)
    {

        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $check = $paket->where([
            'id'    =>  $id
        ])->first();
        if(!$check) {
            return redirect()->to('paket');
        }
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $maskapai = new Maskapai();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kloter = new KloterModel();
        $petugas_umrah = new PetugasManModel();
        $bandara = new BandaraModel();
        $muasah = new MuassahModel();
        $data_hotel = new DataHotelModel();
        $profile = new ProfileModel();
        $data = [
            'data_hotel'    =>  $data_hotel->orderby('nama','asc')->findAll(),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'title' =>  "Paket",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'kloter'    =>  $kloter->where('paket_id', $id)->orderBy('id', 'desc')->findAll(),
            'bandara'   =>  $bandara->findAll(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'maskapai'  =>  $maskapai->where("status", 1)->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'hotel' => $hotel->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("aktif", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'nama_travel'   => $profile->where('id',$check['travel_id'])->first()
        ];

        return view("jamaah/paket/tambah_kepulangan", $data);
    }

    public function tambah_kloter_baru($id)
    {

        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $check = $paket->where([
            'id'    =>  $id
        ])->first();
        if(!$check) {
            return redirect()->to('paket');
        }
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $maskapai = new Maskapai();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kloter = new KloterModel();
        $petugas_umrah = new PetugasManModel();
        $bandara = new BandaraModel();
        $muasah = new MuassahModel();
        $data_hotel = new DataHotelModel();
        $profile = new ProfileModel();
        $data = [
            'data_hotel'    =>  $data_hotel->orderby('nama','asc')->findAll(),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'title' =>  "Paket",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'kloter'    =>  $kloter->where('paket_id', $id)->orderBy('id', 'desc')->findAll(),
            'bandara'   =>  $bandara->findAll(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'maskapai'  =>  $maskapai->where("status", 1)->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'hotel' => $hotel->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("aktif", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'nama_travel'   => $profile->where('id',$check['travel_id'])->first()
        ];

        return view("jamaah/paket/tambah_kloter", $data);
    }
    
    public function edit_kloter_baru($id_kloter,$id)
    {

        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $check = $paket->where([
            'id'    =>  $id
        ])->first();
        if(!$check) {
            return redirect()->to('paket');
        }
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $maskapai = new Maskapai();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kloter = new KloterModel();
        $petugas_umrah = new PetugasManModel();
        $bandara = new BandaraModel();
        $muasah = new MuassahModel();
        $data_hotel = new DataHotelModel();
        $profile = new ProfileModel();
        $check_dua = $kloter->where('id',$id_kloter)->first();
        if(!$check_dua) {
            return redirect()->to('paket');
        }
        $data = [
            'data_hotel'    =>  $data_hotel->orderby('nama','asc')->findAll(),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'title' =>  "Paket",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'kloter'    =>  $kloter->where('paket_id', $id)->orderBy('id', 'desc')->findAll(),
            'bandara'   =>  $bandara->findAll(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'maskapai'  =>  $maskapai->where("status", 1)->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'hotel' => $hotel->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("aktif", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'nama_travel'   => $profile->where('id',$check['travel_id'])->first(),
            'kloter_satu'   =>  $kloter->where('id',$id_kloter)->first()
        ];

        return view("jamaah/paket/edit_kloter", $data);
    }

    public function edit_kepulangan_pakets($id_kepulangan,$id)
    {

        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $check = $paket->where([
            'id'    =>  $id
        ])->first();
        if(!$check) {
            return redirect()->to('paket');
        }
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $maskapai = new Maskapai();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kloter = new KloterModel();
        $petugas_umrah = new PetugasManModel();
        $bandara = new BandaraModel();
        $muasah = new MuassahModel();
        $data_hotel = new DataHotelModel();
        $profile = new ProfileModel();
        $check_dua = $kepulangan->where("id",$id_kepulangan)->first();
        if(!$check_dua) {
            return redirect()->to('paket');
        }
        $data = [
            'data_hotel'    =>  $data_hotel->orderby('nama','asc')->findAll(),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'title' =>  "Paket",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'kloter'    =>  $kloter->where('paket_id', $id)->orderBy('id', 'desc')->findAll(),
            'bandara'   =>  $bandara->findAll(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'maskapai'  =>  $maskapai->where("status", 1)->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'hotel' => $hotel->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("aktif", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'nama_travel'   => $profile->where('id',$check['travel_id'])->first(),
            'kepulangan_row'    =>  $kepulangan->where('id',$id_kepulangan)->first(),
        ];

        return view("jamaah/paket/edit_kepulangan", $data);
    }

    public function edit_hotel_paket($id_hotel,$id)
    {

        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $check = $paket->where([
            'id'    =>  $id
        ])->first();
        if(!$check) {
            return redirect()->to('paket');
        }
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $maskapai = new Maskapai();
        $hotel = new HotelModel();
        $check_dua = $hotel->where('id',$id_hotel)->first();
        if(!$check_dua) {
            return redirect()->to('paket');
        }
        $kepulangan = new KepulanganModel();
        $kloter = new KloterModel();
        $petugas_umrah = new PetugasManModel();
        $bandara = new BandaraModel();
        $muasah = new MuassahModel();
        $data_hotel = new DataHotelModel();
        $profile = new ProfileModel();
        $data = [
            'data_hotel'    =>  $data_hotel->orderby('nama','asc')->findAll(),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'title' =>  "Paket",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'kloter'    =>  $kloter->where('paket_id', $id)->orderBy('id', 'desc')->findAll(),
            'bandara'   =>  $bandara->findAll(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'maskapai'  =>  $maskapai->where("status", 1)->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'hotel' => $hotel->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("aktif", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'nama_travel'   => $profile->where('id',$check['travel_id'])->first(),
            'hotel_satu'    =>  $hotel->where('id',$id_hotel)->first()
        ];

        return view("jamaah/paket/edit_hotel", $data);
    }

    public function edit_keberangakatan_paket($id_keberangakatan,$id)
    {

        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        // if (session()->get('level_id') != "jamaah") {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException();
        // }

        $paket = new PaketModel();
        $check = $paket->where([
            'id'    =>  $id
        ])->first();
        if(!$check) {
            return redirect()->to('paket');
        }
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $check_dua = $keberangkatan->where('id',$id_keberangakatan)->first();
        if(!$check_dua) {
            return redirect()->to('paket');
        }
        $maskapai = new Maskapai();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kloter = new KloterModel();
        $petugas_umrah = new PetugasManModel();
        $bandara = new BandaraModel();
        $muasah = new MuassahModel();
        $data_hotel = new DataHotelModel();
        $profile = new ProfileModel();
        $data = [
            'data_hotel'    =>  $data_hotel->findAll(),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'title' =>  "Paket",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'kloter'    =>  $kloter->where('paket_id', $id)->orderBy('id', 'desc')->findAll(),
            'bandara'   =>  $bandara->findAll(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'maskapai'  =>  $maskapai->where("status", 1)->orderby('nama_maskapai','asc')->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'hotel' => $hotel->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("aktif", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'nama_travel'   => $profile->where('id',$check['travel_id'])->first(),
            'main_dua'  =>  $keberangkatan->where('id',$id_keberangakatan)->first(),
        ];
        

        return view("jamaah/paket/edit_keberangkatan", $data);
    }

    public function tambah_keberangkatan_paket($id)
    {

        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        // if (session()->get('level_id') != "jamaah") {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException();
        // }
        $paket = new PaketModel();
        $check = $paket->where([
            'id'    =>  $id
        ])->first();
        if(!$check) {
            return redirect()->to('paket');
        }
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $maskapai = new Maskapai();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kloter = new KloterModel();
        $petugas_umrah = new PetugasManModel();
        $bandara = new BandaraModel();
        $muasah = new MuassahModel();
        $data_hotel = new DataHotelModel();
        $profile = new ProfileModel();
        $data = [
            'data_hotel'    =>  $data_hotel->findAll(),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'title' =>  "Paket",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'kloter'    =>  $kloter->where('paket_id', $id)->orderBy('id', 'desc')->findAll(),
            'bandara'   =>  $bandara->findAll(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'maskapai'  =>  $maskapai->where("status", 1)->orderby('nama_maskapai','asc')->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'hotel' => $hotel->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("aktif", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'nama_travel'   => $profile->where('id',$check['travel_id'])->first()
        ];

        return view("jamaah/paket/tambah_keberangkatan", $data);
    }

    public function tambah_petugas_rencana($id)
    {

        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $check = $paket->where([
            'id'    =>  $id
        ])->first();
        if(!$check) {
            return redirect()->to('paket');
        }
        $petugas = new PetugasModel();
        $petugas_umrah = new PetugasManModel();
        $profile = new ProfileModel();
        $data = [
            'title' =>  "Paket",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("aktif", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'nama_travel'   => $profile->where('id',$check['travel_id'])->first()
        ];

        return view("jamaah/paket/tambah_petugas", $data);
    }

    public function edit_petugas_paket($id_petugas,$id)
    {

        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $check = $paket->where([
            'id'    =>  $id
        ])->first();
        if(!$check) {
            return redirect()->to('paket');
        }
        $petugas = new PetugasModel();
        $check_dua = $petugas->where('id',$id_petugas)->first();
        if(!$check_dua) {
            return redirect()->to('paket');
        }
        $keberangkatan = new Keberangkatan();
        $maskapai = new Maskapai();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kloter = new KloterModel();
        $petugas_umrah = new PetugasManModel();
        $bandara = new BandaraModel();
        $muasah = new MuassahModel();
        $data_hotel = new DataHotelModel();
        $profile = new ProfileModel();
        $data = [
            'title' =>  "Paket",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                'kategori'  =>  'perencanaan'
            ])->orderBy('id', 'desc')->findAll(),
            'main_satu' =>  $petugas->where('id',$id_petugas)->first(),
            'petugas_umrah' =>  $petugas_umrah->where("aktif", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
        ];

        return view("jamaah/paket/edit_petugas", $data);
    }

    public function tambah_petugas()
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $id = $this->request->getVar("id");
        $petugas = $this->request->getVar('petugas');

        $petugas_umrah = new PetugasManModel();
        $data = $petugas_umrah->where("id", $petugas)->first();
        $petugas = new PetugasModel();
        $check = $petugas->where("nama", $data['nama'])->where("kategori", 'perencanaan')->where("paket_id", $id)->first();
        if ($check) {
            return redirect()->to("detail_paket/" . $id)->with("success", "Petugas Sudah Pernah Ditambahkan");
            exit;
        }
        $petugas->insert([
            'nama'  =>  $data['nama'],
            'type'  =>  $data['tipe_petugas'],
            'created_at'    =>  date("Y-m-d"),
            'update_at' =>  date("Y-m-d"),
            'paket_id'  =>  $id,
            'kategori'  =>  'perencanaan'
        ]);

        return redirect()->to("detail_paket/" . $id)->with("success", "Data Berhasil Di Tambahkan");
    }

    public function edit_petugas()
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $id = $this->request->getVar("id");
        $id_paket = $this->request->getVar("id_paket");
        $petugas = $this->request->getVar('petugas');
        $petugas_umrah = new PetugasManModel();
        $data = $petugas_umrah->where("id", $petugas)->first();
        $petugas = new PetugasModel();
        $check = $petugas->where("nama", $data['nama'])->first();
        if ($check) {
            return redirect()->to("detail_paket/" . $id_paket)->with("success", "Petugas Sudah Pernah Ditambahkan");
            exit;
        }
        $petugas = new PetugasModel();
        $petugas->update($id, [
            'nama'  =>  $data['nama'],
            'type'  =>  $data['tipe_petugas'],
        ]);
        return redirect()->to("detail_paket/" . $id_paket)->with("success", "Data Berhasil Diupdate");
    }

    public function hapus_petugas()
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $petugas = new PetugasModel();
        $petugas->delete($this->request->getVar("id"));
        return redirect()->to("detail_paket/" . $this->request->getVar("id_paket"))->with("success", "Data Berhasil Dihapus");
    }
}
