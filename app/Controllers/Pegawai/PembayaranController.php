<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\PesananModel;

class PembayaranController extends BaseController
{
    public function proses_approve($id_pesanan){
        $pesananModel = new PesananModel();
        $approve = $pesananModel->update($id_pesanan, [
            'status' => 'Sudah Di Approve'
        ]);
        if($approve == true){         
            session()->setFlashdata('success', 'Berhasil Di Approve');
            return redirect()->to(base_url('pegawai/pesanan'));
        } else {
            session()->setFlashdata('error', 'Gagal di Approve');
            return redirect()->back()->withInput();
        }           
    }
    public function proses_kirim($id_pesanan){
        $pesananModel = new PesananModel();
        $approve = $pesananModel->update($id_pesanan, [
            'status' => 'Sudah Dikirim'
        ]);
        if($approve == true){         
            session()->setFlashdata('success', 'Berhasil Di kirim');
            return redirect()->to(base_url('pegawai/pesanan'));
        } else {
            session()->setFlashdata('error', 'Gagal Di Kirim');
            return redirect()->back()->withInput();
        }           
    }    
}
