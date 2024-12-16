<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\CartModel;

class CartController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $id_customer = session()->get('id_customer');
        
        $builder = $db->table('chart');
        $builder->select('chart.*, produk.*') // Select columns you need
                ->join('produk', 'produk.id_produk = chart.id_produk')
                ->where('chart.id_customer', $id_customer);
        
        $query = $builder->get();
        $cart = $query->getResultArray();
        
        $data = [
            'title' => 'Payment',
            'cart' => $cart
        ];
        
        return view('pages/customer/cart', $data);
    }
    public function add_to_cart($id_produk) {
        $produkModel = new ProdukModel();
    
        // Ambil data produk berdasarkan id_produk
        $produk = $produkModel->find($id_produk);
    
        // Pastikan produk ditemukan
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }
    
        // Ambil id_customer dari session
        $id_customer = session()->get('id_customer');
    
        // Siapkan data untuk disimpan ke dalam cart
        $cartModel = new CartModel();
    
        // Generate ID chart
        $lastID = $cartModel->getLastID();
        if ($lastID == null) {
            $incrementId = 1;
        } else {
            $sliceId = (int) substr($lastID, 4); // Menggunakan substr 4 untuk mengambil angka setelah PSN-
            $incrementId = $sliceId + 1;
        }
        $id_chart = 'CART' . sprintf('%03d', $incrementId);
    
        // Siapkan data untuk disimpan ke dalam cart
        $data = [
            'id_chart' => $id_chart,
            'id_produk' => $id_produk,
            'id_customer' => $id_customer,
            'harga' => $produk['harga'], // Mengambil harga dari data produk
            'tanggal' => date('Y-m-d'),
        ];
    
        try {
            // Insert data ke dalam tabel cart
            $cartModel->insert($data);
    
            // Set flashdata success
            session()->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang');
        } catch (\Exception $e) {
            // Set flashdata error
            session()->setFlashdata('error', 'Produk gagal ditambahkan ke keranjang: ' . $e->getMessage());
        }
    
        // Redirect ke halaman shop setelah operasi selesai
        return redirect()->to(base_url('customer/shop'));
    }
    public function remove_cart($id_chart) {
        $cartModel = new CartModel();
        $cartModel->delete($id_chart);
        session()->setFlashdata('success', 'Produk berhasil dihapus dari keranjang belanja.');
        return redirect()->to(base_url('customer/cart'));
    
    }
      
}