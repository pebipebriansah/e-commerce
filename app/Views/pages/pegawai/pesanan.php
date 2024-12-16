<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Pesan Barang</h1>
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
                  <h4>Barang Pesanan</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-stripped" id="table-1">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>ID Pesanan</th>
                          <th>Nama Pembeli</th>
                          <th>Alamat</th>
                          <th>Total</th>
                          <th>Tanggal</th>
                          <th>Status</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <?php $no = 1?>
                      <?php foreach ($pesanan as $pesan): ?>
                        <?php 
                        if ($pesan['status'] == 'Menunggu Konfirmasi') {
                            $badge = "badge-info";
                            $isHide = '';
                        } else if ($pesan['status'] == 'Belum Bayar') {
                            $badge = 'badge-danger';
                            $isHide = 'disabled';
                        } else if ($pesan['status'] == 'Sudah Bayar') {
                            $badge = 'badge-success';
                            $isHide = 'disabled';
                        } else if ($pesan['status'] == 'Sudah Dikirim') {
                            $badge = 'badge-primary';
                            $isHide = 'disabled';
                        } else if ($pesan['status'] == 'Diterima') {
                            $badge = 'badge-success';
                            $isHide = 'disabled';
                        } else if ($pesan['status'] == 'Belum Di Approve') {
                            $badge = 'badge-warning';
                            $isHide = '';
                        } else if ($pesan['status'] == 'Sudah Di Approve') {
                            $badge = 'badge-secondary';
                            $isHide = 'disabled';
                        }
                        ?>

                      <tbody>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?=$pesan['id_pesanan']?></td>
                          <td><?= $pesan['nama_customer']?></td>
                          <td><?= $pesan['tempat_tinggal']?></td>
                          <td><?= $pesan['total']?></td>
                          <td><?= $pesan['tanggal']?></td>
                          
                          <td><div class="badge <?=$badge?>"><?= $pesan['status']?></div></td>
                          <td>
                            <?php if ($pesan['status'] == 'Menunggu Konfirmasi') : ?>
                                <button class="btn btn-success" data-toggle="modal" <?= $isHide ?> data-target="#konfirmasiModal<?= $pesan['id_pesanan'] ?>">Konfirmasi</button>
                            <?php elseif ($pesan['status'] == 'Belum Di Approve') : ?>
                                <button class="btn btn-primary" data-toggle="modal" <?= $isHide ?> data-target="#approveModal<?= $pesan['id_pesanan'] ?>">Approve</button>
                            <?php elseif ($pesan['status'] == 'Sudah Bayar') : ?>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#kirimModal<?= $pesan['id_pesanan'] ?>">Kirim Barang</button>
                            <?php elseif ($pesan['status'] == 'Diterima') : ?>
                                <a href="<?= base_url('pegawai/invoices/' . $pesan['id_pesanan']) ?>" class="btn btn-info">Download Invoice</a>
                            <?php endif; ?>
                        </td>
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


<!-- Modal -->
<!-- Modal Konfirmasi -->
<?php foreach ($pesanan as $pesan) :?>
<div class="modal fade" id="konfirmasiModal<?=$pesan['id_pesanan']?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pegawai/pesanan/konfirmasi/').$pesan['id_pesanan']?>"
                method="POST">
                <?= csrf_field()?>
                <div class="modal-body">
                    Apakah anda yakin ingin konfirmasi Pesanan Ini ini <?=$pesan['id_pesanan']?> ?<br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach?>

<!-- Modal Approve -->
<?php foreach ($pesanan as $pesan) : ?>
    <?php if ($pesan['status'] == 'Belum Di Approve') : ?>
        <div class="modal fade" id="approveModal<?= $pesan['id_pesanan'] ?>" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel<?= $pesan['id_pesanan'] ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel<?= $pesan['id_pesanan'] ?>">Approve Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('pegawai/proses_approve/' . $pesan['id_pesanan']); ?>" method="post">
                        <div class="modal-body">
                            <p>Anda yakin ingin approve pembayaran ini ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Approve</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<!-- Modal Kirim Barang -->
<?php foreach ($pesanan as $pesan) : ?>
    <?php if ($pesan['status'] == 'Sudah Bayar') : ?>
        <div class="modal fade" id="kirimModal<?= $pesan['id_pesanan'] ?>" tabindex="-1" role="dialog" aria-labelledby="kirimModalLabel<?= $pesan['id_pesanan'] ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kirimModalLabel<?= $pesan['id_pesanan'] ?>">Kirim Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('pegawai/proses_kirim/' . $pesan['id_pesanan']); ?>" method="post">
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin mengirim barang untuk pesanan ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Kirim Barang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<?= $this->endSection()?>