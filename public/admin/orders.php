<?php

require_once('../../database/Connection.php');


$stmt = $db->query("SELECT *
FROM ((orders
INNER JOIN users ON orders.user_id = users.user_id)
INNER JOIN items_data ON orders.item_id = items_data.i_img);");
?>

<style>
    .card-margin {
        margin-bottom: 1.875rem;
    }

    .card {
        border: 0;
        box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #ffffff;
        background-clip: border-box;
        border: 1px solid #e6e4e9;
        border-radius: 8px;
    }

    .card .card-header.no-border {
        border: 0;
    }

    .card .card-header {
        background: none;
        padding: 0 0.9375rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        min-height: 50px;
    }

    .card-header:first-child {
        border-radius: calc(8px - 1px) calc(8px - 1px) 0 0;
    }

    .widget-49 .widget-49-title-wrapper {
        display: flex;
        align-items: center;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-primary {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #edf1fc;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-day {
        color: #4e73e5;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-month {
        color: #4e73e5;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-secondary {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #fcfcfd;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-secondary .widget-49-date-day {
        color: #dde1e9;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-secondary .widget-49-date-month {
        color: #dde1e9;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-success {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #e8faf8;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-success .widget-49-date-day {
        color: #17d1bd;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-success .widget-49-date-month {
        color: #17d1bd;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-info {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #ebf7ff;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-info .widget-49-date-day {
        color: #36afff;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-info .widget-49-date-month {
        color: #36afff;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-warning {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: floralwhite;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-warning .widget-49-date-day {
        color: #FFC868;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-warning .widget-49-date-month {
        color: #FFC868;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-danger {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #feeeef;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-danger .widget-49-date-day {
        color: #F95062;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-danger .widget-49-date-month {
        color: #F95062;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-light {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #fefeff;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-light .widget-49-date-day {
        color: #f7f9fa;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-light .widget-49-date-month {
        color: #f7f9fa;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-dark {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #ebedee;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-dark .widget-49-date-day {
        color: #394856;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-dark .widget-49-date-month {
        color: #394856;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-base {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #f0fafb;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-base .widget-49-date-day {
        color: #68CBD7;
        font-weight: 500;
        font-size: 1.5rem;
        line-height: 1;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-date-base .widget-49-date-month {
        color: #68CBD7;
        line-height: 1;
        font-size: 1rem;
        text-transform: uppercase;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-meeting-info {
        display: flex;
        flex-direction: column;
        margin-left: 1rem;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-pro-title {
        color: #3c4142;
        font-size: 14px;
    }

    .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-meeting-time {
        color: #B1BAC5;
        font-size: 13px;
    }

    .widget-49 .widget-49-meeting-points {
        font-weight: 400;
        font-size: 13px;
        margin-top: .5rem;
    }

    .widget-49 .widget-49-meeting-points .widget-49-meeting-item {
        display: list-item;
        color: #727686;
    }

    .widget-49 .widget-49-meeting-points .widget-49-meeting-item span {
        margin-left: .5rem;
    }

    .widget-49 .widget-49-meeting-action {
        text-align: right;
    }

    .widget-49 .widget-49-meeting-action a {
        text-transform: uppercase;
    }

    .card-body {
        p {
            margin-bottom: 0 !important;
        }
    }
</style>

<ul class="nav nav-fill nav-tabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="fill-tab-0" data-bs-toggle="tab" href="#fill-tabpanel-0" role="tab" aria-controls="fill-tabpanel-0" aria-selected="true">Orders</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="fill-tab-1" data-bs-toggle="tab" href="#fill-tabpanel-1" role="tab" aria-controls="fill-tabpanel-1" aria-selected="false">For pick up</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="fill-tab-2" data-bs-toggle="tab" href="#fill-tabpanel-2" role="tab" aria-controls="fill-tabpanel-2" aria-selected="false">On the way</a>
    </li>
</ul>
<div class="tab-content pt-5" id="tab-content">
    <div class="tab-pane active" id="fill-tabpanel-0" role="tabpanel" aria-labelledby="fill-tab-0">
        <div class="cards datadist" style="height: 90dvh; overflow:scroll;">
            <?php if (!empty($stmt)) : ?>
                <?php foreach ($stmt as $rows) : ?>
                    <div class="card" style="width: 15rem; display: inline-block; margin:1px;">
                        <div class="card-items">
                            <div class="card-body">
                                <h5 style="color: red"><?php echo $rows['tracking_number'] ?></h5>
                                <p>Mobile: <?php echo $rows['mobile'] ?></p>
                                <p>Quantity: x <?php echo $rows['total_quantity'] ?></p>
                                <p>Total: ₱<?php echo number_format($rows['price'], 2) ?></p>
                                <div style="margin-top: 20px; text-align:center">
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">

                                        <button type="button" class="btn1 btn" name="btnradio" id="" autocomplete="off"
                                            data-user_id="<?php echo $rows['user_id'] ?>"
                                            data-item_id="<?php echo $rows['i_img'] ?>"
                                            data-quantity="<?php echo $rows['total_quantity'] ?>">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>

                                        <button type="button" class="btn2 btn" name="btnradio" id="" autocomplete="off"
                                            data-user_id="<?php echo $rows['user_id'] ?>"
                                            data-quantity="<?php echo $rows['total_quantity'] ?>">
                                            <i class="fa-regular fa-handshake"></i>
                                        </button>

                                        <button type="button" class="btn3 btn" name="btnradio" id="" autocomplete="off"
                                            data-user_id="<?php echo $rows['user_id'] ?>"
                                            data-quantity="<?php echo $rows['total_quantity'] ?>">
                                            <i class="fa-solid fa-truck-fast"></i>
                                        </button>

                                        <button type="button" class="btn4 btn" name="btnradio" id="" autocomplete="off"
                                            data-user_id="<?php echo $rows['user_id'] ?>"
                                            data-quantity="<?php echo $rows['total_quantity'] ?>">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No orders yet.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="tab-pane" id="fill-tabpanel-1" role="tabpanel" aria-labelledby="fill-tab-1">
        Pick up
    </div>
    <div class="tab-pane" id="fill-tabpanel-2" role="tabpanel" aria-labelledby="fill-tab-2">
        On the way
    </div>
</div>

<script>
    $(document).ready(function() {

        $(".btn1").on('click', function(e) {
            e.preventDefault();

            const user_id = $(this).data('user_id');
            const item_id = $(this).data('item_id');
            const total_quantity = $(this).data('quantity');

            console.log(user_id, total_quantity)

            $.ajax({
                url: "../../database/orders.php",
                type: "post",
                data: {
                    'check_order': true,
                    'user_id': user_id,
                    'item_id': item_id,
                    'total_quantity': total_quantity
                },
                success: function(response) {
                    $('.modal-body').html(response);
                    $('#show-records-data').modal('show');
                },
            });

            $('#viewOrder').modal('show');
        });

        $(".btn2").on('click', function() {
            const user_id = $(this).data('user_id');
            const total_quantity = $(this).data('quantity');

            console.log(user_id, total_quantity)

            $('#hand').modal('show');
        });

        $(".btn3").on('click', function() {
            const user_id = $(this).data('user_id');
            const total_quantity = $(this).data('quantity');

            console.log(user_id, total_quantity)

            $('#viewOrder').modal('show');
        });

        $(".btn4").on('click', function() {
            const user_id = $(this).data('user_id');
            const total_quantity = $(this).data('quantity');

            console.log(user_id, total_quantity)

            $('#viewOrder').modal('show');
        });

    });
</script>