<?php

session_start();

$id = $_SESSION['user_id'];
$mobile = $_SESSION['mobile'];
require_once('../../database/user_show_data.php');
?>



<?php include 'header.php' ?>

<style>
    .slider-three {
        background-color: var(--light-2);
        padding-top: 60px;
        padding-bottom: 70px;
    }

    .slider-three .section-title .title {
        font-size: 44px;
        line-height: 55px;
        font-weight: 600;
        color: var(--black);
    }

    @media (max-width: 767px) {
        .slider-three .section-title .title {
            font-size: 28px;
            line-height: 32px;
        }
    }

    .slider-three .section-title .text {
        color: var(--dark-3);
        margin-top: 24px;
    }

    .slider-three .slider-items-wrapper {
        position: relative;
    }

    .slider-three .slider-items-wrapper .tns-nav {
        width: 100%;
        z-index: 2;
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }

    .slider-three .slider-items-wrapper .tns-nav button {
        width: 10px;
        height: 10px;
        border-radius: 50px;
        background-color: var(--primary);
        opacity: 0.5;
        border: 0;
        margin: 0 5px;
        -webkit-transition: all 0.4s ease-out 0s;
        -moz-transition: all 0.4s ease-out 0s;
        -ms-transition: all 0.4s ease-out 0s;
        -o-transition: all 0.4s ease-out 0s;
        transition: all 0.4s ease-out 0s;
    }

    .slider-three .slider-items-wrapper .tns-nav button.tns-nav-active {
        width: 20px;
        opacity: 1;
        border-radius: 5px;
    }

    .slider-three .single-items-one {
        margin-top: 40px;
    }

    .slider-three .single-items-one img {
        width: 100%;
        box-shadow: var(--shadow-2);
        border-radius: 10px;
    }

    .single-card {
        box-shadow: var(--shadow-1);
        border-radius: 8px;
        overflow: hidden;
        margin-top: 30px;
        -webkit-transition: all 0.3s ease-out 0s;
        -moz-transition: all 0.3s ease-out 0s;
        -ms-transition: all 0.3s ease-out 0s;
        -o-transition: all 0.3s ease-out 0s;
        transition: all 0.3s ease-out 0s;
    }

    .single-card:hover {
        box-shadow: var(--shadow-4);
    }

    .single-card .card-image img {
        object-fit: contain;
        aspect-ratio: 3/2;
        width: 70rem;
    }

    .single-card .card-content {
        padding: 16px;
    }

    .single-card .card-content .card-title {
        margin-bottom: 0;
    }

    .single-card .card-content .card-title a {
        color: var(--black);
        -webkit-transition: all 0.3s ease-out 0s;
        -moz-transition: all 0.3s ease-out 0s;
        -ms-transition: all 0.3s ease-out 0s;
        -o-transition: all 0.3s ease-out 0s;
        transition: all 0.3s ease-out 0s;
    }

    .single-card .card-content .card-title a:hover {
        color: var(--primary);
    }

    .single-card .card-content .text {
        color: var(--dark-3);
        margin-top: 8px;
    }
</style>

<link rel="stylesheet" href="https://cdn.ayroui.com/1.0/css/tiny-slider.css" />

<section class="slider-three">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <h3 class="title">Friendly & Easy</h3>
                    <p class="text">
                        Stop wasting time and money designing and managing a website
                        that doesn’t get results. Happiness guaranteed!
                    </p>
                </div>
            </div>
        </div>
        <!-- row -->

        <div class="slider-items-wrapper">
            <div class="row slider-items-active">
                <div class="col-lg-4">
                    <div class="single-items-one">
                        <img src="https://cdn.ayroui.com/1.0/images/slider/slider-items-one.jpg" alt="Image" />
                    </div>
                    <!-- single-items-one -->
                </div>
                <div class="col-lg-4">
                    <div class="single-items-one">
                        <img src="https://cdn.ayroui.com/1.0/images/slider/slider-items-two.jpg" alt="Image" />
                    </div>
                    <!-- single-items-one -->
                </div>
                <div class="col-lg-4">
                    <div class="single-items-one">
                        <img src="https://cdn.ayroui.com/1.0/images/slider/slider-items-three.jpg" alt="Image" />
                    </div>
                    <!-- single-items-one -->
                </div>
                <div class="col-lg-4">
                    <div class="single-items-one">
                        <img src="https://cdn.ayroui.com/1.0/images/slider/slider-items-two.jpg" alt="Image" />
                    </div>
                    <!-- single-items-one -->
                </div>
            </div>
            <!-- row -->
        </div>
    </div>
    <!-- container -->
</section>

<div class="group-buttons justify-content-center" style="display: flex; flex-wrap: wrap; padding-top: 50px">
    <div class="">
        <?php foreach ($cat as $rows) : ?>
            <a data-id="<?= htmlspecialchars($rows['c_id'], ENT_QUOTES, 'UTF-8') ?>" class="btn primary-btn btn-click-on"><?= htmlspecialchars($rows['cat'], ENT_QUOTES, 'UTF-8') ?></a>
        <?php endforeach; ?>
    </div>
</div>

<section class="card-area pb-5">
    <div class="container datadist">
        <?php if (!empty($items)) : ?>
            <div class="row justify-content-center">
                <?php foreach ($items as $rows) : ?>
                    <div class="col-lg-3 col-sm-6 ">
                        <a href="item.php?item=<?= htmlspecialchars($rows['i_img']) ?>" style="color: black; text-decoration: none">
                            <div class="single-card card-style-one">
                                <div class="card-image">
                                    <?php
                                    $images = json_decode($rows['img'], true);
                                    $firstImage = !empty($images) && is_array($images) ? htmlspecialchars($images[0], ENT_QUOTES, 'UTF-8') : 'default.jpg';
                                    ?>
                                    <img
                                        src="../../uploads/<?= $firstImage ?>"
                                        alt="Product Image">
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">
                                        <a href="javascript:void(0)"><?= htmlspecialchars($rows['name'], ENT_QUOTES, 'UTF-8') ?></a>
                                    </h4>
                                    <p class="text">
                                        &#8369; <?= number_format(htmlspecialchars($rows['price'], ENT_QUOTES, 'UTF-8'), 2) ?>
                                    </p>
                                    <p class="text">
                                        Short description for the ones who look for something new
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>No products available.</p>
        <?php endif; ?>
    </div>
</section>

<script src="https://cdn.ayroui.com/1.0/js/tiny-slider.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    tns({
        autoplay: true,
        autoplayButtonOutput: false,
        mouseDrag: true,
        gutter: 0,
        container: ".slider-items-active",
        center: false,
        nav: true,
        navPosition: "bottom",
        controls: false,
        speed: 400,
        controlsText: [
            '<i class="lni lni-arrow-left-circle"></i>',
            '<i class="lni lni-arrow-right-circle"></i>',
        ],
        responsive: {
            0: {
                items: 1,
            },

            768: {
                items: 2,
            },
            992: {
                items: 3,
            },
        },
    });

    $(document).ready(function() {
        let isScrolling;
        $(document).scroll(function() {
            clearTimeout(isScrolling);
            isScrolling = setTimeout(() => {
                const $nav = $("#mainNavbar");
                $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
            }, 100);
        });

        $('.btn-click-on').on('click', function(e) {
            e.preventDefault();

            const id = $(this).data('id');
            if (!id || isNaN(id)) {
                console.error('Invalid category ID');
                return;
            }
            console.log(id);

            $('.btn-click-on').removeClass('active');
            $(this).addClass('btn-discovery');

            $.ajax({
                url: "category.php",
                type: "post",
                data: {
                    'id': id
                },
                success: function(data) {
                    $('.datadist').html(data);
                },
                error: function(xhr, status, error) {
                    console.error('An error occurred: ' + status + ' - ' + error);
                }
            });
        });

        $(".mobile-options").on('click', function() {
            $(".navbar-container .nav-right").slideToggle('slow');
        });

        $(".search-btn").on('click', function() {
            $(".main-search").addClass('open');
            $('.main-search .form-control').animate({
                'width': '200px',
            });
        });

        $(".search-close").on('click', function() {
            $('.main-search .form-control').animate({
                'width': '0',
            });
            setTimeout(function() {
                $(".main-search").removeClass('open');
            }, 100);
        });
    });

    function toggleFullScreen() {
        var a = $(window).height() - 10;

        if (!document.fullscreenElement &&
            !document.mozFullScreenElement && !document.webkitFullscreenElement) {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
        }
        $('.full-screen').toggleClass('icon-maximize');
        $('.full-screen').toggleClass('icon-minimize');
    }
</script>

<?php include 'footer.php' ?>