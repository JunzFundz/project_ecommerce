<!-- <?php include('admin-header.php'); ?>

<style>
    .container-- {
        display: grid;
        grid-template-columns: repeat(9, 1fr);
        width: 100%;
        margin-inline: 20px;

    }

    .child-1 {
        grid-column: 1/3;

        ul li a {
            text-align: left !important;
            padding-left: 20px;
        }
    }

    .child-2 {
        grid-column: 3/10;
        width: 100%;
    }
</style>

<title>Admin Dashboard</title>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="width: 100%; ">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Administrator</a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-light"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto d-flex flex-row mt-3 mt-lg-0">
                <li class="nav-item text-center mx-2 mx-lg-1">
                    <a class="nav-link active" aria-current="page" href="admin.php">
                        <div>
                            <i class="fas fa-home fa-lg mb-1"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>

<div class="container--" style="margin-top: 20px; width: auto; height: 90vh;">

    <div class="child-1" style="width: 100%;">
        <ul class="nav nav-tabs nav-tabs-vertical" style="width: 100%;" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="vertical-tab-0" data-bs-toggle="tab" href="#vertical-tabpanel-0" role="tab" aria-controls="vertical-tabpanel-0" aria-selected="true">Dashboard</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="vertical-tab-1" data-bs-toggle="tab" href="#vertical-tabpanel-1" role="tab" aria-controls="vertical-tabpanel-1" aria-selected="false">Items</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="vertical-tab-2" data-bs-toggle="tab" href="#vertical-tabpanel-2" role="tab" aria-controls="vertical-tabpanel-2" aria-selected="false">Orders</a>
            </li>
        </ul>
    </div>

    <div class=" child-2">
        <div class="tab-content" id="tab-content" aria-orientation="vertical">
            <div class="tab-pane active" id="vertical-tabpanel-0" role="tabpanel" aria-labelledby="vertical-tab-0">
                <?php include('dashboard.php') ?>
            </div>
            <div class="tab-pane" id="vertical-tabpanel-1" role="tabpanel" aria-labelledby="vertical-tab-1">
                <?php include('items.php') ?>
            </div>
            <div class="tab-pane" id="vertical-tabpanel-2" role="tabpanel" aria-labelledby="vertical-tab-2">
                <?php include('orders.php') ?>
            </div>
        </div>
    </div>
</div>

<?php
include('admin-footer.php');
include('load-modals.php');
?> -->
