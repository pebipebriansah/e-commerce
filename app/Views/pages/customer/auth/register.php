<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="card card-primary">
    <div class="card-header"><h4>Registrasi</h4></div>

    <div class="card-body">
        <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= base_url('register/save') ?>" class="needs-validation" novalidate enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="nama_customer">Nama</label>
                <input id="nama_customer" type="text" class="form-control" name="nama_customer" tabindex="1" required autofocus>
                <div class="invalid-feedback">Masukkan nama dengan benar.</div>
            </div>

            <div class="form-group">
                <label for="foto_profil">Foto Profil</label>
                <input id="foto_profil" type="file" class="form-control" name="foto_profil" tabindex="2" required>
                <div class="invalid-feedback">Masukkan foto profil.</div>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" class="form-control" name="jenis_kelamin" tabindex="3" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <div class="invalid-feedback">Pilih jenis kelamin.</div>
            </div>

            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input id="no_hp" type="text" class="form-control" name="no_hp" tabindex="4" required>
                <div class="invalid-feedback">Masukkan nomor HP dengan benar.</div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="5" required>
                <div class="invalid-feedback">Masukkan alamat email dengan benar.</div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" tabindex="6" required>
                <div class="invalid-feedback">Masukkan kata sandi yang benar.</div>
            </div>

            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <select id="provinsi" class="form-control" name="provinsi" tabindex="7" required>
                    <option value=" ">Pilih Provinsi</option>
                </select>
                <div class="invalid-feedback">Pilih provinsi.</div>
                <input type="hidden" name="nama_provinsi" id="nama_provinsi">
            </div>

            <div class="form-group">
                <label for="kabupaten">Kabupaten/Kota</label>
                <select id="kabupaten" class="form-control" name="kabupaten" tabindex="8" required>
                    <option value="">Pilih Kabupaten/Kota</option>
                </select>
                <div class="invalid-feedback">Pilih kabupaten/kota.</div>
                <input type="hidden" name="nama_kabupaten" id="nama_kabupaten">
            </div>

            <div class="form-group">
                <label for="kecamatan">Kecamatan</label>
                <select id="kecamatan" class="form-control" name="kecamatan" tabindex="9" required>
                    <option value="">Pilih Kecamatan</option>
                </select>
                <div class="invalid-feedback">Pilih kecamatan.</div>
                <input type="hidden" name="nama_kecamatan" id="nama_kecamatan">
            </div>

            <div class="form-group">
                <label for="kelurahan">Kelurahan/Desa</label>
                <select id="kelurahan" class="form-control" name="kelurahan" tabindex="10" required>
                    <option value="">Pilih Kelurahan/Desa</option>
                </select>
                <div class="invalid-feedback">Pilih kelurahan/desa.</div>
                <input type="hidden" name="nama_kelurahan" id="nama_kelurahan">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" class="form-control" name="alamat" rows="3" tabindex="11" required></textarea>
                <div class="invalid-feedback">Masukkan alamat dengan benar.</div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="12">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    // Objek untuk menyimpan mapping ID ke nama
    var provinceMap = {};
    var regencyMap = {};
    var districtMap = {};
    var villageMap = {};

    // Mengambil dan mengisi provinsi
    var url = '<?= base_url('proxy.php?endpoint=provinces.json') ?>';
    console.log('Request URL:', url); // Tambahkan ini untuk debugging

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var options = '<option value="">Pilih Provinsi</option>';
            response.forEach(function(provinsi) {
                provinceMap[provinsi.id] = provinsi.name;
                options += '<option value="' + provinsi.id + '">' + provinsi.name + '</option>';
            });
            $('#provinsi').html(options);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching provinces:', error);
            console.log('Raw response:', xhr.responseText);
        }
    });

    // Event listener untuk perubahan pada select provinsi
    $('#provinsi').change(function() {
        var provinceId = $(this).val();
        if (provinceId !== '') {
            $('#nama_provinsi').val(provinceMap[provinceId]); // Update hidden input
            // Mengambil dan mengisi kabupaten/kota
            $.ajax({
                url: '<?= base_url('proxy.php?endpoint=regencies/') ?>' + provinceId + '.json',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var options = '<option value="">Pilih Kabupaten/Kota</option>';
                    response.forEach(function(kabupaten) {
                        regencyMap[kabupaten.id] = kabupaten.name;
                        options += '<option value="' + kabupaten.id + '">' + kabupaten.name + '</option>';
                    });
                    $('#kabupaten').html(options);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching regencies:', error);
                    console.log('Raw response:', xhr.responseText);
                }
            });
        } else {
            $('#kabupaten').html('<option value="">Pilih Kabupaten/Kota</option>');
            $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
            $('#kelurahan').html('<option value="">Pilih Kelurahan/Desa</option>');
        }
    });

    // Event listener untuk perubahan pada select kabupaten/kota
    $('#kabupaten').change(function() {
        var regencyId = $(this).val();
        if (regencyId !== '') {
            $('#nama_kabupaten').val(regencyMap[regencyId]); // Update hidden input
            // Mengambil dan mengisi kecamatan
            $.ajax({
                url: '<?= base_url('proxy.php?endpoint=districts/') ?>' + regencyId + '.json',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var options = '<option value="">Pilih Kecamatan</option>';
                    response.forEach(function(kecamatan) {
                        districtMap[kecamatan.id] = kecamatan.name;
                        options += '<option value="' + kecamatan.id + '">' + kecamatan.name + '</option>';
                    });
                    $('#kecamatan').html(options);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching districts:', error);
                    console.log('Raw response:', xhr.responseText);
                }
            });
        } else {
            $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
            $('#kelurahan').html('<option value="">Pilih Kelurahan/Desa</option>');
        }
    });

    // Event listener untuk perubahan pada select kecamatan
    $('#kecamatan').change(function() {
        var districtId = $(this).val();
        if (districtId !== '') {
            $('#nama_kecamatan').val(districtMap[districtId]); // Update hidden input
            // Mengambil dan mengisi kelurahan/desa
            $.ajax({
                url: '<?= base_url('proxy.php?endpoint=villages/') ?>' + districtId + '.json',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var options = '<option value="">Pilih Kelurahan/Desa</option>';
                    response.forEach(function(kelurahan) {
                        villageMap[kelurahan.id] = kelurahan.name;
                        options += '<option value="' + kelurahan.id + '">' + kelurahan.name + '</option>';
                    });
                    $('#kelurahan').html(options);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching villages:', error);
                    console.log('Raw response:', xhr.responseText);
                }
            });
        } else {
            $('#kelurahan').html('<option value="">Pilih Kelurahan/Desa</option>');
        }
    });

    // Event listener untuk perubahan pada select kelurahan/desa
    $('#kelurahan').change(function() {
        var selectedId = $(this).val();
        if (selectedId) {
            $('#nama_kelurahan').val(villageMap[selectedId]); // Update hidden input
        }
    });
});
</script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>