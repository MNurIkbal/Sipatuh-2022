<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BandaraModel;
use App\Models\DataHotelModel;
use App\Models\HotelModel;
use App\Models\JamaahModel;
use App\Models\KasusModel;
use App\Models\Keberangkatan;
use App\Models\KepulanganModel;
use App\Models\KloterModel;
use App\Models\LaporanHarianModel;
use App\Models\Maskapai;
use App\Models\MuassahModel;
use App\Models\PaketModel;
use App\Models\PetugasManModel;
use App\Models\PetugasModel;

class RealisasiControlller extends BaseController
{
    public function index()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $travel_id = session()->get('travel_id');
        $paket = new PaketModel();
        $db      = \Config\Database::connect();
        if(session()->get("level_id") == "jamaah") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang'    =>  NULL,
                'kelengkapan' =>    'sudah',
                'status'    =>  "aktif",
                'tiket' =>  'sudah'
            ])->findAll();
        } elseif(session()->get("level_id") == "cabang") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang_id' =>  session()->get('cabang_id'),
                'cabang'    =>  "cabang",
                'status'    =>  "aktif",
                'kelengkapan' =>    'sudah',
                'tiket' =>  'sudah'
            ])->findAll();
        }
        $data = [
            // 'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            // 'result'    =>  $db->query("SELECT paket.nama,paket.tgl_berangkat,paket.tgl_pulang,paket.biaya,paket.id FROM paket LEFT JOIN kloter ON paket.id = kloter.paket_id WHERE travel_id = '$travel_id' AND kloter.keberangkatan = 'sudah' AND paket.status = 'aktif' AND paket.kelengkapan = 'sudah' AND paket.tiket IS NOT NULL")->getResultArray(),
            'title' =>  "Realiasi",
            // 'result'    =>  $paket->where([
            //     'status'    =>  "aktif",
            //     'travel_id'   =>  session()->get("travel_id"),
            //     'kelengkapan'   =>  'sudah',
            //     'tiket' =>  'sudah'
            // ])->findAll()
            'result'    =>  $datapaket,
        ];
        return view("jamaah/realisasi/index",$data);
    }

    public function detail_realisasi_kloter($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kasus = new KasusModel();
        $petugas_umrah = new PetugasManModel();
        $muasah = new MuassahModel();
        $maskapai  = new Maskapai();
        $bandara = new BandaraModel();
        $kloter = new KloterModel();
        $data = [
            'bandara'   =>  $bandara->findAll(),
            'maskapai'  =>  $maskapai->where("status",1)->findAll(),
            'title' =>  "Realisasi",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'id_paket'  =>  $id,
            'kloter'    =>  $kloter->where("paket_id",$id)->where("status","Aktif")->where("keberangkatan","sudah")->where('status_realisasi','sudah')->where("done",NULL)->findAll(),
            'paket' =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                'kategori'  =>  'realisasi'
            ])->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("travel_id",session()->get("travel_id"))->where("aktif","aktif")->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'realisasi'
            ])->findAll(),
            'hotel' =>$hotel->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'realisasi'
            ])->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'realisasi'
            ])->findAll(),
            'muasah'    =>  $muasah->where("status",1)->findAll(),
            'kasus' =>  $kasus->where("paket_id",$id)->findAll(),
        ];
        return view("jamaah/realisasi/kloter_detail",$data);
    }

    public function detail_realisasi($id_kloter,$id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kasus = new KasusModel();
        $petugas_umrah = new PetugasManModel();
        $muasah = new MuassahModel();
        $maskapai  = new Maskapai();
        $bandara = new BandaraModel();
        $db      = \Config\Database::connect();
        $travel_id = session()->get("travel_id");
        $data_hotel = new DataHotelModel();
        $kloter = new KloterModel();
        $data = [
            'bandara'   =>  $bandara->findAll(),
            'maskapai'  =>  $maskapai->where("status",1)->findAll(),
            'title' =>  "Realisasi",
            'data_hotel'    =>  $data_hotel->findAll(),
            // 'result'    =>  $paket->where([
            //     'id'    =>  $id
            // ])->first(),
            'result'    =>  $db->query("SELECT paket.nama,paket.tgl_berangkat,paket.tgl_pulang,paket.biaya,paket.id,paket.kode_paket,kloter.keberangkatan,paket.pemberangkatan,kloter.selesai FROM paket LEFT JOIN kloter ON paket.id = kloter.paket_id WHERE travel_id = '$travel_id' AND kloter.keberangkatan = 'sudah' AND paket.status = 'aktif' AND paket.kelengkapan = 'sudah' AND kloter.id = '$id_kloter' AND paket.id = '$id'")->getRowArray(),
            'id_paket'  =>  $id,
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                // 'kategori'  =>  'realisasi', 
                // 'kloter_id' =>  $id_kloter,
            ])->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("travel_id",session()->get("travel_id"))->where("aktif","aktif")->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id,
                // 'kategori'  =>  'realisasi',
                // 'kloter_id' =>  $id_kloter,
            ])->findAll(),
            'hotel' =>$hotel->where([
                'paket_id'  =>  $id,
                // 'kategori'  =>  'realisasi',
                // 'kloter_id' =>  $id_kloter,
            ])->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id,
                // 'kategori'  =>  'realisasi',
                // 'kloter_id' =>  $id_kloter,
            ])->findAll(),
            'muasah'    =>  $muasah->where("status",1)->findAll(),
            'kasus' =>  $kasus->where("paket_id",$id)->where("kloter_id",$id_kloter)->findAll(),
            'id_kloter' =>  $id_kloter,
            'kloter'    =>  $kloter->where("id",$id_kloter)->first()
        ];
        return view("jamaah/realisasi/detail",$data);
    }

    public function tambah_petugas_realisasi()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $id = $this->request->getVar("id");
        $petugas = $this->request->getVar('petugas');
        $id_paket =  $this->request->getVar("id_paket");
        $petugas_umrah = new PetugasManModel();
        $data = $petugas_umrah->where("id",$petugas)->first();
        $petugass = new PetugasModel();
        $check = $petugass->where("nama",$data['nama'])->where("paket_id",$id_paket)->first();
        if($check) {
            return redirect()->back()->with("error","Petugas Sudah Pernah Ditambahkan");
            exit;
        }
        $id = $this->request->getVar("id");

        $petugas = new PetugasModel();
        $petugas->insert([
            'nama'  =>  $data['nama'],
            'type'  =>  $data['tipe_petugas'],
            'created_at'    =>  date("Y-m-d"),
            'update_at' =>  date("Y-m-d"),
            'paket_id'  =>  $id_paket,
            'kategori'  =>  'realisasi',
            'kloter_id' =>  $this->request->getVar("id_kloter"),
        ]);

        return redirect()->back()->with("success","Data Berhasil Di Tambahkan");
    }

    public function hapus_petugas_realisasi() 
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        

        $petugas = new PetugasModel();
        $petugas->delete($this->request->getVar("id"));
        return redirect()->to("detail_realisasi/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Dihapus");
    }

    public function edit_petugas_realisasi()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $id = $this->request->getVar("id");
        $id_paket = $this->request->getVar("id_paket");
        $petugas = $this->request->getVar('petugas');
        $id_kloter = $this->request->getVar("id_kloter");

        $petugas_umrah = new PetugasManModel();
        $data = $petugas_umrah->where("nama",$petugas)->first();
        $petugas = new PetugasModel();
        $check = $petugas->where("nama",$data['nama'])->where("kategori",'realisasi')->where("kloter_id",$id_kloter)->where("paket_id",$id_paket)->first();
        if($check) {
            return redirect()->to("detail_realisasi/" .  $this->request->getVar("id_kloter") . '/' . $id_paket)->with("success","Petugas Sudah Pernah Ditambahkan");
            exit;
        }
        $petugas = new PetugasModel();
        $petugas->update($id,[
            'nama'  =>  $data['nama'],
            'type'  =>  $data['tipe_petugas'],
        ]);
        return redirect()->to("detail_realisasi/" .  $this->request->getVar("id_kloter") . '/' . $id_paket)->with("success","Data Berhasil Diupdate");
    }

    public function tambah_keberangkatan_realisasi()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $pakets_baru = new PaketModel();
        $paket_tes = $pakets_baru->where('id',$this->request->getVar("id_paket"))->first();
        $star_waktu = date("Y-m-d",strtotime($paket_tes['tgl_berangkat']));
        $end_waktu = date("Y-m-d",strtotime($paket_tes['tgl_pulang']));
        $awal  = date("Y-m-d",strtotime($this->request->getVar("tgl_berangkat")));
        $end =  date("Y-m-d",strtotime($this->request->getVar("tgl_tiba")));
        if($awal < $star_waktu) {
            return redirect()->back()->with("error","Waktu Berangkat Kurang Dari Waktu Keberangkatan Paket");
        } elseif($end > $end_waktu) {
            return redirect()->back()->with("error","Waktu Kepulangan Melebihi Dari Waktu Pulang  Paket");
        } 
        if($end <= $awal) {
            return redirect()->back()->with("error","Waktu Pulang Tidak Boleh Kurang Atau Sama Dengan Waktu Keberangkatan");
        }
        $keberangkatan = new Keberangkatan();
        $keberangkatan->insert([
            'maskapai'  =>  $this->request->getVar("maskapai"),
            'nomor'  =>  $this->request->getVar("nomor"),
            'nama_bandara'  =>  $this->request->getVar("bandara_berangkat"),
            'tgl_berangkat'  =>  $this->request->getVar("tgl_berangkat"),
            'jam_berangkat'  =>  $this->request->getVar("jam_berangkat"),
            'bandara_tiba'  =>  $this->request->getVar("bandara_tiba"),
            'tgl_bandara_tiba'  =>  $this->request->getVar("tgl_tiba"),
            'jam_tiba'  =>  $this->request->getVar("jam_tiba"),
            'paket_id'  =>  $this->request->getVar("id_paket"),
            'created_at'  =>  date("Y-m-d"),
            'update_at'  =>  date("Y-m-d"),
            'kategori'  =>  'realisasi',
            'kloter_id' =>  $this->request->getVar('id_kloter')
        ]);

        return redirect()->to("detail_realisasi/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Ditambahkan");
    }

    public function hapus_keberangkatan_realisasi()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $keberangkatan = new Keberangkatan();
        $keberangkatan->delete($this->request->getVar("id"));
        return redirect()->to("detail_realisasi/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Dihapus");
    }

    public function edit_keberangkatan_realisasi()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $pakets_baru = new PaketModel();
        $paket_tes = $pakets_baru->where('id',$this->request->getVar("id_paket"))->first();
        $star_waktu = date("Y-m-d",strtotime($paket_tes['tgl_berangkat']));
        $end_waktu = date("Y-m-d",strtotime($paket_tes['tgl_pulang']));
        $awal  = date("Y-m-d",strtotime($this->request->getVar("tgl_berangkat")));
        $end =  date("Y-m-d",strtotime($this->request->getVar("tgl_tiba")));
        if($awal < $star_waktu) {
            return redirect()->back()->with("error","Waktu Berangkat Kurang Dari Waktu Keberangkatan Paket");
        } elseif($end > $end_waktu) {
            return redirect()->back()->with("error","Waktu Kepulangan Melebihi Dari Waktu Pulang  Paket");
        } 
        if($end <= $awal) {
            return redirect()->back()->with("error","Waktu Pulang Tidak Boleh Kurang Atau Sama Dengan Waktu Keberangkatan");
        }
        $keberangkatan = new Keberangkatan();
        $keberangkatan->update($this->request->getVar("id"),[
            'maskapai'  =>  $this->request->getVar("maskapai"),
            'nomor'  =>  $this->request->getVar("nomor"),
            'nama_bandara'  =>  $this->request->getVar("bandara_berangkat"),
            'tgl_berangkat'  =>  $this->request->getVar("tgl_berangkat"),
            'jam_berangkat'  =>  $this->request->getVar("jam_berangkat"),
            'bandara_tiba'  =>  $this->request->getVar("bandara_tiba"),
            'tgl_bandara_tiba'  =>  $this->request->getVar("tgl_tiba"),
            'jam_tiba'  =>  $this->request->getVar("jam_tiba"),
            // 'created_at'  =>  date("Y-m-d"),
            'update_at'  =>  date("Y-m-d"),
        ]);

        return redirect()->to("detail_realisasi/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar('id_paket'))->with("success","Data Berhasil Diupdate");
    }

    public function tambah_hotel_realisasi()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $pakets_baru = new PaketModel();
        $paket_tes = $pakets_baru->where('id',$this->request->getVar("id_paket"))->first();
        $star_waktu = date("Y-m-d",strtotime($paket_tes['tgl_berangkat']));
        $end_waktu = date("Y-m-d",strtotime($paket_tes['tgl_pulang']));
        $awal  = date("Y-m-d",strtotime($this->request->getVar("masuk")));
        $end =  date("Y-m-d",strtotime($this->request->getVar("keluar")));
        if($awal < $star_waktu) {
            return redirect()->back()->with("error","Waktu Berangkat Kurang Dari Waktu Keberangkatan Paket");
        } elseif($end > $end_waktu) {
            return redirect()->back()->with("error","Waktu Kepulangan Melebihi Dari Waktu Pulang  Paket");
        } 
        if($end <= $awal) {
            return redirect()->back()->with("error","Waktu Pulang Tidak Boleh Kurang Atau Sama Dengan Waktu Keberangkatan");
        }
        $hotel = new HotelModel();
        $data_hotels = new DataHotelModel();
        $result_hotels = $data_hotels->where("nama",$this->request->getVar("nama_hotel"))->first();
        $hotel->insert([
            'lokasi'    =>  $result_hotels['lokasi'],
            'hotel'    =>  $this->request->getVar("nama_hotel"),
            'orang_perkamar'    =>  $this->request->getVar("orang"),
            'tgl_masuk'    =>  $this->request->getVar("masuk"),
            'tgl_keluar'    =>  $this->request->getVar("keluar"),
            'paket_id'    =>  $this->request->getVar("id_paket"),
            'created_at'    =>  date("Y-m-d"),
            'updated_at'    =>  date("Y-m-d"),
            'kategori'  =>  'realisasi',
            'kloter_id' =>  $this->request->getVar("id_kloter")
        ]); 

        return redirect()->to("detail_realisasi/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Ditambahkan");
    }

    public function hapus_hotel_realisasi()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $hotel = new HotelModel();
        $hotel->delete($this->request->getVar("id"));
        return redirect()->to("detail_realisasi/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Dihapus");
    }

    public function edit_hotel_realisasi()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $pakets_baru = new PaketModel();
        $paket_tes = $pakets_baru->where('id',$this->request->getVar("id_paket"))->first();
        $star_waktu = date("Y-m-d",strtotime($paket_tes['tgl_berangkat']));
        $end_waktu = date("Y-m-d",strtotime($paket_tes['tgl_pulang']));
        $awal  = date("Y-m-d",strtotime($this->request->getVar("masuk")));
        $end =  date("Y-m-d",strtotime($this->request->getVar("keluar")));
        if($awal < $star_waktu) {
            return redirect()->back()->with("error","Waktu Berangkat Kurang Dari Waktu Keberangkatan Paket");
        } elseif($end > $end_waktu) {
            return redirect()->back()->with("error","Waktu Kepulangan Melebihi Dari Waktu Pulang  Paket");
        } 
        if($end <= $awal) {
            return redirect()->back()->with("error","Waktu Pulang Tidak Boleh Kurang Atau Sama Dengan Waktu Keberangkatan");
        }
        $hotel = new HotelModel();
        $data_hotels = new DataHotelModel();
        $result_hotels = $data_hotels->where('nama',$this->request->getVar('nama_hotel'))->first();
        $hotel->update($this->request->getVar("id"),[
            'lokasi'    =>  $result_hotels['lokasi'],
            'hotel'    =>  $this->request->getVar("nama_hotel"),
            'orang_perkamar'    =>  $this->request->getVar("orang"),
            'tgl_masuk'    =>  $this->request->getVar("masuk"),
            'tgl_keluar'    =>  $this->request->getVar("keluar"),
        ]);

        return redirect()->to("detail_realisasi/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Diupdate");
    }

    public function tambah_kepulangan_realisasi()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $pakets_baru = new PaketModel();
        $paket_tes = $pakets_baru->where('id',$this->request->getVar("id_paket"))->first();
        $star_waktu = date("Y-m-d",strtotime($paket_tes['tgl_berangkat']));
        $end_waktu = date("Y-m-d",strtotime($paket_tes['tgl_pulang']));
        $awal  = date("Y-m-d",strtotime($this->request->getVar("tgl_berangkat")));
        $end =  date("Y-m-d",strtotime($this->request->getVar("tgl_tiba")));
        if($awal < $star_waktu) {
            return redirect()->back()->with("error","Waktu Berangkat Kurang Dari Waktu Keberangkatan Paket");
        } elseif($end > $end_waktu) {
            return redirect()->back()->with("error","Waktu Kepulangan Melebihi Dari Waktu Pulang  Paket");
        } 
        if($end <= $awal) {
            return redirect()->back()->with("error","Waktu Pulang Tidak Boleh Kurang Atau Sama Dengan Waktu Keberangkatan");
        }
        $kepulangan = new KepulanganModel();
        $kepulangan->insert([
            'maskapai'  =>  $this->request->getVar("maskapai"),
            'nomor'  =>  $this->request->getVar("nomor"),
            'bandara_berangkat'  =>  $this->request->getVar("bandara_berangkat"),
            'tgl_berangkat'  =>  $this->request->getVar("tgl_berangkat"),
            'jam_berangkat'  =>  $this->request->getVar("jam_berangkat"),
            'bandara_tiba'  =>  $this->request->getVar("bandara_tiba"),
            'tgl_penerbangan_tiba'  =>  $this->request->getVar("tgl_tiba"),
            'jam_tiba'  =>  $this->request->getVar("jam_tiba"),
            'paket_id'  =>  $this->request->getVar("id_paket"),
            'created_at'  =>  date("Y-m-d"),
            'kategori'  =>  'realisasi',
            'kloter_id' =>  $this->request->getVar("id_kloter"),
        ]);

        return redirect()->to("detail_realisasi/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Ditambahkan");
    }

    public function edit_kepulangan_realisasi()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $pakets_baru = new PaketModel();
        $paket_tes = $pakets_baru->where('id',$this->request->getVar("id_paket"))->first();
        $star_waktu = date("Y-m-d",strtotime($paket_tes['tgl_berangkat']));
        $end_waktu = date("Y-m-d",strtotime($paket_tes['tgl_pulang']));
        $awal  = date("Y-m-d",strtotime($this->request->getVar("tgl_berangkat")));
        $end =  date("Y-m-d",strtotime($this->request->getVar("tgl_tiba")));
        if($awal < $star_waktu) {
            return redirect()->back()->with("error","Waktu Berangkat Kurang Dari Waktu Keberangkatan Paket");
        } elseif($end > $end_waktu) {
            return redirect()->back()->with("error","Waktu Kepulangan Melebihi Dari Waktu Pulang  Paket");
        } 
        if($end <= $awal) {
            return redirect()->back()->with("error","Waktu Pulang Tidak Boleh Kurang Atau Sama Dengan Waktu Keberangkatan");
        }
        $kepulangan = new KepulanganModel();
        $kepulangan->update($this->request->getVar("id"),[
            'maskapai'  =>  $this->request->getVar("maskapai"),
            'nomor'  =>  $this->request->getVar("nomor"),
            'bandara_berangkat'  =>  $this->request->getVar("bandara_berangkat"),
            'tgl_berangkat'  =>  $this->request->getVar("tgl_berangkat"),
            'jam_berangkat'  =>  $this->request->getVar("jam_berangkat"),
            'bandara_tiba'  =>  $this->request->getVar("bandara_tiba"),
            'tgl_penerbangan_tiba'  =>  $this->request->getVar("tgl_tiba"),
            'jam_tiba'  =>  $this->request->getVar("jam_tiba"),
            'created_at'  =>  date("Y-m-d")
        ]);

        return redirect()->to("detail_realisasi/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Diupdate");
    }

    public function hapus_kepulangan_realisasi()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $kepulangan = new KepulanganModel();
        $kepulangan->delete($this->request->getVar("id"));
        return redirect()->to("detail_realisasi/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Dihapus");
    }

    public function tambah_kasus()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $kasus = new KasusModel();
        $id = $this->request->getvar("id_paket");
        $kasus->insert([
            'kasus' =>  $this->request->getvar("kasus"),
            'keterangan'    =>  $this->request->getvar("keterangan"),
            'created_at'    =>  date("Y-m-d"),
            'paket_id' =>   $id,
            'kloter_id' =>  $this->request->getVar("id_kloter")
        ]);

        return redirect()->to("detail_realisasi/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Ditambahkan");
    }

    public function edit_kasus()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $id_kasus = $this->request->getvar("id_kasus");
        $id = $this->request->getvar("id_paket");

        $kasus = new KasusModel();
        $kasus->update($id_kasus,[
            'kasus' =>  $this->request->getvar("kasus"),
            'keterangan'=>  $this->request->getvar("keterangan"),
        ]);

        return redirect()->to("detail_realisasi/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Diupdate");
    }

    public function hapus_kasus()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $id_kasus = $this->request->getvar("id_kasus");
        $id = $this->request->getvar("id_paket");

        $kasus = new KasusModel();
        $kasus->delete($id_kasus);

        return redirect()->to("detail_realisasi/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Dihapus");
    }

    public function laporan_harian($id_kasus,$id_paket,$id_kloter)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $kasus = new KasusModel();
        $laporan_harian = new LaporanHarianModel();

        $data = [
            'paket' =>  $paket->first(),
            'kasus' =>  $kasus->where("id",$id_kasus)->first(),
            'result'    =>  $laporan_harian->where("kasus_id",$id_kasus)->findAll(),
            'title' =>  "Laporan Harian",
            'id_kasus'  =>  $id_kasus,
            'id_paket'  =>  $id_paket,
            'id_kloter' => $id_kloter,
        ];

        return view("jamaah/realisasi/laporan_harian",$data);
    }

    public function tambah_laporan_harian()
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
        $id_paket = $this->request->getvar("id_paket");
        $id_kasus = $this->request->getvar("id_kasus");
        $laporan_harian = new LaporanHarianModel();
        $dataBerkas = $this->request->getFile('file');
        $name = $dataBerkas->getName();
        $fileName = $dataBerkas->getRandomName();
        $foto = $fileName;
        $dataBerkas->move('assets/upload/', $fileName);
        $laporan_harian->insert([
            'file_name' =>  $name,
            'file'  =>  $foto,
            'created_at'    =>  date("Y-m-d"),
            'kasus_id'  =>  $id_kasus
        ]);

        return redirect()->to("laporan_harian/" . $id_kasus . '/' . $id_paket . '/' . $this->request->getVar("id_kloter"))->with("success","Data Berhasil Di Tambahkan");
    }

    public function hapus_laporan_harian()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $id_paket = $this->request->getvar("id_paket");
        $id_kasus = $this->request->getvar("id_kasus");
        $id_laporan_harian  = $this->request->getvar("id_laporan_harian");

        $laporan_harian = new LaporanHarianModel();
        $laporan_harian->delete($id_laporan_harian);
        return redirect()->to("laporan_harian/" . $id_kasus . '/' . $id_paket . '/' . $this->request->getVar("id_kloter"))->with("success","Data Berhasil Dihapus");
    }

    public function selesai_paket($id,$id_kloter)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $db      = \Config\Database::connect();
        $paket = new PaketModel();
        $kloter = new KloterModel();
        try {
            //code...
            $kloter->update($id_kloter,[
                'done'  =>  'sudah'
            ]);
    
            $satu = $db->query("SELECT * FROM kloter WHERE paket_id = '$id'  AND done = 'sudah' AND status = 'Aktif'")->getNumRows();
            $dua =  $db->query("SELECT * FROM kloter WHERE paket_id = '$id'   AND status = 'Aktif'")->getNumRows();
            if($satu == $dua) {
                $paket->update($id,[
                    'status'    =>  'selesai'
                ]);
            }

            $jamah = new JamaahModel();
            $jamaah = $jamah->where("paket_id",$id)->where("kloter_id",$id_kloter)->where("status_approve",null)->findAll();
            if($jamaah) {
                foreach($jamaah as $row) {
                    $jamah->update($row['id'],[
                        'status_approve'    =>  'sudah'
                    ]);
                }
            }
    
            return redirect()->to("realisasi")->with("success","Data Berhasil Direalisasikan");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error","Data Gagal Direalisasikan");
            //throw $th;
        }
    }
}
