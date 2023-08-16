<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use App\Models\AsuransiModel;
use App\Models\BankModel;
use App\Models\BioDataModel;
use App\Models\BuktiModel;
use App\Models\DaftarJamaahModel;
use App\Models\DashboardAdmin;
use App\Models\DataProviderModel;
use App\Models\JamaahModel;
use App\Models\KloterModel;
use App\Models\MuassahModel;
use App\Models\PaketDashboardTravelModel;
use App\Models\PaketModel;
use App\Models\ProfileModel;
use App\Models\Users;
use Exception;
use Myth\Auth\Entities\User;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class PendaftaranController extends BaseController
{
    public function pendaftaran()
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        if (session()->get("level_id") == "jamaah") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang'    =>  NULL,
                'kelengkapan' =>    'sudah',
                'status'    =>  "aktif",
            ])->orderBy('id', 'desc')->findAll();
        } elseif (session()->get("level_id") == "cabang") {
            $datapaket = $paket->where([
                'travel_id' =>  session()->get("travel_id"),
                'cabang_id' =>  session()->get('cabang_id'),
                'cabang'    =>  "cabang",
                'status'    =>  "aktif",
                'kelengkapan' =>    'sudah',
            ])->orderBy('id', 'desc')->findAll();
        }
        $data = [
            'title' =>  "Pendaftaran Paket",
            // 'result'    =>  $paket->where([
            //     'status'    =>  "aktif",
            //     'travel_id'   =>  session()->get("travel_id"),
            //     'kelengkapan'   =>  'sudah',
            // ])->findAll(),
            'result'    =>  $datapaket,
        ];
        return view("jamaah/pendaftaran/index", $data);
    }

    public function detail_pendaftaran_kloter($id_paket)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $kloter = new KloterModel();
        $data = [
            'kloter'    =>      $kloter->where("paket_id", $id_paket)->where("status", 'Aktif')->where("done", NULL)->orderBy('id', 'desc')->findAll(),
            'title' =>  "Pendaftaran Paket",
            'paket'    =>  $paket->where([
                'id'    =>  $id_paket
            ])->first(),
            'id_paket'  =>  $id_paket,
        ];

        return view("jamaah/kloter/index", $data);
    }

    public function pindah_paket_umrah($id, $id_kloter, $id_paket)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $paket = new PaketModel();
        $kloter = new KloterModel();
        $jamaah = new JamaahModel();
        $data_kloter = new KloterModel();
        $data = [
            'kloter'    =>      $kloter->where("paket_id", $id_paket)->where("status", 'Aktif')->findAll(),
            'title' =>  "Pendaftaran Paket",
            'paket'    =>  $paket->where([
                'id'    =>  $id_paket
            ])->first(),
            'id_paket'  =>  $id_paket,
            'id_kloter' =>  $id_kloter,
            'id'    =>  $id,
            'main'  =>  $jamaah->where("id", $id)->first(),
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'pemberangkatan'    => null,
                'status_approve'    =>  'sudah'
            ])->findAll(),
            'data_kloter' => $data_kloter->where("paket_id", $id_paket)->where("status", "Aktif")->findAll(),
        ];

        return view("jamaah/pendaftaran/pindah", $data);
    }

    public function ambil_kolter($id)
    {
        $kloter = new KloterModel();
        $data = $kloter->where("paket_id", $id)->where("status", "Aktif")->where("done", NULL)->where("keberangkatan", NULL)->findAll();
        foreach ($data as $row) {
            $html = "<option value='$row[id]'>$row[nama]</option>";
            echo $html;
        }
        // return $id;
    }

    public function tambah_pendaftaran($id_kloter, $id)
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

        $sekarang = date("Y-m-d");
        $expired = $jamaah->where("expired_bayar_dp IS NOT NUll")->where("status_bayar", null)->findAll();
        $expireds = $jamaah->where("expired_bayar_dp IS NOT NUll")->where("status_bayar", null)->first();
        if ($expireds) {
            foreach ($expired as $main) {
                $satu = date("Y-m-d", strtotime($main['expired_bayar_dp']));
                $delete = $jamaah->where("expired_bayar_dp IS NOT NUll")->where("status_bayar", null)->where('date(expired_bayar_dp)', $sekarang)->where('id', $main['id'])->delete();
            }
        }
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
            AND status_vaksin IS NOT NULL
            AND tgl_vaksin IS NOT NULL
            AND jenis_vaksin IS NOT NULL
            AND kloter_id = '$id_kloter'
            AND selesai_pembayaran = 'sudah'
            
            ")->getResult();
        $counts = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id' AND kloter_id = '$id_kloter'")->getResult();
        $data = [
            'title' =>  "Pendaftaran Paket",
            'kloter'   =>   $kloter->where("id", $id_kloter)->first(),
            'result'    => $jamaah->where([
                'paket_id'  =>  $id,
                'kloter_id' =>  $id_kloter,
            ])->findAll(),
            'data_kloter' => $data_kloter->where("paket_id", $id)->where("status", "Aktif")->findAll(),
            'count' =>  count($counts),
            'paket' =>  $db->query("SELECT * FROM kloter INNER JOIN paket ON kloter.paket_id = paket.id WHERE  kloter.id = '$id_kloter'")->getRowArray(),
            // 'paket' =>  $paket->where([
            //     'id'    =>  $id
            // ])->first(),
            'id'    =>  $id,
            'id_kloter' =>  $id_kloter,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'pemberangkatan'    => null
            ])->findAll(),
            'bank'  =>  $bank->where("status", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'finish'    =>  count($finish),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'provider'  =>  $provider->findAll(),
            'asuransi'  =>  $asuransi->findAll(),
        ];

        return view("jamaah/pendaftaran/tambah", $data);
    }

    public function kelengkapan_jamaah($id_jamaah, $id_paket, $id_kloter)
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
            // 'paket' =>  $paket->where([
            //     'id'    =>  $id
            // ])->first(),
            'id_jamaah' =>  $id_jamaah,
            'id'    =>  $id_paket,
            'id_kloter' =>  $id_kloter,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'pemberangkatan'    => null
            ])->findAll(),
            'bank'  =>  $bank->where("status", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'finish'    =>  count($finish),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'provider'  =>  $provider->findAll(),
            'asuransi'  =>  $asuransi->findAll(),
        ];

        return view("jamaah/pendaftaran/kelengkapan", $data);
    }

    public function kelengkapan_jamaah_insert($id_jamaah, $id_paket, $id_kloter)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        if (!$this->validate([
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
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
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

        try {
            $data_result = new JamaahModel();
            $datas = $data_result->where("id", $id_jamaah)->first();
            $user = new Users();
            $user->insert([
                'nama'  =>  $datas['nama'],
                'username'  =>  $datas['nama'],
                'password'  =>  password_hash(123456, PASSWORD_DEFAULT),
                'level_id'  =>  'user',
                'created_at'    =>  date("Y-m-d"),
                'img'   =>  $datas['foto'],
                'email' =>  "",
                'no_hp' =>  $datas['no_telp'],
                'jamaah_id' =>  $datas['id']
            ]);

            $end = $user->orderby("id", "DESC")->first();
            $biodata = new BioDataModel();
            $biodata->insert([
                'title' =>  $datas['title'],
                'nama_paspor' =>  $datas['nama_paspor'],
                'ayah' =>  $datas['ayah'],
                'jenis_identitas' =>  $datas['jenis_identitas'],
                'tempat_lahir' =>  $datas['tempat_lahir'],
                'tgl_lahir' =>  $datas['tgl_lahir'],
                'alamat' =>  $datas['alamat'],
                'provinsi' =>  $datas['provinsi'],
                'kabupaten' =>  $datas['kabupaten'],
                'kecamatan' =>  $datas['kecamatan'],
                'kelurahan' =>  $datas['kelurahan'],
                'no_telp' =>  $datas['no_telp'],
                'kewargannegaraan' =>  $datas['kewargannegaraan'],
                'status_pernikahan' =>  $datas['status_pernikahan'],
                'jenis_pendidikan' =>  $datas['jenis_pendidikan'],
                'jenis_pekerjaan' =>  $datas['jenis_pekerjaan'],
                'provider' =>  $datas['provider'],
                'asuransi' =>  $datas['asuransi'],
                'created_at' =>  date("Y-m-d"),
                'updated_at' =>  date("Y-m-d"),
                'no_paspor' =>  $datas['no_paspor'],
                'no_identitas' =>  $datas['no_identitas'],
                'nomor_polis' =>  $this->request->getVar("nomor"),
                'tgl_input' =>  $this->request->getVar("tgl_input"),
                'tgl_awal' =>  $this->request->getVar("awal"),
                'tgl_akhir' =>  $this->request->getVar("akhir"),
                'nomor_visa' =>  $this->request->getVar("nomor_visa"),
                'tgl_awal_visa' =>  $this->request->getVar("tgl_awal_visa"),
                'tgl_akhir_visa' =>  $this->request->getVar("tgl_akhir_visa"),
                'muassasah' =>  $this->request->getVar("muassasah"),
                'status_vaksin' => "sudah",
                'tgl_vaksin' =>  $this->request->getVar("tgl"),
                'jenis_vaksin' =>  $this->request->getVar("jenis"),
                'user_id' =>  $end['id'],
                'file_paspor' =>  $file_paspor,
                'file_ktp' =>  $data_ktp,
                'file_kk' =>  $data_kk,
                'file_sertifikat_vaksin' =>  $data_vaksin,
                'file_visa' =>  $data_visa,
                'file_asuransi' =>  $data_asuransi,
                'file_provider' =>  $data_provider,
            ]);

            $data_result->update($id_jamaah, [
                'nomor_polis'  =>  $this->request->getVar('nomor'),
                'tgl_input' =>  $this->request->getVar("tgl_input"),
                'tgl_awal' =>  $this->request->getVar("awal"),
                'tgl_akhir' =>  $this->request->getVar("akhir"),
                'nomor_visa' =>  $this->request->getVar("nomor_visa"),
                'tgl_awal_visa' =>  $this->request->getVar("tgl_awal_visa"),
                'tgl_akhir_visa' =>  $this->request->getVar("tgl_akhir_visa"),
                'muassasah' =>  $this->request->getVar("muassasah"),
                'status_vaksin' => "sudah",
                'tgl_vaksin' =>  $this->request->getVar("tgl"),
                'jenis_vaksin' =>  $this->request->getVar("jenis"),
                'user_id'   =>  $end['id']
            ]);

            return redirect()->to("tambah_pendaftaran/$id_kloter/$id_paket")->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->to("kelengkapan_jamaah/$id_jamaah/$id_kloter/$id_paket")->with('error', 'Data Gagal Ditambahkan');
            //throw $th;
        }
    }
    public function edits_jamaah($id_kloter, $id, $ids)
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
            AND status_vaksin IS NOT NULL
            AND tgl_vaksin IS NOT NULL
            AND jenis_vaksin IS NOT NULL
            AND kloter_id = '$id_kloter'
            AND selesai_pembayaran = 'sudah'
            ")->getResult();
        $counts = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id' AND kloter_id = '$id_kloter'")->getResult();
        $data = [
            'title' =>  "Pendaftaran",
            'main'  =>  $jamaah->where('id', $id)->first(),
            'kloter'   =>   $kloter->where("id", $id_kloter)->first(),
            'result'    => $jamaah->where([
                'paket_id'  =>  $id,
                'kloter_id' =>  $id_kloter,
            ])->findAll(),
            'db'    =>  $db,
            'data_kloter' => $data_kloter->where("paket_id", $id)->where("status", "Aktif")->findAll(),
            'count' =>  count($counts),
            'paket' =>  $db->query("SELECT * FROM kloter INNER JOIN paket ON kloter.paket_id = paket.id WHERE  kloter.id = '$id_kloter'")->getRowArray(),
            // 'paket' =>  $paket->where([
            //     'id'    =>  $id
            // ])->first(),
            'id'    =>  $id,
            'ids'   =>  $ids,
            'id_kloter' =>  $id_kloter,
            'all_paket' =>  $paket->where([
                'travel_id'   =>  session()->get("travel_id"),
                'status'    =>  'aktif',
                'pemberangkatan'    => null
            ])->findAll(),
            'bank'  =>  $bank->where("status", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'finish'    =>  count($finish),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'provider'  =>  $provider->orderby('nama_provider', 'asc')->findAll(),
            'asuransi'  =>  $asuransi->orderby('nama', 'asc')->findAll(),
        ];

        return view("jamaah/pendaftaran/edit", $data);
    }

    public function vaksin($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $id_paket = $this->request->getVar("id_paket");
        $id_kloter = $this->request->getVar("id_kloter");

        $paket = new PaketModel();
        $kloter = new KloterModel();
        $jamaah = new JamaahModel();
        $jamaah->update($id, [
            'status_vaksin' =>  'sudah',
            'jenis_vaksin'  =>  $this->request->getVar("jenis"),
            'tgl_vaksin'    =>  $this->request->getVar("tgl"),
        ]);

        // return redirect()->to("tambah_pendaftaran/" . $id_kloter . '/' .  $id_paket);
        return redirect()->back()->with('success', "Data Berhasil Diupdate");
    }

    public function tambah_jamaah()
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        if (!$this->validate([
            'foto' => [
                "rules" =>  "max_size[foto,3024]|mime_in[foto,image/jpg,image/jpeg,image/png]"
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $dataBerkas = $this->request->getFile('foto');
        $fileName = $dataBerkas->getRandomName();
        $jamaah = new JamaahModel();
        $paket_first = new PaketModel();
        $kode_paket_satu = $paket_first->where("id", $this->request->getVar("id_paket"))->first();
        $rekenings = new BankModel();
        $result_rekenings = $rekenings->where("id", $kode_paket_satu['rekening_penampung_id'])->first();
        $kode_paket = $kode_paket_satu['kode_paket'];
        $kloter_result = new KloterModel();
        $provinsi_result = explode("-", $this->request->getVar("provinsi"));
        $provinsi_hasil = $provinsi_result[1];
        $kabupaten_result = explode("-", $this->request->getVar("kabupaten"));
        $kabupaten_hasil = $kabupaten_result[1];
        $kecamatan_result = explode("-", $this->request->getVar('kecamatan'));
        $kecamatan_hasil = $kecamatan_result[1];
        $kelurahan_result = explode('-', $this->request->getVar("kelurahan"));
        $kelurahan_hasil = $kelurahan_result[1];

        $check_kloter = $kloter_result->where("id", $this->request->getVar("id_kloter"))->first();
        if ($check_kloter['batas_jamaah'] <= 0) {
            return redirect()->back()->with('error', "Batas Kuota Jamaah Sudah Habis");
        }

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
            'provinsi' =>  $provinsi_hasil,
            'kabupaten' =>  $kabupaten_hasil,
            'kecamatan' =>  $kecamatan_hasil,
            'kelurahan' =>  $kelurahan_hasil,
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
            'rekening_penampung'    =>  $result_rekenings['bank'] . ' / ' .  $result_rekenings['no_rekening'] .  ' / ' . $result_rekenings['nama'],
            'no_pasti_umrah'    =>  "URM"  . date("Y") . date("m") . rand(1111, 9999),
            'no_registrasi' => date("Y") . date("m") .  $kode_paket . rand(1111, 9999),
            'kloter_id' =>  $this->request->getVar("id_kloter"),
        ]);
        // $db      = \Config\Database::connect();
        // $users= new Users();
        // $users->insert([
        //     'nama'  =>  $this->request->getVar('nama'),
        //     'username'  =>  $this->request->getVar('email'),
        //     'password'  =>  password_hash($this->request->getVar('password'),PASSWORD_DEFAULT),
        //     'level_id'  =>  'user',
        //     'img'   =>  $fileName,
        //     'email'=>   $this->request->getVar('email'),
        //     'no_hp' =>  $this->request->getVar('no_hp'),
        // ]);
        // $akhir_user = $users->orderby('id','desc')->first();
        // $mk = $akhir_user['id'];
        // $db->query("UPDATE jamaah SET user_id = '$mk' ORDER BY id DESC");
        $dataBerkas->move('assets/upload/', $fileName);
        $kloter = new KloterModel();
        $data_kloter = $kloter->where("id", $this->request->getVar("id_kloter"))->first();
        $kloter->update($this->request->getVar('id_kloter'), [
            'batas_jamaah'  =>  $data_kloter['batas_jamaah'] - 1
        ]);

        $e = $jamaah->orderby("id", 'desc')->first();

        $res = $jamaah->where("id", $e['id'])->first();
        $pakets = new PaketModel();
        $rt = $pakets->where("id", $res['paket_id'])->first();

        $daftar = new DaftarJamaahModel();
        $now = date("Y-m-d");
        $che = $daftar->where('travel_id', $rt['travel_id'])->where('date(bulan)', $now)->orderby('id', 'desc')->first();
        if ($che) {
            // $daftar
            $yy = $daftar->where("travel_id", $rt['travel_id'])->orderBy('id', 'desc')->first();

            $daftar->update($yy['id'], [
                'jamaah'    =>  $yy['jamaah'] + 1
            ]);
        } else {
            $daftar->insert([
                'bulan' =>  date("Y-m-d"),
                'jamaah'    =>  1,
                'travel_id' =>  $rt['travel_id']
            ]);
        }

        $dash_admin = new DashboardAdmin();
        $check_dash = $dash_admin->where('travel_id', $rt['travel_id'])->first();
        if ($check_dash) {
            $dash_admins = new DashboardAdmin();
            $dash_admins->update($check_dash['id'], [
                'score' =>  $check_dash['score'] + 1,
            ]);
        } else {
            $dash_admins = new DashboardAdmin();
            $dash_admins->insert([
                'travel_id' =>  $rt['travel_id'],
                'score' =>  1,
                'created_at'    =>  date("Y-m-d")
            ]);
        }

        $paket = new PaketModel();
        $id_paket = $this->request->getVar('id_paket');
        $pake_travel = new PaketDashboardTravelModel();
        $cechK_lima= $pake_travel->where("travel_id",session()->get('travel_id'))->where('paket_id',$id_paket)->first();
        $paket_akhir = $paket->where('id',$this->request->getVar('id_paket'))->orderby('id','desc')->first();
        $konek = \Config\Database::connect();
        if($cechK_lima) { 
            $akhir_travel = session()->get('travel_id');
            $totlas = $cechK_lima['total'] + 1;
            $konek->query("UPDATE paket_dashboard_travel SET total = '$totlas' WHERE travel_id = '$akhir_travel' AND paket_id = '$id_paket'");
        } else {
            $pake_travel->insert([
                'travel_id' =>  session()->get('travel_id'),
                'total' =>  '1',
                'created_at'    =>  date("Y-m-d"),
                'paket_id'  =>  $paket_akhir['id']
            ]); 
        }

        return redirect()->to("tambah_pendaftaran/"  . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success", "Data Berhasil Di tambahkan");
    }

    public function insert_jamaah($id_paket, $id_kloter)
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
            'title' =>  "Pendaftaran Paket",
            'kloter'   =>   $kloter->where("id", $id_kloter)->first(),
            'result'    => $jamaah->where([
                'paket_id'  =>  $id_paket,
                'kloter_id' =>  $id_kloter,
            ])->findAll(),
            'data_kloter' => $data_kloter->where("paket_id", $id_paket)->where("status", "Aktif")->findAll(),
            'count' =>  count($counts),
            'paket' =>  $db->query("SELECT * FROM kloter INNER JOIN paket ON kloter.paket_id = paket.id WHERE  kloter.id = '$id_kloter'")->getRowArray(),
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
            'db'    =>  \Config\Database::connect(),
            'bank'  =>  $bank->where("status", "aktif")->where("travel_id", session()->get("travel_id"))->findAll(),
            'finish'    =>  count($finish),
            'muasah'    =>  $muasah->where("status", 1)->findAll(),
            'provider'  =>  $provider->orderby('nama_provider', 'ASC')->findAll(),
            'asuransi'  =>  $asuransi->orderby('nama', "asc")->findAll(),
        ];

        return view("jamaah/pendaftaran/insert", $data);
    }

    public function edit_jamaah($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $jamaah = new JamaahModel();
        $jamaah->update($id, [
            'title' =>  $this->request->getVar("title"),
            'nama_paspor' =>  $this->request->getVar("nama_paspor"),
            'ayah'  => $this->request->getVar("ayah"),
            'jenis_identitas' =>  $this->request->getVar("jenis_identitas"),
            'tempat_lahir' =>  $this->request->getVar("tempat_lahir"),
            'tgl_lahir' =>  $this->request->getVar("tgl_lahir"),
            'alamat' =>  $this->request->getVar("alamat"),
            'no_telp' =>  $this->request->getVar("no_telpon"),
            'kewargannegaraan' =>  $this->request->getVar("warganegara"),
            'status_pernikahan' =>  $this->request->getVar("nikah"),
            'jenis_pendidikan' =>  $this->request->getVar("jenis_pendidikan"),
            'jenis_pekerjaan' =>  $this->request->getVar("jenis_pekerjaan"),
            'provider' =>  $this->request->getVar("provider"),
            'asuransi' =>  $this->request->getVar("asuransi"),
            'no_paspor' =>  $this->request->getVar("no_paspor"),
            'no_identitas' =>  $this->request->getVar("no_identitas"),
        ]);


        return redirect()->to("tambah_pendaftaran/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success", "Data Berhasil Di Update");
    }

    public function hapus_jamaah($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $kloter = new KloterModel();
        $result_kolter = $kloter->where("id", $this->request->getVar("id_kloter"))->first();
        $kloter->update($this->request->getVar("id_kloter"), [
            'batas_jamaah'  =>  $result_kolter['batas_jamaah'] + 1
        ]);
        $jamaah = new JamaahModel();
        $jamaah->delete($id);
        return redirect()->to("tambah_pendaftaran/"  . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success", "Data Berhasil Di hapus");
    }


    public function pindah_paket($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        if (!$this->validate([
            'paket' => [
                "rules" =>  "required"
            ],
            'kloter'    =>  [
                'rules' =>  'required'
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $id_kloter = $this->request->getVar('id_kloter');
        $id_jamaah = $this->request->getVar('id_jamaah');
        $jamaah = new JamaahModel();
        $first_jamaah = $jamaah->where("id", $id_jamaah)->first();
        $check_count = $jamaah->where('user_id', $first_jamaah['user_id'])->where('paket_id',$this->request->getVar('paket'))->where('kloter_id',$id_kloter)->countAllResults();
        $kloter = new KloterModel();
        // var_dump($this->request->getVar('paket'));
        // var_dump($first_jamaah['user_id']);
        // var_dump($id_kloter);
        // var_dump($check_count);
        // die;
        if($check_count) {
            return redirect()->back()->with('error','Jamaah Sudah Ada');
        }
        $data_akhir_kloter = $kloter->where("id", $id_kloter)->first();
        $check_kloters = $kloter->where("id", $this->request->getVar("kloter"))->first();
        if ($check_kloters['batas_jamaah'] <= 0) {
            return redirect()->back()->with('error', 'Batas kuota jamaah sudah habis');
        }

        // $check_jamaah = $jamaah->where("user_id",)

        // kloter baru
        $kloter->update($this->request->getVar("kloter"), [
            'batas_jamaah'  =>  $check_kloters['batas_jamaah'] - 1
        ]);
        // dd(+$rv);

        $jamaah->update($id_jamaah, [
            'paket_id'  =>  $this->request->getVar("paket"),
            'kloter_id' =>  $this->request->getVar("kloter")
        ]);

        // kloter lama
        $first_kloter = $kloter->where("id", $id_kloter)->first();
        $kloter->update($id_kloter, [
            'batas_jamaah'  =>  $first_kloter['batas_jamaah'] + 1
        ]);

        if (session()->get("level_id") == "user") {
            return redirect()->back()->with("success", "Data Berhasil Di Update");
        } else {
            return redirect()->to("/tambah_pendaftaran/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success", "Paket Anda Berhasil Dipindahkan");
        }
    }

    public function pindah_paket_user($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        if (!$this->validate([
            'paket' => [
                "rules" =>  "required"
            ],
            'kloter'    =>  [
                'rules' =>  'required'
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $id_kloter = $this->request->getVar('id_kloter');
        $id_jamaah = $id;

        $jamaah = new JamaahModel();
        $first_jamaah = $jamaah->where("id", $id_jamaah)->first();
        $kloter = new KloterModel();
        $data_akhir_kloter = $kloter->where("id", $id_kloter)->first();
        // dd($first_jamaah['kloter_id']);
        $check_kloters = $kloter->where("id", $this->request->getVar("kloter"))->first();
        if ($check_kloters['batas_jamaah'] <= 0) {
            return redirect()->back()->with('error', 'Batas kuota jamaah sudah habis');
        }

        // kloter baru
        $kloter->update($this->request->getVar("kloter"), [
            'batas_jamaah'  =>  $check_kloters['batas_jamaah'] - 1
        ]);

        $jamaah->update($id_jamaah, [
            'paket_id'  =>  $this->request->getVar("paket"),
            'kloter_id' =>  $this->request->getVar("kloter")
        ]);

        // kloter lama
        $first_kloter = $kloter->where("id", $id_kloter)->first();
        $kloter->update($id_kloter, [
            'batas_jamaah'  =>  $first_kloter['batas_jamaah'] + 1
        ]);

        if (session()->get("level_id") == "user") {
            return redirect()->to('paket_user')->with("success", "Data Berhasil Di Update");
        } else {
            return redirect()->to("/tambah_pendaftaran/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success", "Paket Anda Berhasil Dipindahkan");
        }
    }

    public function bayar($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }

        $jamah = new JamaahModel();
        $fird = $jamah->where("id", $id)->first();

        if ($this->request->getVar("status") == "cicil" || $this->request->getVar("status") == "lunas") {

            if (!$this->validate([
                'file' => [
                    "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
                ],
                'status'    =>  [
                    'rules' =>  'required'
                ],
                'keterangan'    =>  [
                    'rules' =>  'required'
                ],
                'nominal'   =>  [
                    'rules' =>  'required'
                ]
            ])) {

                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }

            $dataBerkas = $this->request->getFile('file');
            if ($dataBerkas->getError() === 4) {
                // $foto = $this->request->getVar("file_lama");
                session()->setFlashdata('error', "File Harus di isi");
                return redirect()->back()->withInput();
            } else {
                $fileName = $dataBerkas->getRandomName();
                $foto = $fileName;
                $dataBerkas->move('assets/upload/', $fileName);
            }
            $nominal = $this->request->getVar("nominal");
            $biaya = str_replace(".", "", $nominal);
            $paket = new PaketModel();
            $data_paket = $paket->where("id", $this->request->getVar("id_paket"))->first();
            $sisa = $data_paket['biaya'] - $biaya;

            $result = new JamaahModel();
            $paket = new PaketModel();
            $detail_jamaah = $result->where("id", $id)->first();
            $nominal = $this->request->getVar("nominal");
            $biaya = str_replace(".", "", $nominal);
            $data_paket = $paket->where("id", $this->request->getVar("id_paket"))->first();
            if ($biaya >= $data_paket['biaya'] && $this->request->getVar("status") == "cicil") {
                session()->setFlashdata('error', "Nominal Pembayaran Melebihi Atau Sama Dengan Biaya Paket Untuk Cicilan");
                return redirect()->back()->withInput();
            } elseif ($this->request->getVar("status") == "lunas" &&  $biaya < $data_paket['biaya']) {
                session()->setFlashdata('error', "Nominal Pembayaran Kurang Biaya Paket Untuk Melunasinya");
                return redirect()->back()->withInput();
            } elseif ($biaya > $data_paket['biaya']) {
                session()->setFlashdata('error', "Nominal Pembayaran Melebihi Biaya Paket");
                return redirect()->back()->withInput();
            }
            if (empty($detail_jamaah['bukti_pembayaran'])) {
                $result->update($id, [
                    'tgl_bayar' =>  date("Y-m-d"),
                    'rekening_penampung' =>  $this->request->getVar("rekening"),
                    'status_bayar' =>  $this->request->getVar("status"),
                    'keterangan_bayar' =>  $this->request->getVar("keterangan"),
                    'nominal_pembayaran'     => $biaya,
                    'bukti_pembayaran'  =>  $foto,
                    'sisa_pembayaran'   =>  $sisa,
                ]);
            }

            $bukti = new BuktiModel();
            if (!empty($detail_jamaah['bukti_pembayaran'])) {
                $bukti->insert([
                    'nominal' =>    $biaya,
                    'sisa'  =>  $sisa,
                    'bukti' =>  $foto,
                    'created'   =>  date("Y-m-d"),
                    'jamaah_id' =>  $id,
                    'rekening_penampung'    =>  $this->request->getVar('rekening'),
                    'keterangan'    =>  $this->request->getvar('keterangan'),
                    'paket_id'  =>  $fird['paket_id'],
                    'kloter_id' =>  $fird['kloter_id']
                ]);
            }
        } else {
            $nominal = null;
            $foto = null;
            $sisa = null;
            $expired = null;
        }

        if ($this->request->getVar("status")  == "DP") {
            $expired = date("Y-m-d", strtotime($this->request->getVar("expired")));
            $sekarang = date("Y-m-d");
            if ($expired <= $sekarang) {
                session()->setFlashdata('error', "Waktu Expired Tidak Boleh Kurang Atau Sama Dengan Waktu Sekarang");
                return redirect()->back()->withInput();
            }
            if (!empty($fird['status_bayar'])) {

                if (!$this->validate([
                    'file' => [
                        "rules" =>  "max_size[file,3024]|mime_in[file,image/jpg,image/jpeg,image/png]"
                    ],
                    'status'    =>  [
                        'rules' =>  'required'
                    ],
                    'keterangan'    =>  [
                        'rules' =>  'required'
                    ],
                    'nominal'   =>  [
                        'rules' =>  'required'
                    ],
                    'expired'    =>  [
                        'rules' =>  'required'
                    ],
                ])) {

                    session()->setFlashdata('error', $this->validator->listErrors());
                    return redirect()->back()->withInput();
                }

                $dataBerkas = $this->request->getFile('file');
                if ($dataBerkas->getError() === 4) {
                    // $foto = $this->request->getVar("file_lama");
                    session()->setFlashdata('error', "File Harus di isi");
                    return redirect()->back()->withInput();
                } else {
                    $fileName = $dataBerkas->getRandomName();
                    $foto = $fileName;
                    $dataBerkas->move('assets/upload/', $fileName);
                }
                $nominal = $this->request->getVar("nominal");
                $biaya = str_replace(".", "", $nominal);
                $paket = new PaketModel();
                $data_paket = $paket->where("id", $this->request->getVar("id_paket"))->first();
                $sisa = $data_paket['biaya'] - $biaya;
            } else {
                if (!$this->validate([
                    'expired'    =>  [
                        'rules' =>  'required'
                    ],
                ])) {
                    session()->setFlashdata('error', $this->validator->listErrors());
                    return redirect()->back()->withInput();
                }
            }

            $result = new JamaahModel();
            $paket = new PaketModel();
            $nominal = $this->request->getVar("nominal");
            $biaya = str_replace(".", "", $nominal);
            $data_paket = $paket->where("id", $this->request->getVar("id_paket"))->first();
            if ($biaya >= $data_paket['biaya'] && $this->request->getVar("status") == "cicil") {
                session()->setFlashdata('error', "Nominal Pembayaran Melebihi Atau Sama Dengan Biaya Paket Untuk Cicilan");
                return redirect()->back()->withInput();
            } elseif ($this->request->getVar("status") == "lunas" &&  $biaya < $data_paket['biaya']) {
                session()->setFlashdata('error', "Nominal Pembayaran Kurang Biaya Paket Untuk Melunasinya");
                return redirect()->back()->withInput();
            } elseif ($biaya > $data_paket['biaya']) {
                session()->setFlashdata('error', "Nominal Pembayaran Melebihi Biaya Paket");
                return redirect()->back()->withInput();
            }

            $detail_jamaah = $result->where("id", $id)->first();

            if (empty($detail_jamaah['expired_bayar_dp'])) {
                $result->update($id, [
                    'tgl_bayar' =>  date("Y-m-d"),
                    'rekening_penampung' =>  $this->request->getVar("rekening"),
                    'status_bayar' =>  $this->request->getVar("status"),
                    'keterangan_bayar' =>  $this->request->getVar("keterangan"),
                    'expired_bayar_dp'  =>  $expired,
                ]);
            } else {
                if (empty($detail_jamaah['bukti_pembayaran'])) {
                    $result->update($id, [
                        'tgl_bayar' =>  date("Y-m-d"),
                        'rekening_penampung' =>  $this->request->getVar("rekening"),
                        'status_bayar' =>  $this->request->getVar("status"),
                        'keterangan_bayar' =>  $this->request->getVar("keterangan"),
                        'nominal_pembayaran'     => $biaya,
                        'bukti_pembayaran'  =>  $foto,
                        'sisa_pembayaran'   =>  $sisa,
                    ]);
                }
            }


            $bukti = new BuktiModel();
            if (!empty($detail_jamaah['bukti_pembayaran'])) {
                $bukti->insert([
                    'nominal' =>    $biaya,
                    'sisa'  =>  $sisa,
                    'bukti' =>  $foto,
                    'created'   =>  date("Y-m-d"),
                    'jamaah_id' =>  $id,
                    'rekening_penampung'    =>  $this->request->getVar('rekening'),
                    'keterangan'    =>  $this->request->getvar('keterangan'),
                    'paket_id'  =>  $fird['paket_id'],
                    'kloter_id' =>  $fird['kloter_id']
                ]);
            }
        } else {
            $expired = null;
            $nominal = null;
            $foto = null;
            $sisa = null;
        }


        return redirect()->back()->with("success", "Data Berhasil Diupdate");
    }

    public function asuransi($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $jamaah = new JamaahModel();
        $jamaah->update($id, [
            'asuransi'  =>  $this->request->getVar("asuransi"),
            'nomor_polis'  =>  $this->request->getVar("nomor"),
            'tgl_input'  =>  $this->request->getVar("tgl_input"),
            'tgl_awal'  =>  $this->request->getVar("awal"),
            'tgl_akhir'  =>  $this->request->getVar("akhir"),
        ]);

        return redirect()->back()->with("success", "Data Berhasil Diupdate");
        // return redirect()->to("tambah_pendaftaran/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Diupdate");
    }

    public function visa($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $jamaah = new JamaahModel();
        $jamaah->update($id, [
            'provider'  =>  $this->request->getVar("provider"),
            'nomor_visa'  =>  $this->request->getVar("nomor"),
            'tgl_awal_visa'  =>  $this->request->getVar("awal"),
            'tgl_akhir_visa'  =>  $this->request->getVar("akhir"),
            'muassasah' =>  $this->request->getVar("muassasah")
        ]);
        // return redirect()->to("tambah_pendaftaran/" . $this->request->getVar("id_kloter") . '/' . $this->request->getVar("id_paket"))->with("success","Data Berhasil Diupdate");
        return redirect()->back()->with("success", "Data Berhasil Diupdate");
    }

    public function download_template()
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        // $mobil = new SiswaModel();
        // $dataMobil = $mobil->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'title')
            ->setCellValue('B1', 'nama')
            ->setCellValue('C1', 'nama_paspor')
            ->setCellValue('D1', 'ayah')
            ->setCellValue('E1', 'jenis_identitas')
            ->setCellValue('F1', 'tempat_lahir')
            ->setCellValue('G1', 'tgl_lahir')
            ->setCellValue('H1', 'foto')
            ->setCellValue('I1', 'alamat')
            ->setCellValue('J1', 'provinsi')
            ->setCellValue('K1', 'kabupaten')
            ->setCellValue('L1', 'kecamatan')
            ->setCellValue('M1', 'kelurahan')
            ->setCellValue('N1', 'no_telp')
            ->setCellValue('O1', 'no_hp')
            ->setCellValue('P1', 'kewargannegaraan')
            ->setCellValue('Q1', 'status_pernikahan')
            ->setCellValue('R1', 'jenis_pendidikan')
            ->setCellValue('S1', 'jenis_pekerjaan')
            ->setCellValue('T1', 'provider')
            ->setCellValue('U1', 'asuransi')
            ->setCellValue('V1', 'no_paspor')
            ->setCellValue('W1', 'no_identitas')
            ->setCellValue('X1', 'no_pasti_umrah')
            ->setCellValue('Y1', 'paket_id');


        $writer = new Xlsx($spreadsheet);
        $fileName = 'Template Data Jamaah';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function download_jamaah($id, $id_kloter)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $jamaah = new JamaahModel();
        $result = $jamaah->where([
            'paket_id'  =>  $id,
            'kloter_id' =>  $id_kloter
        ])->findAll();
        $data = [
            'jamaah'    =>  $result,
            'id'    =>  $id
        ];
        return view("jamaah/pendaftaran/template", $data);
    }

    public function mangkat()
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $db      = \Config\Database::connect();
        $id = $this->request->getVar("id_paket");
        $paket = new PaketModel();


        $kloter = new KloterModel();
        $kloter->update($this->request->getVar("id_kloter"), [
            'keberangkatan' =>  'sudah'
        ]);

        $check = $db->query("SELECT * FROM kloter WHERE paket_id = '$id' AND keberangkatan = 'sudah'")->getNumRows();
        $check_dua = $db->query("SELECT * FROM kloter WHERE paket_id = '$id'")->getNumRows();
        if ($check == $check_dua) {
            $paket->update($id, [
                "pemberangkatan"    =>  "sudah",
            ]);
        }
        $jamaah = new JamaahModel();
        // foreach($jamaah->findAll() as $row) {
        //     $satu = random_int(11111,99999);
        //     $dua = random_int(11111,99999);
        //     $ids = $row['id'];
        // $db->query("UPDATE jamaah SET
        // tiket_cgk_med = '$satu',
        // tiket_med_gk = '$dua' 
        // WHERE paket_id = '$id' AND id = '$ids'");
        // }


        return redirect()->to("tambah_pendaftaran/" . $this->request->getVar('id_kloter') . '/' . $id)->with("success", "Data Berhasil Diupdate");
    }

    public function download_pdf($id, $id_kloter)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $jamaah = new JamaahModel();
        $paket = new PaketModel();
        $profile = new ProfileModel();
        $bank = new BankModel();
        $red = $paket->where("id", $id)->first();
        $mandiri = $bank->where("id", $red['rekening_penampung_id'])->first();
        $data = [
            'jamaah'    =>  $jamaah->where("paket_id", $id)->where("kloter_id", $id_kloter)->findAll(),
            'title' =>  "Print PDF",
            'mandiri'   =>  $mandiri,
            'paket' =>  $paket->where("id", $id)->first(),
            'profile'   =>  $profile->where("id", session()->get("travel_id"))->first(),
        ];

        return view("jamaah/pendaftaran/print", $data);
    }

    public function print_kartu($id)
    {
        if (!session()->get("login") || session()->get("login") == null) {
            return redirect()->to("/");
            exit;
        }
        $jamaah = new JamaahModel();
        $paket = new PaketModel();
        $data = [
            'jamaah'    =>  $jamaah->where("paket_id", $id)->findAll(),
            'title' =>  "Print PDF",
            'paket' =>  $paket->where("id", $id)->first(),
        ];

        return view("jamaah/pendaftaran/kartu", $data);
    }
}
