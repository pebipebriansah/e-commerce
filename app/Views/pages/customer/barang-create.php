<?= $this->extend('layouts/admin-panel-supplier')?>

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
                    <div class="card-header">
                        <h4>Tambah Data Barang</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('customer/barang/save')?>" method="POST">
                            <?= csrf_field()?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>ID Barang</label>
                                        <input type="text" name="id_barang" class="form-control" readonly required=""
                                            value="<?=$id_barang?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" name="nama_barang" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>ID Supplier</label>
                                        <input type="text" name="id_supplier" class="form-control" readonly required=""
                                            value="<?=session()->get('id_supplier')?>">
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
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input type="number" name="stok" class="form-control">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="text" name="harga" class="form-control">
                                        </div>
                                    </div>
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