<!DOCTYPE html>
<meta http-equiv="refresh" content="1;url=<?=base_url('pegawai/laporan-transaksi')?>">

<head>
    <title><?= $title?> - <?= date('d-m-Y')?></title>
    <link href="<?= base_url('assets/css/styles.css')?>" rel="stylesheet" />
</head>
<style>
.custom-table {
    border-collapse: collapse;
    width: 100%;
    max-width: 650px;
}

.custom-table thead {
    background-color: #ffff99;
    border: 1px solid #000;
}

.custom-table th,
.custom-table td {
    text-align: left;
    padding: 8px;
    border: 1px solid #000;
}

.custom-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #FAFAFA;
    font: 12pt "Time News Roman";
    line-height: 1.3;
}

* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}

.page {
    width: 210mm;
    min-height: 297mm;
    padding: 15mm;
    margin: 10mm auto;
    border: 1px #D3D3D3 solid;
    border-radius: 5px;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    position: relative;
}

.subpage {
    padding: 1cm;
    border: 5px red solid;
    height: 257mm;
    outline: 2cm #FFEAEA solid;
}


@page {
    size: A4;
    margin: 0;
}

@media print {

    html,
    body {
        width: 210mm;
        height: 330mm;
    }

    .page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
    }

    .ratatengah {
        text-align: justify;
        text-indent: 0.5in;
    }
}
</style>
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script language="JavaScript">
var tanggallengkap = new String();
var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
namahari = namahari.split(" ");
var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
namabulan = namabulan.split(" ");
var tgl = new Date();
var hari = tgl.getDay();
var tanggal = tgl.getDate();
var bulan = tgl.getMonth();
var tahun = tgl.getFullYear();
tanggallengkap = tanggal + " " + namabulan[bulan] + " " + tahun;
</script>

<body onload="window.print()">
    <div class="page">
        <center>
            </table>
            <table width="650" style="margin-top: 10px;">
                <tr>
                    <td><?= $title?> Deyinn <br> Bulan
                        <?= date('F, Y', strtotime($laporanTerjual[0]['tanggal']))?></td>
                </tr>
            </table>
            <br>
            <table width="650" style="margin-top: 10px;" class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pesanan</th>
                        <td>Nama Customer</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    $total_akhir = 0; // Inisialisasi variabel untuk menghitung total akhir
                    foreach ($laporanTerjual as $laporan):
                        $total_akhir += $laporan['total']; // Tambahkan total transaksi ke total akhir
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $laporan['id_pesanan'] ?></td>
                        <td><?= $laporan['nama_customer'] ?></td>
                        <td><?= $laporan['tanggal'] ?></td>
                        <td><?= $laporan['status'] ?></td>
                        <td>Rp. <?= number_format($laporan['total']) ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="border: none;"></td>
                        <td>Total</td>
                        <td>
                            <?= "Rp. " . number_format($total_akhir) ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </center>
        <br>
        <table>
            <tr>
                <td align="left">Di cetak pada : <?= date('d-m-Y')?></td>
            </tr>
        </table>
    </div>
</body>