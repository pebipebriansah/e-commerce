<?= $this->extend('layouts/admin-panel-customer') ?>

<?= $this->section('content') ?>
<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Latest Payment</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Total</th>
                            <th>Tanggal</td>
                            <th>Bukti Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array($payment) && !empty($payment)) : ?>
                        <?php foreach ($payment as $pt) : ?>
                        <tr>
                            <td><?= htmlspecialchars($pt['id_pesanan']); ?></td>
                            <td><?= number_format($pt['total'], 0, ',', '.'); ?></td>
                            <td><?= date('d-m-Y', strtotime($pt['tanggal'])); ?></td>
                            <td>
                                <?php if ($pt['bukti_pembayaran'] !== 'Tidak ada Data') : ?>
                                <a href="<?= base_url('uploads/bukti_pembayaran/' . $pt['bukti_pembayaran']); ?>"
                                    target="_blank">Lihat Bukti</a>
                                <?php else : ?>
                                Belum Melakukan Pembayaran
                                <?php endif; ?>
                            </td>
                            <td><?= ucfirst($pt['status']); ?></td>
                            <<td>
                                <?php if ($pt['status'] == 'Diterima') : ?>
                                <a href="<?= base_url('customer/invoices/' . $pt['id_pesanan']); ?>"
                                    class="btn btn-success">Download Invoice</a>
                                <?php else : ?>
                                <button class="btn btn-success" disabled>Download Invoice</button>
                                <?php endif; ?>
                                </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data pesanan.</td>
                        </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>