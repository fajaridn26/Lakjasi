<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('role') == 1 || session()->get('role') == 2) {
            return redirect()->to(base_url('PagesController/dashboard'));
        }
        return view('pages-login');
    }
}
