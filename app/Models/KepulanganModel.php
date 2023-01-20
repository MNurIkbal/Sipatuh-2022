<?php

namespace App\Models;

use CodeIgniter\Model;

class KepulanganModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kepulangan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id",
        'maskapai',
        "nomor",
        "bandara_berangkat",
        "tgl_berangkat",
        "jam_berangkat",
        "bandara_tiba",
        "tgl_penerbangan_tiba",
        "jam_tiba",
        "paket_id",
        "created_at",
        'kategori',
        'kloter_id'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
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
}
