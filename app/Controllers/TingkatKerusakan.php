<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelaporanModel;

class TingkatKerusakan extends BaseController
{
    protected $pelaporan;
    public function __construct()
    {
        $this->pelaporan = new PelaporanModel();
    }
    public function index()
    {
        $id = $this->request->getPost('id');
        $data = $this->pelaporan->where('id_laporan', $id)->findAll();
        return json_encode($data);
    }

    public function UpdateTidakRusak($id = null)
    {
        if ($this->pelaporan->where('id_laporan', $id)->set(['tingkat_rusak' => "Tidak Rusak"])->update()) {
            session()->setFlashdata('Formsukses', 'Berhasil Update Kerusakan!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        } else {
            session()->setFlashdata('Formgagal', 'Gagal Update Kerusakan !!!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        }
    }

    public function UpdateRusakRingan($id = null)
    {
        if ($this->pelaporan->where('id_laporan', $id)->set(['tingkat_rusak' => "Rusak Ringan"])->update()) {
            session()->setFlashdata('Formsukses', 'Berhasil Update Kerusakan!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        } else {
            session()->setFlashdata('Formgagal', 'Gagal Update Kerusakan !!!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        }
    }

    public function UpdateRusakSedang($id = null)
    {
        if ($this->pelaporan->where('id_laporan', $id)->set(['tingkat_rusak' => "Rusak Sedang"])->update()) {
            session()->setFlashdata('Formsukses', 'Berhasil Update Kerusakan!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        } else {
            session()->setFlashdata('Formgagal', 'Gagal Update Kerusakan !!!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        }
    }

    public function UpdateRusakBerat($id = null)
    {
        if ($this->pelaporan->where('id_laporan', $id)->set(['tingkat_rusak' => "Rusak Berat"])->update()) {
            session()->setFlashdata('Formsukses', 'Berhasil Update Kerusakan!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        } else {
            session()->setFlashdata('Formgagal', 'Gagal Update Kerusakan !!!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        }
    }
}
