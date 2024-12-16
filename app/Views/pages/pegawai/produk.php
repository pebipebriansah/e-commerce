<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Produksi</h1>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <?php 
                if (session()->getFlashdata('success')) {
                    echo '<div class="alert alert-success" role="alert">'.session()->getFlashdata('success').'</div>';
                } else if (session()->getFlashdata('error')){
                    echo '<div class="alert alert-danger" role="alert">'.session()->getFlashdata('error').'</div>';
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Produk</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>HPP</th>
                                        <th>Keuntungan</th>
                                    </tr>
                                </thead>
                                <?php $no = 1?>
                                <?php foreach ($produk as $pesanan): ?>
                                <tbody>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $pesanan['nama_produk']?> </td>
                                        <td><?= $pesanan['stok']?> Pcs</td>
                                        <td>Rp. <?= number_format($pesanan['harga'])?></td>
                                        <td>RP. <?= number_format($pesanan['hpp'])?></td>
                                        <td>Rp. <?= number_format($pesanan['keuntungan'])?></td>
                                    </tr>
                                </tbody>
                                <?php endforeach?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Statistik -->
    </section>
</div>
<?= $this->endSection()?>