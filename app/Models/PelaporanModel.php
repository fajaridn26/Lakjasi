<?php

namespace App\Models;

use CodeIgniter\Model;

class PelaporanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pelaporan';
    protected $primaryKey       = 'id_laporan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_pelaporan', 'id_akun', 'lat', 'long', 'lokasifoto', 'tanggal_pelaporan', 'foto', 'tingkat_rusak', 'keterangan', 'status_pelaporan'];

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

    public function getAllPelaporan()
    {
        $query = $this->db->query('SELECT * FROM pelaporan');
        $total = $query->getNumRows() . ' Pelaporan';
        return $total;
    }

    public function getDatas()
    {
        $query = $this->db->query("SELECT * FROM pelaporan JOIN akun ON pelaporan.id_akun = akun.id");
        return $query->getResultArray();
    }
}
