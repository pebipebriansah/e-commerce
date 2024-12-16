<?= $this->extend('layouts/admin-panel-supplier')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Profile</h1>
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
                        <h4>Edit Data Profile</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('customer/profile/update/').$supplier['id_supplier']?>"
                            method="POST">
                            <?= csrf_field()?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>ID Supplier</label>
                                        <input type="text" name="id_supplier" class="form-control" readonly required=""
                                            value="<?=$supplier['id_supplier']?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" name="nama" class="form-control" required=""
                                            value="<?=$supplier['nama']?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" required=""
                                            value="<?=$supplier['email']?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" name="-" readonly class="form-control" required=""
                                            value="<?=$supplier['password']?>">
                                        <label>Masukan Kembali Password</label>
                                        <input type="text" name="password" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="alamat"
                                            required=""><?=$supplier['alamat']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>No Hp</label>
                                        <input type="number" name="no_hp" class="form-control" required=""
                                            value="<?=$supplier['no_hp']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-left">
                                <button class="btn btn-primary">Update</button>
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