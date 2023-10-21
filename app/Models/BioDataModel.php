<?php

namespace App\Models;

use CodeIgniter\Model;

class BioDataModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'biodata';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id",
        "title",
        'nama_paspor',
        'ayah',
        'jenis_identitas',
        'tempat_lahir',
        'tgl_lahir',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'no_telp',
        'kewargannegaraan',
        'status_pernikahan',
        'jenis_pendidikan',
        'jenis_pekerjaan',
        'provider',
        'asuransi',
        'created_at',
        'updated_at',
        'no_paspor',
        'no_identitas',
        'nomor_polis',
        'tgl_input',
        'tgl_awal',
        'tgl_akhir',
        'nomor_visa',
        'tgl_awal_visa',
        'tgl_akhir_visa',
        'muassasah',
        'status_vaksin',
        'tgl_vaksin',
        'jenis_vaksin',
        'user_id',
        'file_paspor',
        'file_ktp',
        'file_kk',
        'file_sertifikat_vaksin',
        'file_visa',
        'file_asuransi',
        'file_provider',
        'tgl_terbit_passport',
        'kota_passport',
        'nomor_bpjs'
    ];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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
}
