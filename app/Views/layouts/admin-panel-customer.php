<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="<?= base_url()?>/assets-shop/images/favicon.png" type="image/x-icon">

    <title>
        Giftos
    </title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets-shop/css/bootstrap.css" />
    <style>
    .user-photo {
        width: 30px;
        /* Ubah ukuran lebar gambar */
        height: 30px;
        /* Ubah ukuran tinggi gambar */
        object-fit: cover;
        margin-right: 10px;
    }
    </style>

    <!-- Custom styles for this template -->
    <link href="<?= base_url()?>/assets-shop/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="<?= base_url()?>/assets-shop/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="index.html">
                    <span>
                        Deyinn Shop
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class=""></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li
                            class="nav-item <?= (current_url(true)->getPath() == 'customer/dashboard') ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?= base_url('customer/dashboard')?>">Home <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?= (current_url(true)->getPath() == 'customer/shop') ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?= base_url('customer/shop')?>">Shop</a>
                        </li>
                        <li class="nav-item <?= (current_url(true)->getPath() == 'customer/order') ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?= base_url('customer/order')?>">Order</a>
                        </li>
                        <li
                            class="nav-item <?= (current_url(true)->getPath() == 'customer/payment') ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?= base_url('customer/payment')?>">Payment</a>
                        </li>
                        <div class="user_option">
                            <a href="<?= base_url('customer/cart') ?>">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            </a>
                        </div>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= session()->get('nama_customer');?>
                                <img src="<?= base_url('uploads/profiles/' . session()->get('foto_profil')) ?>"
                                    class="rounded-circle user-photo">
                                <span class="badge badge-primary">Point Anda : <?= session()->get('point'); ?></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?= base_url('customer/profile')?>">Profile</a>
                                <a class="dropdown-item" href="<?= base_url('/contact')?>">Contact Support</a>
                                <a class="dropdown-item" href="<?= base_url('/logout/customer')?>">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- end header section -->
        <!-- slider section -->



        <!-- end slider section -->
    </div>
    <!-- end hero area -->

    <!-- shop section -->
    <?= $this->renderSection('content')?>
    <!-- end shop section -->
    <!-- info section -->


    <!-- footer section -->
    <footer class=" footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayYear"></span> Deyinn Shop
            </p>
        </div>
    </footer>
    <!-- footer section -->

    <!-- end info section -->

    <script>
    $(document).ready(function() {
        // Menggunakan jQuery untuk menambahkan kelas 'active' saat link di-klik
        $('.navbar-nav .nav-link').on('click', function() {
            $('.navbar-nav').find('.active').removeClass('active');
            $(this).addClass('active');
        });
    });
    </script>
    <script src="<?= base_url()?>/assets-shop/js/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url()?>/assets-shop/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <script src="<?= base_url()?>/assets-shop/js/custom.js"></script>
    <script>
    $(document).ready(function() {
        console.log("jQuery is loaded.");
        $('.dropdown-toggle').dropdown();
    });
    </script>
</body>

</html>