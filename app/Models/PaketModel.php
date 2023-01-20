<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'paket';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["id","nama","biaya","status","tahun","tgl_berangkat","tgl_pulang","provider","asuransi","ket_berangkat","ket_pulang","kode_paket","user_id","pemberangkatan","tiket_cgk_med","tiket_cgk_med","travel_id",'poster','kelengkapan','tiket','tour_leader','cabang_id','status_paket_cabang','cabang','status_approve'];

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

    public function cari($data)
    {
        $builder = $this->table('paket');
        $builder->select('*');
        $builder->join('profile', 'paket.travel_id = profile.id');
        $builder->where('paket.kelengkapan','sudah');
        $builder->where('paket.pemberangkatan',NULL);
        $builder->where('paket.status',"aktif");
        $builder->like('paket.nama',$data);
        $builder->orLike('profile.nama_perusahaan',$data);
        $builder->orLike('profile.nama_travel_umrah',$data);
        $builder->orLike('profile.provinsi',$data);
        $builder->orLike('profile.kabupaten',$data);
        $builder->orLike('profile.kecamatan',$data);
        $builder->orderBy("paket.id","DESC");
        // $builder->paginate(10,'paket');
        return $builder->findAll();
    }

    public function num($data)
    {
        $builder = $this->table('paket');
        $builder->select('*');
        // $builder->join('profile', 'paket.travel_id = profile.id');
        $builder->where('paket.kelengkapan','sudah');
        $builder->where('paket.pemberangkatan',NULL);
        $builder->where('paket.status',"aktif");
        $builder->like('paket.nama',$data);
        $builder->orLike('profile.nama_perusahaan',$data);
        $builder->orLike('profile.nama_travel_umrah',$data);
        $builder->orLike('profile.provinsi',$data);
        $builder->orLike('profile.kabupaten',$data);
        $builder->orLike('profile.kecamatan',$data);
        $builder->orderBy("paket.id","DESC");
        // $builder->paginate(10,'paket');
        return $builder->countAll();
    }

    public function main()
    {
        $builder = $this->table('paket');
        $builder->select('*');
        // $builder->join('profile', 'paket.travel_id = profile.id');
        $builder->where('paket.kelengkapan','sudah');
        $builder->where('paket.pemberangkatan',NULL);
        $builder->where('paket.status',"aktif");
        $builder->orderBy("paket.id","DESC");
        // $builder->paginate(1);
        return $builder->findAll();
    }
}
