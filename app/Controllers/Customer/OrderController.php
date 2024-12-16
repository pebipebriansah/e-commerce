<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\PesananModel;    
use App\Models\PembayaranModel;
use App\Models\DetailPesananModel;
use App\Models\CustomerModel;
use App\Models\PenjualanModel;
class OrderController extends BaseController
{
    public function index()
    {
        $pesananModel = new PesananModel();
        $detailPesananModel = new DetailPesananModel();
        $id_customer = session()->get('id_customer');

        // Ambil data pesanan berdasarkan id_customer
        $orders = $pesananModel->where('id_customer', $id_customer)->findAll();

        // Ambil data detail pesanan berdasarkan pesanan yang dimiliki customer
        $orderDetails = [];
        foreach ($orders as $order) {
            $details = $detailPesananModel->where('id_pesanan', $order['id_pesanan'])->join('produk','produk.id_produk = detail_pesanan.id_produk')->findAll();
            $orderDetails[$order['id_pesanan']] = $details;
        }

        // Data yang dikirim ke view
        $data = [
            'title' => 'Order',
            'orders' => $orders,
            'orderDetails' => $orderDetails,
        ];

        return view('pages/customer/order', $data);
    }
    public function proses_pembayaran($id_pesanan){
    $id_pesanan = $this->request->getPost('id_pesanan');
    $bukti_pembayaran = $this->request->getFile('bukti_pembayaran');
    // Pastikan file bukti pembayaran telah diunggah
    if ($bukti_pembayaran->isValid() && !$bukti_pembayaran->hasMoved()) {
        // Generate nama file unik
        $nama_file = $bukti_pembayaran->getRandomName();

        // Pindahkan file ke folder yang diinginkan (misalnya 'uploads/bukti_pembayaran/')
        $bukti_pembayaran->move('uploads/bukti_pembayaran', $nama_file);

        // Simpan nama file bukti pembayaran ke database
        $pesananModel = new PesananModel();
        $pembayaranModel = new PembayaranModel();
        $total = $pesananModel->getTotalById($id_pesanan);
        $lastID = $pembayaranModel->getLastID();

        if ($lastID == null) {
            $incrementId = 1;
        } else {
            $sliceId = (int) substr($lastID, 4); // Menggunakan substr 4 untuk mengambil angka setelah PSN-
            $incrementId = $sliceId + 1;
        }
        
        $id_pembayaran = 'PMON' . sprintf('%03d', $incrementId);
        $data = [
            'id_pembayaran' => $id_pembayaran,
            'id_pesanan'=> $id_pesanan,
            'id_customer' => session()->get('id_customer'),
            'total' => $total,
            'bukti_pembayaran' => $nama_file
        ];

        $pesananModel->update($id_pesanan, [
            'bukti_pembayaran' => $nama_file,
            'status' => 'Belum Di Approve'
        ]);
        $pembayaranModel->insert($data);

        // Redirect atau berikan respons sukses jika diperlukan
        session()->setFlashdata('success', 'Bukti pembayaran berhasil diunggah.');
        return redirect()->to(base_url('customer/order'));
    } else {
        // File tidak diunggah dengan benar, berikan pesan error atau tindakan lain yang sesuai
        session()->setFlashdata('error', 'Gagal mengunggah bukti pembayaran.');
        return redirect()->back()->withInput();
    }   
    }
    public function proses_terima($id_pesanan)
    {
        $pesananModel = new PesananModel();
        $customerModel = new CustomerModel();
        $penjualanModel = new PenjualanModel();
    
        // Ambil id_customer dari session
        $id_customer = session()->get('id_customer');
    
        // Ambil data pesanan berdasarkan id_pesanan
        $row = $pesananModel->find($id_pesanan);
        if (!$row) {
            session()->setFlashdata('error', 'Pesanan tidak ditemukan.');
            return redirect()->back()->withInput();
        }
    
        // Mengambil id terakhir dari tabel penjualan
        $lastID = $penjualanModel->getLastID();
        $incrementId = ($lastID === null) ? 1 : ((int) substr($lastID, 4) + 1);
    
        // Membuat id_penjualan baru
        $id_penjualan = 'TRS' . sprintf('%03d', $incrementId);
    
        // Menyimpan data penjualan baru
        $data_penjualan = [
            'id_penjualan' => $id_penjualan,
            'id_pesanan' => $row['id_pesanan'],
            'id_customer' => $id_customer,
            'tanggal' => date('Y-m-d'),
            'status' => 'Diterima',
            'total' => $row['total'],
        ];
    
        try {
            $result = $penjualanModel->insert($data_penjualan);
            if ($result === false) {
                $errors = $penjualanModel->errors();
                session()->setFlashdata('error', 'Gagal menyimpan data penjualan. Kesalahan: ' . implode(', ', $errors));
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    
        // Update status pesanan menjadi 'Diterima'
        try {
            $approve = $pesananModel->update($id_pesanan, ['status' => 'Diterima']);
            if ($approve === false) {
                $errors = $pesananModel->errors();
                session()->setFlashdata('error', 'Gagal mengupdate status pesanan. Kesalahan: ' . implode(', ', $errors));
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    
        // Ambil poin sementara dari customer
        try {
            $pointSementara = $customerModel->getPointById($id_customer);
            if (!$pointSementara) {
                session()->setFlashdata('error', 'Gagal mengambil poin customer.');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    
        // Tambahkan 1000 poin
        $newPoint = $pointSementara['point'] + 1000;
        try {
            $updatePoint = $customerModel->update($id_customer, ['point' => $newPoint]);
            if ($updatePoint === false) {
                $errors = $customerModel->errors();
                session()->setFlashdata('error', 'Gagal menambahkan poin customer. Kesalahan: ' . implode(', ', $errors));
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    
        session()->setFlashdata('success', 'Barang Diterima. Poin Anda bertambah 1000.');
        return redirect()->to(base_url('customer/order'));
    }
    
    public function tukar_point($id_pesanan){
        $pesananModel = new PesananModel();
        $customerModel = new CustomerModel();
        $totalSementara = $pesananModel->getTotalById($id_pesanan);
        $pointSementara = $customerModel->getPointById(session()->get('id_customer'));
        if($pointSementara['point'] < 1000){
            session()->setFlashdata('error', 'Poin Anda tidak mencukupi.');
            return redirect()->to(base_url('customer/order'));
        }else{
            $newPoint = $pointSementara['point'] - $totalSementara['total'];
            if($newPoint < 0){
                $newPoint = 0;
            }
            $newPointTotal = $totalSementara['total'] - $pointSementara['point'];
            $pesananModel->update($id_pesanan, ['total' => $newPointTotal]);
            $customerModel->update(session()->get('id_customer'), ['point' => $newPoint]);
            session()->setFlashdata('success', 'Poin Anda berhasil ditukar.');
            return redirect()->to(base_url('customer/order'));
        }
    }
}