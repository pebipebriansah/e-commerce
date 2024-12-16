<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header border border-primary">
            <h1>Dashboard</h1>
        </div>

        <!-- Statistik -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card border border-primary border rounded">
                    <div class="card-header border bord">
                        <h4>Informasi</h4>
                        <div class="card-header-action">
                            <div class="btn-group">
                                <a href="#" class="btn btn-primary" id="month">Bulan Ini</a>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            <!-- end Statistik -->
    </section>
</div>
<?= $this->endSection()?>

<?= $this->section('script')?>
<script src=" https://cdn.jsdelivr.net/npm/chart.js">
                                        </script>
                                        <?= $this->endSection()?>