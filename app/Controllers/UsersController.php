<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BeritaCompanyModel;
use App\Models\CabangModel;
use App\Models\CompanyVideoModel;
use App\Models\DashboardAdmin;
use App\Models\FotoCompanyModel;
use App\Models\KontakUserCompanyModel;
use App\Models\LayananCompanyModel;
use App\Models\PaketModel;
use App\Models\PetugasManModel;
use App\Models\ProfileCompany;
use App\Models\ProfileModel;
use App\Models\SliderCompany;
use App\Models\TestimoniCompanyModel;
use App\Models\TravelModel;
use App\Models\Users;
use Myth\Auth\Entities\User;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class UsersController extends BaseController
{
    public function index()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $validation = \Config\Services::validation();
        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $db      = \Config\Database::connect();
        $users = new Users();
        $travel = new ProfileModel();
        $perusahaan = new TravelModel();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Travel",
            'perusahaan'    =>  $perusahaan->findAll(),
            'petugas'   =>  $petugas_man->findAll(),
            'user'  =>  $users->findAll(),
            'travel'    =>  $travel->findAll(),
            // 'validation'    =>  $validation
            'provinsi'  =>      $db->query("SELECT * FROM provinces")->getResultArray(),
            'title' =>  'Travel'
        ];
        return view("admin/users/index",$data);
    }
    public function edit_travel_baru($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $validation = \Config\Services::validation();
        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $db      = \Config\Database::connect();
        $users = new Users();
        $travel = new ProfileModel();
        $perusahaan = new TravelModel();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Travel",
            'perusahaan'    =>  $perusahaan->findAll(),
            'petugas'   =>  $petugas_man->findAll(),
            'users'  =>  $travel->where('id',$id)->first(),
            'travel'    =>  $travel->findAll(),
            // 'validation'    =>  $validation
            'provinsi'  =>      $db->query("SELECT * FROM provinces")->getResultArray(),
        ];
        return view("admin/users/edit",$data);
    }
    
    public function user_travel($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $validation = \Config\Services::validation();
        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $users = new Users();
        $travel = new ProfileModel();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Travel",
            'petugas'   =>  $petugas_man->findAll(),
            'user'  =>  $users->where("travel_id",$id)->findAll(),
            'travel'    =>  $travel->where("id",$id)->first(),
            'id'    =>  $id,
            // 'validation'    =>  $validation
        ];
        return view("admin/users/users",$data);
    }

    public function add_users()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $users = new Users();

        $check = $users->where("username",$this->request->getVar("username"))->first();
        $checks = $users->where("nama",$this->request->getVar("nama"))->first();
        if($check || $checks) {
            return redirect()->back()->with("error","Data Sudah Ada");
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
        $password = password_hash($this->request->getVar("password"),PASSWORD_DEFAULT);
        $dataBerkas = $this->request->getFile('file');
        $fileName = $dataBerkas->getRandomName();
        $foto = $fileName;
        $dataBerkas->move('assets/upload/', $fileName);
        $users->insert([
            'nama'  =>  $this->request->getVar("nama"),
            'username'  =>  $this->request->getVar("email"),
            'password'  =>  $password,
            'level_id'  =>  $this->request->getVar("level"),
            'created_at'  =>  date("Y-m-d"),
            'img'  =>  $foto,
            'email'  =>  $this->request->getVar("email"),
            'no_hp'  =>  $this->request->getVar("no_hp"),
            'kelengkapan'   =>  'sudah',
            'travel_id' =>  $this->request->getVar('id'),
        ]);

        
        return redirect()->to('user_travel' . '/' . $this->request->getVar('id'))->with("success","Data Berhasil Ditambahkan");
    }

    public function edit_users()
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
        $id = $this->request->getVar("id");
        $dataBerkas = $this->request->getFile('file');
        if($dataBerkas->getError() === 4) {
            $foto = $this->request->getVar("file_lama");
        } else {
            $fileName = $dataBerkas->getRandomName();
            $foto = $fileName;
            $dataBerkas->move('assets/upload/', $fileName);
        }
        $user = new Users();
        $user->update($id,[
            'nama'  =>  $this->request->getVar("nama"),
            'username'  =>  $this->request->getVar("username"),
            'created_at'  =>  date("Y-m-d"),
            'img'  =>  $foto,
            'email'  =>  $this->request->getVar("email"),
            'no_hp'  =>  $this->request->getVar("no_hp"),
        ]);
        return redirect()->to("user_travel" . '/' . $this->request->getVar('travel_id'))->with("success","Data Berhasil Diupdate");
    }

    public function hapus_users()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $id = $this->request->getVar("id");

        $users = new Users();
        $check = $users->where("travel_id",$id)->first();
        $petugas = new PetugasManModel();
        $cabang = new CabangModel();
        $check_enam = $cabang->where("travel_id",$id)->first();
        $check_tiga = $petugas->where("travel_id",$id)->first();
        $check_enam = new DashboardAdmin();
        $checskl = $check_enam->where("travel_id",$id)->first();
        $berita_company = new BeritaCompanyModel();
        $check_berita = $berita_company->where('travel_id',$id)->countAllResults();
        $vidio_company = new CompanyVideoModel();
        $check_video = $vidio_company->where("travel_id",$id)->countAllResults();
        $foto_company = new FotoCompanyModel();
        $check_foto = $foto_company->where('travel_id',$id)->countAllResults(); 
        $kontak_company = new KontakUserCompanyModel();
        $check_contact = $kontak_company->where("travel_id",$id)->countAllResults();
        $layanan_company = new LayananCompanyModel();
        $check_layanan = $layanan_company->where('travel_id',$id)->countAllResults();
        $profile_company = new ProfileCompany();
        $check_profile = $profile_company->where('travel_id',$id)->countAllResults();
        $slider_company = new SliderCompany();
        $check_slider = $slider_company->where("travel_id",$id)->countAllResults();
        $testimony_company = new TestimoniCompanyModel();
        $check_testimoni = $testimony_company->where('travel_id',$id)->countAllResults();
        if($check || $check_tiga || $check_enam || $checskl || $check_berita || $check_video || $check_foto || $check_contact || $check_profile || $check_slider || $check_testimoni || $check_layanan) {
            return redirect()->back()->with("error",'Data Ini Tidak Boleh Dihapus Karena Sudah Berelasi');
        }

        $user = new ProfileModel();
        $user->delete($id);
        return redirect("users")->with("success","Data Berhasil Dihapus");
    }

    public function hapus_users_baru()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $id = $this->request->getVar("id");
        $id_travel = $this->request->getVar('id_travel');
        $user = new Users();
        $check = $user->where('level_id','jamaah')->where('travel_id',$id_travel)->countAllResults();
        if($check == 1) {
            return redirect()->back()->with('error','Minimal User Harus 1');
        }
        $user->delete($id);
        return redirect()->back();
    }

    public function profile_user($id)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $profil = new ProfileModel();
        $travel =  new TravelModel();

        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Profil",
            'travel'    =>  $travel->findAll(),
            'petugas'   =>  $petugas_man->findAll(),
            'profil'    =>  $profil->where("user_id",$id)->first(),
            'id'    =>  $id,
        ];
        
        return view("admin/users/profile",$data);
    }

    public function profile_user_tambah()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $profil = new ProfileModel();
        $db      = \Config\Database::connect();
        $travel =  new TravelModel();
        $data = [
            'result'    =>  $paket->where("travel_id",session()->get("travel_id"))->where("pemberangkatan","sudah")->where("status","aktif")->findAll(),
            'title' =>  "Travel",
            'travel'    =>  $travel->findAll(),
            'petugas'   =>  $petugas_man->findAll(),
            'provinsi'  =>  $db->query("SELECT * FROM provinces")->getResultArray(),
        ];
        return view("admin/users/profile",$data);
    }

    public function update_profile_users()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $profile = new ProfileModel();
        $check = $profile->where("nama_travel_umrah",$this->request->getVar("nama_travel"))->first();
        $website = $profile->where("website",$this->request->getVar("website"))->first();
        if($check || $website) {
            return redirect()->back()->with('error',"Data Sebelumnya Sudah Ada");
        }
        if(!$this->validate([
            'file_logo' => [
                "rules" =>  "max_size[file_logo,3024]|mime_in[file_logo,image/jpg,image/jpeg,image/png]"
            ],
            'file' => [
                "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
            ],
        ])) {
            session()->setFlashdata('error',$this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }

        $dataBerkas = $this->request->getFile('file');
        if($dataBerkas->getError() === 4) {
            $gambar = null;
        }  else {
            $fileName = $dataBerkas->getRandomName();
            $gambar = $fileName;
            $dataBerkas->move('assets/upload/', $fileName);
        }

        $dataBerkasDua = $this->request->getFile('file_logo');
        if($dataBerkasDua->getError() === 4) {
            $gambar_dua = null;
        }  else {
            $fileName_dua = $dataBerkasDua->getRandomName();
            $gambar_dua = $fileName_dua;
            $dataBerkasDua->move('assets/upload/', $fileName_dua);
        }

        // $dataBerkasDuaBanner = $this->request->getFile('file_banner');
        // if($dataBerkasDuaBanner->getError() === 4) {
        //     $gambar_duaBanner = $this->request->getVar("foto_lama_banner");
        // }  else {
        //     $fileName_duaBanner = $dataBerkasDuaBanner->getRandomName();
        //     $gambar_duaBanner = $fileName_duaBanner;
        //     $dataBerkasDuaBanner->move('assets/upload/', $fileName_duaBanner);
        // }

        $provinsi_explode = explode("-",$this->request->getVar("provinsi"));
        $provinsi_hasil = $provinsi_explode[1];
        $kabupaten_explode = explode("-",$this->request->getVar("kabupaten"));
        $kabupaten_hasil = $kabupaten_explode[1];
        $kecamatan_explode = explode("-",$this->request->getVar("kecamatan"));
        $kecamatan_hasil = $kecamatan_explode[1];
        $profile->insert([
            'nama_perusahaan' => $this->request->getVar("nama_perusahaan"),
            'nama_travel_umrah' => $this->request->getVar("nama_travel"),
            'npwp' => $this->request->getVar("npwp"),
            'no_sk' => $this->request->getVar("no_sk"),
            'tgl_sk' => $this->request->getVar("tgl_sk"),
            // 'tgl_berakhir_sk' => $this->request->getVar("akhir_sk"),
            'no_telp' => $this->request->getVar("no_telp"),
            'no_hp' => $this->request->getVar("no_hp"),
            'email' => $this->request->getVar("email"),
            'website' => $this->request->getVar("website"),
            'provinsi' => $provinsi_hasil,
            'kabupaten' => $kabupaten_hasil,
            'kecamatan' => $kecamatan_hasil,
            'alamat' => $this->request->getVar("alamat"),
            'alamat_mekkah' => $this->request->getVar("alamat_mekkah"),
            'no_telp_mekkah' => $this->request->getVar("no_telp_mekkah"),
            'alamat_madinah' => $this->request->getVar("alamat_madinah"),
            'no_telp_madinah' => $this->request->getVar("no_telp_madinah"),
            'foto_kantor' => $gambar,
            'created_at'    =>  date("Y-m-d"),
            'logo_travel'   =>  $gambar_dua,
        ]);

        $akhir = $profile->orderby('id','desc')->first();

        // insert company
        $berita_company = new BeritaCompanyModel();
        $berita_company->insert([
            'img'   =>  'about_1.jpg',
            'pesan' =>  'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Esse placeat quibusdam tempora temporibus molestiae cum deleniti, neque recusandae odit! Sint vitae unde similique officiis aut repellendus doloribus in rerum amet.',
            'title' =>  'Judul',
            'lihat' =>  0,
            'created_at'    =>  date("Y-m-d H:i:s"),
            'travel_id' =>  $akhir['id'],
            'lokasi'    =>  'Jakarta'
        ]);

        $video_company = new CompanyVideoModel();
        $video_company->insert([
            'text'  =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis eaque officiis totam excepturi est! Recusandae necessitatibus, at voluptatibus ea aliquam, iste quisquam, exercitationem possimus facilis ullam repudiandae voluptas veritatis molestiae.',
            'title' =>  'Judul',
            'sub_title' =>  'Sub Title',
            'img'   =>  'about1.jpg',
            'yt'    =>  'rM5THSRxiK8',
            'travel_id'  =>  $akhir['id'],
            'status'    =>  1
        ]);

        $foto_company = new FotoCompanyModel();
        $foto_company->insert([
            'img'   =>  'about_1.jpg',
            'created_at'    =>  date("Y-m-d"),
            'travel_id_company' =>  $akhir['id']
        ]);

        $layanan_company = new LayananCompanyModel();
        $layanan_company->insert([
            'travel_id' =>  $akhir['id'],
            'icon'  =>  'fas fa-home',
            'title' =>  'Judul',
            'text'  =>  'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quos cum repellendus aspernatur suscipit obcaecati! Facere inventore, harum officia impedit ex tempore consequatur illum alias. Eligendi qui hic eius saepe repellat.',
            'created_at'    =>  date("Y-m-d H:i:s")
        ]);

        $profile_company = new ProfileCompany();
        $profile_company->insert([
            'logo'  =>  'company.png',
            'facebook'  =>  'https://www.facebook.com',
            'instagram' =>  'https://www.instagram.com',
            'twitter'   =>  'https://www.twitter.com',
            'youtube'    =>  'https://www.youtube.com',
            'deskripsi_about'   =>  'Haji adalah salah satu dari lima rukun Islam yang wajib dilakukan oleh setiap Muslim yang mampu secara fisik, finansial, dan mental. Haji merupakan ibadah ziarah ke Baitullah Al-Haram di Makkah, Saudi Arabia, yang dilakukan pada bulan Dzulhijjah, bulan terakhir dalam kalender Hijriah.',
            'travel_id'    =>  $akhir['id'],
            'deskripsi_footer'  =>  'Haji adalah salah satu dari lima rukun Islam yang wajib dilakukan oleh setiap Muslim yang mampu secara fisik, finansial, dan mental. Haji merupakan ibadah ziarah ke Baitullah Al-Haram di Makkah, Saudi Arabia, yang dilakukan pada bulan Dzulhijjah, bulan terakhir dalam kalender Hijriah.',
            'created_at'    =>  date("Y-m-d H:i:s"),
            'img_about_1'   =>  'about_1.jpg',
            'img_about_2'   =>  'about_2.jpg',
            'img_about_3'   =>  'about_3.jpg',
            'img_about_4'   =>  'about_4.jpg',
            'img_profile'   =>  'about1.jpg',
            'visi'  =>  'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis dolorum iste nihil officiis saepe ad perspiciatis assumenda, corporis et ullam blanditiis necessitatibus, architecto unde, molestias repudiandae voluptates doloremque beatae perferendis.',
            'misi'  =>  'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis dolorum iste nihil officiis saepe ad perspiciatis assumenda, corporis et ullam blanditiis necessitatibus, architecto unde, molestias repudiandae voluptates doloremque beatae perferendis.',
            'text_profile' =>   'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis excepturi delectus, odio ex rerum voluptates laboriosam provident nihil necessitatibus minima consequuntur enim omnis, sapiente debitis ipsum voluptas nemo commodi. Consequatur!',
            // 'maps'  =>  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15866.427970098475!2d106.807296!3d-6.1833216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sMonumen%20Nasional!5e0!3m2!1sid!2sid!4v1685947302713!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        ]);

        $slider_company = new SliderCompany();
        $slider_company->insert([
            'img'   =>  'slider_1.jpg',
            'status'    =>1,
            'created_at'    =>  date("Y-m-d H:i:s"),
            'travel_id' =>  $akhir['id']
        ]);
        $slider_company->insert([
            'img'   =>  'slider_1.jpg',
            'status'    =>0,
            'created_at'    =>  date("Y-m-d H:i:s"),
            'travel_id' =>  $akhir['id']
        ]);

        $testimony_company = new TestimoniCompanyModel();
        $testimony_company->insert([
            'nama'  =>  'User A',
            'travel_id' =>  $akhir['id'],
            'pesan' =>  'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora assumenda accusantium enim, neque dolores impedit dolor aperiam voluptatum qui recusandae soluta ad eveniet at voluptatem. Saepe ipsam facere quod. Doloremque!',
            'created_at'    =>  date("Y-m-d H:i:s"),
            'profesi'   =>  'Pengusaha',
            'img'   =>  'testimonial-1.jpg'
        ]);

        return redirect()->to("users/" )->with("success","Data Berhasil Ditambahkan");
    }

    public function edit_travel()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        
        if(!$this->validate([
            'file_logo' => [
                "rules" =>  "max_size[file_logo,3024]|mime_in[file_logo,image/jpg,image/jpeg,image/png]"
            ],
            'file' => [
                "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
            ],
        ])) {
            session()->setFlashdata('error',$this->validator->listErrors());
            return redirect()->back()->withInput();
        }


        $profile = new ProfileModel();
        $id = $this->request->getVar("id");
        $dataBerkas = $this->request->getFile('file');
        if($dataBerkas->getError() === 4) {
            $gambar = $this->request->getVar("file_kantor_lama");;
        }  else {
            $config["allowed_types"] = "jpg|jpeg|png";
            $config["max_size"] = 4048;
            $fileName = $dataBerkas->getRandomName();
            $gambar = $fileName;
            $dataBerkas->move('assets/upload/', $fileName);
        }

        $dataBerkasDua = $this->request->getFile('file_logo');
        if($dataBerkasDua->getError() === 4) {
            $gambar_dua = $this->request->getVar("file_logo_lama");
        }  else {
            $fileName_dua = $dataBerkasDua->getRandomName();
            $gambar_dua = $fileName_dua;
            $dataBerkasDua->move('assets/upload/', $fileName_dua);
        }

        $profile->update($id,[
            'nama_perusahaan' => $this->request->getVar("nama_perusahaan"),
            'nama_travel_umrah' => $this->request->getVar("nama_travel"),
            'npwp' => $this->request->getVar("npwp"),
            'no_sk' => $this->request->getVar("no_sk"),
            'tgl_sk' => $this->request->getVar("tgl_sk"),
            'no_telp' => $this->request->getVar("no_telp"),
            'no_hp' => $this->request->getVar("no_hp"),
            'email' => $this->request->getVar("email"),
            'alamat_mekkah' => $this->request->getVar("alamat_mekkah"),
            'no_telp_mekkah' => $this->request->getVar("no_telp_mekkah"),
            'alamat_madinah' => $this->request->getVar("alamat_madinah"),
            'no_telp_madinah' => $this->request->getVar("no_telp_madinah"),
            'foto_kantor' => $gambar,
            'logo_travel'   =>  $gambar_dua,
        ]);
        return redirect()->to("users/" )->with("success","Data Berhasil update");
    }
}