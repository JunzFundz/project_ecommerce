<?php

session_start();

require_once('../../database/user_show_data.php');
include('../../database/user.php');
$_SESSION['user_id'];
$product_id;
$user_id;
$total_quantity;
$variant;

?>

<style>
    .shop {
        font-size: 10px;
    }

    .space {
        letter-spacing: 0.8px !important;
    }

    .second a:hover {
        color: rgb(92, 92, 92);
    }

    .active-2 {
        color: rgb(92, 92, 92)
    }


    .breadcrumb>li+li:before {
        content: "" !important
    }

    .breadcrumb {
        padding: 0px;
        font-size: 10px;
        color: #aaa !important;
    }

    .first {
        background-color: white;
    }

    a {
        text-decoration: none !important;
        color: #aaa;
    }

    .btn-lg,
    .form-control-sm:focus,
    .form-control-sm:active,
    a:focus,
    a:active {
        outline: none !important;
        box-shadow: none !important
    }

    .form-control-sm:focus {
        border: 1.5px solid #4bb8a9;
    }

    .btn-group-lg>.btn,
    .btn-lg {
        padding: .5rem 0.1rem;
        font-size: 1rem;
        border-radius: 0;
        color: white !important;
        background-color: #4bb8a9;
        height: 2.8rem !important;
        border-radius: 0.2rem !important;
    }

    .btn-group-lg>.btn:hover,
    .btn-lg:hover {
        background-color: #26A69A;
    }

    .btn-outline-primary {
        background-color: #fff !important;
        color: #4bb8a9 !important;
        border-radius: 0.2rem !important;
        border: 1px solid #4bb8a9;
    }

    .btn-outline-primary:hover {
        background-color: #4bb8a9 !important;
        color: #fff !important;
        border: 1px solid #4bb8a9;
    }

    .card-2 {
        margin-top: 40px !important;
    }

    .card-header {
        background-color: #fff;
        border-bottom: 0px solid #aaaa !important;
    }

    p {
        font-size: 13px;
    }

    .small {
        font-size: 9px !important;
    }

    .form-control-sm {
        height: calc(2.2em + .5rem + 2px);
        font-size: .875rem;
        line-height: 1.5;
        border-radius: 0;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .boxed {
        padding: 0px 8px 0 8px;
        background-color: #4bb8a9;
        color: white;
    }

    .boxed-1 {
        padding: 0px 8px 0 8px;
        color: black !important;
        border: 1px solid #aaaa;
    }

    .bell {
        opacity: 0.5;
        cursor: pointer;
    }

    @media (max-width: 767px) {
        .breadcrumb-item+.breadcrumb-item {
            padding-left: 0
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<div class=" container-fluid my-5 ">
    <div class="row justify-content-center ">
        <div class="col-xl-10">
            <div class="card shadow-lg ">
                <div class="row p-2 mt-3 justify-content-between mx-sm-2">
                    <div class="col">
                        <p class="text-muted space mb-0 shop">Shop No.78618K</p>
                        <p class="text-muted space mb-0 shop">Store Locator</p>
                    </div>
                    <div class="col">
                        <div class="row justify-content-start ">
                            <div class="col">
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <img class="irc_mi img-fluid bell" src="https://i.imgur.com/uSHMClk.jpg" width="30" height="30">
                    </div>
                </div>
                <div class="row  mx-auto justify-content-center text-center">
                    <div class="col-12 mt-3 ">
                    </div>
                </div>

                <div class="row justify-content-around">
                    <div class="col-md-5">
                        <div class="card border-0">
                            <div class="card-header pb-0">
                                <h2 class="card-title space ">Checkout</h2>
                                <p class="card-text text-muted mt-4  space">SHIPPING DETAILS</p>
                                <hr class="my-0">
                            </div>
                            <div class="card-body">

                                <div class="row mt-4">
                                    <div class="col">
                                        <p class="text-muted mb-2">Delivery</p>
                                        <hr class="mt-0">
                                    </div>
                                </div>

                                <div class="row no-gutters">
                                    <div class="col-sm pr-sm-2">
                                        <div class="form-group">
                                            <label for="NAME" class="small text-muted mb-1">FIRST NAME</label>
                                            <input type="text" class="form-control form-control-sm" name="NAME" id="fname" aria-describedby="helpId">
                                        </div>
                                    </div>
                                    <div class="col-sm pr-sm-2">
                                        <div class="form-group">
                                            <label for="NAME" class="small text-muted mb-1">LAST NAME</label>
                                            <input type="text" class="form-control form-control-sm" name="NAME" id="lname" aria-describedby="helpId">
                                        </div>
                                    </div>
                                    <div class="col-sm pr-sm-2">
                                        <div class="form-group">
                                            <label for="NAME" class="small text-muted mb-1">MOBILE</label>
                                            <input type="text" class="form-control form-control-sm" name="NAME" id="mobile" aria-describedby="helpId">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="NAME" class="small text-muted mb-1">ADDRESS</label>
                                    <input type="text" class="form-control form-control-sm" name="NAME" id="address" aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                    <label for="NAME" class="small text-muted mb-1">APARTMENT, BLOCK ETC.</label>
                                    <input type="text" class="form-control form-control-sm" name="NAME" id="house" aria-describedby="helpId">
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-sm-6 pr-sm-2">
                                        <div class="form-group">
                                            <label for="NAME" class="small text-muted mb-1">ZIP CODE</label>
                                            <input type="text" class="form-control form-control-sm zip_change" name="zip" id="zip" aria-describedby="helpId" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="NAME" class="small text-muted mb-1">CITY</label>
                                            <input type="text" class="form-control form-control-sm" name="NAME" id="city" aria-describedby="helpId">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="NAME" class="small text-muted mb-1">REGION</label>
                                    <input type="text" class="form-control form-control-sm" name="NAME" id="region" aria-describedby="helpId">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card border-0 ">
                            <div class="card-header card-2">
                                <p class="card-text text-muted mt-md-4  mb-2 space">YOUR ORDER</p>
                                <hr class="my-2">
                            </div>
                            <div class="card-body pt-0">
                                <?php
                                if (!empty($product) && isset($product[0]['name'])) {
                                    $images = json_decode($product[0]['img'], true);
                                    if (!empty($images) && is_array($images)) {
                                        $firstImage = htmlspecialchars($images[0], ENT_QUOTES, 'UTF-8');
                                    } else {
                                        $firstImage = '../uploads/default.jpg';
                                    }
                                ?>

                                    <div class="row justify-content-between">
                                        <div class="col-auto col-md-7">
                                            <div class="media flex-column flex-sm-row">
                                                <img class="img-fluid" src="../../uploads/<?= $firstImage ?>" width="62" height="62" alt="Product Image">
                                                <div class="media-body my-auto">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <p class="mb-0"><b><?php echo htmlspecialchars($product[0]['name']); ?></b></p>
                                                            <?php foreach ($get_variant as $var) { ?>
                                                                <small class="text-muted">
                                                                    <?= htmlspecialchars($var['variable']) ?>
                                                                    <?php echo $total_weight_in_kg ?>
                                                                </small>


                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pl-0 flex-sm-col col-auto my-auto">
                                            <p class="boxed-1">x<?php echo htmlspecialchars($total_quantity) ?></p>
                                        </div>
                                        <div class="pl-0 flex-sm-col col-auto my-auto">
                                            <p><b>Php <?php echo htmlspecialchars($price) ?></b></p>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <p>No product data available.</p>
                                <?php } ?>

                                <hr class="my-2">
                                <div class="row ">
                                    <div class="col">
                                        <div class="row justify-content-between">
                                            <div class="col-4">
                                                <p class="mb-1"><b>Subtotal</b></p>
                                            </div>
                                            <div class="flex-sm-col col-auto">
                                                <p class="mb-1"><b><?php echo htmlspecialchars($total_no_shipping) ?></b></p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col">
                                                <p class="mb-1"><b>Shipping</b></p>
                                            </div>
                                            <div class="flex-sm-col col-auto">
                                                <p class="mb-1"><b id="shipping-fee"></b><b> Php</b></p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-4">
                                                <p><b>Total</b></p>
                                            </div>
                                            <div class="flex-sm-col col-auto">
                                                <p class="mb-1" style="color: red; font-size: 15px"><b id="total_pay"></b><b> Php</b></p>
                                            </div>
                                        </div>
                                        <hr class="my-0">
                                    </div>
                                </div>
                                <div class="row mb-5 mt-4 ">
                                    <div class="col-md-7 col-lg-6 mx-auto">
                                        <button type="submit" id="placed_order" class="btn btn-block btn-outline-primary btn-lg" style="border-radius: 0 !important;">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="total_with_shipping" value="">
<input type="hidden" id="get_days" value="">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '../../database/user.php',
            method: 'post',
            data: {
                'users_id': <?php echo $_SESSION['user_id']; ?>
            },
            success: function(response) {
                $('#fname').val(response.fname);
                $('#lname').val(response.lname);
                $('#mobile').val(response.mobile);
                $('#address').val(response.brgy);
                $('#house').val(response.house);
                $('#zip').val(response.zip);
                $('#city').val(response.city);
                $('#region').val(response.region);

                const initialZipcode = $('#zip').val();
                console.log('Initial Zipcode:', initialZipcode);
                if (initialZipcode) {
                    fetchShippingFee(initialZipcode);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        const subtotal = <?php echo $total_no_shipping ?>;
        const weight = parseFloat(<?php echo number_format($total_weight_in_kg, 2); ?>);

        function fetchShippingFee(zipcode) {
            if (zipcode.length > 0) {
                $.ajax({
                    url: '../../database/user_payment.php',
                    method: 'POST',
                    data: {
                        'cart_zipcode': true,
                        'zipcode': zipcode,
                        'weight': weight,
                        'subtotal': subtotal
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            $('#shipping-fee').text('+' + response.shipping_fee);
                            $('#total_with_shipping').val(response.shipping_fee);
                            $('#total_pay').text(response.total_pay);
                            $('#get_days').val(response.estimated_days);
                        } else {
                            $('#shipping-fee').text(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error: ' + error);
                        $('#shipping-fee').text('An error occurred. Please try again.');
                    }
                });
            }
        }

        $('#zip').on('input', function(e) {
            e.preventDefault();
            const zipcode = $(this).val();
            fetchShippingFee(zipcode);
        });


        $('#placed_order').on('click', function() {
            const fname = $('#fname').val();
            const lname = $('#lname').val();
            const mobile = $('#mobile').val();
            const address = $('#address').val();
            const house = $('#house').val();
            const zip = $('#zip').val();
            const city = $('#city').val();
            const region = $('#region').val();

            const user_id = <?php echo $_SESSION['user_id'] ?>;
            const product_id = <?php echo $product_id ?>;
            const quantity = <?php echo $total_quantity ?>;
            const price = <?php echo $price ?>;
            const variant = <?php echo $variant ?>;
            const shipping = $('#total_with_shipping').val();

            console.log({
                fname,
                lname,
                mobile,
                address,
                house,
                zip,
                city,
                region,
                user_id,
                product_id,
                quantity,
                price
            });

            $.ajax({
                url: '../../database/user_payment.php',
                method: 'POST',
                data: {
                    'placed_order_now': true,
                    fname: fname,
                    lname: lname,
                    mobile: mobile,
                    address: address,
                    house: house,
                    zip: zip,
                    city: city,
                    region: region,

                    user_id: user_id,
                    product_id: product_id,
                    quantity: quantity,
                    price: price,
                    variant: variant,
                    shipping: shipping
                },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        title: "Order placed",
                        text: "Your order has been placed successfully.",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "index.php";
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            })
        })

    });
</script>