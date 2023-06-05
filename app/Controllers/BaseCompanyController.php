<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BeritaCompanyModel;
use App\Models\CompanyVideoModel;
use App\Models\FotoCompanyModel;
use App\Models\KontakUserCompanyModel;
use App\Models\LayananCompanyModel;
use App\Models\ProfileCompany;
use App\Models\ProfileModel;
use App\Models\SliderCompany;
use App\Models\TestimoniCompanyModel;
use App\Models\Users;

class BaseCompanyController extends BaseController
{
    public function index()
    {
        $profil = new ProfileCompany();
        $new = new ProfileModel();
        $video = new CompanyVideoModel();
        $galeri = new FotoCompanyModel();
        $data = [
            'title' =>  'Pengaturan',
            'profile'   =>  $profil->where('travel_id',session()->get('travel_id'))->first(),
            'webapp'    =>  $new->where('id',session()->get('travel_id'))->first(),
            'video' =>  $video->where('travel_id',session()->get('travel_id'))->first(),
            
        ];
        return view('jamaah/pengaturan_company/index',$data);
    }

    public function tambah_testimoni()
    {
        try {
            $testimoni = new TestimoniCompanyModel();
            if(!$this->validate([
                'file' => [
                    "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
                ]
            ])) {
                session()->setFlashdata('error',$this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $dataBerkas_1 = $this->request->getFile('file');
            $fileName1 = $dataBerkas_1->getRandomName();
            $img_about_1 = $fileName1;
            $dataBerkas_1->move('company/img/', $fileName1);
    
            $testimoni->insert([
                'nama'  =>  $this->request->getVar('nama'),
                'travel_id' =>  session()->get('travel_id'),
                'pesan' =>  $this->request->getVar('pesan'),
                'created_at'    =>  date("Y-m-d H:i:s"),
                'profesi'   =>  $this->request->getVar('profesi'),
                'img'   =>  $img_about_1
            ]);
            return redirect()->back()->with('success','Data Berhasil Ditambahkan');
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Ditambahkan');
            //throw $th;
        }
    }

    public function edit_testimoni()
    {
        try {
            $id = $this->request->getvar('id');
            $testimoni = new TestimoniCompanyModel();
            $dataBerkas_1 = $this->request->getFile('file');
            if($dataBerkas_1->getError() === 4) {
                $img_about_1 = $this->request->getVar('img_lama');
            } else {
                $fileName1 = $dataBerkas_1->getRandomName();
                $img_about_1 = $fileName1;
                $dataBerkas_1->move('company/img/', $fileName1);
            }

            $testimoni->update($id,[
                'nama'  =>  $this->request->getVar('nama'),
                'pesan' =>  $this->request->getVar('pesan'),
                'profesi'   =>  $this->request->getVar('profesi'),
                'img'   =>  $img_about_1
            ]);
            return redirect()->back()->with('success','Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error','Data Gagal Ditambahkan');
        }
    }

    public function hapus_testimoni()
    {
        try {
            $id = $this->request->getVar('id');
            $testimoni = new TestimoniCompanyModel();
            $testimoni->where('id',$id)->delete();
            return redirect()->back()->with('success','Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Dihapus');
            //throw $th;
        }
    }

    public function tambah_galeri()
    {
        try {
            if(!$this->validate([
                'file' => [
                    "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
                ]
            ])) {
                session()->setFlashdata('error',$this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            
            $dataBerkas_1 = $this->request->getFile('file');
            $fileName1 = $dataBerkas_1->getRandomName();
            $img_about_1 = $fileName1;
            $dataBerkas_1->move('company/img/', $fileName1);
            
            $foto = new FotoCompanyModel();
            $foto->insert([
                'img'   =>  $img_about_1,
                'created_at'    =>  date("Y-m-d"),
                'travel_id_company' =>  session()->get('travel_id'),
            ]);
            return redirect()->back()->with('success','Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Ditambahkan');
            //throw $th;
        }
    }

    public function testimoni_company()
    {
        $profil = new ProfileCompany();
        $new = new ProfileModel();
        $video = new CompanyVideoModel();
        $testimoni = new TestimoniCompanyModel();
        $galeri = new FotoCompanyModel();
        $data = [
            'title' =>  'Testimoni',
            'galeri'    =>  $galeri->where("travel_id_company",session()->get('travel_id'))->get()->getResult(),
            'result'    =>   $testimoni->where('travel_id',session()->get('travel_id'))->get()->getResult(),
        ];
        return view('jamaah/testimoni_company/index',$data);
    }

    public function hapus_kontak()
    {
        try {
            $id = $this->request->getVar('id');
            $kontak = new KontakUserCompanyModel();
            $kontak->where("id",$id)->delete();
            return redirect()->back()->with('success','Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Dihapus');
            //throw $th;
        }
    }

    public function hapus_slider()
    {
        try {
            $id = $this->request->getVar('id');
            $slider = new SliderCompany();
            $slider->where('id',$id)->delete();
            return redirect()->back()->with('success','Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Ditambahkan');
            //throw $th;
        }
    }

    public function tambah_slider()
    {
        try {
            if(!$this->validate([
                'file' => [
                    "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
                ]
            ])) {
                session()->setFlashdata('error',$this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $dataBerkas_1 = $this->request->getFile('file');
            $fileName1 = $dataBerkas_1->getRandomName();
            $img_about_1 = $fileName1;
            $dataBerkas_1->move('assets/upload/', $fileName1);

            $slider = new SliderCompany();
            $slider->insert([
                'img'   =>  $img_about_1,
                'created_at'    =>  date("Y-m-d"),
                'travel_id' =>  session()->get('travel_id')
            ]);
            return redirect()->back()->with('success','Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Ditambahkan');
            //throw $th;
        }
    }

    public function kontak_company()
    {
        $profil = new ProfileCompany();
        $new = new ProfileModel();
        $video = new CompanyVideoModel();
        $testimoni = new TestimoniCompanyModel();
        $galeri = new FotoCompanyModel();
        $slider = new SliderCompany();
        $kontak = new KontakUserCompanyModel();
        $data = [
            'title' =>  'Contact',
            'slider'    =>  $slider->where("travel_id",session()->get('travel_id'))->get()->getResult(),
            'kontak'    =>  $kontak->where("travel_id",session()->get('travel_id'))->get()->getResult(),
            'galeri'    =>  $galeri->where("travel_id_company",session()->get('travel_id'))->get()->getResult(),
            'result'    =>   $testimoni->where('travel_id',session()->get('travel_id'))->get()->getResult(),
        ];
        return view('jamaah/kontak_company/index',$data);
    }

    public function hapus_galeri()
    {
        try {
            $id = $this->request->getVar('id');
            $galeri = new FotoCompanyModel();
            $galeri->where('id',$id)->delete();
            return redirect()->back()->with('success','Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Dihapus');
            //throw $th;
        }
    }

    public function update_video()
    {
        try {
            $video = new CompanyVideoModel();
            $id = $this->request->getVar('id');
            if(!$this->validate([
                'file' => [
                    "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
                ]
            ])) {
                session()->setFlashdata('error',$this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $dataBerkas_1 = $this->request->getFile('file');
            if($dataBerkas_1->getError() === 4) {
                $img_about_1 = $this->request->getVar('img_lama');
            } else {
                $fileName1 = $dataBerkas_1->getRandomName();
                $img_about_1 = $fileName1;
                $dataBerkas_1->move('company/img/', $fileName1);
            }
            $video->update($id,[
                'text'  =>  $this->request->getVar('pesan'),
                'title' =>  $this->request->getVar('judul'),
                'sub_title' =>  $this->request->getVar('sub'),
                'img'   =>  $img_about_1,
                'yt'    =>  $this->request->getVar('link'),
            ]);
            return redirect()->back()->with('success','Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Diupdate');
            //throw $th;
        }
    }

    public function tambah_artikel()
    {
        
        try {
            $artikel = new BeritaCompanyModel();
            if(!$this->validate([
                'file' => [
                    "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
                ]
            ])) {
                session()->setFlashdata('error',$this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $dataBerkas_1 = $this->request->getFile('file');
            $fileName1 = $dataBerkas_1->getRandomName();
            $img_about_1 = $fileName1;
            $dataBerkas_1->move('company/img/', $fileName1);
            $artikel->insert([
                'img'   =>  $img_about_1,
                'pesan' =>  $this->request->getVar('pesan'),
                'title' =>  $this->request->getVar('judul'),
                'lihat' =>  0,
                'created_at'    =>  date("Y-m-d"),
                'travel_id' =>  session()->get('travel_id'),
                'lokasi'    =>  $this->request->getVar('lokasi')
            ]);
            return redirect()->back()->with('success','Data Berhasil Ditambahkan');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error','Data Gagal Ditambahkan');
        }
    }

    public function edit_artikel()
    {
        
        try {
            $artikel = new BeritaCompanyModel();
            if(!$this->validate([
                'file' => [
                    "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
                ]
            ])) {
                session()->setFlashdata('error',$this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $dataBerkas_1 = $this->request->getFile('file');
            if($dataBerkas_1->getError() === 4) {
                $img_about_1 = $this->request->getVar('img_lama');
            } else {
                $fileName1 = $dataBerkas_1->getRandomName();
                $img_about_1 = $fileName1;
                $dataBerkas_1->move('company/img/', $fileName1);
            }
            $artikel->update($this->request->getVar('id'),[
                'img'   =>  $img_about_1,
                'pesan' =>  $this->request->getVar('pesan'),
                'title' =>  $this->request->getVar('judul'),
                'lokasi'    =>  $this->request->getVar('lokasi')
            ]);
            return redirect()->back()->with('success','Data Berhasil Diupdate');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error','Data Gagal Ditambahkan');
        }
    }

    public function hapus_artikel()
    {
        try {
            $id = $this->request->getVar('id');
            $artikel = new BeritaCompanyModel();
            $artikel->where('id',$id)->delete();
            return redirect()->back()->with('success','Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Dihapus');
            //throw $th;
        }
    }
    
    public function layanan_company()
    {
        $profil = new ProfileCompany();
        $new = new ProfileModel();
        $layanan = new LayananCompanyModel();
        $artikel = new BeritaCompanyModel();
        $data = [
            'title' =>  'Layanan',
            'layanan'   =>  $layanan->where('travel_id',session()->get('travel_id'))->get()->getResult(),
            'profile'   =>  $profil->where('travel_id',session()->get('travel_id'))->first(),
            'webapp'    =>  $new->where('id',session()->get('travel_id'))->first(),
            'artikel'   =>  $artikel->where('travel_id',session()->get('travel_id'))->get()->getResult(),
        ];
        return view('jamaah/layanan_company/index',$data);
    }

    public function tambah_layanan()
    {
        try {
            $layanan = new LayananCompanyModel();
            $layanan->insert([
                'travel_id' =>  session()->get('travel_id'),
                'icon'  =>  $this->request->getVar('icon'),
                'title'  =>  $this->request->getVar('judul'),
                'text'  =>  $this->request->getVar('pesan')
            ]);
            return redirect()->back()->with('success','Data Berhasil Di Tambahkan');
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Di Tambahkan');
            //throw $th;
        }
    }

    public function edit_layanan()
    {
        try {
            $layanan = new LayananCompanyModel();
            $layanan->update($this->request->getVar('id'),[
                'icon'  =>  $this->request->getVar('icon'),
                'title'  =>  $this->request->getVar('judul'),
                'text'  =>  $this->request->getVar('pesan')
            ]);
            return redirect()->back()->with('success','Data Berhasil Di Tambahkan');
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Di Tambahkan');
            //throw $th;
        }
    }

    public function hapus_layanan()
    {
        try {
            $id = $this->request->getVar('id');
            $layanan = new LayananCompanyModel();
            $layanan->where('id',$id)->delete();
            return redirect()->back()->with('success','Data Berhasil Di Hapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Data Gagal Di Hapus');
            //throw $th;
        }
    }

    public function update_pengaturan()
    {
        try {
            $profil = new ProfileCompany();
            if(!$this->validate([
                'logo' => [
                    "rules" =>  "max_size[logo,3024]|mime_in[logo,image/jpg,image/jpeg,image/png]"
                ],
                'img_about_1' => [
                    "rules" =>  "max_size[img_about_1,3024]|mime_in[img_about_1,image/jpg,image/jpeg,image/png]"
                ],
                'img_about_2' => [
                    "rules" =>  "max_size[img_about_2,3024]|mime_in[img_about_2,image/jpg,image/jpeg,image/png]"
                ],
                'img_about_3' => [
                    "rules" =>  "max_size[img_about_3,3024]|mime_in[img_about_3,image/jpg,image/jpeg,image/png]"
                ],
                'img_about_4' => [
                    "rules" =>  "max_size[img_about_4,3024]|mime_in[img_about_4,image/jpg,image/jpeg,image/png]"
                ],
                'img_profile' => [
                    "rules" =>  "max_size[img_profile,3024]|mime_in[img_profile,image/jpg,image/jpeg,image/png]"
                ],
            ])) {
                session()->setFlashdata('error',$this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $dataBerkas = $this->request->getFile('logo');
            if($dataBerkas->getError() === 4) {
                $logo = $this->request->getVar('logo_lama');
            } else {
                $fileName = $dataBerkas->getRandomName();
                $dataBerkas->move('assets/upload/', $fileName);
                $logo = $fileName;
            }
    
            $dataBerkas_1 = $this->request->getFile('img_about_1');
            if($dataBerkas_1->getError() === 4) {
                $img_about_1 = $this->request->getVar('img_about_1_lama');
            } else {
                $fileName1 = $dataBerkas_1->getRandomName();
                $img_about_1 = $fileName1;
                $dataBerkas_1->move('company/img/', $fileName1);
            }
    
            $dataBerkas_2 = $this->request->getFile('img_about_2');
            if($dataBerkas_2->getError() === 4) {
                $img_about_2 = $this->request->getVar('img_about_2_lama');
            } else {
                $fileName2 = $dataBerkas_2->getRandomName();
                $img_about_2 = $fileName2;
                $dataBerkas_2->move('company/img/', $fileName2);
            }
            
            $dataBerkas_3 = $this->request->getFile('img_about_3');
            if($dataBerkas_3->getError() === 4) {
                $img_about_3 = $this->request->getVar('img_about_3_lama');
            } else {
                $fileName3 = $dataBerkas_3->getRandomName();
                $img_about_3 = $fileName3;
                $dataBerkas_3->move('company/img/', $fileName3);
            }
    
            $dataBerkas_4 = $this->request->getFile('img_about_4');
            if($dataBerkas_4->getError() === 4) {
                $img_about_4 = $this->request->getVar('img_about_4_lama');
            } else {
                $fileName4 = $dataBerkas_4->getRandomName();
                $img_about_4 = $fileName4;
                $dataBerkas_4->move('company/img/', $fileName4);
            }
    
            $dataBerkas_5 = $this->request->getFile('img_profile');
            if($dataBerkas_5->getError() === 4) {
                $img_about_5 = $this->request->getVar('img_profile_lama');
            } else {
                $fileName5 = $dataBerkas_5->getRandomName();
                $img_about_5 = $fileName5;
                $dataBerkas_5->move('company/img/', $fileName5);
            }
    
            $profil->update($this->request->getVar('id'),[
                'logo'  =>  $logo,
                'facebook'  =>  $this->request->getVar('facebook'),
                'instagram' =>  $this->request->getVar('instagram'),
                'twitter'   =>  $this->request->getVar('twitter'),
                'youtube'   =>  $this->request->getVar('youtube'),
                'deskripsi_about'   =>  $this->request->getVar('about'),
                'deskripsi_footer'   =>  $this->request->getVar('footer'),
                'img_about_1'   =>  $img_about_1,
                'img_about_2'   =>  $img_about_2,
                'img_about_3'   =>  $img_about_3,
                'img_about_4'   =>  $img_about_4,
                'img_profile'   =>  $img_about_5,
                'visi'  =>  $this->request->getVar('visi'),
                'misi'  =>  $this->request->getVar('misi'),
                'text_profile'  =>  $this->request->getVar('deskripsi_profile'),
                'maps'  =>  $this->request->getVar('maps')
            ]);
            return redirect()->back()->with('success','Data Berhasil Diupdate');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error','Data Gagal Diupdate');
        }
    }
}
