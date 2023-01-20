<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AsuransiModel;
use App\Models\BankModel;
use App\Models\BannerModel;
use App\Models\BioDataModel;
use App\Models\BuktiModel;
use App\Models\DataBank;
use App\Models\DataProviderModel;
use App\Models\JamaahModel;
use App\Models\KloterModel;
use App\Models\MuassahModel;
use App\Models\PaketModel;
use App\Models\ProfileModel;

class UserManagementControllerBaru extends BaseController
{
    public function index()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $now = date("Y-m-d");
        $banner = new BannerModel();
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $pakets = new PaketModel();
        $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
        $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 10 ")->getResultArray();

        $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
        $count = count($st);
        $tes =  $jamaah->where("id",session()->get("jamaah_id"))->first();
        if($tes) {
            $check_paket = $pakets->where("id",$tes['paket_id'])->first();
            $check_travel = $travel->where("id",$check_paket['travel_id'])->first();
            $profile= new ProfileModel();
            $kloter = new KloterModel();
    
            $data = [
                'paket_dua' =>  $paket_dua,
                'count' =>  $count,
                'kloter'    =>  $kloter->where("id",$tes['kloter_id'])->first(),
                'baru'    =>  $st,
                'profile'   =>  $profile->where('id',$check_travel['id'])->first(),
                'jamaah'    =>  $jamaah->where("id",session()->get("jamaah_id"))->first(),
                'title' =>  'Travel-Q',
                'db'    =>  $db,
                'pakets'    => $pakets->where("id",$tes['paket_id'])->first(),
                // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
                'count' =>  $db->query("SELECT * FROM profile")->getResult(),
            ];
            // dd($data['pakets']);
            
            return view("user/dashboard",$data);
        } else {
            $check_paket = $pakets->first();
            $check_travel = $travel->first();
            $profile= new ProfileModel();
            $kloter = new KloterModel();
    
            $data = [
                'paket_dua' =>  $paket_dua,
                'count' =>  $count,
                'kloter'    =>  null,
                'baru'    =>  $st,
                'profile'   =>  null,
                'jamaah'    =>  null,
                'title' =>  'Travel-Q',
                'db'    =>  $db,
                'pakets'    => null,
                // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
                'count' =>  $db->query("SELECT * FROM profile")->getResult(),
            ];
            // dd($data['pakets']);
            
            return view("user/dashboard",$data);
        }
    }
    public function view_profile()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $now = date("Y-m-d");
        $banner = new BannerModel();
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $pakets = new PaketModel();
        $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
        $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 10 ")->getResultArray();

        $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
        $count = count($st);
        $biodata = new BioDataModel();
        $tes =  $jamaah->where("id",session()->get("jamaah_id"))->first();

        $data = [
            'paket_dua' =>  $paket_dua,
            'count' =>  $count,
            'jamaah'   =>  $biodata->where("user_id",session()->get('id'))->first(),
            'kloter'    =>  null,
            'baru'    =>  $st,
            'profile'   =>  null,
            'title' =>  'Travel-Q',
            'db'    =>  $db,
            'pakets'    => null,
            // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];
        
        
        return view("user/view_profile",$data);
    }
    public function pindah_paket_jamaah($id_jamaah,$id_paket,$id_kloter)
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $now = date("Y-m-d");
        $banner = new BannerModel();
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $pakets = new PaketModel();
        $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
        $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 10 ")->getResultArray();

        $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
        $count = count($st);
        $paket = new PaketModel();
        $tes =  $jamaah->where("id",$id_jamaah)->first();
        $check_paket = $pakets->where("id",$id_paket)->first();
        $check_travel = $travel->where("id",$check_paket['travel_id'])->first();
        $profile= new ProfileModel();
        $data = [
            'paket_dua' =>  $paket_dua,
            'count' =>  $count,
            'id'    =>  session()->get("id"),
            'baru'    =>  $st,
            'id_paket'  =>  $check_paket['id'],
            'id_kloter' =>  $tes['kloter_id'],
            'profile'   =>  $profile->where('id',$check_travel['id'])->first(),
            'jamaah'    =>  $jamaah->where("id",$id_jamaah)->first(),
            'title' =>  'Pindah Paket',
            'db'    =>  $db,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'pemberangkatan'    => null
            ])->findAll(),
            'check_paket'   =>  $check_paket,
            'pakets'    => $pakets->where("id",$tes['paket_id'])->first(),
            // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];        
        return view("user/pindah_paket",$data);
    }

    public function asuransi_jamaah()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $now = date("Y-m-d");
        $banner = new BannerModel();
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $pakets = new PaketModel();
        $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
        $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 10 ")->getResultArray();

        $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
        $count = count($st);
        $paket = new PaketModel();
        $tes =  $jamaah->where("id",session()->get("jamaah_id"))->first();
        if($tes) {

            $check_paket = $pakets->where("id",$tes['paket_id'])->first();
            $check_travel = $travel->where("id",$check_paket['travel_id'])->first();
            $profile= new ProfileModel();
            $asuransi = new AsuransiModel();
            $data = [
                'paket_dua' =>  $paket_dua,
                'count' =>  $count,
                'id'    =>  session()->get("jamaah_id"),
                'baru'    =>  $st,
                'asuransi'  =>  $asuransi->findAll(),
                'id_paket'  =>  $check_paket['id'],
                'id_kloter' =>  $tes['kloter_id'],
                'profile'   =>  $profile->where('id',$check_travel['id'])->first(),
                'main'    =>  $jamaah->where("id",session()->get("jamaah_id"))->first(),
                'title' =>  'Pindah Paket',
                'db'    =>  $db,
                'all_paket' =>  $paket->where([
                    'travel_id'   =>  session()->get("travel_id"),
                    'status'    =>  'aktif',
                    'pemberangkatan'    => null
                ])->findAll(),
                'check_paket'   =>  $check_paket,
                'pakets'    => $pakets->where("id",$tes['paket_id'])->first(),
                // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
                'count' =>  $db->query("SELECT * FROM profile")->getResult(),
            ];
            // dd($data['pakets']);
        } else {
            
                        $profile= new ProfileModel();
                        $asuransi = new AsuransiModel();
                        $data = [
                            'paket_dua' =>  $paket_dua,
                            'count' =>  $count,
                            'id'    =>  session()->get("jamaah_id"),
                            'baru'    =>  null,
                            'asuransi'  =>  $asuransi->findAll(),
                            'id_paket'  =>  null,
                            'id_kloter' =>  null,
                            'profile'   => null,
                            'main'    =>  null,
                            'title' =>  'Pindah Paket',
                            'db'    =>  $db,
                            
                            'check_paket'   =>  null,
                            'pakets'    => null,
                            // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
                            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
                        ];
                        // dd($data['pakets']);

        }
        
        
        return view("user/asuransi",$data);
    }
    public function profile_jamaah()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $now = date("Y-m-d");
        $title = "Profile";
        $banner = new BannerModel();
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $pakets = new PaketModel();
        $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
        $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 10 ")->getResultArray();

        $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
        $count = count($st);
        $paket = new PaketModel();
        $tes =  $jamaah->where("id",session()->get("jamaah_id"))->first();
        if($tes) {
            $check_paket = $pakets->where("id",$tes['paket_id'])->first();
            $check_travel = $travel->where("id",$check_paket['travel_id'])->first();
            $profile= new ProfileModel();
            $provider = new DataProviderModel();
            $asuransi = new AsuransiModel();
            $MuassahModel = new MuassahModel();
            $data = [
                'paket_dua' =>  $paket_dua,
                'muasah'    =>  $MuassahModel->findAll(),
                'count' =>  $count,
                'id'    =>  session()->get("jamaah_id"),
                'baru'    =>  $st,
                'provider'  =>  $provider->findAll(),
                'asuransi'  =>  $asuransi->findAll(),
                'id_paket'  =>  $check_paket['id'],
                'id_kloter' =>  $tes['kloter_id'],
                'title' =>  $title,
                'provinsi'  =>  $db->query("SELECT * FROM provinces")->getResultArray(),
    
                'profile'   =>  $profile->where('id',$check_travel['id'])->first(),
                'main'    =>  $jamaah->where("id",session()->get("jamaah_id"))->first(),
                'title' =>  'Pindah Paket',
                'db'    =>  $db,
                'all_paket' =>  $paket->where([
                    'travel_id'   =>  session()->get("travel_id"),
                    'status'    =>  'aktif',
                    'pemberangkatan'    => null
                ])->findAll(),
                'check_paket'   =>  $check_paket,
                'pakets'    => $pakets->where("id",$tes['paket_id'])->first(),
                // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
                'count' =>  $db->query("SELECT * FROM profile")->getResult(),
            ];
            
        } else {
            $profile= new ProfileModel();
            $provider = new DataProviderModel();
            $asuransi = new AsuransiModel();
            $MuassahModel = new MuassahModel();
            $data = [
                'paket_dua' =>  $paket_dua,
                'muasah'    =>  $MuassahModel->findAll(),
                'count' =>  $count,
                'id'    =>  session()->get("jamaah_id"),
                'baru'    =>  $st,
                'title' =>  $title,
                'provider'  =>  $provider->findAll(),
                'asuransi'  =>  $asuransi->findAll(),
                'id_paket'  => null,
                'id_kloter' =>  null,
                'provinsi'  =>  $db->query("SELECT * FROM provinces ORDER BY name ASC")->getResultArray(),
    
                'profile'   =>  null,
                'title' =>  'Pindah Paket',
                'db'    =>  $db,
                'all_paket' =>  $paket->where([
                    'travel_id'   =>  session()->get("travel_id"),
                    'status'    =>  'aktif',
                    'pemberangkatan'    => null
                ])->findAll(),
                'check_paket'   =>  null,
                'pakets'    => null,
                // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
                'count' =>  $db->query("SELECT * FROM profile")->getResult(),
            ];
            
        } 
        return view("user/profile/index",$data);
    }

    public function paket_user()
    {
        $paket = new PaketModel();
        $jamaah = new JamaahModel();
        $checks = $jamaah->where("user_id",session()->get('id'))->where("kloter_id IS NOT NULL")->countAllResults();
        if($checks) {
            $check = $jamaah->where("user_id",session()->get('id'))->where("kloter_id IS NOT NULL")->findAll();
            $int_paket = [];
            foreach($check as $row) {
                $int_paket[] =  $row['paket_id'];
            }
            if($int_paket) {
                $satu = array_unique($int_paket);
                $result = [];
                foreach($satu as $main) {
                    $result[] = $paket->where('id',$main)->first();
                }
            } else {
                $result = [];
            }
        } else {
            $result = [];
        }
        $data = [
            'title' =>  'paket',
            'paket' =>  $result
        ];
        return view("user/paket/index",$data);
    }

    public function paket_selesai_user()
    {
        $paket = new PaketModel();
        $jamaah = new JamaahModel();
        $checks = $jamaah->where("user_id",session()->get('id'))->where('status_approve',"sudah")->countAllResults();
        if($checks) {
            $check = $jamaah->where("user_id",session()->get('id'))->where('status_approve',"sudah")->findAll();
            $int_paket = [];
            foreach($check as $row) {
                $int_paket[] =  $row['paket_id'];
            }
            if($int_paket) {
                $satu = array_unique($int_paket);
                foreach($satu as $main) {
                    $result = $paket->where('id',$main)->findAll();
                }
            } else {
                $result = [];
            }
        } else {
            $result = [];
        }
        
        $data = [
            'title' =>  'paket',
            'paket' =>  $result
        ];
        return view("user/paket/index",$data);
    }

    public function detail_paket_user($id)
    {
        $paket = new PaketModel();
        $pakets = $paket->where("id",$id)->first();

        $kloter = new KloterModel();
        $kloters = $kloter->where("paket_id",$id)->findAll();
        $data = [
            'title' =>  'paket',
            'result'    =>  $kloters,
            'id'    =>  $id,
            'paket' =>  $pakets
        ];
        return view('user/paket/kloter',$data);
    }

    public function detail_jamaah_aktif($id_paket,$id_kloter)
    {
     
        $paket = new PaketModel();
        $kloter = new KloterModel();
        $pakets = $paket->where('id',$id_paket)->first();
        $kloters = $kloter->where("id",$id_kloter)->first();
        $jamaah = new JamaahModel();
        $jamaahs = $jamaah->where("paket_id",$id_paket)->where('kloter_id',$id_kloter)->where("status_approve",null)->where("user_id",session()->get('id'))->findAll();

        $data = [
            'id_paket'  =>  $id_paket,
            'id_kloter' =>  $id_kloter,
            'paket' =>  $pakets,
            'kloter'    =>  $kloters,
            'jamaah'    =>  $jamaahs
        ];

        return view('user/paket/jamaah',$data);
    }

    public function profile_insert()
    {
        
        if(!$this->validate([
            'file_ktp' => [
                "rules" => "uploaded[file_ktp]|mime_in[file_ktp,application/pdf]|max_size[file_ktp,3024]"
                ],
            'file_kk' => [
                "rules" => "uploaded[file_kk]|mime_in[file_kk,application/pdf]|max_size[file_kk,3024]"
            ],
            'sertifikat_vaksin' => [
                "rules" => "uploaded[sertifikat_vaksin]|mime_in[sertifikat_vaksin,application/pdf]|max_size[sertifikat_vaksin,3024]"
            ],
            'file_asuransi' => [
                "rules" => "uploaded[file_asuransi]|mime_in[file_asuransi,application/pdf]|max_size[file_asuransi,3024]"
            ],
            'file_provider' => [
                "rules" => "uploaded[file_provider]|mime_in[file_provider,application/pdf]|max_size[file_provider,3024]"
            ],
            'file_paspor' => [
                "rules" => "uploaded[file_paspor]|mime_in[file_paspor,application/pdf]|max_size[file_paspor,3024]"
            ],
            'file_visa' => [
                "rules" => "uploaded[file_visa]|mime_in[file_visa,application/pdf]|max_size[file_visa,3024]"
            ],
        ])) {
            session()->setFlashdata('error',$this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        
    
        try {
            $dataBerkas = $this->request->getFile('file_ktp');
            $namaktp = $dataBerkas->getRandomName();
            $data_ktp = $namaktp;
            $dataBerkas->move('assets/upload/', $namaktp);
            
            $satu = $this->request->getFile('file_kk');
            $kk = $satu->getRandomName();
            $data_kk = $kk;
            $satu->move('assets/upload/', $kk);
            
            $dua = $this->request->getFile('file_visa');
            $visa = $dua->getRandomName();
            $data_visa = $visa;
            $dua->move('assets/upload/', $visa);
            
            $tiga = $this->request->getFile('file_provider');
            $provider = $tiga->getRandomName();
            $data_provider = $provider;
            $tiga->move('assets/upload/', $provider);
            
            $empat = $this->request->getFile('sertifikat_vaksin');
            $vaksin = $empat->getRandomName();
            $data_vaksin = $vaksin;
            $empat->move('assets/upload/', $vaksin);
            
            $lima = $this->request->getFile('file_asuransi');
            $asuransi = $lima->getRandomName();
            $data_asuransi = $asuransi;
            $lima->move('assets/upload/', $asuransi);
            
            $enam = $this->request->getFile('file_paspor');
            $paspor = $enam->getRandomName();
            $file_paspor = $paspor;
            $enam->move('assets/upload/', $paspor);
            //code...
            $provinsi_explode = explode("-",$this->request->getVar("provinsi"));
            $provinsi_hasil = $provinsi_explode[1];
            $kabupaten_explode = explode("-",$this->request->getVar("kabupaten"));
            $kabupaten_hasil = $kabupaten_explode[1];
            $kecamatan_explode = explode("-",$this->request->getVar("kecamatan"));
            $kecamatan_hasil = $kecamatan_explode[1];
            $kelurahan_explode = explode('-',$this->request->getVar("kelurahan"));
            $kelurahan_hasil = $kelurahan_explode[1];
            $biodata = new BioDataModel();
            $biodata->insert([
                'title' =>  $this->request->getvar('title'),
                'nama_paspor' =>  $this->request->getvar('nama_paspor'),
                'ayah' =>  $this->request->getvar('ayah'),
                'jenis_identitas' =>  $this->request->getvar('jenis_identitas'),
                'tempat_lahir' =>  $this->request->getvar('tempat_lahir'),
                'tgl_lahir' =>  $this->request->getvar('tgl_lahir'),
                'alamat' =>  $this->request->getvar('alamat'),
                'provinsi' =>  $provinsi_hasil,
                'kabupaten' =>  $kabupaten_hasil,
                'kecamatan' =>  $kecamatan_hasil,
                'kelurahan' =>  $kelurahan_hasil,
                'no_telp' =>  $this->request->getvar('no_telpon'),
                'kewargannegaraan' =>  $this->request->getvar('warganegara'),
                'status_pernikahan' =>  $this->request->getvar('nikah'),
                'jenis_pendidikan' =>  $this->request->getvar('jenis_pendidikan'),
                'jenis_pekerjaan' =>  $this->request->getvar('jenis_pekerjaan'),
                'provider' =>  $this->request->getvar('provider'),
                'asuransi' =>  $this->request->getvar('asuransi'),
                'created_at' =>  date("Y-m-d"),
                'updated_at' =>  date("Y-m-d"),
                'no_identitas' =>  $this->request->getvar('no_identitas'),  
                'no_paspor' =>  $this->request->getvar('no_paspor'),
                'nomor_polis' =>  $this->request->getvar('nomor'),
                'tgl_input' =>  $this->request->getvar('tgl_input'),
                'tgl_awal' =>  $this->request->getvar('awal'),
                'tgl_akhir' =>  $this->request->getvar('akhir'),
                'nomor_visa' =>  $this->request->getvar('nomor_visa'),
                'tgl_awal_visa' =>  $this->request->getvar('tgl_awal_visa'),
                'tgl_akhir_visa' =>  $this->request->getvar('tgl_akhir_visa'),
                'muassasah' =>  $this->request->getvar('muassasah'),
                'status_vaksin' => "Sudah",
                'tgl_vaksin' =>  $this->request->getvar('tgl'),
                'jenis_vaksin' =>  $this->request->getvar('jenis'),
                'status_approve' => null,
                'user_id'   =>  session()->get('id'),
                'file_paspor'   =>  $file_paspor,
                'file_ktp'  =>  $data_ktp,
                'file_kk'   =>  $data_kk,
                'file_sertifikat_vaksin' =>  $data_vaksin,
                'file_visa' =>  $data_visa,
                'file_asuransi' =>  $data_asuransi,
                'file_provider' =>  $data_provider
            ]);
            return redirect()->to("dashboard_user")->with('success',"Data Berhasil Ditambahkan");
        } catch (\Throwable $th) {
            return redirect()->to("profile_jamaah")->with('error',"Data Gagal Ditambahkan");
        }
    }
    public function visa_jamaah()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $now = date("Y-m-d");
        $banner = new BannerModel();
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $pakets = new PaketModel();
        $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
        $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 10 ")->getResultArray();

        $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
        $count = count($st);
        $paket = new PaketModel();
        $tes =  $jamaah->where("id",session()->get("jamaah_id"))->first();
        $check_paket = $pakets->where("id",$tes['paket_id'])->first();
        $check_travel = $travel->where("id",$check_paket['travel_id'])->first();
        $profile= new ProfileModel();
        $provider = new DataProviderModel();
        $asuransi = new AsuransiModel();
        $MuassahModel = new MuassahModel();
        $data = [
            'paket_dua' =>  $paket_dua,
            'muasah'    =>  $MuassahModel->findAll(),
            'count' =>  $count,
            'id'    =>  session()->get("jamaah_id"),
            'baru'    =>  $st,
            'provider'  =>  $provider->findAll(),
            'asuransi'  =>  $asuransi->findAll(),
            'id_paket'  =>  $check_paket['id'],
            'id_kloter' =>  $tes['kloter_id'],
            'profile'   =>  $profile->where('id',$check_travel['id'])->first(),
            'main'    =>  $jamaah->where("id",session()->get("jamaah_id"))->first(),
            'title' =>  'Pindah Paket',
            'db'    =>  $db,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'pemberangkatan'    => null
            ])->findAll(),
            'check_paket'   =>  $check_paket,
            'pakets'    => $pakets->where("id",$tes['paket_id'])->first(),
            // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];
        // dd($data['pakets']);
        
        return view("user/visa",$data);
    }
    public function pembayaran_jamaah()
    {
        if(!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $db      = \Config\Database::connect();
        $travel = new ProfileModel();
        $now = date("Y-m-d");
        $banner = new BannerModel();
        $db      = \Config\Database::connect();
        $jamaah = new JamaahModel();
        $pakets = new PaketModel();
        $paket = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 3 ")->getResultArray();
        $paket_dua = $db->query("SELECT * FROM paket WHERE kelengkapan = 'sudah' AND pemberangkatan IS NULL ORDER BY id DESC LIMIT 10 ")->getResultArray();

        $st = $db->query("SELECT * FROM banner WHERE expired >= '$now'")->getResultArray();
        $count = count($st);
        $paket = new PaketModel();
        $tes =  $jamaah->where("id",session()->get("jamaah_id"))->first();
        $check_paket = $pakets->where("id",$tes['paket_id'])->first();
        $check_travel = $travel->where("id",$check_paket['travel_id'])->first();
        $profile= new ProfileModel();
        $bank = new BankModel();
        $data = [
            'bank'  =>  $bank->findAll(),
            'paket_dua' =>  $paket_dua,
            'count' =>  $count,
            'bukti' =>  new BuktiModel(),
            'id'    =>  session()->get("jamaah_id"),
            'baru'    =>  $st,
            'id_paket'  =>  $check_paket['id'],
            'id_kloter' =>  $tes['kloter_id'],
            'profile'   =>  $profile->where('id',$check_travel['id'])->first(),
            'main'    =>  $jamaah->where("id",session()->get("jamaah_id"))->first(),
            'title' =>  'Pindah Paket',
            'db'    =>  $db,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'pemberangkatan'    => null
            ])->findAll(),
            'check_paket'   =>  $check_paket,
            'paket'    => $pakets->where("id",$tes['paket_id'])->first(),
            // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];
        
        
        return view("user/pembayaran",$data);
    }
}
