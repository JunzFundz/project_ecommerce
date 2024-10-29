<?php
session_start();
$_SESSION['user_id'];

require_once('../../database/user.php');
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php include 'header.php' ?>

<div class="modal fade" tabindex="-1" id="addrating" aria-labelledby="addratingLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <span class="modal-title  text-center" id="addratingLabel">Submit Rating</span>
            </div>
            <div class="modal-body text-center">
                <input type="hidden" id="rate-user-id" value="">
                <input type="hidden" id="rate-item-id" value="">
                <input type="hidden" id="rate-session" value="">

                <i class="bi bi-star fa-star item--rating" id="submit--item--rating1" data-item-star="1"></i>
                <i class="bi bi-star fa-star item--rating" id="submit--item--rating2" data-item-star="2"></i>
                <i class="bi bi-star fa-star item--rating" id="submit--item--rating3" data-item-star="3"></i>
                <i class="bi bi-star fa-star item--rating" id="submit--item--rating4" data-item-star="4"></i>
                <i class="bi bi-star fa-star item--rating" id="submit--item--rating5" data-item-star="5"></i>

                <textarea style="margin-top: 20px;" class="form-control" id="insight" rows="3" placeholder="Add a message here"></textarea>
                <br>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="file_img">
                </div>
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

                            <?php if ($rows['order_status'] == 1 || $rows['order_status'] == 2 || $rows['order_status'] == 3 || $rows['order_status'] == 4) { ?>
                                <div class="features-btn rounded-buttons">
                                    <a class="btn primary-btn-outline rounded-full" href="track.php?token=<?php echo $_SESSION['order_token'] ?>">
                                        VIEW STATUS
                                    </a>
                                </div>
                            <?php } else if ($rows['order_status'] == 5) { ?>
                                <div class="features-btn rounded-buttons">
                                    <a class="btn primary-btn-outline rounded-full add-rate"
                                        data-userid="<?= $rows['user'] ?>"
                                        data-itemid="<?= $rows['item'] ?>"
                                        data-session="<?= $rows['order_token'] ?>"
                                        href="#" id="">
                                        RATE IT
                                    </a>
                                </div>
                            <?php } else if ($rows['order_status'] == 6) { ?>
                                <div class="features-btn rounded-buttons">
                                    <a class="btn primary-btn-outline rounded-full" href="track.php?token=<?php echo $_SESSION['order_token'] ?>">
                                        VIEW STATUS
                                    </a>
                                </div>
                            <?php } else { ?>
                                <div class="features-btn rounded-buttons">
                                    <a class="btn primary-btn-outline rounded-full" href="track.php?token=<?php echo $_SESSION['order_token'] ?>">
                                        VIEW DETAILS
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-rate').on('click', function() {
            const user = $(this).data('userid');
            const item = $(this).data('itemid');
            const session = $(this).data('session');

            $.ajax({
                url: "../../database/user.php",
                type: "post",
                data: {
                    'submit_data': true,
                    'user': user,
                    'session': session,
                    'item': item
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#rate-user-id').val(response.user_id);
                        $('#rate-item-id').val(response.product_id);
                        $('#rate-session').val(response.session);
                        $('#addrating').modal('show');
                    } else {
                        alert('Failed to retrieve data.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + status + ' - ' + error);
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
        var insight = $('#insight').val();
        var session = $('#rate-session').val();
        var image = $('#file_img')[0].files[0];

        var formData = new FormData();
        formData.append('submit_rate', true);
        formData.append('item_rate_data', item_rate_data);
        formData.append('item_id', item_id);
        formData.append('user_id', user_id);
        formData.append('session', session);
        formData.append('insight', insight);
        formData.append('image', image);

        $.ajax({
            url: '../../database/user.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    title: "Success",
                    text: "Rating Added",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: "Oppss",
                    text: "Error occured",
                    icon: "error",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        });
    });
</script>