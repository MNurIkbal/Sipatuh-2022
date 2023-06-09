<?php

namespace App\Controllers;

use App\Models\AsuransiModel;
use App\Models\BannerModel;
use App\Models\BioDataModel;
use App\Models\DataProviderModel;
use App\Models\JamaahModel;
use App\Models\KloterModel;
use App\Models\PaketModel;
use App\Models\ProfileModel;
use App\Models\Users;
use CodeIgniter\Database\BaseConnection;
use Myth\Auth\Entities\User;

class Home extends BaseController
{
    public function index()
    {
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $now = date("Y-m-d");
        $banner = new BannerModel();
        $simpan = 0;
        
        foreach($banner->findAll() as $row) {
            $waktu_mulai  = date("Y-m-d",strtotime($row['star']));
                $waktu_akhir  = date("Y-m-d",strtotime($row['expired']));
                $sekarang = date("Y-m-d");
                if($sekarang < $waktu_mulai) {
                    $simpan =0;
                } elseif($sekarang > $waktu_akhir) {
                    $simpan = 0;
                } else {
                    $simpan++;
                }
        }
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
        $paket = new PaketModel();

        $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
        $count = count($st);
        $hari_ini = date("Y-m-d");
        $paket_result = $paket->where('status','aktif')->where('pemberangkatan',null)->where('tgl_pulang >',$hari_ini)->where('status_approve','sudah')->where('status_paket_cabang','sudah')->orderby('id','desc')->paginate(10);
        // $paket_cabang = $paket->where('status','aktif')->where('pemberangkatan',null)->where('tgl_pulang >',$hari_ini)->where('cabang','cabang')->where('status_approve','sudah')->orderby('id','desc')->paginate(10);
        // $pakets = array_merge($paket_result,$paket_cabang);
        
        $pagination = $paket->pager->links();
        $data = [
            'paket_dua' => $paket_result,
            'pager' =>  $paket->pager,
            'count' =>  $count,
            'baru'    =>  $st,
            'pagination'    =>  $pagination,
            'jamaah'    =>  $jamaah,
            'simpan'    =>  $simpan,
            'title' =>  'Manasikita',
            'db'    =>  $db,
            'banner'    =>  $banner->findAll(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];
        return view("index",$data);
    }

    public function mencari()
    {
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $now = date("Y-m-d");
        $banner = new BannerModel();
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
        
        // $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 10 ")->getResultArray();
        $paket = new PaketModel();
        $paket_dua = $paket->main();

        $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
        $count = count($st);
        $data = [
            'paket_dua' =>  $paket->paginate(10,'paket'),
            'pager' =>  $paket->pager,
            'count' =>  $count,
            'baru'    =>  $st,
            'jamaah'    =>  $jamaah,
            'title' =>  'Travel-Q',
            'db'    =>  $db,
            'banner'    =>  $banner->findAll(),
            // 'paket'    => $paket,
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];
        return view("cari",$data);
    }

    public function ambil_provinsi($id)
    {
        $db      = \Config\Database::connect();
        $str = explode("-",$id);
        $explode = $str[0];
        $kabupaten = $db->query("SELECT * FROM   regencies WHERE  province_id = '$explode' ORDER BY name ASC")->getResultArray(); 

        foreach($kabupaten as $row) {
            $id = $row['id'];
            $nama = $row['name'];
            $data  = "<option value='$id-$nama'>$nama</option>";
            echo $data;
        }
    }

    public function detail_provinsi($id) 
    {
        $db      = \Config\Database::connect();
        $provinsi = $db->query("SELECT * FROM provinces WHERE name = '$id'")->getRowArray();
        return $provinsi['id'];
    }

    public function ambil_provinsi_edit($id)
    {
        $db      = \Config\Database::connect();
        $str = explode("-",$id);
        $explode = $str[0];
        $kabupaten = $db->query("SELECT * FROM   regencies WHERE  province_id = '$id' ORDER BY name ASC" )->getResultArray(); 

        foreach($kabupaten as $row) {
            $id = $row['id'];
            $nama = $row['name'];
            $data  = "<option value='$id'>$nama</option>";
            echo $data;
        }
    }

    public function ambil_kabupaten($id)
    {
        $db      = \Config\Database::connect();
        $str = explode("-",$id);
        $explode = $str[0];
        $kecamatan = $db->query("SELECT * FROM   districts WHERE  regency_id = '$explode' ORDER BY name ASC")->getResultArray(); 


        foreach($kecamatan as $row) {
            $id = $row['id'];
            $nama = $row['name'];
            $data  = "<option value='$id-$nama'>$nama</option>";
            echo $data;
        }
    }

    public function validation_waktu($start,$end,$id_paket)
    {
        $paket = new PaketModel();
        $result_paket = $paket->where("id",$id_paket)->first();
        $mulai = date("Y-m-d",strtotime($start));
        $akhir = date("Y-m-d",strtotime($end));
        // $tgl_berangkat = date("Y");

        if($akhir < $mulai) {
            return "Waktu Akhir Kurang Dari Waktu Mulai";
        } elseif($mulai > $akhir) {
            return "Waktu Mulai Lebih Dari Waktu Akhir";
        } 
    }

    public function ambil_kabupaten_edits($id,$provinsi)
    {
        $db      = \Config\Database::connect();
        $str = explode("-",$id);
        $explode = $str[0];
        $kecamatan = $db->query("SELECT * FROM   districts WHERE  regency_id = '$explode'")->getResultArray(); 


        foreach($kecamatan as $row) {
            $id = $row['id'];
            $nama = $row['name'];
            if($nama == $provinsi){
                $selected = "selected";
            } else {
                $selected = "";
            }
            $data  = "<option value='$id-$nama' $selected>$nama</option>";
            echo $data;
        }
    }

    public function ambil_kecamatan($id)
    {
        $db      = \Config\Database::connect();
        $str = explode("-",$id);
        $explode = $str[0];
        $kelurahan = $db->query("SELECT * FROM   villages WHERE  district_id = '$explode'")->getResultArray(); 


        foreach($kelurahan as $row) {
            $id = $row['id'];
            $nama = $row['name'];
            $data  = "<option value='$id-$nama'>$nama</option>";
            echo $data;
        }
    }

    public function detail_paket_users($id)
    {
        $biodata = new BioDataModel();
        $session = session()->get("login");
        $checks = $biodata->where("user_id",session()->get('id'))->first();
        if(!isset($session) ||  !$checks) {
            return redirect()->to("masuk");
            exit;
        }
        // $provinsi = new Provin
    $db      = \Config\Database::connect();
    $travel = new ProfileModel();
    $now = date("Y-m-d");
    $paket = new PaketModel();
    $banner = new BannerModel();
    $db      = \Config\Database::connect();
    $paket = $paket->where("id",$id)->first();
    $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id ASC LIMIT 10 ")->getResultArray();

    $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
    $count = count($st);
    $provider  = new DataProviderModel();
    $asuransi = new AsuransiModel();
    $kloter = new KloterModel();
    $data = [
        'kloter'    =>  $kloter->where("status","Aktif")->where("paket_id",$id)->where("keberangkatan",NULL)->findAll(),
        'paket_dua' =>  $paket_dua,
        'provider'=>    $provider->findAll(),
        'count' =>  $count,
        'biodata'   =>  $biodata->where("user_id",session()->get('id'))->first(),
        'asuransi'  =>  $asuransi->findAll(),
        'baru'    =>  $st,
        'id'    =>  $id,
        'provinsi'  =>  $db->query("SELECT * FROM provinces")->getResultArray(),
        'title' =>  'Travel-Q',
        'paket'    => $paket,
        'travel'    =>  $travel->where("id",$paket['travel_id'])->first(),
        'count' =>  $db->query("SELECT * FROM profile")->getResult(),
    ];
    
    return view("paket",$data);
    }

    public function cari()
    {
        $result = new PaketModel();
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $data = $this->request->getVar("cari");
        // $query = $db->query("SELECT * FROM paket INNER JOIN profile ON paket.travel_id = profile.id WHERE paket.nama LIKE '$data' OR profile.nama_perusahaan LIKE '$data' OR profile.nama_travel_umrah LIKE '$data' OR profile.provinsi LIKE '$data' OR profile.kabupaten  LIKE '$data' OR profile.kecamatan LIKE '$data' AND kelengkapan = 'sudah' AND pemberangkatan IS NULL  ORDER BY paket.id DESC LIMIT 10")->getResultArray();


        // $count = $db->query("SELECT * FROM paket INNER JOIN profile ON paket.travel_id = profile.id WHERE paket.nama LIKE '$data' OR profile.nama_perusahaan LIKE '$data' OR profile.nama_travel_umrah LIKE '$data' OR profile.provinsi LIKE '$data' OR profile.kabupaten  LIKE '$data' OR profile.kecamatan LIKE '$data' AND kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY paket.id DESC LIMIT 10")->getResultArray();
        if($result->num($data)) {
            $travel = new ProfileModel();
            $now = date("Y-m-d");
            $banner = new BannerModel();
            $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
            $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 10 ")->getResultArray();
    
            $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
            $count = count($st);
            $main = [
                'title' =>  "Travel-Q",
                'paket_dua' =>  $result->cari($data),
            'count' =>  $count,
            'jamaah'    =>  $jamaah,
            'baru'    =>  $st,
            'db'    =>  $db,
            'paket'    => $paket,
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
            ];

            // dd($main['paket_dua']);
            return view("cari",$main);
        } else {
            return redirect()->to("/cari")->with("error","Data Tidak Ditemukan");
        }
    }

    public function tambah_jamaah_user()
    {
        // try {
            $jamaah = new JamaahModel();
            $paket_first = new PaketModel();
            $kode_paket_satu = $paket_first->where("id",$this->request->getVar("id_paket"))->first();
            $kode_paket = $kode_paket_satu['kode_paket'];
            $checks = new BioDataModel();
            // $biodata = $checks->where("user_id",session()->get('id'))->first(); 
            $biodata = $checks->join('paket', 'paket.id', '=', 'biodata.paket_id')
                  ->where('biodata.user_id', session()->get('id'))
                //   ->where('paket.id', session()->get('travel_id'))
                  ->first();
                  dd($biodata);
            // if($biodata) {
            //     return redirect()->back()->with('error','Akun Jamaah Sudah Ada');
            // }

            $jamaah->insert([
                'title' =>  $this->request->getVar("title"),
                'nama' =>  $this->request->getVar("nama"),
                'nama_paspor' =>  $this->request->getVar("nama_paspor"),
                'ayah'  => $this->request->getVar("ayah"),
                'jenis_identitas' =>  $this->request->getVar("jenis_identitas"),
                'tempat_lahir' =>  $this->request->getVar("tempat_lahir"),
                'tgl_lahir' =>  $this->request->getVar("tgl_lahir"),
                'foto' =>  session()->get('img'),
                'alamat' =>  $biodata['alamat'],
                'provinsi' =>  $biodata['provinsi'],
                'kabupaten' =>  $biodata['kabupaten'],
                'kecamatan' =>  $biodata['kecamatan'],
                'kelurahan' =>  $biodata['kelurahan'],
                'no_telp' =>  $this->request->getVar("no_telpon"),
                'no_hp' =>  session()->get('no_hp'),
                'kewargannegaraan' =>  $this->request->getVar("warganegara"),
                'status_pernikahan' =>  $this->request->getVar("nikah"),
                'jenis_pendidikan' =>  $this->request->getVar("jenis_pendidikan"),
                'jenis_pekerjaan' =>  $this->request->getVar("jenis_pekerjaan"),
                'provider' =>  $this->request->getVar("provider"),
                'asuransi' =>  $this->request->getVar("asuransi"),
                'paket_id' =>  $this->request->getVar("id_paket"),
                'created_at' =>  date("Y-m-d"),
                'updated_at' =>  date("Y-m-d"),
                'no_paspor' =>  $this->request->getVar("no_paspor"),
                'no_identitas' =>  $this->request->getVar("no_identitas"),
                'no_pasti_umrah'    =>  "URM"  . date("Y") . date("m") . rand(1111,9999),
                'nomor_polis'   =>  $biodata['nomor_polis'],
                'tgl_input' =>  $biodata['tgl_input'],
                'tgl_awal' =>  $biodata['tgl_awal'],
                'tgl_akhir' =>  $biodata['tgl_akhir'],
                'nomor_visa' =>  $biodata['nomor_visa'],
                'tgl_awal_visa' =>  $biodata['tgl_awal_visa'],
                'tgl_akhir_visa' =>  $biodata['tgl_akhir_visa'],
                'muassasah' =>  $biodata['muassasah'],
                'no_registrasi' => date("Y") . date("m") .  $kode_paket . rand(1111,9999),
                'status_vaksin' =>  'sudah',
                'tgl_vaksin'    =>  $biodata['tgl_vaksin'],
                'jenis_vaksin'    =>  $biodata['jenis_vaksin'],
                'user_id'   =>  session()->get('id')
                // 'kloter_id' =>  $this->request->getVar("id_kloter"),
            ]);

    
            return redirect()->to("detail_paket_users/" .  $this->request->getVar("id_paket"))->with("success","Data Berhasil Di tambahkan");
        // } catch (\Throwable $th) {
        //     return redirect()->to("detail_paket_users/" .  $this->request->getVar("id_paket"))->with("error","Data Gagal Di tambahkan");
        //     //throw $th;
        // }
       
    }

    public function keluar()
    {
        // session()->destroy();
        // session()->remove("login");
        // session()->remove("id");
        // session()->remove("travel_id");
        // return redirect()->to("/masuk");
        session()->destroy();
        session()->remove("login");
        session()->remove("id");
        session()->remove("level_id");
        session()->remove("email");
        session()->remove("no_hp");
        session()->remove("username");
        session()->remove("nama");
        session()->remove("password");
        session()->remove("created_at");
        session()->remove("updated_at");
        session()->remove("cabang_id");
        session()->remove("travel_id");
        session()->remove("jamaah_id");
        return redirect()->to("/masuk");
    }

    public function login()
    {
        $sesi = session()->get("login");
        if(isset($sesi)) {
            if(session()->get("level_id") == "user") {
                return redirect()->to("dashboard_user");
            } else {
                return redirect()->to("dashboard");
            }
        }
        return view("auth");
    }

    public function daftar()
    {
        try {
            $password = $this->request->getVar('password');
            $password_satu = $this->request->getvar('password_satu');
            if($password != $password_satu) {
                return redirect()->to('regis')->with('error',"Password Tidak Sama");
            }
            $username = $this->request->getvar("username");
            $db      = \Config\Database::connect();
            $user = new Users();
            $result = $user->where("username",$username)->first();
            $email = $this->request->getvar('email');
            if($result ) {
                return redirect()->to("regis")->with('error',"Akun Sudah Ada");
            }

            $hash = password_hash($password,PASSWORD_DEFAULT);
            if(!$this->validate([
                'file' => [
                    "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
                ],
            ])) {
                session()->setFlashdata('error',$this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $dataBerkas = $this->request->getFile('file');
            $fileName = $dataBerkas->getRandomName();
            $foto = $fileName;
            $dataBerkas->move('assets/upload/', $fileName); 
            $user->insert([
                'nama'  =>  $this->request->getvar("nama"),
                'username'  =>  $this->request->getvar("username"),
                'password'  =>  $hash,
                'level_id'  =>  'user',
                'created_at'    =>  date("Y-m-d H:i:s"),
                // 'updated_at'    => date("Y-m-d"),
                'img'   =>  $foto,
                'email' =>  $this->request->getVar("username"),
                'no_hp' =>  $this->request->getvar("no_hp"),
                'kelengkapan'   =>  null,
                'travel_id' =>  null,
                'jamaah_id' =>  null,
                'cabang_id' =>  null,
            ]);
            return redirect()->to("masuk")->with('success',"Data Berhasil Ditambahkan");
        } catch (\Throwable $th) {
            return redirect()->to("regis")->with('error',"Data Gagal Ditambahkan");
        }
    }
    public function regis()
    {
        $sesi = session()->get("login");
        if(isset($sesi)) {
            if(session()->get("level_id") == "user") {
                return redirect()->to("dashboard_user");
            } else {
                return redirect()->to("dashboard");
            }
        }
        return view("regis");
    }

    public function detail_banner($id)
    {
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $paket = new PaketModel();
        $data = [
            'title' =>  'Sipatuh',
            'paket' =>  $paket->where("travel_id",$id)->where("status","aktif")->findAll(),
            'id'    =>  $id,
            'banner'    =>  $travel->findAll(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];
        return view("detail",$data);
    }

    
    public function daftar_jamaah($id,$id_paket)
    {
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $paket = new PaketModel();
        $data = [
            'title' =>  'Sipatuh',
            'paket' =>  $paket->findAll(),
            'id'    =>  $id,
            'id_paket'  =>  $id_paket,
            'banner'    =>  $travel->findAll(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];
        return view("daftar",$data);
    }

    public function daftar_jamaah_baru()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        try {
            $dataBerkas = $this->request->getFile('foto');
            $fileName = $dataBerkas->getRandomName();
            $jamaah = new JamaahModel();
            $jamaah->insert([
                'title' =>  $this->request->getVar("title"),
                'nama' =>  $this->request->getVar("nama"),
                'nama_paspor' =>  $this->request->getVar("nama_paspor"),
                'ayah'  => $this->request->getVar("ayah"),
                'jenis_identitas' =>  $this->request->getVar("jenis_identitas"),
                'tempat_lahir' =>  $this->request->getVar("tempat_lahir"),
                'tgl_lahir' =>  $this->request->getVar("tgl_lahir"),
                'foto' =>  $fileName,
                'alamat' =>  $this->request->getVar("alamat"),
                'provinsi' =>  $this->request->getVar("provinsi"),
                'kabupaten' =>  $this->request->getVar("kabupaten"),
                'kecamatan' =>  $this->request->getVar("kecamatan"),
                'kelurahan' =>  $this->request->getVar("kelurahan"),
                'no_telp' =>  $this->request->getVar("no_telpon"),
                'no_hp' =>  $this->request->getVar("no_hp"),
                'kewargannegaraan' =>  $this->request->getVar("warganegara"),
                'status_pernikahan' =>  $this->request->getVar("nikah"),
                'jenis_pendidikan' =>  $this->request->getVar("jenis_pendidikan"),
                'jenis_pekerjaan' =>  $this->request->getVar("jenis_pekerjaan"),
                'provider' =>  $this->request->getVar("provider"),
                'asuransi' =>  $this->request->getVar("asuransi"),
                'paket_id' =>  $this->request->getVar("id_paket"),
                'created_at' =>  date("Y-m-d"),
                'updated_at' =>  date("Y-m-d"),
                'no_paspor' =>  $this->request->getVar("no_paspor"),
                'no_identitas' =>  $this->request->getVar("no_identitas"),
                'no_pasti_umrah'    =>  "URM"  . rand(999,10000),
                'no_registrasi' => rand(1111,9999),
            ]);
            $dataBerkas->move('assets/upload/', $fileName);
            $id = $this->request->getVar("id");
            $id_paket = $this->request->getVar("id_paket");
    
            return redirect()->to("daftar_jamaah/"  . $id . '/' . $id_paket)->with("success","Data Berhasil Di tambahkan");
        } catch (\Throwable $th) {
            return redirect()->to("daftar_jamaah/"  . $id . '/' . $id_paket)->with("error","Data Gagal Di tambahkan");
        }
    }

    public function ganti_password()
    {
        $password = $this->request->getVar("password");
        $password_satu = $this->request->getVar("password_satu");

        if($password != $password_satu) {
            return redirect()->back()->with("success","Data  Berhasil Diupdate");
        }

        $hash = password_hash($password_satu,PASSWORD_DEFAULT);

        $id = session()->get("id");
        $users = new Users();
        $users->update($id,[
            'password'  =>  $hash
        ]);

        return redirect()->back()->with("success","Data  Berhasil Diupdate");
    }
}
