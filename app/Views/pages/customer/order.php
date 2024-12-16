<?= $this->extend('layouts/admin-panel-customer') ?>

<?= $this->section('content') ?>
<section class="shop_section layout_padding">
    <div class="container">
        <?php 
        if (session()->getFlashdata('success')) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.session()->getFlashdata('success').'</div>';
        } else if (session()->getFlashdata('error')){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.session()->getFlashdata('error').'</div>';
        }
        ?>
        <div class="heading_container heading_center">
            <style>
            .alert {
                width: 100%;
                padding: 20px;
                margin-bottom: 15px;
                box-sizing: border-box;
            }

            .alert-fade {
                opacity: 0;
                transition: opacity 0.5s ease-out;
            }
            </style>
            <h2>Latest Orders</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array($orders) && !empty($orders)) : ?>
                        <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td>
                                <?php if (isset($orderDetails[$order['id_pesanan']])) : ?>
                                <?php foreach ($orderDetails[$order['id_pesanan']] as $detail) : ?>
                                <?= $detail['id_produk'] . ' - ' . htmlspecialchars($detail['nama_produk']); ?><br>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                            <td><?= number_format($order['total'], 0, ',', '.'); ?></td>
                            <td><?= date('d-m-Y', strtotime($order['tanggal'])); ?></td>
                            
                            <td><?= ucfirst($order['status']); ?></td>
                            <td>
                                <?php if ($order['status'] === 'Menunggu Konfirmasi') : ?>
                                <button type="button" class="btn btn-primary" disabled>Bayar</button>
                                <?php elseif ($order['status'] === 'Belum Bayar') : ?>
                                <button type="button" class="btn btn-primary" onclick="payWithMidtrans('<?= $order['id_pesanan']; ?>')">Bayar</button>
                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                    data-target="#tukarPoinModal<?= $order['id_pesanan']; ?>">Tukar Poin</button>
                                <?php elseif ($order['status'] === 'Sudah Dibayar') : ?>
                                <button type="button" class="btn btn-primary" disabled>Sudah Dibayar</button>
                                <?php elseif ($order['status'] === 'Sudah Dikirim') : ?>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#terimaModal<?= $order['id_pesanan']; ?>">Terima Barang</button>
                                <?php endif; ?>
                                <button type="button" class="btn btn-info" onclick="checkOrderStatus('<?= $order['id_pesanan']; ?>')">Cek Status</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data pesanan.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-left">
                                Catatan: <br>
                                - Total harga akan berubah ketika admin sudah mengkonfirmasi pesanan.<br> - Jika status
                                pesanan sudah "Sudah Dibayar" , silahkan tunggu konfirmasi dari admin. <br> - Jika
                                status
                                pesanan sudah "Sudah Dikirim" , silahkan tunggu barang sampai.<br>
                                - Jika status pesanan sudah "Selesai" , silahkan konfirmasi penerimaan barang.<br>
                                - Silahkan upload bukti pembayaran jika status pesanan "Belum Bayar".<br>
                                - Silahkan lakukan pembayaran pada nomor rekening A.N Adelline - 12345678 .<br>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Include Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-bFxdurrneaOxz8pb"></script>
<script type="text/javascript">
    function payWithMidtrans(orderId) {
        fetch(`<?= base_url('payment/'); ?>/${orderId}`)
            .then(response => response.json())
            .then(data => {
                snap.pay(data.snapToken, {
                    onSuccess: function(result) {
                        alert('Pembayaran berhasil!');
                        location.reload(); // Refresh halaman setelah pembayaran sukses
                    },
                    onPending: function(result) {
                        alert('Pembayaran tertunda, silakan selesaikan pembayaran.');
                    },
                    onError: function(result) {
                        alert("Pembayaran gagal, silahkan coba lagi.");
                    },
                    onClose: function() {
                        alert("Anda menutup popup tanpa menyelesaikan pembayaran.");
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal mendapatkan token pembayaran.');
            });
    }
</script>
<script>
    function checkOrderStatus(orderId) {
        fetch(`check-status/${orderId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    alert(`Status Pesanan: ${data.status}`);
                    if (data.status === 'settlement') {
                        location.reload(); // Refresh halaman jika status adalah 'settlement'
                    }
                } else if (data.error) {
                    alert(`Error: ${data.error}`);
                }
            })
            .catch(error => {
                alert('Pesanan tidak ada');
                console.error('Error:', error);
            });
    }
</script>
<!-- Modal Tukar Poin -->
<?php foreach ($orders as $order) : ?>
<div class="modal fade" id="tukarPoinModal<?= $order['id_pesanan']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="tukarPoinModalLabel<?= $order['id_pesanan']; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tukarPoinModalLabel<?= $order['id_pesanan']; ?>">Tukar Poin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('customer/tukarPoin/' . $order['id_pesanan']); ?>" method="post">
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menukar poin Anda untuk mengurangi total harga pesanan ini?</p>
                    <p>Jumlah Poin Anda: <?=session()->get('point'); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tukar Poin</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Modal Terima Barang-->
<?php foreach ($orders as $order) : ?>
<?php if ($order['status'] === 'Sudah Dikirim') : ?>
<div class="modal fade" id="terimaModal<?= $order['id_pesanan']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="terimaModalLabel<?= $order['id_pesanan']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="terimaModalLabel<?= $order['id_pesanan']; ?>">Terima Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('customer/proses_terima/' . $order['id_pesanan']); ?>" method="post">
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengkonfirmasi penerimaan barang untuk pesanan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Terima Barang</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?php endforeach; ?>
<?= $this->endSection() ?>