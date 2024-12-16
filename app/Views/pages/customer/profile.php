<?= $this->extend('layouts/admin-panel-customer') ?>

<?= $this->section('content') ?>
<section class="profile_section layout_padding">
    <style>
    .mt-3 {
        margin-top: 15px;
        /* Atur margin top sesuai kebutuhan */
    }

    .profile-info {
        text-align: left;
        /* Pastikan teks rata kiri */
    }
    </style>
    <div class="container">
        <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
        </div>
        <?php elseif (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>

        <div class="heading_container heading_center">
            <h2>Profile</h2>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="text-center">
                    <?php if (!empty($customer['foto_profil'])) : ?>
                    <!-- Tampilkan Foto Profil -->
                    <img src="<?= base_url('uploads/profiles/' . $customer['foto_profil']); ?>" alt="Profile Picture"
                        class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    <?php else : ?>
                    <!-- Jika tidak ada foto profil, tampilkan placeholder -->
                    <img src="<?= base_url('uploads/profiles/blank.jpg'); ?>" alt="Profile Picture"
                        class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="mt-3 profile-info">
                        <!-- Tampilkan Informasi Profil -->
                        <p><strong>Nama:</strong> <?= htmlspecialchars($customer['nama_customer']); ?></p>
                        <p><strong>Jenis Kelamin:</strong> <?= ucfirst($customer['jenis_kelamin']); ?></p>
                        <p><strong>Tempat Tinggal:</strong> <?= htmlspecialchars($customer['tempat_tinggal']); ?></p>
                        <p><strong>No HP:</strong> <?= htmlspecialchars($customer['no_hp']); ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($customer['email']); ?></p>
                        <p><strong>Point:</strong> <?= $customer['point']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>