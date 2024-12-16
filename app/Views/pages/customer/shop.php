<?= $this->extend('layouts/admin-panel-customer')?>

<?= $this->section('content')?>
<section class="shop_section layout_padding">

    <div class="container">
        <?php 
            if (session()->getFlashdata('success')) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.session()->getFlashdata('success').'</div>';
            } else if (session()->getFlashdata('error')){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.session()->getFlashdata('error').'</div>';
            }
            ?>
        <div class="heading_container heading_center">
            <style>
            .alert {
                width: 100%;
                padding: 20px;
                margin-bottom: 15px;
                box-sizing: border-box;
            }

            .alert-fade {
                opacity: 0;
                transition: opacity 0.5s ease-out;
            }
            </style>
            <h2>Latest Products</h2>
        </div>
        <div class="row">
            <?php foreach ($produk as $p) : ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="box">
                    <a href="#" class="product-link" data-id="<?= $p['id_produk'];?>" data-toggle="modal"
                        data-target="#productModal<?= $p['id_produk']; ?>">
                        <div class="img-box">
                            <img src="<?= base_url('uploads/photos/' . $p['photo']) ?>" alt="<?= $p['nama_produk']; ?>">
                        </div>
                        <div class="detail-box">
                            <h6><?= $p['nama_produk']; ?></h6>
                            <h6>Price <span><?= $p['harga']; ?></span></h6>
                        </div>
                        <div class="new">
                            <span>New</span>
                        </div>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="btn-box">
            <a href="">View All Products</a>
        </div>
    </div>
</section>
<!-- Modal -->
<?php foreach ($produk as $p) : ?>
<div class="modal fade" id="productModal<?= $p['id_produk']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="productModalLabel<?= $p['id_produk']; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel<?= $p['id_produk']; ?>">Detail Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="productDetail<?= $p['id_produk']; ?>">
                <h5><?= htmlspecialchars($p['nama_produk']); ?></h5>
                <p><?= htmlspecialchars($p['keterangan']); ?></p>
                <p>Harga: <?= htmlspecialchars($p['harga']); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
                <!-- Form untuk mengarahkan ke halaman pesan-baju-create -->
                <form id="buyForm<?= $p['id_produk']; ?>"
                    action="<?= base_url('customer/shop/pesan-barang/') . $p['id_produk'] ?>" method="get">
                    <button type="submit" class="btn btn-primary buy-button">
                        <i class="fa fa-shopping-cart"></i> Buy
                    </button>
                </form>

                <!-- Form untuk Add to Cart -->
                <form id="addToCartForm<?= $p['id_produk']; ?>"
                    action="<?= base_url('customer/cart/add_to_cart/') . $p['id_produk']; ?>" method="get">
                    <button type="submit" class="btn btn-success add-to-cart-button">
                        <i class="fa fa-cart-plus"></i> Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?= $this->endSection() ?>

<!-- Script -->
<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $('.product-link').click(function(e) {
        e.preventDefault();
        var idProduk = $(this).data('id');

        // Ambil detail produk dari server dengan AJAX
        $.ajax({
            type: 'GET',
            url: 'produk/detail/' + idProduk, // Ganti dengan URL yang sesuai
            success: function(response) {
                // Tampilkan detail produk di modal yang sesuai
                $('#productDetail' + idProduk).html(response);
                // Tampilkan modal yang sesuai
                $('#productModal' + idProduk).modal('show');
            },
            error: function(error) {
                console.error('Error:', error);
                $('#productDetail' + idProduk).html('<p>Produk tidak ditemukan.</p>');
                $('#productModal' + idProduk).modal('show');
            }
        });
    });

    $('.add-to-cart').click(function() {
        // Logic untuk menambahkan produk ke keranjang belanja
        alert('Produk telah ditambahkan ke keranjang.');
    });
});

document.addEventListener("DOMContentLoaded", function() {
    setInterval(function() {
        location.reload();
    }, 1000); // 1000 milidetik = 1 detik
});
</script>
<?= $this->endSection() ?>