<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class RiwayatPelaporan extends BaseController
{
    public function index()
    {
        if (session()->get('role') == 1 || session()->get('role') == 2) {
            $db = \Config\Database::connect();
            $builder = $db->table('pelaporan');
            $query = $builder->get()->getResult();
            $data['pelaporan'] = $query;
            return view ('riwayat-pelaporan', $data);
        }else{
            return redirect()->to(base_url('PagesController/login'));
        }
    }
}
