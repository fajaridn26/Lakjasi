<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AkunModel;
use App\Models\PelaporanModel;
use App\Models\StatusPelaporanModel;
use TCPDF;

class PagesController extends BaseController
{
    protected $akun;
    protected $pelaporan;
    protected $status;
    public function __construct()
    {
        $this->akun = new AkunModel();
        $this->pelaporan = new PelaporanModel();
        $this->status = new StatusPelaporanModel();
    }

    public function register()
    {
        if (session()->get('role') == 1 || session()->get('role') == 2) {
            return redirect()->to(base_url('PagesController/dashboard'));
        }
        $data = [
            'title' => "Lakjasi || Register",
            'validation' => \Config\Services::validation()
        ];
        echo view('pages-register', $data);
    }

    public function login()
    {
        if (session()->get('role') == 1 || session()->get('role') == 2) {
            return redirect()->to(base_url('PagesController/dashboard'));
        }
        $data = [
            'title' => "Lakjasi || Login"
        ];
        echo view('pages-login', $data);
    }

    public function dashboard()
    {
        if (session()->get('role') == 1 || session()->get('role') == 2) {
            $data = [
                'title' => "Dashboard - Lakjasi",
                'nama'  => session()->get('nama'),
                'totalakun' => $this->akun->getAllAkun(),
                'totalpelaporan' => $this->pelaporan->getAllPelaporan(),
                'lokasi' => $this->pelaporan->notLike('status_pelaporan', 'Laporan Telah Dikirim')->findAll()
            ];
            return view('dashboard', $data);
        } else {
            return redirect()->to(base_url('PagesController/login'));
        }
    }

    public function input_pelaporan()
    {
        if (session()->get('role') == 1 || session()->get('role') == 2) {
            $data = [
                'title' => "Input Pelaporan - Lakjasi",
                'nama'  => session()->get('nama')
            ];
            return view('input-pelaporan-kerusakan', $data);
        } else {
            return redirect()->to(base_url('PagesController/login'));
        }
    }

    public function riwayat_pelaporan()
    {
        if (session()->get('role') == 1) {
            $data = [
                'title' => "Riwayat Pelaporan - Lakjasi",
                'nama' => session()->get('nama'),
                'pelaporan' => $this->pelaporan->where('id_akun', session()->get('id'))->findAll()
            ];
            return view('riwayat-pelaporan', $data);
        } elseif (session()->get('role') == 2) {
            $data = [
                'title' => "Riwayat Pelaporan - Lakjasi",
                'nama' => session()->get('nama'),
                'pelaporan' => $this->pelaporan->where('id_akun', session()->get('id'))->findAll(),
                // 'status' => $this->status->where('id_akun',session()->get('id'))->findAll()
            ];
            return view('riwayat-pelaporan', $data);
        }
        return redirect()->to(base_url('PagesController/login'));
    }

    public function data_pelaporan()
    {
        if (session()->get('role') == 1) {
            $data = [
                'title' => "Data Pelaporan - Lakjasi",
                'nama'  => session()->get('nama'),
                'pelaporan' => $this->pelaporan->getDatas()
            ];
            return view('data-pelaporan-kerusakan', $data);
        } else {
            return redirect()->to(base_url('PagesController/login'));
        }
    }

    public function users_profile()
    {
        if (session()->get('role') == 1 || session()->get('role') == 2) {
            $data = [
                'title' => "Profile - Lakjasi"
            ];
            return view('users-profile', $data);
        } else {
            return redirect()->to(base_url('PagesController/login'));
        }
    }

    public function data_users()
    {
        if (session()->get('role') == 1) {
            $data = [
                'title' => "Data Users - Lakjasi",
                'nama'  => session()->get('nama'),
                'pelaporan' => $this->akun->findAll()
            ];
            return view('data-users', $data);
        } else {
            return redirect()->to(base_url('PagesController/login'));
        }
    }

    public function lupa_password()
    {
        $data = [
            'title' => "Lupa Password - Lakjasi"
        ];
        return view('lupa-password', $data);
    }

    public function password_baru()
    {
        $data = [
            'title' => "Password Baru - Lakjasi"
        ];
        return view('password-baru', $data);
    }

    public function printpdf()
    {
        //Ambil Data Tanggal Cetak
        $tanggalAwal = date_create($this->request->getVar('tanggal_awal') . " 00:00:00");
        $tanggalAkhir = date_create($this->request->getVar('tanggal_akhir') . " 23:59:59");
        $db      = \Config\Database::connect();
        $builder = $db->table('pelaporan');
        $builder->select('nama,lat,long,tanggal_pelaporan,foto,tingkat_rusak,keterangan');
        $builder->join('akun', 'pelaporan.id_akun = akun.id');
        $builder->where('tanggal_pelaporan >=', $tanggalAwal->format("Y-m-d H:i:s"));
        $builder->where('tanggal_pelaporan <=', $tanggalAkhir->format("Y-m-d H:i:s"));
        $query = $builder->get();
        $pelaporan = $query->getResultArray();

        if (session()->get('role') == 1) {

            if ($pelaporan) {
                $data = array(
                    'pelaporan' => $pelaporan,
                    'tanggalawal' => $tanggalAwal,
                    'tanggalakhir' => $tanggalAkhir,
                    'title' => "Cetak Data Pelaporan - Lakjasi"
                );
                $html = view('print-pdf', $data);

                // create new PDF document
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                //Informasi Dokumen
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Fajar Indrawan');
                $pdf->SetTitle('Data Pelaporan');
                $pdf->SetSubject('Data Pelaporan');

                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);

                $pdf->AddPage();

                $pdf->writeHTML($html, true, false, true, false, '');
                $this->response->setContentType('application/pdf');
                $pdf->Output('cetak-data-laporan.pdf', 'D');
            } else {
                echo "Kosong";
            }
        }
    }

    public function blank()
    {
        $data = [
            'title' => "Blank - Lakjasi",
            'nama'  => session()->get('nama')
        ];
        return view('pages-blank', $data);
    }
}
