<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketDashboardTravelModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'paket_dashboard_travel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'travel_id',
        'total',
        'created_at',
        'paket_id'
    ];
    public function getPaketData($travelId)
    {
        $this->where('paket_dashboard_travel.travel_id', $travelId);
        $this->join('paket', 'paket.id = paket_dashboard_travel.paket_id');
        $this->select('paket.*, paket_dashboard_travel.total');

        return $this->findAll();
    }


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
