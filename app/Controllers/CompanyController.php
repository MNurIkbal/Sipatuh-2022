<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BeritaCompanyModel;
use App\Models\CabangModel;
use App\Models\CompanyVideoModel;
use App\Models\FotoCompanyModel;
use App\Models\JamaahModel;
use App\Models\KontakUserCompanyModel;
use App\Models\LayananCompanyModel;
use App\Models\PaketModel;
use App\Models\ProfileCompany;
use App\Models\ProfileModel;
use App\Models\SliderCompany;
use App\Models\TestimoniCompanyModel;
use CodeIgniter\HTTP\Request;
use Config\Pager;

class CompanyController extends BaseController
{
    public function index($id)
    {
        $profile = new ProfileModel();
        $result = $profile->where('website',$id)->first();
        if(!$result) {
            return redirect()->to('/');
        }
        $travel =   new ProfileCompany();
        $check  = $travel->where("travel_id",$result['id'])->first();
        $slider = new SliderCompany();
        $slid = $slider->where("travel_id",$result['id'])->countAllResults();
         if(!$result || !$check || !$slid)  {
            return redirect()->to('/');
        }
        
        
        $slide = $slider->where("travel_id",$result['id'])->get()->getResult();
        $paket = new PaketModel();
        $check_paket = $paket->where("status","aktif")->where('travel_id',$result['id'])->countAllResults();
        
        $jamaah = new JamaahModel();
        $count_jamaah = $jamaah->getPaketCount($result['id']);
        $cabang = new CabangModel();
        $count_cabang = $cabang->where("travel_id",$result['id'])->countAllResults();
        $paket = new PaketModel();
        $db = \Config\Database::connect();
        $new_paket = $paket->where('travel_id',$result['id'])->where('status','aktif')->where('pemberangkatan',NULL)->where('status_approve','sudah')->orderBy('id','desc')->limit(10)->get()->getResult();
        $video = new CompanyVideoModel();
        $vidio = $video->where('travel_id',$result['id'])->where("status","1")->first();
        $layanan = new LayananCompanyModel();
        $new_layanan  = $layanan->where("travel_id",$result['id'])->get()->getResult();
        $testimoni = new TestimoniCompanyModel();
        $testi = $testimoni->where("travel_id",$result['id'])->get()->getResult();
        $data = [
            'title' =>  $result['nama_travel_umrah'],
            'profile'   =>  $result,
            'vidio' =>  $vidio,
            'layanan'   =>  $new_layanan,
            'testimoni' =>  $testi,
            'db'    => $db,
            'check' =>  $check,
            'jamaah'    =>  $jamaah,
            'slider'    =>  $slide,
            'count_paket'   =>  $check_paket,
            'count_jamaah'  =>  $count_jamaah,
            'count_cabang'  =>  $count_cabang,
            'paket' =>  $new_paket,
            'title' =>  'Beranda'
        ];
        return view('company/index',$data);
    }

    public function profile_company($id)
    {
        $profile = new ProfileModel();
        $result = $profile->where('website',$id)->first();
        if(!$result) {
            return redirect()->to('/');
        }
        $travel =   new ProfileCompany();
        $check  = $travel->where("travel_id",$result['id'])->first();
        $slider = new SliderCompany();
        $slid = $slider->where("travel_id",$result['id'])->countAllResults();
         if(!$result || !$check || !$slid)  {
            return redirect()->to('/');
        }
        
        
      
        $data = [
            'title' =>  $result['nama_travel_umrah'],
            'profile'   =>  $result,
            'check' =>  $check,
            'title' =>  'Profile'

        ];
        return view('company/about',$data);
    }

    public function kontak_company($id)
    {
        $profile = new ProfileModel();
        $result = $profile->where('website',$id)->first();
        
        if(!$result) {
            return redirect()->to('/');
        }
        $travel =   new ProfileCompany();
        $check  = $travel->where("travel_id",$result['id'])->first();
        $slider = new SliderCompany();
        $slid = $slider->where("travel_id",$result['id'])->countAllResults();
         if(!$result || !$check || !$slid)  {
            return redirect()->to('/');
        }
        
        
      
        $data = [
            'title' =>  $result['nama_travel_umrah'],
            'profile'   =>  $result,
            'check' =>  $check,
            'title' =>  'Kontak',
            'id'    =>  $result['id']

        ];
        return view('company/kontak',$data);
    }

    public function kirim_pesan()
    {
        try {
            
            $pesan = new KontakUserCompanyModel();
            $pesan->insert([
                'name'  =>  $this->request->getVar('nama'),
                'email' =>  $this->request->getVar('email'),
                'subjek'    =>  $this->request->getVar('subjek'),
                'pesan' =>  $this->request->getVar('pesan'),
                'created_at'    =>  date("Y-m-d H:i:s"),
                'travel_id' =>  $this->request->getVar('id')
            ]);
            return redirect()->back()->with('success','Data Berhasil Dikirim');
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with('success','Data Gagal Dikirim');
            //throw $th;
        }
    }

    public function foto_company($id)
    {
        $profile = new ProfileModel();
        $result = $profile->where('website',$id)->first();
        if(!$result) {
            return redirect()->to('/');
        }
        $travel =   new ProfileCompany();
        $check  = $travel->where("travel_id",$result['id'])->first();
        $slider = new SliderCompany();
        $slid = $slider->where("travel_id",$result['id'])->countAllResults();
         if(!$result || !$check || !$slid)  {
            return redirect()->to('/');
        }
        
        $foto = new FotoCompanyModel();
        $img = $foto->where("travel_id_company",$result['id'])->get()->getResult();
      
        $data = [
            'title' =>  $result['nama_travel_umrah'],
            'profile'   =>  $result,
            'check' =>  $check,
            'title' =>  'Galeri',
            'foto'  =>  $img,
        ];
        return view('company/foto',$data);
    }

    public function paket_company($id)
    {
        $profile = new ProfileModel();
        $result = $profile->where('website',$id)->first();
        if(!$result) {
            return redirect()->to('/');
        }
        $travel =   new ProfileCompany();
        $check  = $travel->where("travel_id",$result['id'])->first();
        $slider = new SliderCompany();
        $slid = $slider->where("travel_id",$result['id'])->countAllResults();
         if(!$result || !$check || !$slid)  {
            return redirect()->to('/');
        }
        $paket = new PaketModel();
        $new_paket = $paket->where('travel_id',$result['id'])->where('status','aktif')->where('pemberangkatan',NULL)->orderBy('id','desc')->limit(10)->get()->getResult();

        $pager = new Pager();

        // Menentukan jumlah item per halaman
        $perPage = 10;

        // Mendapatkan data berita dari model dengan paginasi
        $hari = date("Y-m-d");
        $beritas = $paket
    ->where('travel_id', $result['id'])
    ->where('status', 'aktif')
    ->where('pemberangkatan', NULL)
    ->where("tgl_pulang >",date("Y-m-d"))
    ->where('status_paket_cabang','sudah')
    ->where('status_approve','sudah')
    ->orderBy('id', 'desc')
    ->paginate($perPage);



        // Mendapatkan tautan pagination
        $pagination = $paket->pager->links();
        $data = [
            'title' =>  $result['nama_travel_umrah'],
            'profile'   =>  $result,
            'check' =>  $check,
            'paket' =>  $beritas,
            'jamaah'    =>  new JamaahModel(),
            'title' =>  'Paket',
            'db'    =>  \Config\Database::connect(),
            'pagination' =>  $pagination,
        ];
        return view('company/paket',$data);
    }

    public function artikel_company($id)
    {
        $profile = new ProfileModel();
        $result = $profile->where('website',$id)->first();
        if(!$result) {
            return redirect()->to('/');
        }
        $travel =   new ProfileCompany();
        $check  = $travel->where("travel_id",$result['id'])->first();
        $slider = new SliderCompany();
        $slid = $slider->where("travel_id",$result['id'])->countAllResults();
         if(!$result || !$check || !$slid)  {
            return redirect()->to('/');
        }
        $berita = new BeritaCompanyModel();
        $news = $berita->where("travel_id",$result['id'])->get()->getResult();
        

        $pager = new Pager();

        // Menentukan jumlah item per halaman
        $perPage = 10;

        // Mendapatkan data berita dari model dengan paginasi
        $beritas = $berita->where('travel_id',$result['id'])->paginate($perPage);

        // Mendapatkan tautan pagination
        $pagination = $berita->pager->links();

        $data = [
            'title' =>  $result['nama_travel_umrah'],
            'profile'   =>  $result,
            'check' =>  $check,
            'title' =>  'Artikel',
            'berita'    =>  $beritas,
            'pagination' =>  $pagination,
            'company'   =>  $id
        ];
        return view('company/artikel',$data);
    }

    public function detail_artikel($id,$company)
    {
        $profile = new ProfileModel();
        $result = $profile->where('website',$company)->first();
        if(!$result) {
            return redirect()->to('/');
        }
        $berita = new BeritaCompanyModel();
        $newst = $berita->where("id",$id)->first();
        if(!$newst) {
            return redirect()->to('/');
        }
        $travel =   new ProfileCompany();
        $check  = $travel->where("travel_id",$result['id'])->first();
        $slider = new SliderCompany();
        $slid = $slider->where("travel_id",$result['id'])->countAllResults();
         if(!$result || !$check || !$slid)  {
            return redirect()->to('/');
        }

        $artikel = $berita->where('travel_id',$result['id'])->orderby('id','desc')->limit(10)->get()->getResult();
        $data = [
            'title' =>  $result['nama_travel_umrah'],
            'profile'   =>  $result,
            'check' =>  $check,
            'title' =>  'Artikel',
            'berita'    =>  $newst,
            'artikel'   =>  $artikel,
            'company'   =>  $company
        ];
        return view('company/detail_artikel',$data);
    }
}