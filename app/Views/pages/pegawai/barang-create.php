<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kelola Data Barang</h1>
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
                        <h4>Tambah Data Produk</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('pegawai/barang/save')?>" method="POST"
                            enctype="multipart/form-data">
                            <?= csrf_field()?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>ID Produk</label>
                                        <input type="text" name="id_produk" class="form-control" readonly required=""
                                            value="<?=$id_barang?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Produk</label>
                                        <input type="text" name="nama_produk" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select name="id_kategori" class="form-control">
                                            <option value="#">Pilih Kategori</option>
                                            <?php foreach($kategori as $kate):?>
                                            <option value="<?= $kate['id_kategori']?>"><?= $kate['kategori']?></option>
                                            <?php endforeach?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" name="jumlah" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="text" name="harga" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Photo</label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                </div>
                                <div class="card-footer text-right">
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