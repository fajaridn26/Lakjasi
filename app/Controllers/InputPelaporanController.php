<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AkunModel;
use App\Models\PelaporanModel;
use App\Models\StatusPelaporanModel;

class InputPelaporanController extends BaseController
{
    protected $akun;
    protected $status;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->akun = new AkunModel();
        $this->status = new StatusPelaporanModel();
    }

    public function index()
    {
        if (session()->get('role') == 1 || session()->get('role') == 2) {
            return view('input-pelaporan-kerusakan', ['errors' => []]);
        } else {
            return redirect()->to(base_url('PagesController/login'));
        }
    }

    public function save()
    {
        if (session()->get('role') == 2 || session()->get('role') == 1) {
            $validationRule = [
                'foto' => [
                    'rules' => 'uploaded[foto]'
                        . '|is_image[foto]'
                        . '|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[foto,10000]'
                ],
            ];
            if (!$this->validate($validationRule)) {
                session()->setFlashdata('eror', 'File Tidak Sesuai!, Harus Foto!');
                return redirect()->to(base_url('PagesController/input_pelaporan'));
            }
            $ceklat = $this->request->getVar('lat');
            $ceklong = $this->request->getVar('long');
            $keterangan = $this->request->getVar('keterangan');
            $tanggal = $this->request->getVar('tanggal');
            $foto = $this->request->getFile('foto');
            $lokasiFoto = $this->request->getPost('lokasifoto');
            if (isset($ceklat) && isset($ceklong)) {
                try {
                    $name = $foto->getRandomName();
                    $foto->move("assets/imagePelaporan", $name);
                    $pelaporans = new PelaporanModel();
                    $data = [
                        'id_akun'  => session()->get('id'),
                        'lat'      => $ceklat,
                        'long'     => $ceklong,
                        'tanggal_pelaporan' => $tanggal,
                        'foto'     => $name,
                        'keterangan' => $keterangan,
                        'lokasifoto' => $lokasiFoto,
                        'status_pelaporan' => 'Laporan Telah Dikirim'
                    ];
                    $pelaporans->insert($data);
                    $get_id = $pelaporans->getInsertID();
                    $this->status->insert([
                        'id_pelaporan'     => $get_id,
                        'status_pelaporan' => 'Laporan Telah Dikirim'
                    ]);
                    session()->setFlashdata('sukses', 'Berhasil Melaporkan, Terima kasih ! ');
                    return redirect()->to(base_url('PagesController/input_pelaporan'));
                } catch (\Throwable $th) {
                    session()->setFlashdata('fail', 'Gagal Melaporkan! ' . $get_id);
                    return redirect()->to(base_url('PagesController/input_pelaporan'));
                }
            } else {
                session()->setFlashdata('require', 'Lokasi Belum Terisi !');
                return redirect()->to(base_url('PagesController/input_pelaporan'));
            }
        } else {
            session()->setFlashdata('anonymous', 'Maaf Anda Tidak Memiliki Akses!');
            return redirect()->to(base_url());
        }
    }
}
