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
        
        $time_waktu = $this->request->getVar('masuk');
        
        $parts = explode(' - ', $time_waktu);
        $tanggalWaktuPertama = $parts[0]; // "18/09/2023 17:00"
        
        $tgl_pertaman = explode(' ', $tanggalWaktuPertama);
        // waktu pertaman
        $time_satu = $tgl_pertaman[0];
        list($day, $month, $year) = explode('/', $time_satu);
        $newDateFormat = sprintf('%04d-%02d-%02d', $year, $month, $day);



        //waktu kedua
        $time_lima  = $parts[1];
        list($hari, $bulan, $tahun) = explode('/', $time_lima);
        $newDateFormat_dua = sprintf('%04d-%02d-%02d', $tahun, $bulan, $hari);

        $hotel = new HotelModel();
        $data_hotel = new DataHotelModel();
        $result_hotel = $data_hotel->where("nama",$this->request->getVar("nama_hotel"))->first();
        $hotel->insert([
            'lokasi'    =>  $result_hotel['lokasi'],
            'hotel'    =>  $this->request->getVar("nama_hotel"),
            'orang_perkamar'    =>  $this->request->getVar("orang"),
            'tgl_masuk'    =>  $newDateFormat,
            'tgl_keluar'    =>  $newDateFormat_dua,
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
       
        $time_waktu = $this->request->getVar('masuk');
        
        $parts = explode(' - ', $time_waktu);
        $tanggalWaktuPertama = $parts[0]; // "18/09/2023 17:00"
        
        $tgl_pertaman = explode(' ', $tanggalWaktuPertama);
        // waktu pertaman
        $time_satu = $tgl_pertaman[0];
        list($day, $month, $year) = explode('/', $time_satu);
        $newDateFormat = sprintf('%04d-%02d-%02d', $year, $month, $day);



        //waktu kedua
        $time_lima  = $parts[1];
        list($hari, $bulan, $tahun) = explode('/', $time_lima);
        $newDateFormat_dua = sprintf('%04d-%02d-%02d', $tahun, $bulan, $hari);
        
        // $one = explode("-",$newDateFormat);
        // $two = explode("-",$newDateFormat_dua);
        $main =date("Y-m-d",strtotime($newDateFormat));
        var_dump("mulai",$main);
        die;
        try {
            //code...
            $hotel = new HotelModel();
            $data_hotel = new DataHotelModel();
            $result_hotel = $data_hotel->where("nama",$this->request->getVar("nama_hotel"))->first();
            $hotel->update($this->request->getVar("id"),[
                'lokasi'    =>  $result_hotel['lokasi'],
                'hotel'    =>  $this->request->getVar("nama_hotel"),
                'orang_perkamar'    =>  $this->request->getVar("orang"),
                'tgl_masuk'    =>  $newDateFormat,
                'tgl_keluar'    =>  $newDateFormat_dua,
            ]);
    
            return redirect()->to("detail_paket/" . $this->request->getVar("id_paket"))->with("success","Data Berhasil Diupdate");
        } catch (\Throwable $th) {
            return redirect()->to("detail_paket/" . $this->request->getVar("id_paket"))->with("error","Data Gagal Diupdate");
            //throw $th;
        }
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
