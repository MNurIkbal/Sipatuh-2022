<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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
        $data = [
            'kloter'    =>  $kloter,
            'level' =>  $level->findAll(),
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Petugas",
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
                            
                            paket.travel_id,
                            paket.id as id_paket,
                            paket.nama as nama_paket

             FROM jamaah INNER JOIN paket ON jamaah.paket_id = paket.id WHERE  paket.travel_id = '$travel' AND jamaah.kloter_id IS NULL ORDER BY id DESC")->getResultArray(),
        ];
        // dd($data['jamaah']);
        return view("jamaah/request_jamaah/index",$data);
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

        return redirect()->back()->with('success','Data Berhasil Diupdate');
    }
}
