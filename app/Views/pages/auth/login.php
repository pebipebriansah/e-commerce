<?= $this->extend('layouts/auth')?>

<?= $this->section('content')?>
<div class="card card-success">
    <div class="card-header">
        <h4 style="color:black">Login</h4>
    </div>

    <div class="card-body">
        <!-- setflash data -->
        <?php
                if (session()->getFlashdata('msg')) {
                  echo '<div class="alert alert-danger" role="alert">';
                  echo session()->getFlashdata('msg');
                  echo '</div>';
                }
                ?>
        <form method="POST" action="<?= base_url('auth')?>" class="needs-validation" novalidate="">
            <?= csrf_field()?>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                    Masukan alamat email dengan benar
                </div>
            </div>

            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                <div class="invalid-feedback">
                    Masukan kata sandi yang benar
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-Light btn-outline-primary btn-lg btn-block" tabindex="4">
                    Masuk
                </button>
            </div>
        </form>


    </div>
</div>
<?= $this->endSection()?>