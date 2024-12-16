<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class AuthController extends BaseController
{
    public function index()
    {
        return view('pages/auth/login');
    }

    public function auth() 
    {
        $user = new UsersModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $user->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id' => $data['id'],
                    'nama' => $data['nama'],
                    'email' => $data['email'],
                    'role' => $data['role'],
                    'logged_in' => TRUE
                ];
                session()->set($ses_data);
                return redirect()->to('/pegawai/home');
            } else {
                session()->setFlashdata('msg', 'Password Salah');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('msg', 'Email Tidak Ditemukan');
            return redirect()->to('/login');
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}