<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Penjualan</h1>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <?php 
                if (session()->getFlashdata('success')) {
                    echo '<div class="alert alert-success" role="alert">'.session()->getFlashdata('success').'</div>';
                } else if (session()->getFlashdata('error')){
                    echo '<div class="alert alert-danger" role="alert">'.session()->getFlashdata('error').'</div>';
                }
                ?>
                <div class="card">
                    <form action="#" method="POST" id="downloadForm">
                        <div class="card-header d-flex justify-content-between">
                            <div class="form-group">
                                <label>Filter</label>
                                <select id="filter" class="form-control" name="filter">
                                    <option value="#">Filter</option>
                                    <option value="bulan">Bulan</option>
                                    <option value="tahun">Tahun</option>
                                    <option value="tiga-bulan">3 Bulan Terakhir</option>
                                </select>
                            </div>
                            <div class="form-group" id="bulanSelect">
                                <label>Pilih Bulan</label>
                                <input type="month" id="month" class="form-control" name="month">
                            </div>
                            <div class="form-group" id="tahunSelect">
                                <label>Pilih Tahun</label>
                                <select id="year" class="form-control" name="year">
                                    <?php
                                    $currentYear = date('Y');
                                    for ($i = $currentYear; $i >= 2000; $i--) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="cetak" class="btn btn-success" form="downloadForm"
                                    onclick="setAction('cetak')">Cetak</button>
                                <button type="submit" name="unduh" class="btn btn-primary" form="downloadForm"
                                    onclick="setAction('unduh')">Unduh</button>
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped" id="tableMonth">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Penjualan</th>
                                        <th>ID Pesanan</th>
                                        <th>Nama Customer</th>
                                        <th>Tanggal</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1?>
                                    <?php foreach ($laporanTerjual as $laporan): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $laporan['id_penjualan']?></td>
                                        <td><?= $laporan['id_pesanan']?></td>
                                        <td><?= $laporan['nama_customer']?></td>
                                        <td><?= $laporan['tanggal']?></td>
                                        <td>Rp. <?= number_format($laporan['total'])?></td>
                                    </tr>
                                    <?php endforeach?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Statistik -->
    </section>
</div>
<!-- Modal -->
<?= $this->endSection()?>

<?= $this->section('script')?>
<script>
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var selectedFilter = $('#filter').val();
        var selectedMonth = $('#month').val();
        var selectedYear = $('#year').val();

        var rowDate = data[1];
        var rowMonth = rowDate.split('-')[1];
        var rowYear = rowDate.split('-')[0];

        if (selectedFilter === 'bulan') {
            var fix = rowYear + '-' + rowMonth;

            if (
                (selectedMonth === fix) ||
                (selectedMonth === '') ||
                (fix === '')
            ) {
                return true;
            }
        } else if (selectedFilter === 'tiga-bulan') {
            if (selectedMonth === '' || selectedYear === '') {
                return true; // Return true if either month or year is empty
            }

            var currentDate = new Date();
            var currentYear = currentDate.getFullYear();
            var currentMonth = currentDate.getMonth() + 1; // Adding 1 to get the current month

            var selectedYear = parseInt(selectedYear);
            var selectedMonth = parseInt(selectedMonth);

            var diffMonths = (currentYear - selectedYear) * 12 + (currentMonth - selectedMonth);

            if (diffMonths < 3 || selectedMonth === 0) {
                return true;
            }
        } else if (selectedFilter === 'tahun') {
            if (selectedYear === '') {
                return true; // Return true if year is empty
            }

            var currentDate = new Date();
            var currentYear = currentDate.getFullYear();

            var selectedYear = parseInt(selectedYear);

            if (selectedYear === currentYear) {
                return true;
            }
        }

        return false;
    }
);

$(document).ready(function() {
    // Hide initial select elements
    $('#bulanSelect, #tahunSelect').hide();

    // Show/hide select elements based on filter selection
    $('#filter').on('change', function() {
        var selectedFilter = $(this).val();

        if (selectedFilter === 'bulan') {
            $('#bulanSelect').show();
            $('#tahunSelect').hide();
        } else if (selectedFilter === 'tahun') {
            $('#bulanSelect').hide();
            $('#tahunSelect').show();
        } else {
            $('#bulanSelect, #tahunSelect').hide();
        }
    });

    var table = $('#tableMonth').DataTable({
        "order": [
            [1, "asc"]
        ]
    });

    // Refilter the table
    $('#filter, #month, #year').on('change', function() {
        table.draw();
    });
});
</script>
<script>
function setAction(action) {
    var form = document.getElementById("downloadForm");
    if (action === "cetak") {
        form.action = "<?= base_url('pegawai/laporan-transaksi/create') ?>";
    } else if (action === "unduh") {
        form.action = "<?= base_url('pegawai/laporan-transaksi/unduh') ?>";
    }
}
</script>
<?= $this->endSection()?>