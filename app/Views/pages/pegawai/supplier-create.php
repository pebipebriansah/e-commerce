<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Kelola Data Supplier</h1>
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
                  <h4>Tambah Data Supplier</h4>
                </div>
                <div class="card-body">
                 <form action="<?= base_url('pegawai/supplier/save')?>" method="POST" >
                 <?= csrf_field()?>
                 <div class="row">
                     <div class="col-6">
                         <div class="form-group">
                            <label>ID Supplier</label>
                            <input type="text" name="id_supplier" class="form-control"  required="" value="<?=$id_supplier?>">
                            <div class="valid-feedback">
                                Masukan ID Supplier
                            </div>
                        </div>
                        <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required="">
                        <div class="invalid-feedback">
                            Masukan Nama yang Valid
                        </div>
                        </div>
                        <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                        <div class="invalid-feedback">
                            Masukan Email yang Valid
                        </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                         <div class="form-group">
                         <label>Password</label>
                         <input type="password" name="password" class="form-control">
                         <div class="invalid-feedback">
                             Masukan Password yang Valid
                         </div>
                         </div>
                         <div class="form-group">
                         <label>Alamat</label>
                         <input type="text" name="alamat" class="form-control">
                         <div class="invalid-feedback">
                             Masukan Alamat yang Valid
                         </div>
                         </div>
                         <div class="form-group">
                         <label>No. Telepon</label>
                         <input type="text" name="no_hp" class="form-control">
                         <div class="invalid-feedback">
                             Masukan No. Telepon yang Valid
                         </div>
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