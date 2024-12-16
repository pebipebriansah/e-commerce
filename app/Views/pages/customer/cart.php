<?= $this->extend('layouts/admin-panel-customer') ?>

<?= $this->section('content') ?>
<section class="shop_section layout_padding">
    <div class="container">
        <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success'); ?>
        </div>
        <?php elseif (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
        </div>
        <?php endif; ?>

        <div class="heading_container heading_center">
            <h2>Shopping Cart</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="<?= base_url('customer/checkout'); ?>" method="post">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Chart</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($cart) && !empty($cart)) : ?>
                            <?php foreach ($cart as $item) : ?>
                            <tr>
                                <td><?= $item['id_chart']; ?></td>
                                <td><?= htmlspecialchars($item['nama_produk']); ?></td>
                                <td><?= number_format($item['harga'], 0, ',', '.'); ?></td>
                                <td><?= date('d-m-Y', strtotime($item['tanggal'])); ?></td>
                                <td>
                                    <a href="<?= base_url('customer/remove_cart/'.$item['id_chart']); ?>"
                                        class="btn btn-danger">Remove</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="2"></td>
                                <td><strong>Total:</strong></td>
                                <td><strong><?= number_format(array_sum(array_column($cart, 'harga')), 0, ',', '.'); ?></strong>
                                </td>

                            </tr>
                            <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center">Keranjang belanja kosong.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?php if (!empty($cart)) : ?>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>