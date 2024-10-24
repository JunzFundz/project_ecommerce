<?php
session_start();
$_SESSION['user_id'];

require_once('../../database/user.php');
?>

<style>
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
        background-color: var(--light-2);
        padding-top: 120px;
        padding-bottom: 120px;
    }

    .features-one .section-title {
        padding-bottom: 10px;
    }

    .features-one .title {
        font-size: 44px;
        font-weight: 600;
        color: var(--black);
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
</style>

<?php include 'header.php' ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="modal fade" tabindex="-1" id="addrating" aria-labelledby="addratingLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <span class="modal-title  text-center" id="addratingLabel">Submit Rating</span>
            </div>
            <div class="modal-body text-center">
                <input type="hidden" id="rate-user-id" value="">
                <input type="hidden" id="rate-item-id" value="">

                <i class="bi bi-star fa-star item--rating" id="submit--item--rating1" data-item-star="1"></i>
                <i class="bi bi-star fa-star item--rating" id="submit--item--rating2" data-item-star="2"></i>
                <i class="bi bi-star fa-star item--rating" id="submit--item--rating3" data-item-star="3"></i>
                <i class="bi bi-star fa-star item--rating" id="submit--item--rating4" data-item-star="4"></i>
                <i class="bi bi-star fa-star item--rating" id="submit--item--rating5" data-item-star="5"></i>

                <textarea style="margin-top: 20px;" class="form-control" id="textAreaExample" rows="3" placeholder="Add a message here"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-subtle" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="submit--item--rating">Add</button>
            </div>
        </div>
    </div>
</div>

<section class="features-area features-one">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <h3 class="title">Purchase</h3>
                    <p class="text">
                        You can view your purchase and status of your orders here
                    </p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <?php foreach ($get_orders as $rows) : ?>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="features-style-one text-center">
                        <div class="features-icon">
                            <?php
                            $_SESSION['order_token'] = htmlspecialchars($rows['order_token']);

                            $images = json_decode($rows['img'], true);
                            $firstImage = !empty($images) && is_array($images) ? htmlspecialchars($images[0], ENT_QUOTES, 'UTF-8') : 'default.jpg';
                            ?>
                            <img src="../../uploads/<?= $firstImage ?>" alt="Additional Image" class="img-fluid" width="300px">
                        </div>
                        <div class="features-content">
                            <p class="text">
                                <?= date('F j, Y', strtotime($rows['order_date'])); ?> | <?= $rows['tracking_number'] ?>
                            </p>

                            <?php if ($rows['order_status'] == 1 || $rows['order_status'] == 2) { ?>
                                <div class="features-btn rounded-buttons">
                                    <a class="btn primary-btn-outline rounded-full" href="track.php">
                                        VIEW STATUS
                                    </a>
                                </div>
                            <?php } else if ($rows['order_status'] == 3) { ?>
                                <div class="features-btn rounded-buttons">
                                    <a class="btn primary-btn-outline rounded-full" href="track.php">
                                        DELIVERED
                                    </a>
                                </div>
                            <?php } else if ($rows['order_status'] == 4) { ?>
                                <div class="features-btn rounded-buttons">
                                    <a class="btn primary-btn-outline rounded-full add-rate" data-userid="<?= $rows['user'] ?>" data-itemid="<?= $rows['item'] ?>" href="#" id="">
                                        RATE IT
                                    </a>
                                </div>
                            <?php } else { ?>
                                <div class="features-btn rounded-buttons">
                                    <a class="btn primary-btn-outline rounded-full add-rate" data-userid="<?= $rows['user'] ?>" data-itemid="<?= $rows['item'] ?>" href="#" id="">
                                        COMPLETED
                                    </a>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-rate').on('click', function() {
            const user = $(this).data('userid');
            const item = $(this).data('itemid');

            $.ajax({
                url: "../../database/user.php",
                type: "post",
                data: {
                    'submit_data': true,
                    'user': user,
                    'item': item
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);

                    if (response.success) {
                        $('#rate-user-id').val(response.user_id);
                        $('#rate-item-id').val(response.product_id);
                        $('#addrating').modal('show');
                    } else {
                        console.error('Failed to retrieve data.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('An error occurred: ' + status + ' - ' + error);
                }
            });
        });
    });

    var item_rate_data = 0;
    $(document).on('mouseenter', '.item--rating', function() {
        var item_stars = $(this).data('item-star');

        itemRemoveStar();

        for (var count = 1; count <= item_stars; count++) {
            $('#submit--item--rating' + count).removeClass('bi-star').addClass('bi-star-fill yellow-star');
        }
    });

    $(document).on('mouseleave', '.item--rating', function() {
        itemRemoveStar();

        for (var count = 1; count <= item_rate_data; count++) {
            $('#submit--item--rating' + count).removeClass('bi-star').addClass('bi-star-fill yellow-star');
        }
    });

    $(document).on('click', '.item--rating', function() {
        item_rate_data = $(this).data('item-star');

        itemRemoveStar();
        for (var count = 1; count <= item_rate_data; count++) {
            $('#submit--item--rating' + count).removeClass('bi-star').addClass('bi-star-fill yellow-star');
        }
    });

    function itemRemoveStar() {
        for (var count = 1; count <= 5; count++) {
            $('#submit--item--rating' + count).removeClass('bi-star-fill yellow-star').addClass('bi-star');
        }
    }

    $(document).on('click', '#submit--item--rating', function(e) {
        e.preventDefault();
        var user_id = $('#rate-user-id').val();
        var item_id = $('#rate-item-id').val();

        console.log(user_id, res_id, item_id);

        $.ajax({
            url: '../data/item-rating.php',
            type: 'POST',
            data: {
                'submit_rate': true,
                'item_star': item_rate_data,
                'item_star': item_rate_data,
                'quality': quality
            },
            success: function(response) {
                var results = JSON.parse(response);

                if (results.success) {
                    $('#alert-box').removeClass('invisible').addClass('visible opacity-100');
                    $('#alert-text').html(results.success);

                    setTimeout(function() {
                        $('#alert-box').removeClass('visible').addClass('invisible');
                        window.location.href = 'home.php';
                    }, 3000);
                } else if (results.error) {
                    $('#alert-box').removeClass('invisible').addClass('visible opacity-100');
                    $('#alert-text').html(results.error);

                    setTimeout(function() {
                        $('#alert-box').removeClass('visible').addClass('invisible');
                        if (response) {
                            window.location.href = 'home.php';
                        }
                    }, 3000);
                } else {
                    $('#alert-box').removeClass('invisible').addClass('visible opacity-100');
                    $('#alert-text').html(message);

                    setTimeout(function() {
                        $('#alert-box').removeClass('visible').addClass('invisible');
                        if (results) {
                            window.location.href = 'login.php';
                        }
                    }, 3000);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
</script>