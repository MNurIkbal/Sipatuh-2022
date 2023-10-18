<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'profile';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_perusahaan',
        'nama_travel_umrah',
        'npwp',
        'no_sk',
        'tgl_sk',
        'tgl_berakhir_sk',
        'no_telp',
        'no_hp',
        'email',
        'website',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'alamat',
        'alamat_mekkah',
        'no_telp_mekkah',
        'alamat_madinah',
        'no_telp_madinah',
        'foto_kantor',
        'user_id',
        'created_at',
        'updated_at',
        'logo_travel',
        'banner',
        'aktif_status',
        'deskrip',
        'img_about_1',
        'img_about_2',
        'img_about_3',
        'longtitude',
        'latitude'
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
