<?php

session_start();

$id = $_SESSION['user_id'];
require_once('../../database/user_show_data.php');
?>

<?php include 'header.php' ?>

<style>
    /* tabs-one */
    .tabs-one {
        border: 1px solid var(--gray-4);
    }

    .tabs-one .nav {
        border-bottom: 1px solid var(--gray-4);
    }

    @media (max-width: 767px) {
        .tabs-one .nav {
            display: block;
        }
    }

    @media only screen and (min-width: 576px) and (max-width: 767px) {
        .tabs-one .nav {
            display: flex;
        }
    }

    .tabs-one .nav .nav-item a {
        font-size: 16px;
        line-height: 24px;
        color: var(--dark-3);
        font-weight: 700;
        padding: 13px;
        -webkit-transition: all 0.3s ease-out 0s;
        -moz-transition: all 0.3s ease-out 0s;
        -ms-transition: all 0.3s ease-out 0s;
        -o-transition: all 0.3s ease-out 0s;
        transition: all 0.3s ease-out 0s;
        display: block;
    }

    .tabs-one .nav .nav-item a.active {
        color: var(--white);
        background: var(--primary);
    }

    .tabs-one .tab-content .tab-text {
        padding: 15px;
    }

    .tabs-one .tab-content .tab-text .text {
        color: var(--dark-3);
    }
</style>

<link rel="stylesheet" href="https://cdn.ayroui.com/1.0/css/tiny-slider.css" />

<br><br>
<div class="tabs" style="margin-inline: 10px">
    <div class="single-tabs tabs-one">
        <ul class="nav nav-justified" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="active" id="tab-one-one-tab" data-bs-toggle="tab" href="#tab-one-one" role="tab"
                    aria-controls="tab-one-one" aria-selected="true">ORDERS</a>
            </li>
            <li class="nav-item">
                <a id="tab-one-two-tab" data-bs-toggle="tab" href="#tab-one-two" role="tab"
                    aria-controls="tab-one-two" aria-selected="false">ITEMS</a>
            </li>
            <li class="nav-item">
                <a id="tab-one-three-tab" data-bs-toggle="tab" href="#tab-one-three" role="tab"
                    aria-controls="tab-one-three" aria-selected="false">TRANSACTIONS</a>
            </li>
            <li class="nav-item">
                <a id="tab-one-four-tab" data-bs-toggle="tab" href="#tab-one-four" role="tab"
                    aria-controls="tab-one-four" aria-selected="false">TAB 04</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one-one" role="tabpanel"
                aria-labelledby="tab-one-one-tab">
                <?php include('purchase.php') ?>
            </div>
            <div class="tab-pane fade" id="tab-one-two" role="tabpanel" aria-labelledby="tab-one-two-tab">
                <?php include('items.php') ?>
            </div>
            <div class="tab-pane fade" id="tab-one-three" role="tabpanel" aria-labelledby="tab-one-three-tab">

            </div>
            <div class="tab-pane fade" id="tab-one-four" role="tabpanel" aria-labelledby="tab-one-four-tab">

            </div>
        </div>
    </div>
</div>

<?php
include('admin-footer.php');
include('load-modals.php');
?>
<script src="https://cdn.ayroui.com/1.0/js/tiny-slider.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>