<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h2>Invoice</h2>
                            </td>
                            <td>
                                Invoice #: <?= htmlspecialchars($pesanan['id_pesanan']); ?><br>
                                Tanggal: <?= date('d-m-Y', strtotime($pesanan['tanggal'])); ?><br>
                                Status: <?= ucfirst($pesanan['status']); ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Nama Produk:<br>
                                <?php if (isset($orderDetails[$pesanan['id_pesanan']])) : ?>
                                    <?php foreach ($orderDetails[$pesanan['id_pesanan']] as $detail) : ?>
                                        <?= $detail['id_produk'] . ' - ' . htmlspecialchars($detail['nama_produk']); ?><br>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                Total: Rp. <?= number_format($pesanan['total'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                Nama Customer: <?= htmlspecialchars($pembayaran['nama_customer']); ?><br>
                                Alamat: <?= htmlspecialchars($pembayaran['alamat_customer']); ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Bukti Pembayaran</td>
                <td>Status</td>
            </tr>

            <tr class="details">
                <td>
                    <?php if ($pembayaran['bukti_pembayaran'] !== 'Tidak ada Data') : ?>
                        <a href="<?= base_url('uploads/bukti_pembayaran/' . $pembayaran['bukti_pembayaran']); ?>" target="_blank">Lihat Bukti</a>
                    <?php else : ?>
                        Belum Melakukan Pembayaran
                    <?php endif; ?>
                </td>
                <td><?= ucfirst($pembayaran['status']); ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
