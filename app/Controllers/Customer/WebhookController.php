<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;

use Midtrans\Notification;
use Midtrans\Config;
use App\Models\PesananModel;

class WebhookController extends BaseController
{
    public function handle()
    {
        // Set Midtrans configuration
        Config::$serverKey = 'SB-Mid-server-Xp8iWFicCUusYLDEEeUPzd4G';
        Config::$isProduction = false; // Ubah menjadi true jika menggunakan Midtrans Production
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Log request body
        log_message('info', 'Webhook received: ' . file_get_contents('php://input'));

        try {
            // Buat instance dari Notification
            $notification = new Notification();

            // Ambil data notifikasi
            $transaction = $notification->transaction_status;
            $type = $notification->payment_type;
            $orderId = $notification->order_id;
            $fraud = $notification->fraud_status;

            // Log notification data
            log_message('info', 'Notification data: ' . json_encode($notification));

            // Cari order berdasarkan orderId
            $orderModel = new PesananModel();
            $order = $orderModel->where('order_id', $orderId)->first();
            
            if (!$order) {
                log_message('error', 'Order not found: ' . $orderId);
                return $this->response->setStatusCode(404, 'Order not found');
            }

            // Update status order berdasarkan status transaksi dari Midtrans
            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $orderModel->update($order['id_pesanan'], ['status' => 'Pending']);
                    } else {
                        $orderModel->update($order['id_pesanan'], ['status' => 'Sudah Bayar']);
                    }
                }
            } else if ($transaction == 'settlement') {
                $orderModel->update($order['id_pesanan'], ['status' => 'Sudah Bayar']);
            } else if ($transaction == 'pending') {
                $orderModel->update($order['id_pesanan'], ['status' => 'Belum Bayar']);
            } else if ($transaction == 'deny') {
                $orderModel->update($order['id_pesanan'], ['status' => 'Deny']);
            } else if ($transaction == 'expire') {
                $orderModel->update($order['id_pesanan'], ['status' => 'Expire']);
            } else if ($transaction == 'cancel') {
                $orderModel->update($order['id_pesanan'], ['status' => 'Cancel']);
            }
            // Log order update
            log_message('info', 'Order updated: ' . $orderId);

        } catch (\Exception $e) {
            log_message('error', 'Exception: ' . $e->getMessage());
            return $this->response->setStatusCode(500, 'Error processing notification');
        }
        // Response untuk Midtrans
        return $this->response->setJSON(['message' => 'Notification handled successfully']);
    }
}
