<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <style>
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
            background: var(--primary-dark);
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
            background: var(--primary);
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
            background-color: var(--white);
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
                background-color: var(--primary);
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
            color: var(--white);
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
            background-color: var(--white);
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
            color: var(--dark);
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
            background-color: var(--primary);
            color: var(--white);
        }

        .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a::before {
            display: none;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a:hover {
                background-color: var(--primary-dark);
                color: var(--white);
            }

            .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a i {
                color: var(--primary-dark);
                -webkit-transition: all 0.3s ease-out 0s;
                -moz-transition: all 0.3s ease-out 0s;
                -ms-transition: all 0.3s ease-out 0s;
                -o-transition: all 0.3s ease-out 0s;
                transition: all 0.3s ease-out 0s;
            }

            .navbar-one .navbar .navbar-nav .nav-item .sub-menu li a:hover i {
                color: var(--white);
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
                color: var(--white);
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
            color: var(--primary);
            border-color: var(--white);
        }

        .navbar-one .navbar .navbar-btn ul li a.primary-btn:hover {
            background-color: transparent;
            color: var(--white);
        }
    </style>
    <title>MyPurchase</title>
    <link rel="stylesheet" href="https://cdn.ayroui.com/1.0/css/bootstrap.min.css" />
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.ayroui.com/1.0/css/starter.css" />
</head>

<body>

    <section class="navbar-area navbar-one">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="javascript:void(0)">
                            <img src="../logo.png" alt="Logo" width="90" height="60" />
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
                                    <a href="javascript:void(0)">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a href="testimonial.php">Ratings</a>
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
                                        <li><a href="javascript:void(0)">Logout</a></li>
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

    <script>
        let navbarTogglerOne = document.querySelector(
            ".navbar-one .navbar-toggler"
        );
        navbarTogglerOne.addEventListener("click", function() {
            navbarTogglerOne.classList.toggle("active");
        });
    </script>
</body>

</html>