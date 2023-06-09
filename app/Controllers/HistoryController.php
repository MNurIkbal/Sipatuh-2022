<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AsuransiModel;
use App\Models\BandaraModel;
use App\Models\BankModel;
use App\Models\BuktiModel;
use App\Models\DataBank;
use App\Models\DataHotelModel;
use App\Models\DataProviderModel;
use App\Models\HotelModel;
use App\Models\JamaahModel;
use App\Models\KasusModel;
use App\Models\Keberangkatan;
use App\Models\KepulanganModel;
use App\Models\KloterModel;
use App\Models\LaporanHarianModel;
use App\Models\Maskapai;
use App\Models\MuassahModel;
use App\Models\PaketModel;
use App\Models\PetugasManModel;
use App\Models\PetugasModel;
use App\Models\ProfileModel;

class HistoryController extends BaseController
{
    public function index()
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        if (session()->get("level_id") == "jamaah") {

            // $datapaket = $paket->where([
            //     'travel_id' =>  session()->get("travel_id"),
            //     'cabang'    =>  NULL,
            //     'kelengkapan' =>    'sudah',
            //     'status'    =>  "selesai",
            //     'tiket' =>  'sudah'
            // ])->findAll();
            $datapaket = $paket->join('kloter', 'paket.id = kloter.paket_id')
                ->select(
                    "paket.id as id_paket,
                    paket.nama,
                    paket.tgl_berangkat,
                    paket.tgl_pulang,
                    paket.biaya,
                    paket.ket_berangkat,
                    paket.provider,
                    paket.tahun,
                    paket.status,
                    paket.ket_pulang,
                    paket.asuransi,

                    kloter.id
                    "
                )
                ->where([
                    'paket.travel_id' => session()->get("travel_id"),
                    'kloter.keberangkatan' => 'sudah',
                    'kloter.status_realisasi'   =>  'sudah',
                    'kloter.done'  => 'sudah',
                    'paket.cabang' => NULL,
                    'paket.kelengkapan' => 'sudah',
                    'paket.tiket' => 'sudah',
                ])
                ->groupBy('paket.id')
                ->findAll();
                
        } elseif (session()->get("level_id") == "cabang") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang_id' =>  session()->get('cabang_id'),
                'cabang'    =>  "cabang",
                'status'    =>  "selesai",
                'kelengkapan' =>    'sudah',
                'tiket' =>  'sudah'
            ])->findAll();
        }
        $data = [
            'title' =>  "History",
            'result'    =>  $datapaket
        ];
        return view("jamaah/history/index", $data);
    }

    public function detail_selesai_jamaah($id_kloter, $id_paket, $judul)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $kloter = new KloterModel();
        $jamaah = new JamaahModel();
        $paket = new PaketModel();
        $provider = new DataProviderModel();
        $asuransi = new AsuransiModel();
        $bank = new BankModel();
        $db      = \Config\Database::connect();
        $data_kloter = new KloterModel();
        $muasah = new MuassahModel();
        $finish = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id_paket' 
            AND tgl_bayar IS NOT NULL
            AND rekening_penampung IS NOT NULL 
            AND status_bayar = 'lunas'
            AND keterangan_bayar IS NOT NULL 
            AND nomor_polis  IS NOT NULL
            AND tgl_input IS NOT NULL
            AND tgl_awal IS NOT NULL
            AND tgl_akhir IS NOT NULL
            AND nomor_visa IS NOT NULL
            AND tgl_awal_visa IS NOT NULL
            AND tgl_akhir_visa IS NOT NULL
            AND muassasah IS NOT NULL
            AND status_vaksin IS NOT NULL
            AND tgl_vaksin IS NOT NULL
            AND jenis_vaksin IS NOT NULL
            AND kloter_id = '$id_kloter'
            AND selesai_pembayaran = 'sudah'
            ")->getResult();
        $counts = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id_paket' AND kloter_id = '$id_kloter'")->getResult();
        $data = [
            'title' =>  "Pendaftaran",
            'kloter'   =>   $kloter->where("id", $id_kloter)->first(),
            'result'    => $jamaah->where([
                'paket_id'  =>  $id_paket,
                'kloter_id' =>  $id_kloter,
            ])->findAll(),
            'data_kloter' => $data_kloter->where("paket_id", $id_paket)->where("status", "Aktif")->findAll(),
            'count' =>  count($counts),
            'paket' =>  $db->query("SELECT * FROM kloter INNER JOIN paket ON kloter.paket_id = paket.id WHERE  kloter.id = '$id_kloter'")->getRowArray(),
            // 'paket' =>  $paket->where("id",$id_paket)->first(),
            // 'paket' =>  $paket->where([
            //     'id'    =>  $id
            // ])->first(),
            'id'    =>  $id_paket,
            'id_kloter' =>  $id_kloter,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'pemberangkatan'    => null
            ])->findAll(),
            'judul' =>   $judul,
            'bank'  =>  $bank->where("status", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'finish'    =>  count($finish),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'provider'  =>  $provider->findAll(),
            'asuransi'  =>  $asuransi->findAll()
        ];


        return view("jamaah/history/tambah", $data);
    }

    public function detail_jamaah_selesai($id_jamaah, $id_paket, $id_kloter, $judul)
    {

        $paket = new PaketModel();
        $kloter = new KloterModel();
        $pakets = $paket->where('id', $id_paket)->first();
        $kloters = $kloter->where("id", $id_kloter)->first();
        $profile = new ProfileModel();
        $data_profile = $profile->where("id", $pakets['travel_id'])->first();
        $jamaah = new JamaahModel();
        $jamaahs = $jamaah->where("paket_id", $id_paket)->where('kloter_id', $id_kloter)->where("status_approve", "sudah")
            ->where("id", $id_jamaah)->first();

        $rekening_penampung = new BankModel();
        $banks = $rekening_penampung->where("id", $pakets['rekening_penampung_id'])->first();
        $data = [
            'banks' => $banks,
            'id_paket'  =>  $id_paket,
            'id_kloter' =>  $id_kloter,
            'paket' =>  $pakets,
            'id_jamaah' =>  $id_jamaah,
            'kloter'    =>  $kloters,
            'title' =>  'History',
            'main'    =>  $jamaahs,
            'judul' =>  $judul,
            'perusahaan'    =>  $data_profile
        ];

        return view("jamaah/realisasi/detail_diri", $data);
    }

    public function pembayaran_selesai($id, $id_paket, $id_kloter, $judul)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $paket = new PaketModel();
        $petugas_man  = new PetugasManModel();
        $rekening = new BankModel();
        $data_bank = new DataBank();
        $jamaah = new JamaahModel();
        $kloter = new KloterModel();
        $bank = new BankModel();
        $bukti = new BuktiModel();
        $result_paket = $paket->where("id", $id_paket)->first();
        $data = [
            'result'    =>  $paket->where("travel_id", session()->get("travel_id"))->where("pemberangkatan", "sudah")->where("status", "aktif")->findAll(),
            'title' =>  "Pembayaran",
            'id_jamaah'    =>  $id,
            'judul' =>  $judul,
            'kloter'  =>  $kloter->where('id', $id_kloter)->first(),
            'id_kloter' =>  $id_kloter,
            'main'    =>  $jamaah->where("id", $id)->first(),
            'id_paket'  =>  $id_paket,
            'paket' =>  $paket->where("id", $id_paket)->first(),
            // 'bank'  =>  $rekening->findAll(),
            'bank'  =>  $bank->where("id", $result_paket['rekening_penampung_id'])->first(),
            'petugas'   =>  $petugas_man->findAll(),
            'bukti' =>  $bukti->where("jamaah_id", $id)->where("paket_id", $id_paket)->where('kloter_id', $id_kloter)->findAll(),

            'rekening'  =>  $rekening->where("travel_id", session()->get("travel_id"))->findAll()
        ];

        return view("jamaah/realisasi/pembayaran", $data);
    }

    public function detail_history_kloter($id, $judul)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $kloter = new KloterModel();
        if (session()->get("level_id") == "jamaah") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang'    =>  NULL,
                'kelengkapan' =>    'sudah',
                'status'    =>  "aktif",
                'tiket' =>  'sudah'
            ])->findAll();
        } elseif (session()->get("level_id") == "cabang") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang_id' =>  session()->get('cabang_id'),
                'cabang'    =>  "cabang",
                'status'    =>  "aktif",
                'kelengkapan' =>    'sudah',
                'tiket' =>  'sudah'
            ])->findAll();
        }
        $data = [
            'title' =>  "History",
            'result'    =>  $datapaket,
            'paket'    =>  $paket->where('id', $id)->first(),
            'id_paket'  =>  $id,
            'judul' =>  $judul,
            'kloter'    =>  $kloter->where("paket_id", $id)->where("status", "Aktif")->where("keberangkatan", 'sudah')->where("status_realisasi", "sudah")->where("done", "sudah")->findAll(),
        ];
        return view("jamaah/history/kloter", $data);
    }
    public function detail_perencanaan_kloter($id, $id_paket, $judul)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $maskapai = new Maskapai();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kloter = new KloterModel();
        $petugas_umrah = new PetugasManModel();
        $bandara = new BandaraModel();
        $muasah = new MuassahModel();
        $data_hotel = new DataHotelModel();
        if (session()->get("level_id") == "jamaah") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang'    =>  NULL,
                'kelengkapan' =>    'sudah',
                'status'    =>  "aktif",
                'tiket' =>  'sudah'
            ])->findAll();
        } elseif (session()->get("level_id") == "cabang") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang_id' =>  session()->get('cabang_id'),
                'cabang'    =>  "cabang",
                'status'    =>  "aktif",
                'kelengkapan' =>    'sudah',
                'tiket' =>  'sudah'
            ])->findAll();
        }
        $data = [
            'title' =>  "History",
            // 'result'    =>  $datapaket,
            'data_hotel'    =>  $data_hotel->findAll(),
            'bandara'   =>  $bandara->findAll(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id_paket,
                // 'kategori'  =>  'perencanaan'
            ])->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id_paket,
                // 'kategori'  =>  'perencanaan'
            ])->findAll(),
            'hotel' => $hotel->where([
                'paket_id'  =>  $id_paket,
                // 'kategori'  =>  'perencanaan'
            ])->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id_paket,
                // 'kategori'  =>  'perencanaan'
            ])->findAll(),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'result'    =>  $paket->where('id', $id_paket)->first(),
            'id_paket'  =>  $id_paket,
            'judul' =>  $judul,
            'kloter'    =>  $kloter->where("paket_id", $id_paket)->where("done", 'sudah')->findAll(),
        ];
        return view("jamaah/history/detail_perencanaan", $data);
    }
    public function detail_perencanaan_realisasi($id, $id_paket, $judul)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kasus = new KasusModel();
        $petugas_umrah = new PetugasManModel();
        $muasah = new MuassahModel();
        $maskapai  = new Maskapai();
        $bandara = new BandaraModel();
        $db      = \Config\Database::connect();
        $travel_id = session()->get("travel_id");
        $data_hotel = new DataHotelModel();
        $kloter = new KloterModel();
        if (session()->get("level_id") == "jamaah") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang'    =>  NULL,
                'kelengkapan' =>    'sudah',
                'status'    =>  "aktif",
                'tiket' =>  'sudah'
            ])->findAll();
        } elseif (session()->get("level_id") == "cabang") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang_id' =>  session()->get('cabang_id'),
                'cabang'    =>  "cabang",
                'status'    =>  "aktif",
                'kelengkapan' =>    'sudah',
                'tiket' =>  'sudah'
            ])->findAll();
        }
        // $data = [
        //     'title' =>  "History",
        //     // 'result'    =>  $datapaket,
        //     'data_hotel'    =>  $data_hotel->findAll(),
        //     'bandara'   =>  $bandara->findAll(),
        //     'petugas'   =>  $petugas->where([
        //         'paket_id'    =>  $id,
        //         'kategori'  =>  'perencanaan'
        //     ])->findAll(),
        //     'keberangkatan' => $keberangkatan->where([
        //         'paket_id'  =>  $id,
        //         'kategori'  =>  'perencanaan'
        //     ])->findAll(),
        //     'hotel' =>$hotel->where([
        //         'paket_id'  =>  $id,
        //         'kategori'  =>  'perencanaan'
        //     ])->findAll(),
        //     'kepulangan'    =>  $kepulangan->where([
        //         'paket_id'  =>  $id,
        //         'kategori'  =>  'perencanaan'
        //     ])->findAll(),
        //     'muasah'    =>  $muasah->where("status",1)->findAll(),
        //     'result'    =>  $paket->where('id',$id_paket)->first(),
        //     'id_paket'  =>  $id_paket,
        //     'judul' =>  $judul,
        //     'kloter'    =>  $kloter->where("paket_id",$id_paket)->findAll(),
        // ];
        $data = [
            'bandara'   =>  $bandara->findAll(),
            'maskapai'  =>  $maskapai->where("status", 1)->findAll(),
            'title' =>  "History",
            'data_hotel'    =>  $data_hotel->findAll(),
            // 'result'    =>  $paket->where([
            //     'id'    =>  $id
            // ])->first(),
            'result'    =>  $db->query("SELECT          
                    paket.nama,
                    paket.tgl_berangkat,
                    paket.tgl_pulang,
                    paket.biaya,
                    paket.id,
                    paket.kode_paket,
                    kloter.keberangkatan,
                    paket.pemberangkatan,
                    kloter.selesai 
                    FROM paket LEFT JOIN kloter 
                    ON paket.id = kloter.paket_id 
                    WHERE travel_id = '$travel_id' AND 
                    kloter.keberangkatan = 'sudah' AND 
                    paket.status = 'selesai' AND 
                    paket.kelengkapan = 'sudah'")->getRowArray(),
            'id_paket'  =>  $id_paket,
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id_paket,
                // 'kategori'  =>  'realisasi',
                // 'kloter_id' =>  $id,
            ])->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("travel_id", session()->get("travel_id"))->where("aktif", "aktif")->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id_paket,
                // 'kategori'  =>  'realisasi',
                // 'kloter_id' =>  $id,
            ])->findAll(),
            'hotel' => $hotel->where([
                'paket_id'  =>  $id_paket,
                // 'kategori'  =>  'realisasi',
                // 'kloter_id' =>  $id,
            ])->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id_paket,
                // 'kategori'  =>  'realisasi',
                // 'kloter_id' =>  $id,
            ])->findAll(),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'kasus' =>  $kasus->where("paket_id", $id_paket)->where("kloter_id", $id)->findAll(),
            'id_kloter' =>  $id,
            'judul' =>  $judul,
            'kloter'    =>  $kloter->where("id", $id)->first()
        ];
        return view("jamaah/history/detail_realisasi", $data);
    }

    public function laporan_harian_realisasi($id_kasus, $id_paket, $id_kloter, $judul)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $kasus = new KasusModel();
        $laporan_harian = new LaporanHarianModel();


        $data = [
            'paket' =>  $paket->first(),
            'kasus' =>  $kasus->where("id", $id_kasus)->first(),
            'result'    =>  $laporan_harian->where("kasus_id", $id_kasus)->findAll(),
            'title' =>  "Laporan Harian",
            'id_kasus'  =>  $id_kasus,
            'id_paket'  =>  $id_paket,
            'judul' =>  $judul,
            'id_kloter' => $id_kloter,
        ];

        return view("jamaah/history/laporan_harian_kasus", $data);
    }

    public function detail_history($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $kasus = new KasusModel();
        $data = [
            'title' =>  "Detail History",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id
            ])->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id
            ])->findAll(),
            'hotel' => $hotel->where([
                'paket_id'  =>  $id,
            ])->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id
            ])->findAll(),
            'kasus' =>  $kasus->where("paket_id", $id)->findAll(),
        ];
        return view("jamaah/history/detail", $data);
    }

    public function laporan_harian_history($id_kasus, $id_paket)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $kasus = new KasusModel();
        $laporan_harian = new LaporanHarianModel();

        $data = [
            'paket' =>  $paket->first(),
            'kasus' =>  $kasus->where("id", $id_kasus)->first(),
            'result'    =>  $laporan_harian->findAll(),
            'title' =>  "Laporan Harian History",
            'id_kasus'  =>  $id_kasus,
            'id_paket'  =>  $id_paket
        ];

        return view("jamaah/history/laporan_harian", $data);
    }

    public function detail_jamaah_history($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $jamaah = new JamaahModel();
        $paket = new PaketModel();
        $bank = new BankModel();
        $db      = \Config\Database::connect();
        $muasah = new MuassahModel();
        $finish = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id' 
            AND tgl_bayar IS NOT NULL
            AND rekening_penampung IS NOT NULL 
            AND status_bayar = 'lunas'
            AND keterangan_bayar IS NOT NULL 
            AND nomor_polis  IS NOT NULL
            AND tgl_input IS NOT NULL
            AND tgl_awal IS NOT NULL
            AND tgl_akhir IS NOT NULL
            AND nomor_visa IS NOT NULL
            AND tgl_awal_visa IS NOT NULL
            AND tgl_akhir_visa IS NOT NULL
            AND muassasah IS NOT NULL
            ")->getResult();
        $counts = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id'")->getResult();
        $data = [
            'title' =>  "History Jamaah",
            'result'    => $jamaah->where([
                'paket_id'  =>  $id
            ])->findAll(),
            'count' =>  count($counts),
            'paket' =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'id'    =>  $id,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'id'    =>  $id
            ])->findAll(),
            'id'    =>  $id,
            'bank'  =>  $bank->where("status", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'finish'    =>  count($finish),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
        ];
        return view("jamaah/history/jamaah", $data);
    }

    public function detail_perencanaan_history($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $petugas = new PetugasModel();
        $keberangkatan = new Keberangkatan();
        $maskapai = new Maskapai();
        $hotel = new HotelModel();
        $kepulangan = new KepulanganModel();
        $petugas_umrah = new PetugasManModel();
        $bandara = new BandaraModel();
        $muasah = new MuassahModel();
        $data = [
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'title' =>  "History Perencanaa",
            'result'    =>  $paket->where([
                'id'    =>  $id
            ])->first(),
            'bandara'   =>  $bandara->findAll(),
            'petugas'   =>  $petugas->where([
                'paket_id'    =>  $id,
                'kategori'  =>  'perencanaan'
            ])->findAll(),
            'maskapai'  =>  $maskapai->where("status", 1)->findAll(),
            'keberangkatan' => $keberangkatan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->findAll(),
            'hotel' => $hotel->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->findAll(),
            'kepulangan'    =>  $kepulangan->where([
                'paket_id'  =>  $id,
                'kategori'  =>  'perencanaan'
            ])->findAll(),
            'petugas_umrah' =>  $petugas_umrah->where("aktif", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
        ];
        return view("jamaah/history/perencanaan", $data);
    }
}
