<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Kelola Data Users</h1>
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
                  <h4>Edit Data User</h4>
                </div>
                <div class="card-body">
                 <form action="<?= base_url('pegawai/users/update/').$user['id']?>" method="POST" >
                 <?= csrf_field()?>
                 <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" value="<?= $user['nama']?>" class="form-control"  required="">
                        <div class="valid-feedback">
                          Good job!
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= $user['email']?>" class="form-control" required="">
                        <div class="invalid-feedback">
                          Oh no! Email is invalid.
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <p class="text-muted">Kosongkan jika tidak ingin diubah</p>
                      </div>
                      <div class="form-group">
                        <label>Role</label>
                        <select name="role" id="" class="form-control" disabled>
                          <option value="<?= $user['role']?>" selected>
                        <?php
                        switch ($user['role']) {
                          case '1':
                            echo "Pimpinan";
                            break;
                          case '2':
                            echo "Pegawai";
                            break;
                          case '3':
                            echo "Supplier";
                            break;
                        }
                        ?>
                        </option>
                        </select>
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