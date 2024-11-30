<?php
require_once('../database/user_show_data.php');
include('header.php');
?>

<link rel="stylesheet" href="https://cdn.ayroui.com/1.0/css/tiny-slider.css" />
<link rel="stylesheet" href="style.css">

<div class="modal fade" tabindex="-1" id="forgot-pass" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal-style">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
            </div>
            <div class="modal-body">
                <form action="../database/signin.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" />
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Mobile Number</label>
                        <input
                            type="tel"
                            class="form-control"
                            name="number"
                            id="number"
                            pattern="^[0-9]{11}$"
                            placeholder="Enter 11-digit mobile number"
                            maxlength="11"
                            required />
                    </div>


                    <div class="text-end">
                        <button type="submit" name="confirm" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="login" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content custom-modal-style">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order here</h5>
            </div>
            <div class="modal-body">
                <form action="../database/signin.php" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label">Phone</label>
                        <input type="text" class="form-control id_mobile" name="mobile" />
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="pass" class="form-control id_pass" id="exampleInputPassword1" />
                    </div>

                    <div class="text-end">
                        <button type="submit" name="signin" class="btn btn-primary signin-user">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="slider-three">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <br>
                    <p class="text custom-text-style">
                        We offer and provide authentic Korean products. Experience the best quality skincare and cosmetics made by one of the best technology in the world
                    </p>
                    <br>
                </div>
            </div>
        </div>
        <!-- row -->

        <div class="slider-items-wrapper">
            <div class="row slider-items-active">
                <div class="col-lg-4">
                    <div class="single-items-one">
                        <img src="../public/img/l1.JPG" alt="Image" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-items-one">
                        <img src="../public/img/l2.JPG" alt="Image" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-items-one">
                        <img src="../public/img/l3.JPG" alt="Image" />
                    </div>
                    <!-- single-items-one -->
                </div>
                <div class="col-lg-4">
                    <div class="single-items-one">
                        <img src="../public/img/l4.JPG" alt="Image" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<h4 class="text-center">Categories</h4>
<div class="group-buttons justify-content-center cat-style" style="display: flex; flex-wrap: wrap; padding-top: 20px">
    <div class="">
        <?php foreach ($cat as $rows) : ?>
            <a data-id="<?= htmlspecialchars($rows['c_id'], ENT_QUOTES, 'UTF-8') ?>" class="button-style btn-click-on" style="padding: 5px;"><?= htmlspecialchars($rows['cat'], ENT_QUOTES, 'UTF-8') ?></a>
        <?php endforeach; ?>
    </div>
</div>

<section class="card-area pb-5">
    <div class="container datahtml">
        <?php if (!empty($items)) : ?>
            <div class="row justify-content-center">
                <?php foreach ($items as $rows) : ?>
                    <div class="col-lg-3 col-sm-6 card-bg">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#login" style="color: black; text-decoration: none">
                            <div class="single-card card-style-one">
                                <div class="card-image">
                                    <?php
                                    $images = json_decode($rows['img'], true);
                                    $firstImage = !empty($images) && is_array($images) ? htmlspecialchars($images[0], ENT_QUOTES, 'UTF-8') : 'default.jpg';
                                    ?>
                                    <img
                                        src="../uploads/<?= $firstImage ?>"
                                        alt="Product Image">
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">
                                        <a href="javascript:void(0)"><?= htmlspecialchars($rows['name'], ENT_QUOTES, 'UTF-8') ?></a>
                                    </h4>
                                    <p class="text">
                                        &#8369; <?= number_format(htmlspecialchars($rows['price'], ENT_QUOTES, 'UTF-8'), 2) ?>
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
                    $('.datahtml').html(data);
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

    // $('.signin-user').on('click', function(e) {
    //     e.preventDefault();

    //     const mobile = $('.id_mobile').val();
    //     const pass = $('.id_pass').val();

    //     console.log(mobile, pass)

    //     $.ajax({
    //         type: 'POST',
    //         url: '../database/signin.php',
    //         data: {
    //             'signin': true,
    //             mobile: mobile,
    //             pass: pass
    //         },
    //         success: function(response) {
    //             alert(response.message);
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('An error occurred: ' + status + ' - ' + error);
    //         }

    //     })
    // });
</script>

<?php include 'footer.php' ?>