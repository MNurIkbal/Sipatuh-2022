<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataHotelModel;
use App\Models\HotelModel;
use App\Models\PaketModel;

class HotelController extends BaseController
{
    public function tambah_hotel()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $get = $paket->where("id",$this->request->getVar('id'))->first();
        $start = date("Y-m-d",strtotime($get['tgl_berangkat']));
        $end = date("Y-m-d",strtotime($get['tgl_pulang']));

        $awal = date("Y-m-d",strtotime($this->request->getVar("masuk")));
        $akhir = date("Y-m-d",strtotime($this->request->getVar("keluar")));

        if($awal < $start) {
            return redirect()->back()->with("error","Waktu Berangkat Kurang Dari Waktu Keberangkatan Paket");
        } elseif($akhir > $end) {
            return redirect()->back()->with("error","Waktu Kepulangan Melebihi Dari Waktu Pulang  Paket");
        } 
        if($akhir <= $awal) {
            return redirect()->back()->with("error","Waktu Pulang Tidak Boleh Kurang Atau Sama Dengan Waktu Keberangkatan");
        }

        $hotel = new HotelModel();
        $data_hotel = new DataHotelModel();
        $result_hotel = $data_hotel->where("nama",$this->request->getVar("nama_hotel"))->first();
        $hotel->insert([
            'lokasi'    =>  $result_hotel['lokasi'],
            'hotel'    =>  $this->request->getVar("nama_hotel"),
            'orang_perkamar'    =>  $this->request->getVar("orang"),
            'tgl_masuk'    =>  $this->request->getVar("masuk"),
            'tgl_keluar'    =>  $this->request->getVar("keluar"),
            'paket_id'    =>  $this->request->getVar("id"),
            'created_at'    =>  date("Y-m-d"),
            'updated_at'    =>  date("Y-m-d"),
            'kategori' =>   'perencanaan'
        ]);

        return redirect()->to("detail_paket/" . $this->request->getVar("id"))->with("success","Data Berhasil Ditambahkan");
    }

    public function edit_hotel()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        
        $paket = new PaketModel();
        $get = $paket->where("id",$this->request->getVar('id_paket'))->first();
       
        $start = date("Y-m-d",strtotime($get['tgl_berangkat']));
        $end = date("Y-m-d",strtotime($get['tgl_pulang']));
        $awal = date("Y-m-d",strtotime($this->request->getVar("masuk")));
        $akhir = date("Y-m-d",strtotime($this->request->getVar("keluar")));

        if($awal < $start) {
            return redirect()->back()->with("error","Waktu Berangkat Kurang Dari Waktu Keberangkatan Paket");
        } elseif($akhir > $end) {
            return redirect()->back()->with("error","Waktu Kepulangan Melebihi Dari Waktu Pulang  Paket");
        } 
        if($akhir <= $awal) {
            return redirect()->back()->with("error","Waktu Pulang Tidak Boleh Kurang Atau Sama Dengan Waktu Keberangkatan");
        }
        $hotel = new HotelModel();
        $data_hotel = new DataHotelModel();
        $result_hotel = $data_hotel->where("nama",$this->request->getVar("nama_hotel"))->first();
        $hotel->update($this->request->getVar("id"),[
            'lokasi'    =>  $result_hotel['lokasi'],
            'hotel'    =>  $this->request->getVar("nama_hotel"),
            'orang_perkamar'    =>  $this->request->getVar("orang"),
            'tgl_masuk'    =>  $this->request->getVar("masuk"),
            'tgl_keluar'    =>  $this->request->getVar("keluar"),
        ]);

        return redirect()->to("detail_paket/" . $this->request->getVar("id_paket"))->with("success","Data Berhasil Diupdate");
    }

    public function hapus_hotel()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $hotel = new HotelModel();
        $hotel->delete($this->request->getVar("id"));
        return redirect()->to("detail_paket/" . $this->request->getVar("id_paket"))->with("success","Data Berhasil Dihapus");
    }
}
