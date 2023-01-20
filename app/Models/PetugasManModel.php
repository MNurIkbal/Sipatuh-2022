<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasManModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'petugas_umrah';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "nama",
        'no_ktp',
        'no_paspor',
        'tipe_petugas',
        'no_hp_satu',
        'no_hp_dua',
        'tgl_lahir',
        'email',
        'alamat',
        'aktif',
        'created_at',
        'update_at',
        'user_id',
        'travel_id',
        'foto'
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
