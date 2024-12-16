<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class UsersController extends BaseController
{
    public function index()
    {
        $usersModel = new UsersModel();
        $users = $usersModel->findAll();
        $uri = service('uri');
        $data = [
            'title' => 'Users',
            'users' => $users,
            'uri' => $uri
        ];
        return view('pages/pegawai/users', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Users',
        ];
        return view('pages/pegawai/users-create', $data);

    }

    public function save()
    {
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $users = new UsersModel();
        $data = [
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => '2',
        ];
        if ($data){
            $users->insert($data);
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('pegawai/users'));
        } else {
            session()->setFlashdata('error', 'Data gagal ditambahkan');
            return redirect()->to(base_url('pegawai/users/create'));
        }
    }

    public function edit($id)
    {
        $usersModel = new UsersModel();
        $user = $usersModel->find($id);

        $data = [
            'title' => 'Edit Data Users',
            'user' => $user,
        ];
        return view('pages/pegawai/users-edit', $data);
    }

    public function update($id)
    {
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $users = new UsersModel();
        $data = [
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
        if ($data){
            $users->update($id, $data);
            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to(base_url('pegawai/users'));
        } else {
            session()->setFlashdata('error', 'Data gagal diubah');
            return redirect()->to(base_url('pegawai/users/edit/'.$id));
        }
    }

    public function delete($id)
    {
        $users = new UsersModel();
        $users->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to(base_url('pegawai/users'));
    }
}