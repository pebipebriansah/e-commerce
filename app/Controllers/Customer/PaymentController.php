<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\PesananModel;
use Midtrans\Transaction;

class PaymentController extends BaseController
{
    
    public function pay($orderId)
    {
        // Load order from database
        $orderModel = new PesananModel();
        $order = $orderModel->find($orderId);

        if (!$order) {
            return $this->response->setStatusCode(404, 'Order not found');
        }

        // Set Midtrans configuration
        Config::$serverKey = 'SB-Mid-server-Xp8iWFicCUusYLDEEeUPzd4G';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Prepare transaction details
        $params = [
            'transaction_details' => [
                'order_id' => $order['id_pesanan'],
                'gross_amount' => $order['total'],
            ],
            'customer_details' => [
                'first_name' => session()->get('nama_customer'),
                'last_name' => '',
                'email' => session()->get('email'),
                'phone' => session()->get('no_hp'),
            ],
        ];

        // Get Snap token
        $snapToken = Snap::getSnapToken($params);

        // Return Snap token as JSON
        return $this->response->setJSON(['snapToken' => $snapToken]);
    }
    public function checkStatus($orderId)
    {
        // Load Midtrans configuration
        Config::$serverKey = 'SB-Mid-server-Xp8iWFicCUusYLDEEeUPzd4G';
        Config::$isProduction = false;

        try {
            $status = Transaction::status($orderId);
            $transactionStatus = $status->transaction_status;

            // If the transaction is settled, update the order status in the database
            if ($transactionStatus == 'settlement') {
                $orderModel = new PesananModel();
                $orderModel->update($orderId, ['status' => 'Sudah Bayar']);
            }

            return $this->response->setJSON(['status' => $transactionStatus]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Pesanan tidak ada'], 500);
        }
    }
}
