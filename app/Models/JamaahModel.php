<?php

namespace App\Models;

use CodeIgniter\Model;

class JamaahModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jamaah';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id",
        "title",
        'nama',
        'nama_paspor',
        'ayah',
        'jenis_identitas',
        'tempat_lahir',
        'tgl_lahir',
        'foto',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'no_telp',
        'no_hp',
        'kewargannegaraan',
        'status_pernikahan',
        'jenis_pendidikan',
        'jenis_pekerjaan',
        'provider',
        'asuransi',
        'paket_id',
        'created_at',
        'updated_at',
        'no_paspor',
        'no_identitas',
        'no_pasti_umrah',
        'tgl_bayar',
        'rekening_penampung',
        'status_bayar',
        'keterangan_bayar',
        'nomor_polis',
        'tgl_input',
        'tgl_awal',
        'tgl_akhir',
        'nomor_visa',
        'tgl_awal_visa',
        'tgl_akhir_visa',
        'muassasah',
        'no_registrasi',
        'tiket_cgk_med',
        'tiket_med_gk',
        'tgl_keluar_paspor',
        'tgl_habis_paspor',
        'kota_paspor',
        'no_tiket',
        'nominal_pembayaran',
        'bukti_pembayaran',
        'sisa_pembayaran',
        'kloter_id',
        'selesai_pembayaran',
        'status_vaksin',
        'tgl_vaksin',
        'jenis_vaksin',
        'status_approve_bayar',
        'status_approve',
        'user_id',
        'expired_bayar_dp',
        'no_kursi',
        'tgl_lunas'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function result($id_travel)
    {
        $builder = $this->table('jamaah');
        $builder->select("
        jamaah.nama as nama_jamaah,
        jamaah.paket_id,
        jamaah.status_bayar,
        jamaah.selesai_pembayaran,
        jamaah.no_identitas,
        jamaah.no_telp,
        jamaah.no_hp,
        jamaah.no_pasti_umrah,
        jamaah.provider,
        jamaah.asuransi,
        jamaah.id as id_jamaah,
        jamaah.nomor_polis,
        jamaah.nomor_visa,
        jamaah.no_paspor,
        jamaah.status_approve_bayar,
        jamaah.rekening_penampung,
        jamaah.nominal_pembayaran,
        jamaah.bukti_pembayaran,
        jamaah.keterangan_bayar,
        jamaah.kloter_id,
        

        paket.id as id_paket,
        paket.travel_id,
        profile.id as id_profile,


        ");
        $builder->join("paket","jamaah.paket_id = paket.id");
        $builder->join("profile","paket.travel_id = profile.id");
        $builder->where("paket.travel_id",$id_travel);
        $builder->where("jamaah.selesai_pembayaran",NULL);
        $builder->orWhere("jamaah.status_bayar","cicil");
        $builder->orWhere("jamaah.status_bayar","lunas");
        return $builder->findAll();

    }
    public function result_dua($id_travel,$id_paket,$id_kloter)
    {
        $builder = $this->table('jamaah');
        $builder->select("
        jamaah.nama as nama_jamaah,
        jamaah.paket_id,
        jamaah.status_bayar,
        jamaah.selesai_pembayaran,
        jamaah.no_identitas,
        jamaah.no_telp,
        jamaah.no_hp,
        jamaah.no_pasti_umrah,
        jamaah.provider,
        jamaah.asuransi,
        jamaah.id as id_jamaah,
        jamaah.nomor_polis,
        jamaah.nomor_visa,
        jamaah.no_paspor,
        jamaah.status_approve_bayar,
        jamaah.rekening_penampung,
        jamaah.nominal_pembayaran,
        jamaah.bukti_pembayaran,
        jamaah.keterangan_bayar,
        jamaah.kloter_id,
        

        paket.id as id_paket,
        paket.travel_id,
        profile.id as id_profile,


        ");
        $builder->join("paket","jamaah.paket_id = paket.id");
        $builder->join("profile","paket.travel_id = profile.id");
        $builder->where("paket.travel_id",$id_travel);
        $builder->where("paket.id",$id_paket);
        $builder->where("jamaah.kloter_id",$id_kloter);
        $builder->where("jamaah.selesai_pembayaran",NULL);
        $builder->orWhere("jamaah.status_bayar","cicil");
        $builder->orWhere("jamaah.status_bayar","lunas");
        $builder->orderby("jamaah.id","desc");
        return $builder->findAll();

    }
}
