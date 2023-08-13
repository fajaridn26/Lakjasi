<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelaporanModel;
use App\Models\StatusPelaporanModel;

class StatusPelaporan extends BaseController {
    protected $status;
    protected $pelaporan;
    public function __construct()
    {
        $this->status = new StatusPelaporanModel();
        $this->pelaporan = new PelaporanModel();
    }

    public function index()
    {
        $id = $this->request->getPost('id');
        $data = $this->status->where('id_pelaporan',$id)->findAll();
        return json_encode($data);
    }

    public function UpdateDiterima($id = null) {
        if ($this->status->insert([ 
            'id_pelaporan'=> $id,
            'status_pelaporan'=> "Laporan Diterima"
        ]) && $this->pelaporan->where('id_laporan',$id)->set(['status_pelaporan' => "Laporan Diterima"])->update()) {
            session()->setFlashdata('Formsukses', 'Berhasil Update Status!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        }else {
            session()->setFlashdata('Formgagal', 'Gagal Update Status !!!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        }
    }

    public function UpdateDitolak($id = null) {
        if ($this->status->insert([ 
                'id_pelaporan'=> $id,
                'status_pelaporan'=> "Laporan Ditolak"
        ])&& $this->pelaporan->where('id_laporan',$id)->set(['status_pelaporan' => "Laporan Ditolak"])->update()) {
            session()->setFlashdata('Formsukses', 'Berhasil Update Status!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        } else {
            session()->setFlashdata('Formgagal', 'Gagal Update Status !!!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        }
    }

    public function UpdateMenunggu($id =null) {
        if ($this->status->insert([
            'id_pelaporan'=> $id,
            'status_pelaporan'=> "Menunggu Proses Perbaikan Jalan"
        ])&& $this->pelaporan->where('id_laporan',$id)->set(['status_pelaporan' => "Menunggu Proses Perbaikan Jalan"])->update()) {
            session()->setFlashdata('Formsukses', 'Berhasil Update Status!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        } else {
            session()->setFlashdata('Formgagal', 'Gagal Update Status !!!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        }
    }

    public function UpdateProses($id= null)
    {
        if ($this->status->insert([
            'id_pelaporan'=> $id,
            'status_pelaporan'=> "Jalan Dalam Proses Perbaikan"
        ])&& $this->pelaporan->where('id_laporan',$id)->set(['status_pelaporan' => "Jalan Dalam Proses Perbaikan"])->update()) {
            session()->setFlashdata('Formsukses', 'Berhasil Update Status!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        } else {
            session()->setFlashdata('Formgagal', 'Gagal Update Status !!!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        }
    }

    public function UpdateSelesai($id = null)
    {
        if ($this->status->insert([
            'id_pelaporan'=> $id,
            'status_pelaporan'=> "Jalan Sudah Selesai Dalam Proses Perbaikan"
        ])&& $this->pelaporan->where('id_laporan',$id)->set(['status_pelaporan' => "Jalan Sudah Selesai Dalam Proses Perbaikan"])->update()) {
            session()->setFlashdata('Formsukses', 'Berhasil Update Status!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        } else {
            session()->setFlashdata('Formgagal', 'Gagal Update Status !!!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        }
    }
}