<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AkunModel;
use App\Controllers\PagesController;
use App\Models\PelaporanModel;

class AuthenticationController extends BaseController
{
    protected $akunmodel;
    protected $pelaporanmodel;
    protected $page;

    public function __Construct()
    {
        $this->akunmodel = new AkunModel();
        $this->pelaporanmodel = new PelaporanModel();
        $this->page = new PagesController();
    }

    public function Register()
    {
        // untuk validasi
        if (!$this->validate([
            //Field Yang mau divalidasi
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi ! '
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi ! '
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi ! '
                ]
            ],
            'tanggallahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi ! '
                ]
            ],
            'whatsapp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi ! '
                ]
            ]
        ])) {
            //Kalau tidak tervalidasi maka di kembalikan ke halaman register beserta inputan pengguna
            return redirect()->to(base_url('PagesController/registrasi'))->withInput();
        }

        //Kalau Lolos Validasi
        //1. Input Database
        $nomor = "62" . $this->request->getVar('whatsapp');
        if ($this->akunmodel->save([
            'nama' => $this->request->getVar('nama'),
            'email_pengguna' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'tanggal_lahir' => $this->request->getVar('tanggallahir'),
            'no_whatsapp' => $nomor,
            'role' => 2,
            'status_active' => 1
        ])) {
            //Jika Berhasil Tampilkan Pesan
            session()->setFlashdata('register', 'Register Berhasil, Silahkan Login.');
            return redirect()->to(base_url('PagesController/Register'));
        }
    }

    public function Login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        //2. Cocokkan Dengan Yang Ada DiDatabase
        $user = $this->akunmodel->where(['email_pengguna' => $email])->first();
        if ($user) {
            //Kalau ada user nya cek passwordnya sama atau tidak dengan inputan 
            if (password_verify($password, $user['password'])) {
                //Kalau Password Nya sama maka cek apakah usernya aktif ?
                if ($user['status_active'] == 1) {
                    //Kalau usernya aktif maka login berhasil
                    //1.Simpan session usernya
                    $dataSession = [
                        'id' => $user['id'],
                        'nama' => $user['nama'],
                        'email' => $user['email_pengguna'],
                        'role' => $user['role'],
                        'logged_in' => TRUE
                    ];
                    session()->set($dataSession);
                    //2. Redirect Kehalaman Role id masing masing
                    if ($user['role'] == 1) {
                        return redirect()->to(base_url('PagesController/dashboard'));
                    } else if ($user['role'] == 2) {
                        return redirect()->to(base_url('PagesController/dashboard'));
                    }
                } else {
                    //Kalau usernya gak aktif
                    session()->setFlashdata('loginsave', 'Akun anda dinonaktifkan, harap hubungi admin ! ');
                    return redirect()->to(base_url('PagesController/login'));
                }
            } else {
                //Kalau Passwordnya gak sama , kasih pesan error
                session()->setFlashdata('loginsave', 'Password yang Anda masukkan salah.');
                return redirect()->to(base_url('PagesController/login'));
            }
        } else {
            //Kalau user nya gak ada
            session()->setFlashdata('loginsave', 'Email Belum Terdaftar. ');
            return redirect()->to(base_url('PagesController/login'));
        }
    }

    public function updateprofile()
    {
        if (session()->get('role') == 2 || session()->get('role') == 1) {
            $id = session()->get('id');
            $nama = $this->request->getVar('nama');
            $email = $this->request->getVar('email');
            $user = $this->akunmodel->where(['email_pengguna' => session()->get('email')])->first();
            if ($this->akunmodel->where('id', $id)->set(['nama' => $nama, 'email_pengguna' => $email])->update()) {
                session()->setFlashdata('UpdateProfile', 'Profile Berhasil Diupdate');
                session()->remove('nama');
                session()->remove('email');
                session()->set('nama', $nama);
                session()->set('email', $email);
                return redirect()->to(base_url('PagesController/users_profile'));
            } else {
                echo 'Gagal Edit Profile';
            }
        } else {
            //jdi klo user bukan role ny g bs akses, hrus login dulu dan sesuai role 2
            return redirect()->to(base_url('PagesController/login'));
        }
    }

    public function updatepass()
    {
        if (session()->get('role') == 2 || session()->get('role') == 1) {
            $emails = session()->get('email');
            $user = $this->akunmodel->where('email_pengguna', $emails)->first();
            $password = $this->request->getVar('passwordlama');
            $passbaru = password_hash($this->request->getVar('konfirmasipasswordbaru'), PASSWORD_DEFAULT);
            if (!password_verify($password, $user['password'])) {
                session()->setFlashdata('Pass', 'Password Salah.');
                return redirect()->to(base_url('PagesController/users_profile'));
            } else if ($this->request->getVar('passwordbaru') !== $this->request->getVar('konfirmasipasswordbaru')) {
                session()->setFlashdata('KonfirmPass', 'Konfirmasi Password Tidak Sama.');
                return redirect()->to(base_url('PagesController/users_profile'));
            } else if ($this->akunmodel->where('email_pengguna', $emails)->set(['password' => $passbaru])->update()) {
                session()->setFlashdata('ChangePass', 'Password Berhasil diubah.');
                return redirect()->to(base_url('PagesController/users_profile'));
            }
        } else {
            return redirect()->to(base_url('PagesController/login'));
        }
    }

    public function hapusdataUsers($id)
    {
        if ($this->akunmodel->delete($id)) {
            session()->setFlashdata('DataUsers', 'Berhasil Dihapus!');
            return redirect()->to(base_url('PagesController/data_users'));
        }
    }

    public function hapusdataPelapor($id)
    {
        if ($this->pelaporanmodel->delete($id)) {
            session()->setFlashdata('DataPelapor', 'Berhasil Dihapus!');
            return redirect()->to(base_url('PagesController/data_pelaporan'));
        }
    }

    public function reset()
    {
        $pass = $this->request->getVar('password');
        $konpass = $this->request->getVar('password2');
        $email = $this->request->getVar('email');
        if ($pass != $konpass) {
            session()->setFlashdata('gagal', 'tidak ada email');
            return redirect()->back();
        }
        $cek = $this->akunmodel->where('email_pengguna', $email)->first();
        if ($this->akunmodel->save([
            'id' => $cek['id'],
            'password' => password_hash($pass, PASSWORD_DEFAULT),
            'hashlink' => ''
        ])) {
            session()->setFlashdata('sukses', 'Berhasil');
            return redirect()->back();
        } else {
            session()->setFlashdata('gagal', 'error');
            return redirect()->back();
        }
    }

    public function hash()
    {
        session()->setTempdata('status', '1');
        $emailaddr = $this->request->getPost('email');
        $cek = $this->akunmodel->where('email_pengguna', $emailaddr)->first();
        if (is_null($cek)) {
            session()->setFlashdata('gagal', 'Tidak ada email');
            return redirect()->back();
        }
        $hash = hash('sha3-512', $cek['email_pengguna'] . $cek['password'] . $cek['id']);
        $ceklink = $this->akunmodel->where('hashlink', $hash)->first();
        if ($ceklink) {
            $this->sendemail($cek['email_pengguna'], $hash);
            session()->setFlashdata('sukses', 'Berhasil');
            return redirect()->back();
        } else {
            $send = $this->sendemail($cek['email_pengguna'], $hash);
            $this->akunmodel->save([
                'id' => $cek['id'],
                'hashlink' => $hash
            ]);
            if ($send == true) {
                session()->setFlashdata('sukses', 'berhasil');
                return redirect()->back();
            } else {
                session()->setFlashdata('gagal', 'gagal');
                return redirect()->back();
            }
        }
    }

    public function forgotpass($hash = null)
    {
        if (is_null($hash)) {
            return redirect()->to(base_url());
        }
        $cek = $this->akunmodel->where('hashlink', $hash)->first();
        if (is_null($cek)) {
            return redirect()->to(base_url());
        }
        $data = [
            'title' => 'Lakjasi || Lupa Password',
            'email' => $cek['email_pengguna']
        ];
        return view('password-baru', $data);
    }

    public function sendemail($alamatemail, $hash)
    {
        if (session()->getTempdata('status') != '1') {
            return redirect()->to(base_url());
        }
        $link = base_url() . "/AuthenticationController/forgotpass/" . $hash;
        $email = \Config\Services::email();
        $email->setFrom('fajar.indrawan26@gmail.com', 'Lakjasi');
        $email->setTo($alamatemail);
        $email->setSubject('Lupa Password Akun Lakjasi');
        $email->setMessage('<h1>Lupa Password</h1><br>Klik tombol dibawah ini untuk memasukkan password baru<br><table width="100%" cellspacing="0" cellpadding="0"><tr>
                                    <td>
                                        <table cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="border-radius: 2px;" bgcolor="#0B5ED7">
                                                    <a href="' . $link . '" target="_blank" style="padding: 8px 12px; border: 1px solid #0B5ED7;border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #ffffff;text-decoration: none;font-weight:bold;display: inline-block;">
                                                        Ganti Password           
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                </table>');
        return $email->send();
    }

    public function UpdateDataUser($id = null)
    {
        if (session()->get('role') != 1) {
            return redirect()->back();
        }
        $nama = $this->request->getPost('nama');
        $email =  $this->request->getPost('email');
        $role = $this->request->getPost('role');
        if ($this->akunmodel->save([
            'id' => $id,
            'nama' => $nama,
            'email_pengguna' => $email,
            'role' => $role
        ])) {
            session()->setFlashdata('users', 'Berhasil Update Data');
            return redirect()->back();
        } else {
            session()->setFlashdata('Formgagal', 'Gagal Update Data');
            return redirect()->back();
        }
    }

    public function logout()
    {
        $dataSession = [
            'id',
            'nama',
            'email',
            'role',
            'logged_in'
        ];
        session()->remove($dataSession);
        return redirect()->to(base_url());
    }
}
