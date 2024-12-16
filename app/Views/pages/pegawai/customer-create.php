<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kelola Data Customer</h1>
        </div>

        <!-- Statistik -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <?php
                if (session()->getFlashdata('error')){
                  echo '<div class="alert alert-danger" role="alert">'.session()->getFlashdata('error').'</div>';
                }
                ?>
                    <div class="card-header">
                        <h4>Tambah Data Customer</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('pegawai/customer/save')?>" method="POST">
                            <?= csrf_field()?>
                            <div class="form-group">
                                <label>ID Customer</label>
                                <input type="text" name="id_customer" class="form-control" required="" value="<?=$no_customer?>" readonly>
                                <div class="valid-feedback">
                                    Good job!
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Customer</label>
                                <input type="text" name="nama_customer" class="form-control" required="">
                                <div class="valid-feedback">
                                    Good job!
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="#">Silahkan Pilih</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Oh no! Gender is invalid.
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tempat Tinggal</label>
                                <input type="text" name="tempat_tinggal" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>No Hp</label>
                                <input type="text" name="no_hp" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                           <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                           </div>
                           <div class="form-group">
                                <label>Point</label>
                                <input type="text" name="point" class="form-control" value="0">
                           </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Statistik -->
    </section>
</div>
<?= $this->endSection()?>
<?= $this->section('script')?>
<script>
let table = new DataTable('#table-users', {
    searchable: true,
    sortable: true,
    fixedHeight: true
});
</script>
<?= $this->endSection()?>