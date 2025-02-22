<?php
session_start();
require_once('../../database/user.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Track</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");

        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        body {
            background-color: #eee;
            font-family: "Poppins", sans-serif;
            font-weight: 300
        }

        .cart {
            height: 100vh
        }

        .progresses {
            display: flex;
            align-items: center
        }

        .line {
            width: 76px;
            height: 6px;
            background: #63d19e
        }

        .steps {
            display: flex;
            background-color: #63d19e;
            color: #fff;
            font-size: 12px;
            width: 30px;
            height: 30px;
            align-items: center;
            justify-content: center;
            border-radius: 50%
        }

        .check1 {
            display: flex;
            background-color: #63d19e;
            color: #fff;
            font-size: 17px;
            width: 60px;
            height: 60px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-bottom: 10px
        }

        .invoice-link {
            font-size: 15px
        }

        .order-button {
            height: 50px
        }

        .background-muted {
            background-color: #fafafc
        }
    </style>
</head>

<body oncontextmenu="return false;">

    <?php foreach ($token_data as $data):
        if ($data['order_status'] == 1) { ?>

            <div class="container mt-4 mb-4">
                <div class="row d-flex cart align-items-center justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="d-flex justify-content-center border-bottom">
                                <div class="p-3">
                                    <div class="progresses">
                                        <div class="steps"> <span><i class="fa fa-check"></i></span> </div> <span class="line"></span>
                                        <div class="steps"> <span></span> </div> <span class="line"></span>
                                        <div class="steps"><span class="font-weight-bold"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-6 border-right p-5">
                                    <div class="text-center order-details">
                                        <div class="d-flex justify-content-center mb-5 flex-column align-items-center"> <span class="check1"><i class="fa fa-check"></i></span><span class="font-weight-bold">Your order is on the process</span></div>
                                    </div>
                                </div>
                                <div class="col-md-6 background-muted">
                                    <div class="p-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center"> <span><i class="fa fa-clock-o text-muted"></i> <?= htmlspecialchars($data['days']) ?> days delivery</span></div>
                                        <div class="mt-3">
                                            <h6 class="mb-0">Item : <?= htmlspecialchars($data['variants']) ?></h6>
                                            <div class="d-flex flex-column mt-3"> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6 border-right">
                                            <div class="p-3 d-flex justify-content-center align-items-center"><span class="font-weight-bold">Summary</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Php</span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Subtotal</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span> <?= htmlspecialchars(number_format($data['sub_total'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Shipping fees</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span><?= htmlspecialchars(number_format($data['ship_fee'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Total</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold"><span><?= htmlspecialchars(number_format($data['sub_total'] + $data['ship_fee'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php  } elseif ($data['order_status'] == 2) { ?>

            <div class="container mt-4 mb-4">
                <div class="row d-flex cart align-items-center justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="d-flex justify-content-center border-bottom">
                                <div class="p-3">
                                    <div class="progresses">
                                        <div class="steps"> <span><i class="fa fa-check"></i></span> </div> <span class="line"></span>
                                        <div class="steps"> <span></span> </div> <span class="line"></span>
                                        <div class="steps"><span class="font-weight-bold"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-6 border-right p-5">
                                    <div class="text-center order-details">
                                        <div class="d-flex justify-content-center mb-5 flex-column align-items-center"> <span class="check1"><i class="fa fa-check"></i></span><span class="font-weight-bold">Your order is accepted the seller is now preparing your order</span><small class="mt-2"></small></div>
                                    </div>
                                </div>
                                <div class="col-md-6 background-muted">
                                    <div class="p-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center"> <span><i class="fa fa-clock-o text-muted"></i> <?= htmlspecialchars($data['days']) ?> days delivery</span></div>
                                        <div class="mt-3">
                                            <h6 class="mb-0">Item : <?= htmlspecialchars($data['variants']) ?></h6>
                                            <div class="d-flex flex-column mt-3"> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6 border-right">
                                            <div class="p-3 d-flex justify-content-center align-items-center"><span class="font-weight-bold">Summary</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Php</span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Subtotal</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span> <?= htmlspecialchars(number_format($data['sub_total'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Shipping fees</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span><?= htmlspecialchars(number_format($data['ship_fee'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Total</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold"><span><?= htmlspecialchars(number_format($data['sub_total'] + $data['ship_fee'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php  } elseif ($data['order_status'] == 3) { ?>

            <div class="container mt-4 mb-4">
                <div class="row d-flex cart align-items-center justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="d-flex justify-content-center border-bottom">
                                <div class="p-3">
                                    <div class="progresses">
                                        <div class="steps"> <span><i class="fa fa-check"></i></span> </div> <span class="line"></span>
                                        <div class="steps"> <span></span> </div> <span class="line"></span>
                                        <div class="steps"><span class="font-weight-bold"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-6 border-right p-5">
                                    <div class="text-center order-details">
                                        <div class="d-flex justify-content-center mb-5 flex-column align-items-center"> <span class="check1"><i class="fa fa-check"></i></span><span class="font-weight-bold">Your order is handed to logistics</span><small class="mt-2"><?= htmlspecialchars($data['tracking_number']) ?></small></div>
                                    </div>
                                </div>
                                <div class="col-md-6 background-muted">
                                    <div class="p-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center"> <span><i class="fa fa-clock-o text-muted"></i> <?= htmlspecialchars($data['days']) ?> days delivery</span></div>
                                        <div class="mt-3">
                                            <h6 class="mb-0">Item : <?= htmlspecialchars($data['variants']) ?></h6>
                                            <div class="d-flex flex-column mt-3"> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6 border-right">
                                            <div class="p-3 d-flex justify-content-center align-items-center"><span class="font-weight-bold">Summary</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Php</span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Subtotal</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span> <?= htmlspecialchars(number_format($data['sub_total'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Shipping fees</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span><?= htmlspecialchars(number_format($data['ship_fee'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Total</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold"><span><?= htmlspecialchars(number_format($data['sub_total'] + $data['ship_fee'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } elseif ($data['order_status'] == 4) { ?>

            <div class="container mt-4 mb-4">
                <div class="row d-flex cart align-items-center justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="d-flex justify-content-center border-bottom">
                                <div class="p-3">
                                    <div class="progresses">
                                        <div class="steps"> <span><i class="fa fa-check"></i></span> </div><span class="line"></span>
                                        <div class="steps"> <span></span> <i class="fa fa-check"></i></div><span class="line"></span>
                                        <div class="steps"><span class="font-weight-bold"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-6 border-right p-5">
                                    <div class="text-center order-details">
                                        <div class="d-flex justify-content-center mb-5 flex-column align-items-center"> <span class="check1"><i class="fa fa-check"></i></span><span class="font-weight-bold">Your order is on the way</span><small class="mt-2"><?= htmlspecialchars($data['tracking_number']) ?></small></div>
                                    </div>
                                </div>
                                <div class="col-md-6 background-muted">
                                    <div class="p-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center"> <span><i class="fa fa-clock-o text-muted"></i> <?= htmlspecialchars($data['days']) ?> days delivery</span></div>
                                        <div class="mt-3">
                                            <h6 class="mb-0">Item : <?= htmlspecialchars($data['variants']) ?></h6>
                                            <div class="d-flex flex-column mt-3"> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6 border-right">
                                            <div class="p-3 d-flex justify-content-center align-items-center"><span class="font-weight-bold">Summary</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Php</span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Subtotal</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span> <?= htmlspecialchars(number_format($data['sub_total'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Shipping fees</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span><?= htmlspecialchars(number_format($data['ship_fee'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Total</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold"><span><?= htmlspecialchars(number_format($data['sub_total'] + $data['ship_fee'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php  } elseif ($data['order_status'] == 6) { ?>

            <div class="container mt-4 mb-4">
                <div class="row d-flex cart align-items-center justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="d-flex justify-content-center border-bottom">
                                <div class="p-3">
                                    <div class="progresses">
                                        <div class="steps"> <span><i class="fa fa-check"></i></span> </div><span class="line"></span>
                                        <div class="steps"> <span></span></div><span class="line"></span>
                                        <div class="steps"><span class="font-weight-bold"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-6 border-right p-5">
                                    <div class="text-center order-details">
                                        <div class="d-flex justify-content-center mb-5 flex-column align-items-center"> <span class="check1"><i class="fa fa-check"></i></span><span class="font-weight-bold">Your order was cancelled by seller</span><small class="mt-2"><?= htmlspecialchars($data['tracking_number']) ?></small></div>
                                    </div>
                                </div>
                                <div class="col-md-6 background-muted">
                                    <div class="p-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center"> <span><i class="fa fa-clock-o text-muted"></i> <?= htmlspecialchars($data['days']) ?> days delivery</span></div>
                                        <div class="mt-3">
                                            <h6 class="mb-0">Item : <?= htmlspecialchars($data['variants']) ?></h6>
                                            <div class="d-flex flex-column mt-3"> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6 border-right">
                                            <div class="p-3 d-flex justify-content-center align-items-center"><span class="font-weight-bold">Summary</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Php</span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Subtotal</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span> <?= htmlspecialchars(number_format($data['sub_total'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Shipping fees</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span><?= htmlspecialchars(number_format($data['ship_fee'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Total</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold"><span><?= htmlspecialchars(number_format($data['sub_total'] + $data['ship_fee'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } else { ?>

            <div class="container mt-4 mb-4">
                <div class="row d-flex cart align-items-center justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="d-flex justify-content-center border-bottom">
                                <div class="p-3">
                                    <div class="progresses">
                                        <div class="steps"> <span><i class="fa fa-check"></i></span> </div><span class="line"></span>
                                        <div class="steps"> <span></span> <i class="fa fa-check"></i></div><span class="line"></span>
                                        <div class="steps"><span class="font-weight-bold"><i class="fa fa-check"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-6 border-right p-5">
                                    <div class="text-center order-details">
                                        <div class="d-flex justify-content-center mb-5 flex-column align-items-center"> <span class="check1"><i class="fa fa-check"></i></span><span class="font-weight-bold">Your order is completed</span><small class="mt-2"><?= htmlspecialchars($data['tracking_number']) ?></small></div>

                                    </div>
                                </div>
                                <div class="col-md-6 background-muted">
                                    <div class="p-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center"> <span><i class="fa fa-clock-o text-muted"></i> <?= htmlspecialchars($data['days']) ?> days delivery</span></div>
                                        <div class="mt-3">
                                            <h6 class="mb-0">Item : <?= htmlspecialchars($data['variants']) ?></h6>
                                            <div class="d-flex flex-column mt-3"> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6 border-right">
                                            <div class="p-3 d-flex justify-content-center align-items-center"><span class="font-weight-bold">Summary</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Php</span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Subtotal</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span> <?= htmlspecialchars(number_format($data['sub_total'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 border-bottom">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span>Shipping fees</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span><?= htmlspecialchars(number_format($data['ship_fee'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Total</span> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold"><span><?= htmlspecialchars(number_format($data['sub_total'] + $data['ship_fee'], 2)) ?></span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div> </div>
                        </div>
                    </div>
                </div>
            </div>

    <?php }
    endforeach; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>