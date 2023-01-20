<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AsuransiModel;
use App\Models\DataProviderModel;
use App\Models\JamaahModel;
use App\Models\KloterModel;
use App\Models\PaketModel;
use App\Models\ProviderModel;

class RequestPaketController extends BaseController
{
    public function index()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $jamaah = new JamaahModel();
        $provider = new ProviderModel();
        $data_provider = new DataProviderModel();
        $asuransi = new AsuransiModel();
        $kloter = new KloterModel();
        $data = [
            'title' =>  "Aplikasi Sipatuh",
            'kloter'    =>  $kloter->findAll(),
            'result'    =>  $paket->where([
                // 'user_id'   =>  session()->get("id")
                'travel_id' =>  session()->get('travel_id'),
                'cabang'    =>  'cabang',
                'status'    =>  'aktif',
                'status_paket_cabang'   => NULL,
            ])->findAll(),
            'provider'  =>  $data_provider->findAll(),
            'asuransi'  =>  $asuransi->findAll()
            // 'provider'  =>  $provider->findAll()
        ];
        return view("jamaah/paket_cabang/index",$data);
    }

    public function konfirmasi_paket($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $paket->update($id,[
            'status_paket_cabang'   =>  'sudah'
        ]);

        return redirect()->back()->with("success","Data Berhasil Diupdate");
    }

    public function tolak_paket($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $paket->update($id,[
            'status_approve'   =>  'tolak'
        ]);
        return redirect()->back()->with("success","Data Berhasil Diupdate");
    }
}
