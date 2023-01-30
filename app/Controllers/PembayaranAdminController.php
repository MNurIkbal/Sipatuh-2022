<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BannerModel;
use App\Models\BuktiModel;
use App\Models\DataBank;
use App\Models\JamaahModel;
use App\Models\KloterModel;
use App\Models\PaketModel;
use App\Models\ProfileModel;

class PembayaranAdminController extends BaseController
{
    public function index()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $profile = new ProfileModel();
        $bank = new DataBank();
        $banner = new BannerModel();
        $pembayaran = new JamaahModel();
        $bukti = new BuktiModel();
        $travel = session()->get("travel_id");
        // dd($travel);/
        $paket = new PaketModel();
        $data_paket = $paket->where("travel_id",$travel)->where("status","aktif")->orderby('id','desc')->findAll();
        $data = [
            'bukti' =>  $bukti,
            'title' =>  "Pembayaran",
            'data_paket'    =>  $data_paket,
            'bank'  =>  $bank->findAll(),
            'banner'    =>  $banner->findAll(),
            // 'jamaah'    =>  $pembayaran->where("selesai_pembayaran",NULL)->orWhere("status_bayar",'cicil')->orWhere("status_bayar",'lunas')->findAll(),
            'jamaah'    =>  $pembayaran->result(session()->get("travel_id")),
            'profile'   =>  $profile->where("id",session()->get("travel_id"))->first(),
        ];

        // dd($data['jamaah']);
        return view("admin/pembayaran/index",$data);
    }
    public function detail_pembayaran_kloter($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $profile = new ProfileModel();
        $bank = new DataBank();
        $banner = new BannerModel();
        $pembayaran = new JamaahModel();
        $bukti = new BuktiModel();
        $travel = session()->get("travel_id");
        // dd($travel);/
        $paket = new PaketModel();
        $data_paket = $paket->where("travel_id",$travel)->where("status","aktif")->where('id',$id)->first();
        $kloter = new KloterModel();
        $result = $kloter->where("paket_id",$id)->findAll();
        $data = [
            'data_kloter'    =>  $result,
            'bukti' =>  $bukti,
            'title' =>  "Pembayaran",
            'id'    =>  $id,
            'data_paket'    =>  $data_paket,
            'bank'  =>  $bank->findAll(),
            'banner'    =>  $banner->findAll(),
            // 'jamaah'    =>  $pembayaran->where("selesai_pembayaran",NULL)->orWhere("status_bayar",'cicil')->orWhere("status_bayar",'lunas')->findAll(),
            'jamaah'    =>  $pembayaran->result(session()->get("travel_id")),
            'profile'   =>  $profile->where("id",session()->get("travel_id"))->first(),
        ];

        // dd($data['jamaah']);
        return view("admin/pembayaran/kloter",$data);
    }
    public function detail_pembayaran_jamaah($id_paket,$id_kloter)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $profile = new ProfileModel();
        $bank = new DataBank();
        $banner = new BannerModel();
        $pembayaran = new JamaahModel();
        $bukti = new BuktiModel();
        $travel = session()->get("travel_id");
        // dd($travel);/
        $paket = new PaketModel();
        $data_paket = $paket->where("travel_id",$travel)->where("status","aktif")->where('id',$id_paket)->first();
        $kloter = new KloterModel();
        $result = $kloter->where("paket_id",$id_paket)->findAll();
        $data = [
            'data_kloter'    =>  $result,
            'bukti' =>  $bukti,
            'title' =>  "Pembayaran",
            'id'    =>  $id_paket,
            'data_paket'    =>  $data_paket,
            'bank'  =>  $bank->findAll(),
            'banner'    =>  $banner->findAll(),
            // 'jamaah'    =>  $pembayaran->where("selesai_pembayaran",NULL)->orWhere("status_bayar",'cicil')->orWhere("status_bayar",'lunas')->findAll(),
            'jamaah'    =>  $pembayaran->result_dua(session()->get("travel_id"),$id_paket,$id_kloter),
            'profile'   =>  $profile->where("id",session()->get("travel_id"))->first(),
        ];

        // dd($data['jamaah']);
        return view("admin/pembayaran/bayar",$data);
    }

    public function tolak($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $bukti = new BuktiModel();
        $jamaah = new JamaahModel();
        $jamaah->update($id,[
            'tgl_bayar' =>  null,
            'rekening_penampung'    =>  null,
            'status_bayar'  =>  null,
            'keterangan_bayar'  =>  null,
            'nominal_pembayaran'    =>  null,
            'bukti_pembayaran'  =>  null,
            'sisa_pembayaran'   =>  null,
            'status_approve_bayar'  =>  'tolak'
        ]);

        $bukti->where("jamaah_id",$id)->delete();
        return redirect()->back()->with('success',"Data Berhasil Diupdate");
    }

    public function approve($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $bukti = new BuktiModel();
        $jamaah = new JamaahModel();
        $jamaah->update($id,[
            'selesai_pembayaran'   =>  'sudah',
            'status_approve_bayar'  =>  'sudah'
        ]);
        return redirect()->back()->with('success',"Data Berhasil Diupdate");
    }

    
}
