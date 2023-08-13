<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table            = 'akun';
    protected $allowedFields    = ['id', 'email_pengguna', 'nama', 'password', 'hashlink', 'no_whatsapp', 'tanggal_lahir', 'role', 'status_active'];
    protected $useTimestamps = true;

    public function getAllAkun()
    {
        $query = $this->db->query('SELECT * FROM akun WHERE role = 2');
        $total = $query->getNumRows() . ' Users';
        return $total;
    }
}
