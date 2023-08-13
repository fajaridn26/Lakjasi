<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class StatusPelaporanModel extends Model
{
    protected $table            = 'status_pelaporan';
    protected $insertID         = 0;
    protected $allowedFields    = ['id','id_pelaporan','status_pelaporan', 'created_at', 'update_at'];
    protected $useTimestamps    = true;
}
