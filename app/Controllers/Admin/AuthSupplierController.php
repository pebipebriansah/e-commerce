<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class AuthSupplierController extends BaseController
{
    public function index()
    {
        return view('pages/customer/auth/login');
    }

    public function auth()
    {
        $customer = new CustomerModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $customer->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_customer' => $data['id_customer'],
                    'nama_customer' => $data['nama_customer'],
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'tempat_tinggal' => $data['tempat_tinggal'],
                    'no_hp' => $data['no_hp'],
                    'point' => $data['point'],
                    'foto_profil' => $data['foto_profil'],
                    'is_customer' => true,
                ];
                session()->set($ses_data);
                return redirect()->to('customer/dashboard');
            } else{
                session()->setFlashdata('msg', 'Password salah');
                return redirect()->to('/login/customer');
            }
        } else {
            session()->setFlashdata('msg', 'Email Tidak Ditemukan');
            return redirect()->to('/login/customer');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login/customer');
    }
    public function register(){
        return view('pages/customer/auth/register');
    }
    public function save()
{
    // Ambil data dari form registrasi
    $customerModel = new CustomerModel();
    
    // Validasi upload foto profil
    $validationRules = [
        'foto_profil' => [
            'uploaded[foto_profil]',
            'max_size[foto_profil,1024]',
            'mime_in[foto_profil,image/jpg,image/jpeg,image/png]',
        ],
    ];

    if (!$this->validate($validationRules)) {
        session()->setFlashdata('msg', 'Gagal mengunggah foto profil: ' . $this->validator->getError('foto_profil'));
        return redirect()->to(base_url('register'));
    }

    $fotoProfil = $this->request->getFile('foto_profil');
    $fotoProfil->move(ROOTPATH . 'public/uploads/profiles'); // Simpan foto profil ke folder tertentu
    $lastID = $customerModel->getLastID();
        if($lastID == null){
            $incrementId = 1;
        }else{
            // Pastikan bahwa kita hanya mengambil bagian angka setelah 'CSM-'
            $sliceId = intval(substr($lastID, 4)); // Ambil bagian setelah 'CSM-'
            $incrementId = $sliceId + 1;
        }
    $id_customer = 'CSM-' . sprintf('%03d', $incrementId);
    $alamat = $this->request->getPost('alamat');
    $kabupaten = $this->request->getPost('nama_kabupaten');
    $provinsi = $this->request->getPost('nama_provinsi');
    $kecamatan = $this->request->getPost('nama_kecamatan');
    $kelurahan = $this->request->getPost('nama_kelurahan');
    $tempat_tinggal = $alamat.', '.$kabupaten. ', '. $provinsi. ', '. $kecamatan. ', '. $kelurahan;
    $ongkir = $customerModel->getOngkirByProvinsi($provinsi);
    // Data untuk disimpan ke dalam tabel customer
    $data = [
        'id_customer' => $id_customer,
        'nama_customer' => $this->request->getPost('nama_customer'),
        'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        'tempat_tinggal' => $tempat_tinggal,
        'ongkir' => $ongkir,
        'no_hp' => $this->request->getPost('no_hp'),
        'point' => 0, // Default point
        'email' => $this->request->getPost('email'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'foto_profil' => $fotoProfil->getName(), // Simpan nama file foto profil ke database
    ];

    // Simpan data ke dalam tabel customer
    $customerModel->insert($data);

    // Set flashdata untuk memberikan pesan sukses kepada pengguna
    session()->setFlashdata('success', 'Registrasi berhasil. Silakan login.');

    // Redirect ke halaman login atau halaman lain yang sesuai
    return redirect()->to(base_url('/login/customer'));
}
}