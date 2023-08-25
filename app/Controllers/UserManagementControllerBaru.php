<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AsuransiModel;
use App\Models\BankModel;
use App\Models\BannerModel;
use App\Models\BioDataModel;
use App\Models\BuktiModel;
use App\Models\DaftarJamaahModel;
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
        if (!session()->get("login") || session()->get("login") == null) {
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
        $id_jamaah = session()->get('id');
        $check_biodata = $biodata->where('user_id', $id_jamaah)->first();
        $tes =  $jamaah->where("id", session()->get("jamaah_id"))->first();
        $result_jamaah = $jamaah->where('user_id', session()->get('id'))->where('kloter_id', null)->get()->getResult();
        if ($tes) {
            $check_paket = $pakets->where("id", $tes['paket_id'])->first();
            $check_travel = $travel->where("id", $check_paket['travel_id'])->first();
            $profile = new ProfileModel();
            $kloter = new KloterModel();

            $data = [
                'paket_dua' =>  $paket_dua,
                'count' =>  $count,
                'result_jamaah' =>  $result_jamaah,
                'kloter'    =>  $kloter->where("id", $tes['kloter_id'])->first(),
                'baru'    =>  $st,
                'tes'   =>  $tes,
                'profile'   =>  $profile->where('id', $check_travel['id'])->first(),
                'jamaah'    =>  $jamaah->where("id", session()->get("jamaah_id"))->first(),
                'title' =>  'Travel-Q',
                'db'    =>  $db,
                'check_biodata' =>  $check_biodata,
                'pakets'    => $pakets->where("id", $tes['paket_id'])->first(),
                // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
                'count' =>  $db->query("SELECT * FROM profile")->getResult(),

            ];

            return view("user/dashboard", $data);
        } else {
            $r = session()->get('id');
            $check_paket = $pakets->first();
            $check_travel = $travel->first();

            $profile = new ProfileModel();
            $kloter = new KloterModel();
            $pem =  $db->query("SELECT SUM(biaya) FROM paket INNER JOIN jamaah ON paket.id = jamaah.paket_id WHERE jamaah.user_id = '$r' AND jamaah.kloter_id IS NOT NULL ")->getRowArray();
            $hitang =  $db->query("SELECT SUM(sisa_pembayaran) FROM paket INNER JOIN jamaah ON paket.id = jamaah.paket_id WHERE jamaah.user_id = '$r'")->getRowArray();

            $sle = $db->query("SELECT * FROM paket INNER JOIN jamaah ON paket.id = jamaah.paket_id INNER JOIN kloter ON paket.id = kloter.paket_id WHERE jamaah.user_id = '$r' AND kloter.keberangkatan = 'sudah' AND kloter.status_realisasi = 'sudah' AND kloter.done = 'sudah' GROUP BY paket.id")->getNumRows();
            foreach ($pem as $t) {
                $rf = $t;
            }


            $daf = new DaftarJamaahModel();

            foreach ($hitang as $q) {
                $v = $q;
            }
            $biodatas = new BioDataModel();
            $id_users = session()->get('id');
            $first_biodata = $biodatas->where('user_id', $id_users)->countAllResults();
            $vaksin = $biodatas->where('user_id', $id_users)->first();

            $biodatas = new BioDataModel();
            $data = [
                'paket_dua' =>  $paket_dua,
                'count' =>  $count,
                'first_biodata' =>  $first_biodata,
                'kloter'    =>  null,
                'baru'    =>  $st,
                'tes'   =>  $tes,
                'check_biodata' =>  $check_biodata,
                'profile'   =>  null,
                'daftar'    =>  $daf->findAll(),
                'jamaah'    =>  null,
                'hutang'    =>  $v,
                'title' =>  'Dashboard',
                'db'    =>  $db,
                'selesai'   =>  $sle,
                // 'paket_terdaftar'   =>  $db->query("SELECT * FROM paket INNER JOIN jamaah ON paket.id = jamaah.paket_id WHERE jamaah.user_id = '$r' AND jamaah.status_approve = 'sudah'")->getNumRows(),
                'paket_terdaftar'   =>  $db->query("SELECT * FROM jamaah INNER JOIN paket ON jamaah.paket_id = paket.id WHERE jamaah.user_id = '$r' AND jamaah.kloter_id IS NOT NULL")->getNumRows(),
                'pakets'    => null,
                // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
                'count' =>  $db->query("SELECT * FROM profile")->getResult(),
                'pembayaran'    => $rf,
                'aktif' => $vaksin,
                'result_jamaah' =>  $result_jamaah,
            ];


            return view("user/dashboard", $data);
        }
    }
    public function view_profile()
    {
        if (!session()->get("login") || session()->get("login") == null) {
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
        $tes =  $jamaah->where("id", session()->get("jamaah_id"))->first();
        $biodatas = new BioDataModel();
        $cheks = $biodata->where('user_id', session()->get('id'))->first();
        if (!$cheks) {
            return redirect()->to('profile_jamaah');
        }
        $data = [
            'paket_dua' =>  $paket_dua,
            'count' =>  $count,
            'jamaah'   =>  $biodata->where("user_id", session()->get('id'))->first(),
            'kloter'    =>  null,
            'baru'    =>  $st,
            'profile'   =>  null,
            'title' =>  'Profile',
            'db'    =>  $db,
            'pakets'    => null,
            // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];


        return view("user/view_profile", $data);
    }
    public function pindah_paket_jamaah($id_jamaah, $id_paket, $id_kloter)
    {
        if (!session()->get("login") || session()->get("login") == null) {
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
        $tes =  $jamaah->where("id", $id_jamaah)->first();
        $check_paket = $pakets->where("id", $id_paket)->first();
        $check_travel = $travel->where("id", $check_paket['travel_id'])->first();
        $profile = new ProfileModel();
        $data = [
            'paket_dua' =>  $paket_dua,
            'count' =>  $count,
            'id'    => $id_jamaah,
            'baru'    =>  $st,
            'id_paket'  =>  $check_paket['id'],
            'id_kloter' =>  $tes['kloter_id'],
            'profile'   =>  $profile->where('id', $check_travel['id'])->first(),
            'jamaah'    =>  $jamaah->where("id", $id_jamaah)->first(),
            'title' =>  'Paket',
            'db'    =>  $db,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  $check_paket['travel_id'],
                'status'    =>  'aktif',
                'pemberangkatan'    => null,
                'status_approve'    =>  'sudah',
                'status_paket_cabang'   =>  'sudah',
                'id !=' =>  $id_paket,
            ])->findAll(),
            'check_paket'   =>  $check_paket,
            'pakets'    => $pakets->where("id", $tes['paket_id'])->first(),
            // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];

        return view("user/pindah_paket", $data);
    }

    public function asuransi_jamaah()
    {
        if (!session()->get("login") || session()->get("login") == null) {
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
        $tes =  $jamaah->where("id", session()->get("jamaah_id"))->first();
        if ($tes) {

            $check_paket = $pakets->where("id", $tes['paket_id'])->first();
            $check_travel = $travel->where("id", $check_paket['travel_id'])->first();
            $profile = new ProfileModel();
            $asuransi = new AsuransiModel();
            $data = [
                'paket_dua' =>  $paket_dua,
                'count' =>  $count,
                'id'    =>  session()->get("jamaah_id"),
                'baru'    =>  $st,
                'asuransi'  =>  $asuransi->findAll(),
                'id_paket'  =>  $check_paket['id'],
                'id_kloter' =>  $tes['kloter_id'],
                'profile'   =>  $profile->where('id', $check_travel['id'])->first(),
                'main'    =>  $jamaah->where("id", session()->get("jamaah_id"))->first(),
                'title' =>  'Pindah Paket',
                'db'    =>  $db,
                'all_paket' =>  $paket->where([
                    'travel_id'   =>  session()->get("travel_id"),
                    'status'    =>  'aktif',
                    'pemberangkatan'    => null
                ])->findAll(),
                'check_paket'   =>  $check_paket,
                'pakets'    => $pakets->where("id", $tes['paket_id'])->first(),
                // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
                'count' =>  $db->query("SELECT * FROM profile")->getResult(),
            ];
            // dd($data['pakets']);
        } else {

            $profile = new ProfileModel();
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


        return view("user/asuransi", $data);
    }
    public function profile_jamaah()
    {
        if (!session()->get("login") || session()->get("login") == null) {
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
        $tes =  $jamaah->where("id", session()->get("jamaah_id"))->first();
        if ($tes) {
            $check_paket = $pakets->where("id", $tes['paket_id'])->first();
            $check_travel = $travel->where("id", $check_paket['travel_id'])->first();
            $profile = new ProfileModel();
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

                'profile'   =>  $profile->where('id', $check_travel['id'])->first(),
                'main'    =>  $jamaah->where("id", session()->get("jamaah_id"))->first(),
                'title' =>  'Pindah Paket',
                'db'    =>  $db,
                'all_paket' =>  $paket->where([
                    'travel_id'   =>  session()->get("travel_id"),
                    'status'    =>  'aktif',
                    'pemberangkatan'    => null
                ])->findAll(),
                'check_paket'   =>  $check_paket,
                'pakets'    => $pakets->where("id", $tes['paket_id'])->first(),
                // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
                'count' =>  $db->query("SELECT * FROM profile")->getResult(),
            ];
        } else {
            $profile = new ProfileModel();
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
                'title' =>  'Profile',
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
        return view("user/profile/index", $data);
    }

    public function paket_user()
    {
        $paket = new PaketModel();
        $jamaah = new JamaahModel();
        $checks = $jamaah->where("user_id", session()->get('id'))->where("kloter_id IS NOT NULL")->countAllResults();
        if ($checks) {
            $check = $jamaah->where("user_id", session()->get('id'))->where("kloter_id IS NOT NULL")->orderby('id', 'desc')->findAll();
            $int_paket = [];
            foreach ($check as $row) {
                $int_paket[] =  $row['paket_id'];
            }
            if ($int_paket) {
                $satu = array_unique($int_paket);
                $result = [];
                foreach ($satu as $main) {
                    $result[] = $paket->where('id', $main)->where('status', 'aktif')->orderby('id', 'desc')->first();
                }
            } else {
                $result = [];
            }
        } else {
            $result = [];
        }
        $data = [
            'title' =>  'Paket',
            'paket' =>  $result
        ];
        return view("user/paket/index", $data);
    }

    public function paket_selesai_user()
    {
        $paket = new PaketModel();
        $jamaah = new JamaahModel();
        $checks = $jamaah->where("user_id", session()->get('id'))->where('status_approve', "sudah")->where('status_approve_bayar', 'sudah')->where('selesai_pembayaran', 'sudah')->where('no_kursi IS NOT NULL')->countAllResults();
        if ($checks) {
            $check = $jamaah->where("user_id", session()->get('id'))->where('status_approve', "sudah")->where('status_approve_bayar', 'sudah')->where('selesai_pembayaran', 'sudah')->where('no_kursi IS NOT NULL')->findAll();
            $int_paket = [];
            foreach ($check as $row) {
                $int_paket[] =  $row['paket_id'];
            }
            if ($int_paket) {
                $satu = array_unique($int_paket);
                foreach ($satu as $main) {
                    $result = $paket->where('id', $main)->orderby('id', 'desc')->findAll();
                }
            } else {
                $result = [];
            }
        } else {
            $result = [];
        }

        $data = [
            'title' =>  'History',
            'paket' =>  $result
        ];
        return view("user/paket/index_selesai", $data);
    }

    public function detail_paket_user_selesai($id)
    {
        $paket = new PaketModel();
        $pakets = $paket->where("id", $id)->first();

        $kloter = new KloterModel();
        $kloters = $kloter->where("paket_id", $id)->where("status", "aktif")->where("keberangkatan", "sudah")->where("status_realisasi", 'sudah')->findAll();
        $data = [
            'title' =>  'paket',
            'result'    =>  $kloters,
            'id'    =>  $id,
            'paket' =>  $pakets
        ];
        return view('user/paket/kloter_selesai', $data);
    }

    public function detail_paket_user($id)
    {
        $paket = new PaketModel();
        $pakets = $paket->where("id", $id)->first();
        if (!$pakets) {
            return redirect()->to('paket_user');
        }

        $kloter = new KloterModel();
        $kloters = $kloter->where("paket_id", $id)->where("status", "aktif")->where("keberangkatan", null)->orderby('id', 'desc')->findAll();
        $data = [
            'title' =>  'Paket',
            'result'    =>  $kloters,
            'id'    =>  $id,
            'paket' =>  $pakets
        ];
        return view('user/paket/kloter', $data);
    }

    public function detail_jamaah_aktif($id_paket, $id_kloter)
    {

        $paket = new PaketModel();
        $kloter = new KloterModel();
        $pakets = $paket->where('id', $id_paket)->first();
        $kloters = $kloter->where("id", $id_kloter)->first();
        if (!$kloters || !$pakets) {
            return redirect()->to('paket_user');
        }
        $jamaah = new JamaahModel();
        $jamaahs = $jamaah->where("paket_id", $id_paket)->where('kloter_id', $id_kloter)->where("status_approve", null)->where("user_id", session()->get('id'))->findAll();

        $data = [
            'id_paket'  =>  $id_paket,
            'id_kloter' =>  $id_kloter,
            'paket' =>  $pakets,
            'kloter'    =>  $kloters,
            'jamaah'    =>  $jamaahs,
            'title' =>  'Paket'
        ];

        return view('user/history/jamaah', $data);
    }

    public function detail_jamaah_aktif_selesai($id_paket, $id_kloter)
    {

        $paket = new PaketModel();
        $kloter = new KloterModel();
        $pakets = $paket->where('id', $id_paket)->first();
        $kloters = $kloter->where("id", $id_kloter)->first();
        $jamaah = new JamaahModel();
        $jamaahs = $jamaah->where("paket_id", $id_paket)->where('kloter_id', $id_kloter)->where("status_approve", "sudah")->where("user_id", session()->get('id'))->where('status_bayar', 'lunas')->where("selesai_pembayaran", 'sudah')->findAll();

        $data = [
            'id_paket'  =>  $id_paket,
            'id_kloter' =>  $id_kloter,
            'paket' =>  $pakets,
            'kloter'    =>  $kloters,
            'jamaah'    =>  $jamaahs,
            'title' =>  'History'
        ];

        return view('user/history/jamaah_selesai', $data);
    }

    public function detail_jamaah_diri($id_jamaah, $id_paket, $id_kloter)
    {

        $paket = new PaketModel();
        $kloter = new KloterModel();
        $pakets = $paket->where('id', $id_paket)->first();
        $kloters = $kloter->where("id", $id_kloter)->first();
        $profile = new ProfileModel();
        $data_profile = $profile->where("id", $pakets['travel_id'])->first();
        $jamaah = new JamaahModel();
        $checks = $jamaah->where('id', $id_jamaah)->first();
        $jamaahs = $jamaah->where("paket_id", $id_paket)->where('kloter_id', $id_kloter)->where("status_approve", null)->where("user_id", session()->get('id'))->where("id", $id_jamaah)->first();
        if (!$kloters || !$pakets || !$checks) {
            return redirect()->to('paket_user');
        }
        $data = [
            'id_paket'  =>  $id_paket,
            'id_kloter' =>  $id_kloter,
            'paket' =>  $pakets,
            'id_jamaah' =>  $id_jamaah,
            'kloter'    =>  $kloters,
            'main'    =>  $jamaahs,
            'perusahaan'    =>  $data_profile,
            'title' =>  'Paket'
        ];

        return view('user/paket/detail_diri', $data);
    }
    public function detail_jamaah_diri_selesai($id_jamaah, $id_paket, $id_kloter)
    {

        $paket = new PaketModel();
        $kloter = new KloterModel();
        $pakets = $paket->where('id', $id_paket)->first();
        $kloters = $kloter->where("id", $id_kloter)->first();
        $profile = new ProfileModel();
        $data_profile = $profile->where("id", $pakets['travel_id'])->first();
        $jamaah = new JamaahModel();
        $jamaahs = $jamaah->where("paket_id", $id_paket)->where('kloter_id', $id_kloter)->where("status_approve", "sudah    ")->where("user_id", session()->get('id'))->where("id", $id_jamaah)->first();

        $data = [
            'id_paket'  =>  $id_paket,
            'id_kloter' =>  $id_kloter,
            'paket' =>  $pakets,
            'id_jamaah' =>  $id_jamaah,
            'title' =>  'History',
            'kloter'    =>  $kloters,
            'main'    =>  $jamaahs,
            'perusahaan'    =>  $data_profile
        ];

        return view('user/history/detail_diri', $data);
    }

    public function checkout($id_jamaah, $id_paket, $id_kloter)
    {
        $paket = new PaketModel();
        $kloter = new KloterModel();
        $pakets = $paket->where('id', $id_paket)->first();
        $kloters = $kloter->where("id", $id_kloter)->first();
        $profile = new ProfileModel();
        $data_profile = $profile->where("id", $pakets['travel_id'])->first();
        $jamaah = new JamaahModel();
        $bank = new BankModel();
        $bukti = new BuktiModel();
        $check_jamaah = $jamaah->where('id', $id_jamaah)->first();
        if (!$pakets || !$kloters || !$check_jamaah) {
            return redirect()->to('paket_user');
        }
        $jamaahs = $jamaah->where("paket_id", $id_paket)->where('kloter_id', $id_kloter)->where("status_approve", null)->where("user_id", session()->get('id'))->where("id", $id_jamaah)->first();

        $data = [
            'id_paket'  =>  $id_paket,
            'id_kloter' =>  $id_kloter,
            'paket' =>  $pakets,
            'id_jamaah' =>  $id_jamaah,
            'kloter'    =>  $kloters,
            'title' =>  'Paket',
            'main'    =>  $jamaahs,
            'bank'  =>  $bank->where("id", $pakets['rekening_penampung_id'])->first(),
            'perusahaan'    =>  $data_profile,
            'bukti' =>  $bukti->where("jamaah_id", $id_jamaah)->where("paket_id", $id_paket)->where('kloter_id', $id_kloter)->findAll(),
        ];

        return view('user/paket/pembayaran', $data);
    }

    public function checkout_selesai($id_jamaah, $id_paket, $id_kloter)
    {
        $paket = new PaketModel();
        $kloter = new KloterModel();
        $pakets = $paket->where('id', $id_paket)->first();
        $kloters = $kloter->where("id", $id_kloter)->first();
        $profile = new ProfileModel();
        $data_profile = $profile->where("id", $pakets['travel_id'])->first();
        $jamaah = new JamaahModel();
        $bank = new BankModel();
        $bukti = new BuktiModel();

        $jamaahs = $jamaah->where("paket_id", $id_paket)->where('kloter_id', $id_kloter)->where("status_approve", "sudah")->where("user_id", session()->get('id'))->where("id", $id_jamaah)->first();
        $data = [
            'id_paket'  =>  $id_paket,
            'id_kloter' =>  $id_kloter,
            'paket' =>  $pakets,
            'id_jamaah' =>  $id_jamaah,
            'kloter'    =>  $kloters,
            'title' =>  'History',

            'main'    =>  $jamaahs,
            'bank'  =>  $bank->where("id", $pakets['rekening_penampung_id'])->first(),
            'perusahaan'    =>  $data_profile,
            'bukti' =>  $bukti->where("jamaah_id", $id_jamaah)->where("paket_id", $id_paket)->where('kloter_id', $id_kloter)->findAll(),
        ];

        return view('user/history/pembayaran', $data);
    }

    public function export_invoice($id_jamaah, $id_paket, $id_kloter)
    {

        $paket = new PaketModel();
        $kloter = new KloterModel();
        $pakets = $paket->where('id', $id_paket)->first();
        $kloters = $kloter->where("id", $id_kloter)->first();
        $profile = new ProfileModel();
        $data_profile = $profile->where("id", $pakets['travel_id'])->first();
        $jamaah = new JamaahModel();
        $bank = new BankModel();
        $bukti = new BuktiModel();

        if (session()->get('level_id') == "jamaah" || session()->get('level_id') == "cabang") {
            $jamaahs = $jamaah->where("paket_id", $id_paket)->where('kloter_id', $id_kloter)->where("id", $id_jamaah)->first();
        } else {
            $jamaahs = $jamaah->where("paket_id", $id_paket)->where('kloter_id', $id_kloter)->where("user_id", session()->get('id'))->where("id", $id_jamaah)->first();
        }
        $data = [
            'id_paket'  =>  $id_paket,
            'id_kloter' =>  $id_kloter,
            'paket' =>  $pakets,
            'id_jamaah' =>  $id_jamaah,
            'kloter'    =>  $kloters,

            'main'    =>  $jamaahs,
            'bank'  =>  $bank->where("id", $pakets['rekening_penampung_id'])->first(),
            'perusahaan'    =>  $data_profile,
            'bukti' =>  $bukti->where("jamaah_id", $id_jamaah)->where("paket_id", $id_paket)->where('kloter_id', $id_kloter)->findAll(),
        ];

        return view('user/paket/export', $data);
    }

    public function insert_checkout()
    {
        try {
            //     //code...

            $metode = $this->request->getVar("metode");
            $catatan = htmlspecialchars($this->request->getVar("catatan"), true);
            $bayar = (int)str_replace(".", "", $this->request->getVar("bayar"));
            $id_paket = $this->request->getVar("id_paket");
            $id_jamaah = $this->request->getVar("id_jamaah");
            $id_kloter = $this->request->getVar("id_kloter");

            $paket = new PaketModel();
            $result = $paket->where('id', $id_paket)->first();
            $kloter = new KloterModel();
            $jamaah = new JamaahModel();
            $bukti = new BuktiModel();

            $result_jamaah = $jamaah->where("id", $id_jamaah)->first();
            $result_kloter = $kloter->where("id", $id_kloter)->first();

            if ($metode == "DP") {
                $now = date("Y-m-d");
                $seminggu = date("Y-m-d", strtotime("+7 days", strtotime(date("Y-m-d"))));

                if (empty($result_jamaah['status_bayar'])) {

                    $jamaah->update($id_jamaah, [
                        'tgl_bayar' =>  date("Y-m-d"),
                        'rekening_penampung' =>  $this->request->getVar("rek"),
                        'status_bayar' =>  $metode,
                        // 'keterangan_bayar' =>  $catatan,
                        // 'nominal_pembayaran'     => $bayar,
                        // 'bukti_pembayaran'  =>  $foto,
                        // 'sisa_pembayaran'   =>  $sisa,
                        'expired_bayar_dp'  =>  $seminggu
                    ]);

                    $status = true;
                } elseif (empty($result_jamaah['bukti_pembayaran'])) {
                    if (!$this->validate([
                        'file' => [
                            "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
                        ],
                        'bayar' =>  [
                            'rules' =>  'required'
                        ],
                        'catatan'   =>  [
                            'rules' =>  'required'
                        ]
                    ])) {
                        session()->setFlashdata('error', "Semua Input Harus Di Isi");
                        return redirect()->back()->withInput();
                    }

                    $dataBerkas = $this->request->getFile('file');
                    if ($dataBerkas->getError() === 4) {
                        session()->setFlashdata('error', "File Harus di isi");
                        return redirect()->back()->withInput();
                    } else {
                        $fileName = $dataBerkas->getRandomName();
                        $foto = $fileName;
                        $dataBerkas->move('assets/upload/', $fileName);
                    }
                    $int_bayar = (int)$result['biaya'];
                    if ($bayar > $int_bayar) {
                        return redirect()->back()->with('error', 'Pembayaran Melebihi Biaya Paket');
                    } elseif ($bayar == $int_bayar) {
                        return redirect()->back()->with('error', 'Metode pembayaran DP tidak boleh lunas');
                    }

                    $sisa = $int_bayar - $bayar;

                    $jamaah->update($id_jamaah, [
                        'keterangan_bayar' =>  $catatan,
                        'nominal_pembayaran'     => $bayar,
                        'bukti_pembayaran'  =>  $foto,
                        'sisa_pembayaran'   =>  $sisa,
                    ]);
                    $status = true;
                } elseif (!empty($result_jamaah['bukti_pembayaran'])) {
                    if (!$this->validate([
                        'file' => [
                            "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
                        ],
                        'bayar' =>  [
                            'rules' =>  'required'
                        ],
                        'catatan'   =>  [
                            'rules' =>  'required'
                        ]
                    ])) {
                        session()->setFlashdata('error', "Semua Input Harus Di Isi");
                        return redirect()->back()->withInput();
                    }

                    $dataBerkas = $this->request->getFile('file');
                    if ($dataBerkas->getError() === 4) {
                        session()->setFlashdata('error', "File Harus di isi");
                        return redirect()->back()->withInput();
                    } else {
                        $fileName = $dataBerkas->getRandomName();
                        $foto = $fileName;
                        $dataBerkas->move('assets/upload/', $fileName);
                    }
                    $int_bayar = (int)$result['biaya'];
                    if ($bayar >= $int_bayar) {
                        return redirect()->back()->with('error', 'Pembayaran Melebihi Atau Sama Dengan Biaya Paket');
                    } elseif ($int_bayar <= 0) {
                        return redirect()->back()->with('error', 'Pembayaran paket sudah selesai');
                    } elseif ($result_jamaah['status_bayar'] == "lunas") {
                        return redirect()->back()->with('error', 'Pembayaran paket sudah selesai');
                    } elseif (!empty($result_jamaah['sisa_pembayaran'])) {
                        if ($bayar > $result_jamaah['sisa_pembayaran']) {
                            return redirect()->back()->with('error', 'Pembayaran Melebihi Sisa Pembayaran');
                        }
                    }

                    $sissa = $result_jamaah['sisa_pembayaran'] - $bayar;


                    $bukti->insert([
                        'nominal' =>    $bayar,
                        'sisa'  =>  $sissa,
                        'bukti' =>  $foto,
                        'created'   =>  date("Y-m-d"),
                        'jamaah_id' =>  $id_jamaah,
                        'rekening_penampung'    =>  $this->request->getVar('rek'),
                        'keterangan'    =>  $catatan,
                        'paket_id'  =>  $id_paket,
                        'kloter_id' =>  $id_kloter
                    ]);
                    $status = true;
                    if ($sissa == 0) {
                        $jamaah->update($id_jamaah, [
                            'status_bayar'  =>  'lunas',
                            'sisa_pembayaran'   =>  $sissa,
                            'tgl_lunas' =>  date("Y-m-d")
                        ]);
                    } else {
                        $jamaah->update($id_jamaah, [
                            'sisa_pembayaran'   =>  $sissa,
                        ]);
                    }
                }
                if ($status == true) {
                    return redirect()->back()->with('success', 'Berhasil Membayar');
                } else {
                    return redirect()->back()->with('error', 'Gagal Membayar');
                }
            } elseif ($metode == "cicil") {
                if (!$this->validate([
                    'file' => [
                        "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
                    ],
                    'bayar' =>  [
                        'rules' =>  'required'
                    ],
                    'catatan'   =>  [
                        'rules' =>  'required'
                    ]
                ])) {
                    session()->setFlashdata('error', "File Input Invalid");
                    return redirect()->back()->withInput();
                }

                $dataBerkas = $this->request->getFile('file');
                if ($dataBerkas->getError() === 4) {
                    session()->setFlashdata('error', "File Harus di isi");
                    return redirect()->back()->withInput();
                } else {
                    $fileName = $dataBerkas->getRandomName();
                    $foto = $fileName;
                    $dataBerkas->move('assets/upload/', $fileName);
                }
                $int_bayar = (int)$result['biaya'];
                if ($bayar >= $int_bayar) {
                    return redirect()->back()->with('error', 'Pembayaran Lebih Atau Sama Dengan Biaya Paket');
                } elseif ($int_bayar <= 0) {
                    return redirect()->back()->with('error', 'Pembayaran paket sudah selesai');
                } elseif ($result_jamaah['status_bayar'] == "lunas") {
                    return redirect()->back()->with('error', 'Pembayaran paket sudah selesai');
                } elseif (!empty($result_jamaah['sisa_pembayaran'])) {
                    if ($bayar > $result_jamaah['sisa_pembayaran']) {
                        return redirect()->back()->with('error', 'Pembayaran Melebihi Sisa Pembayaran');
                    }
                }

                $sisa = $int_bayar - $bayar;

                if (empty($result_jamaah['status_bayar'])) {
                    $jamaah->update($id_jamaah, [
                        'tgl_bayar' =>  date("Y-m-d"),
                        'rekening_penampung' =>  $this->request->getVar("rek"),
                        'status_bayar' =>  $metode,
                        'keterangan_bayar' =>  $catatan,
                        'nominal_pembayaran'     => $bayar,
                        'bukti_pembayaran'  =>  $foto,
                        'sisa_pembayaran'   =>  $sisa,
                    ]);

                    $berhasil = true;
                } else {
                    $uang = $result_jamaah['sisa_pembayaran'] - $bayar;
                    $bukti->insert([
                        'nominal' =>    $bayar,
                        'sisa'  =>  $uang,
                        'bukti' =>  $foto,
                        'created'   =>  date("Y-m-d"),
                        'jamaah_id' =>  $id_jamaah,
                        'rekening_penampung'    =>  $this->request->getVar('rek'),
                        'keterangan'    =>  $catatan,
                        'paket_id'  =>  $id_paket,
                        'kloter_id' =>  $id_kloter
                    ]);
                    if ($uang == 0) {
                        $jamaah->update($id_jamaah, [
                            'status_bayar'  =>  'lunas',
                            'sisa_pembayaran'   =>  $uang,
                            'tgl_lunas' =>  date("Y-m-d")
                        ]);
                    } else {
                        $jamaah->update($id_jamaah, [
                            'sisa_pembayaran'   =>  $uang,
                        ]);
                    }
                    $berhasil = true;
                }

                if ($berhasil == true) {
                    return redirect()->back()->with('success', "Berhasil Membayar");
                } else {
                    return redirect()->back()->with('success', "Gagal Membayar");
                }
            } elseif ($metode == "lunas") {
                if (!$this->validate([
                    'file' => [
                        "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
                    ],
                    'bayar' =>  [
                        'rules' =>  'required'
                    ],
                    'catatan'   =>  [
                        'rules' =>  'required'
                    ]
                ])) {
                    session()->setFlashdata('error', "File Input Invalid");
                    return redirect()->back()->withInput();
                }

                $dataBerkas = $this->request->getFile('file');
                if ($dataBerkas->getError() === 4) {
                    session()->setFlashdata('error', "File Harus di isi");
                    return redirect()->back()->withInput();
                } else {
                    $fileName = $dataBerkas->getRandomName();
                    $foto = $fileName;
                    $dataBerkas->move('assets/upload/', $fileName);
                }
                $int_bayar = (int)$result['biaya'];
                if ($bayar > $int_bayar) {
                    return redirect()->back()->with('error', 'Pembayaran Melebihi Biaya Paket');
                } elseif ($result_jamaah['status_bayar'] == "lunas") {
                    return redirect()->back()->with('error', 'Pembayaran Paket Sudah Selesai');
                } elseif ($bayar < $result['biaya']) {
                    return redirect()->back()->with('error', 'Metode Pembayaran Lunas Tidak Boleh Kurang Dari Biaya Paket');
                }

                $sisa = $int_bayar - $bayar;
                $jamaah->update($id_jamaah, [
                    'tgl_bayar' =>  date("Y-m-d"),
                    'rekening_penampung' =>  $this->request->getVar("rek"),
                    'status_bayar' =>  $metode,
                    'keterangan_bayar' =>  $catatan,
                    'nominal_pembayaran'     => $bayar,
                    'bukti_pembayaran'  =>  $foto,
                    'sisa_pembayaran'   =>  $sisa,
                    'tgl_lunas' =>  date("Y-m-d")
                ]);
                $berhasil = true;
                if ($berhasil == true) {
                    return redirect()->back()->with('success', "Berhasil Membayar");
                } else {
                    return redirect()->back()->with('error', "Gagal Membayar");
                }
            } else {
                return redirect()->back()->with('error', "Gagal Membayar");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal Membayar');
        }
    }

    public function profile_insert()
    {

        if (!$this->validate([
            'file_ktp' => [
                "rules" => "uploaded[file_ktp]|mime_in[file_ktp,application/pdf]|max_size[file_ktp,3024]"
            ],
            'file_kk' => [
                "rules" => "uploaded[file_kk]|mime_in[file_kk,application/pdf]|max_size[file_kk,3024]"
            ],
            'file_asuransi' => [
                "rules" => "mime_in[file_asuransi,application/pdf]|max_size[file_asuransi,3024]"
            ],
            'file_provider' => [
                "rules" => "mime_in[file_provider,application/pdf]|max_size[file_provider,3024]"
            ],
            'file_paspor' => [
                "rules" => "mime_in[file_paspor,application/pdf]|max_size[file_paspor,3024]"
            ],
            'file_visa' => [
                "rules" => "mime_in[file_visa,application/pdf]|max_size[file_visa,3024]"
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
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
            $check_satu = $dua->getError();
            if ($check_satu != 4) {
                $visa = $dua->getRandomName();
                $data_visa = $visa;
                $dua->move('assets/upload/', $visa);
            } else {
                $data_visa = null;
            }

            $tiga = $this->request->getFile('file_provider');
            $check_dua = $tiga->getError();
            if ($check_dua != 4) {
                $provider = $tiga->getRandomName();
                $data_provider = $provider;
                $tiga->move('assets/upload/', $provider);
            } else {
                $data_provider = null;
            }

            $lima = $this->request->getFile('file_asuransi');
            $check_enam = $lima->getError();
            if ($check_enam != 4) {
                $asuransi = $lima->getRandomName();
                $data_asuransi = $asuransi;
                $lima->move('assets/upload/', $asuransi);
            } else {
                $data_asuransi = null;
            }

            $enam = $this->request->getFile('file_paspor');
            $check_tuju = $enam->getError();
            if ($check_tuju != 4) {
                $paspor = $enam->getRandomName();
                $file_paspor = $paspor;
                $enam->move('assets/upload/', $paspor);
            } else {
                $file_paspor = null;
            }
            //code...
            $provinsi_explode = explode("-", $this->request->getVar("provinsi"));
            $provinsi_hasil = $provinsi_explode[1];
            $kabupaten_explode = explode("-", $this->request->getVar("kabupaten"));
            $kabupaten_hasil = $kabupaten_explode[1];
            $kecamatan_explode = explode("-", $this->request->getVar("kecamatan"));
            $kecamatan_hasil = $kecamatan_explode[1];
            $kelurahan_explode = explode('-', $this->request->getVar("kelurahan"));
            $kelurahan_hasil = $kelurahan_explode[1];
            $biodata = new BioDataModel();
            if ($this->request->getVar('tgl_input')) {
                $satus = $this->request->getVar('tgl_input');
            } else {
                $satus = null;
            }
            if ($this->request->getVar('awal')) {
                $duas = $this->request->getVar('awal');
            } else {
                $duas = null;
            }
            if ($this->request->getVar('akhir')) {
                $tigas = $this->request->getVar('akhir');
            } else {
                $tigas = null;
            }
            if ($this->request->getVar('tgl_awal_visa')) {
                $empats = $this->request->getVar('tgl_awal_visa');
            } else {
                $empats = null;
            }
            if ($this->request->getVar('tgl_akhir_visa')) {
                $limas = $this->request->getVar('tgl_akhir_visa');
            } else {
                $limas = null;
            }
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
                'created_at' =>  date("Y-m-d"),
                'updated_at' =>  date("Y-m-d"),
                'no_identitas' =>  $this->request->getvar('no_identitas'),
                'no_paspor' =>  $this->request->getvar('no_paspor'),
                'nomor_polis' =>  $this->request->getvar('nomor'),
                'tgl_input' =>  $satus,
                'tgl_awal' =>  $duas,
                'tgl_akhir' =>  $tigas,
                'nomor_visa' =>  $this->request->getvar('nomor_visa'),
                'tgl_awal_visa' =>  $empats,
                'tgl_akhir_visa' =>  $limas,
                'muassasah' =>  $this->request->getvar('muassasah'),
                'status_vaksin' => "Sudah",
                'status_approve' => null,
                'user_id'   =>  session()->get('id'),
                'file_paspor'   =>  $file_paspor,
                'file_ktp'  =>  $data_ktp,
                'file_kk'   =>  $data_kk,
                'file_visa' =>  $data_visa,
                'file_asuransi' =>  $data_asuransi,
                'file_provider' =>  $data_provider
            ]);
            return redirect()->to("dashboard_user")->with('success', "Data Berhasil Ditambahkan");
        } catch (\Throwable $th) {
            return redirect()->to("profile_jamaah")->with('error', "Data Gagal Ditambahkan");
        }
    }
    public function visa_jamaah()
    {
        if (!session()->get("login") || session()->get("login") == null) {
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
        $tes =  $jamaah->where("id", session()->get("jamaah_id"))->first();
        $check_paket = $pakets->where("id", $tes['paket_id'])->first();
        $check_travel = $travel->where("id", $check_paket['travel_id'])->first();
        $profile = new ProfileModel();
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
            'profile'   =>  $profile->where('id', $check_travel['id'])->first(),
            'main'    =>  $jamaah->where("id", session()->get("jamaah_id"))->first(),
            'title' =>  'Pindah Paket',
            'db'    =>  $db,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'pemberangkatan'    => null
            ])->findAll(),
            'check_paket'   =>  $check_paket,
            'pakets'    => $pakets->where("id", $tes['paket_id'])->first(),
            // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];
        // dd($data['pakets']);

        return view("user/visa", $data);
    }
    public function pembayaran_jamaah()
    {
        if (!session()->get("login") || session()->get("login") == null) {
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
        $tes =  $jamaah->where("id", session()->get("jamaah_id"))->first();
        $check_paket = $pakets->where("id", $tes['paket_id'])->first();
        $check_travel = $travel->where("id", $check_paket['travel_id'])->first();
        $profile = new ProfileModel();
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
            'profile'   =>  $profile->where('id', $check_travel['id'])->first(),
            'main'    =>  $jamaah->where("id", session()->get("jamaah_id"))->first(),
            'title' =>  'Pindah Paket',
            'db'    =>  $db,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'pemberangkatan'    => null
            ])->findAll(),
            'check_paket'   =>  $check_paket,
            'paket'    => $pakets->where("id", $tes['paket_id'])->first(),
            // 'jamaah'    =>  $jamaah->where("id",session()->get("id"))->first(),
            'count' =>  $db->query("SELECT * FROM profile")->getResult(),
        ];


        return view("user/pembayaran", $data);
    }
}
