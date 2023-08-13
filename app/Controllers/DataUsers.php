<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DataUsers extends BaseController
{
    public function index()
    {
        if (session()->get('role') == 1) {
            $db = \Config\Database::connect();
            $builder = $db->table('akun');
            $query = $builder->get()->getResult();
            $data['akun'] = $query;
            return view ('data-users', $data);
        }else{
            return redirect()->to(base_url('PagesController/login'));
        }
    }
}
