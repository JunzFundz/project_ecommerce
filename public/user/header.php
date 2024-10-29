<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.ayroui.com/1.0/css/bootstrap.min.css" />
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.ayroui.com/1.0/css/starter.css" />

    <style>
        body {
            background: rgb(255,255,255);
            background: linear-gradient(24deg, rgba(255,255,255,1) 0%, rgba(227,132,132,1) 100%); 
        }

        .yellow-star {
            color: #FFD700;
        }

        .item--rating {
            font-size: 2rem;
        }

        .features-style-one .primary-btn-outline {
            border-color: var(--primary);
            color: var(--primary);
        }

        .features-style-one .active.primary-btn-outline,
        .features-style-one .primary-btn-outline:hover,
        .features-style-one .primary-btn-outline:focus {
            background: var(--primary-dark);
            color: var(--white);
        }

        .features-style-one .deactive.primary-btn-outline {
            color: var(--dark-3);
            border-color: var(--gray-4);
            pointer-events: none;
        }

        .features-one {
            padding-top: 120px;
            padding-bottom: 120px;
        }

        .features-one .section-title {
            padding-bottom: 10px;
        }

        .features-one .title {
            font-size: 44px;
            font-weight: 600;
            color: #297300;
            line-height: 55px;
        }

        @media (max-width: 767px) {
            .features-one .title {
                font-size: 30px;
                line-height: 35px;
            }
        }

        .features-one .text {
            font-size: 16px;
            line-height: 24px;
            color: var(--dark-3);
            margin-top: 24px;
        }

        .features-style-one {
            background-color: var(--white);
            padding: 40px 20px;
            margin-top: 40px;
            box-shadow: var(--shadow-2);
            border-radius: 4px;
            transition: all 0.3s;
        }

        .features-style-one:hover {
            box-shadow: var(--shadow-4);
        }

        .features-style-one .features-icon {
            position: relative;
            display: inline-block;
            z-index: 1;
            height: 100px;
            width: 100px;
            line-height: 100px;
            text-align: center;
            font-size: 40px;
            color: var(--primary);
            border: 2px solid rgba(187, 187, 187, 0.192);
            border-radius: 50%;
            -webkit-transition: all 0.3s ease-out 0s;
            -moz-transition: all 0.3s ease-out 0s;
            -ms-transition: all 0.3s ease-out 0s;
            -o-transition: all 0.3s ease-out 0s;
            transition: all 0.3s ease-out 0s;
        }

        @media (max-width: 767px) {
            .features-style-one .features-icon {
                height: 70px;
                width: 70px;
                line-height: 70px;
                font-size: 35px;
            }
        }

        .features-style-one:hover .features-icon {
            border-color: transparent;
            color: var(--white);
        }

        .features-style-one .features-content {
            margin-top: 24px;
        }

        .features-style-one .features-title {
            font-size: 26px;
            line-height: 35px;
            font-weight: 600;
            color: var(--black);
            -webkit-transition: all 0.3s ease-out 0s;
            -moz-transition: all 0.3s ease-out 0s;
            -ms-transition: all 0.3s ease-out 0s;
            -o-transition: all 0.3s ease-out 0s;
            transition: all 0.3s ease-out 0s;
        }

        @media only screen and (min-width: 992px) and (max-width: 1199px),
        (max-width: 767px) {
            .features-style-one .features-title {
                font-size: 22px;
            }
        }

        .features-style-one .text {
            color: var(--dark-3);
            margin-top: 16px;
        }

        .features-style-one .features-btn {
            margin-top: 32px;
        }

        a {
            text-decoration: none !important;
        }

        .primary-btn {
            background: var(--primary);
            color: var(--white);
            box-shadow: var(--shadow-2);
        }

        .active.primary-btn,
        .primary-btn:hover,
        .primary-btn:focus {
            background: white;
            color: var(--white);
            box-shadow: var(--shadow-4);
        }

        .deactive.primary-btn {
            background: var(--gray-4);
            color: var(--dark-3);
            pointer-events: none;
        }

        .primary-btn-outline {
            border-color: var(--primary);
            color: var(--primary);
        }

        .active.primary-btn-outline,
        .primary-btn-outline:hover,
        .primary-btn-outline:focus {
            background: var(--primary-dark);
            color: var(--white);
        }

        .deactive.primary-btn-outline {
            color: var(--dark-3);
            border-color: var(--gray-4);
            pointer-events: none;
        }

        .navbar-one {
            background: white;
            -webkit-box-shadow: -4.5px 1px 16px 1.5px #dddddd;
            -moz-box-shadow: -4.5px 1px 16px 1.5px #dddddd;
            box-shadow: -4.5px 1px 16px 1.5px #dddddd;
        }

        /* @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one {
                padding: 20px 0;
            }
        } */

        .navbar-one .navbar {
            position: relative;
            padding: 0;
        }

        .navbar-one .navbar .navbar-toggler .toggler-icon {
            width: 30px;
            height: 2px;
            background-color: #467326;
            margin: 5px 0;
            display: block;
            position: relative;
            -webkit-transition: all 0.3s ease-out 0s;
            -moz-transition: all 0.3s ease-out 0s;
            -ms-transition: all 0.3s ease-out 0s;
            -o-transition: all 0.3s ease-out 0s;
            transition: all 0.3s ease-out 0s;
        }

        .navbar-one .navbar .navbar-toggler.active .toggler-icon:nth-of-type(1) {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
            top: 7px;
        }

        .navbar-one .navbar .navbar-toggler.active .toggler-icon:nth-of-type(2) {
            opacity: 0;
        }

        .navbar-one .navbar .navbar-toggler.active .toggler-icon:nth-of-type(3) {
            -webkit-transform: rotate(135deg);
            -moz-transform: rotate(135deg);
            -ms-transform: rotate(135deg);
            -o-transform: rotate(135deg);
            transform: rotate(135deg);
            top: -7px;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one .navbar .navbar-collapse {
                position: absolute;
                top: 140%;
                left: 0;
                width: 100%;
                background-color: white;
                z-index: 8;
                padding: 10px 0;
                border-radius: 0 0 5px 5px;
            }
        }

        .navbar-one .navbar .navbar-nav .nav-item {
            margin: 0 5px;
            position: relative;
        }

        .navbar-one .navbar .navbar-nav .nav-item a {
            font-size: 16px;
            line-height: 24px;
            font-weight: 600;
            padding: 28px 15px;
            color: #467326;
            text-transform: capitalize;
            position: relative;
            display: flex;
            align-items: center;
            z-index: 0;
            -webkit-transition: all 0.3s ease-out 0s;
            -moz-transition: all 0.3s ease-out 0s;
            -ms-transition: all 0.3s ease-out 0s;
            -o-transition: all 0.3s ease-out 0s;
            transition: all 0.3s ease-out 0s;
        }

        .navbar-one .navbar .navbar-nav .nav-item a::before {
            position: absolute;
            content: "";
            left: 0;
            bottom: 0;
            height: 100%;
            width: 0%;
            background-color: #A0D94A;
            opacity: 0;
            visibility: hidden;
            z-index: -1;
            -webkit-transition: all 0.3s ease-out 0s;
            -moz-transition: all 0.3s ease-out 0s;
            -ms-transition: all 0.3s ease-out 0s;
            -o-transition: all 0.3s ease-out 0s;
            transition: all 0.3s ease-out 0s;
        }

        .navbar-one .navbar .navbar-nav .nav-item a.active::before {
            opacity: 0.1;
            visibility: visible;
            width: 100%;
        }

        .navbar-one .navbar .navbar-nav .nav-item a:hover::before {
            opacity: 0.1;
            visibility: visible;
            width: 100%;
        }

        .navbar-one .navbar .navbar-nav .nav-item a i {
            font-weight: 700;
            padding-left: 8px;
            font-size: 14px;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one .navbar .navbar-nav .nav-item a {
                padding: 10px 10px;
                display: block;
            }

            .navbar-one .navbar .navbar-nav .nav-item a::before {
                border-radius: 5px;
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one .navbar .navbar-nav .nav-item {
                margin-bottom: 5px;
            }

            .navbar-one .navbar .navbar-nav .nav-item:last-child {
                margin-bottom: 0;
            }
        }

        .navbar-one .navbar .navbar-nav .nav-item .sub-menu {
            position: absolute;
            left: 0;
            top: 100%;
            width: 260px;
            background-color: var(--white);
            box-shadow: var(--shadow-4);
            border-radius: 5px;
            opacity: 0;
            visibility: hidden;
            -webkit-transition: all 0.3s ease-out 0s;
            -moz-transition: all 0.3s ease-out 0s;
            -ms-transition: all 0.3s ease-out 0s;
            -o-transition: all 0.3s ease-out 0s;
            transition: all 0.3s ease-out 0s;
            z-index: 99;
            padding: 10px;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one .navbar .navbar-nav .nav-item .sub-menu {
                position: relative !important;
                width: 100% !important;
                left: 0 !important;
                top: auto !important;
                opacity: 1 !important;
                visibility: visible !important;
                right: auto;
                -webkit-transform: translateX(0%);
                -moz-transform: translateX(0%);
                -ms-transform: translateX(0%);
                -o-transform: translateX(0%);
                transform: translateX(0%);
                -webkit-transition: all none ease-out 0s;
                -moz-transition: all none ease-out 0s;
                -ms-transition: all none ease-out 0s;
                -o-transition: all none ease-out 0s;
                transition: all none ease-out 0s;
                box-shadow: none;
                text-align: left;
                border-top: 0;
                height: 0;
            }
        }

        .navbar-one .navbar .navbar-nav .nav-item .sub-menu.collapse:not(.show) {
            height: auto;
            display: block;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one .navbar .navbar-nav .nav-item .sub-menu.collapse:not(.show) {
                height: 0;
                display: none;
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one .navbar .navbar-nav .nav-item .sub-menu.show {
                height: auto;
            }
        }

        .navbar-one .navbar .navbar-nav .nav-item .sub-menu li {
            position: relative;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a {
                border-radius: 5px !important;
            }
        }

        .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 24px;
            font-weight: 500;
            position: relative;
            color: #467326;
            -webkit-transition: all 0.3s ease-out 0s;
            -moz-transition: all 0.3s ease-out 0s;
            -ms-transition: all 0.3s ease-out 0s;
            -o-transition: all 0.3s ease-out 0s;
            transition: all 0.3s ease-out 0s;
            z-index: 5;
            text-transform: capitalize;
            border-radius: 5px;
        }

        .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a:hover {
            background-color: #467326;
            color: var(--white);
        }

        .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a::before {
            display: none;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a:hover {
                background-color: #467326;
                color: var(--white);
            }

            .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a i {
                color: #467326;
                -webkit-transition: all 0.3s ease-out 0s;
                -moz-transition: all 0.3s ease-out 0s;
                -ms-transition: all 0.3s ease-out 0s;
                -o-transition: all 0.3s ease-out 0s;
                transition: all 0.3s ease-out 0s;
            }

            .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a:hover i {
                color: #467326;
            }
        }

        .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a i {
            font-size: 14px;
            font-weight: 700;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a i {
                display: none;
            }
        }

        .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a .sub-nav-toggler i {
            display: inline-block;
        }

        .navbar-one .navbar .navbar-nav .nav-item .sub-menu li .sub-menu {
            right: auto;
            left: 100%;
            top: 0;
            opacity: 0;
            visibility: hidden;
            -webkit-transition: all 0.3s ease-out 0s;
            -moz-transition: all 0.3s ease-out 0s;
            -ms-transition: all 0.3s ease-out 0s;
            -o-transition: all 0.3s ease-out 0s;
            transition: all 0.3s ease-out 0s;
        }

        @media only screen and (min-width: 1200px) and (max-width: 1399px),
        only screen and (min-width: 1400px) {
            .navbar-one .navbar .navbar-nav .nav-item .sub-menu li .sub-menu {
                margin-left: 10px;
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one .navbar .navbar-nav .nav-item .sub-menu li .sub-menu {
                padding-left: 30px;
                height: 0;
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one .navbar .navbar-nav .nav-item .sub-menu li .sub-menu.show {
                visibility: visible;
                height: auto;
                position: relative;
            }
        }

        .navbar-one .navbar .navbar-nav .nav-item .sub-menu li:hover .sub-menu {
            opacity: 1;
            visibility: visible;
            height: auto;
        }

        .navbar-one .navbar .navbar-nav .nav-item:hover .sub-menu {
            opacity: 1;
            visibility: visible;
            height: auto;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one .navbar .navbar-nav .nav-item .sub-nav-toggler {
                display: inline-block;
                position: absolute;
                top: 0;
                right: 0;
                padding: 10px 14px;
                font-size: 16px;
                background: none;
                border: 0;
                color: #467326;
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .navbar-one .navbar .navbar-btn {
                position: absolute;
                right: 70px;
                top: 3px;
            }
        }

        @media (max-width: 767px) {
            .navbar-one .navbar .navbar-btn {
                position: absolute;
                right: 60px;
                top: 3px;
            }
        }

        .navbar-one .navbar .navbar-btn ul {
            display: flex;
        }

        .navbar-one .navbar .navbar-btn ul li {
            display: inline-block;
            margin-right: 12px;
        }

        .navbar-one .navbar .navbar-btn ul li a {
            font-weight: 600;
            text-transform: capitalize;
            letter-spacing: 0;
        }

        .navbar-one .navbar .navbar-btn ul li a.primary-btn-outline {
            border-color: var(--white);
            color: var(--white);
        }

        .navbar-one .navbar .navbar-btn ul li a.primary-btn-outline:hover {
            background-color: var(--white);
            color: var(--primary);
        }

        .navbar-one .navbar .navbar-btn ul li a.primary-btn {
            background-color: var(--white);
            color: #467326;
            border-color: var(--white);
        }

        .navbar-one .navbar .navbar-btn ul li a.primary-btn:hover {
            background-color: transparent;
            color: var(--white);
        }
    </style>

</head>
<body oncontextmenu="return false;">

    <div class="modal fade" tabindex="-1" id="forgot-pass" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">New password</label>
                        <input type="hidden" class="form-control" id="user_id" value="<?php echo $_SESSION['user_id'] ?>" />
                        <input type="email" class="form-control" id="n_pass" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm password</label>
                        <input type="password" class="form-control" id="c_pass" />
                    </div>
                    <div class="text-end">
                        <button type="button" name="confirm" class="btn btn-primary btn-change-pass">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="navbar-area navbar-one">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="index.php">
                            <img src="../logo.png" alt="Logo" width="150" height="80" />
                        </a>
                        <button
                            class="navbar-toggler"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarOne"
                            aria-controls="navbarOne"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarOne">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item">
                                    <a href="index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="products.php">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="page-scroll active"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#sub-nav1"
                                        aria-controls="sub-nav1"
                                        aria-expanded="false"
                                        aria-label="Toggle navigation"
                                        href="javascript:void(0)">
                                        Options
                                        <div class="sub-nav-toggler">
                                            <span><i class="lni lni-chevron-down"></i></span>
                                        </div>
                                    </a>
                                    <ul class="sub-menu collapse" id="sub-nav1">
                                        <li><a href="cart.php">Cart</a></li>
                                        <li><a href="purchase.php">My purchase</a></li>
                                        <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#forgot-pass">Change password</a></li>
                                        <li><a href="../logout.php">Logout</a></li>
                                        <!-- <li>
                                            <a
                                                class="page-scroll"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#sub-nav2"
                                                aria-controls="sub-nav2"
                                                aria-expanded="false"
                                                aria-label="Toggle navigation"
                                                href="javascript:void(0)">
                                                Settings
                                                <div class="sub-nav-toggler">
                                                    <span><i class="lni lni-chevron-down"></i></span>
                                                </div>
                                            </a>
                                            <ul class="sub-menu collapse" id="sub-nav2">
                                                <li>
                                                    <a href="javascript:void(0)">Profile</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Information</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Logout</a>
                                                </li>
                                            </ul>
                                        </li> -->
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- <div class="navbar-btn d-none d-sm-inline-block">
                            <ul>
                                <li>
                                    <a class="btn primary-btn-outline" href="javascript:void(0)">Sign In</a>
                                </li>
                                <li>
                                    <a class="btn primary-btn" href="javascript:void(0)">Sign Up</a>
                                </li>
                            </ul>
                        </div> -->
                    </nav>
                    <!-- navbar -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>

    <script src="https://cdn.ayroui.com/1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        $('.btn-change-pass').on('click', function(event) {
            event.preventDefault();

            const npass = $('#n_pass').val();
            const cpass = $('#c_pass').val();
            const user_id = $('#user_id').val();

            if (npass != cpass) {
                alert('Password and confirm password do not match');
                return;
            }
            if (npass == "" || cpass == "") {
                alert('Password required');
                return;
            }

            $.ajax({
                url: '../../database/signin.php',
                method: 'POST',
                data: {
                    'confirm_newpass': true,
                    cpass: cpass,
                    user_id: user_id
                },
                success: function(response) {
                    Swal.fire({
                        title: "Password updated",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
    <script>
        let navbarTogglerOne = document.querySelector(
            ".navbar-one .navbar-toggler"
        );
        navbarTogglerOne.addEventListener("click", function() {
            navbarTogglerOne.classList.toggle("active");
        });
    </script>