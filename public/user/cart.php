<?php
session_start();
$_SESSION['user_id'];
include('../../database/user_cart.php');

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body {
        background: rgb(255,255,255);
        background: linear-gradient(24deg, rgba(255,255,255,1) 0%, rgba(227,132,132,1) 100%); 
        min-height: 100vh;
        vertical-align: middle;
        display: flex;
        font-family: sans-serif;
        font-size: 0.8rem;
        font-weight: bold;
    }

    * {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .card {
        .title {
            margin-bottom: 5vh;
        }

        margin: auto;
        max-width: 950px;
        width: 90%;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border: transparent;

        .cart {
            background: rgba(255, 255, 255, 0.61);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(9.3px);
            -webkit-backdrop-filter: blur(9.3px);
            border: 1px solid rgba(255, 255, 255, 1);
            padding: 4vh 5vh;
        }

        @media(max-width:767px) {
            .cart {
                padding: 4vh;
                border-bottom-left-radius: unset;
            }
        }

        .summary {
            background-color: #F2F2F0;
            padding: 4vh;
            color: rgb(65, 65, 65);
        }

        @media(max-width:767px) {
            .summary {
                border-top-right-radius: unset;
            }
        }

        .summary .col-2 {
            padding: 0;
        }

        .summary .col-10 {
            padding: 0;
        }

        .row {
            margin: 0;
        }

        .title b {
            font-size: 1.5rem;
        }

        .main {
            margin: 0;
            padding: 2vh 0;
            width: 100%;
        }

        .col-2,
        .col {
            padding: 0 1vh;
        }

        a {
            padding: 0 1vh;
        }

        .close {
            margin-left: auto;
            font-size: 0.7rem;
        }

        img {
            width: 3.5rem;
        }

        .back-to-shop {
            margin-top: 4.5rem;
        }

        h5 {
            margin-top: 4vh;
        }

        hr {
            margin-top: 1.25rem;
        }

        form {
            padding: 2vh 0;
        }

        select {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1.5vh 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }

        input {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }

        input:focus::-webkit-input-placeholder {
            color: transparent;
        }

        .btn {
            background-color: #000;
            border-color: #000;
            color: white;
            width: 100%;
            font-size: 0.7rem;
            margin-top: 4vh;
            padding: 1vh;
            border-radius: 0;
        }

        .btn:focus {
            box-shadow: none;
            outline: none;
            box-shadow: none;
            color: white;
            -webkit-box-shadow: none;
            transition: none;
        }

        .btn:hover {
            color: white;
        }

        a {
            color: black;
        }

        a:hover {
            color: black;
            text-decoration: none;
        }

        #code {
            background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: center;
        }
    }
</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<div class="card ">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>Shopping Cart</b></h4>
                    </div>
                </div>
            </div>

            <?php if (!empty($view)) : ?>
                <?php foreach ($view as $rows) : ?>
                    <div class="row border-top border-bottom" id="new-idd">
                        <div class="row main align-items-center">

                            <div class="col-2">
                                <?php
                                $images = json_decode($rows['img'], true);
                                if (!empty($images) && is_array($images)) {
                                    $firstImage = htmlspecialchars($images[0], ENT_QUOTES, 'UTF-8');
                                ?>
                                    <img class="img-fluid" src="../../uploads/<?= $firstImage ?>">
                                <?php } else { ?>
                                    <img style="height: 200px; object-fit:contain; aspect-ratio: 3/2" src="../uploads/default.jpg" class="card-img-top" alt="Default image" />
                                <?php } ?>
                            </div>
                            <div class="col">
                                <div class="row"><?= $rows['variable'] ?>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: red">₱<?= number_format((float)$rows['v_price']) ?></span></div>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-outline-secondary px-3 decrement" data-item-id="<?= $rows['i_img'] ?>" data-cart-id="<?= $rows['cart_id'] ?>" style="margin-top: 0 !important; border-radius: 0;">-</button>

                                    <input type="text" id="quantity_input" class="btn-outline-secondary form-control text-center quantity" value="<?= $rows['c_quantity'] ?>" min="1" style="width: 60px; border-radius: 0;">

                                    <button type="button" class="btn btn-outline-secondary px-3 increment" data-item-id="<?= $rows['i_img'] ?>" data-cart-id="<?= $rows['cart_id'] ?>" style="margin-top: 0 !important; border-radius: 0;">+</button>
                                </div>
                            </div>
                            <div class="col">₱ <?= $total_no_ship = number_format($rows['c_quantity'] * $rows['v_price']) ?></div>

                            <div class="col">
                                <span class="close delete_item" style="cursor: pointer" id="" data-item-id="<?= $rows['i_img'] ?>" data-cart-id="<?= $rows['cart_id'] ?>">&#10005;</span>
                            </div>
                        </div>
                    </div>
                    <form action="fromcart.php" method="post">
                        <input type="hidden" name="price[]" value="<?= htmlspecialchars(number_format($rows['v_price'])) ?>">
                        <input type="hidden" name="weight[]" value="<?= htmlspecialchars(number_format($rows['c_weight'])) ?>">
                        <input type="hidden" name="units[]" value="<?php echo $rows['units']; ?>">
                        <input type="hidden" name="user_id[]" value="<?php echo $_SESSION['user_id'] ?>">
                        <input type="hidden" name="item_id[]" value="<?php echo $rows['i_img']; ?>">
                        <input type="hidden" name="quantity[]" value="<?php echo $rows['c_quantity']; ?>">
                        <input type="hidden" name="variant[]" value="<?php echo $rows['c_var']; ?>">

                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No cart items.</p>
                <?php endif; ?>


                <div class="back-to-shop"><a href="index.php">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
        </div>
        <div class="col-md-4 summary">
            <div>
                <h5><b>Summary</b></h5>
            </div>
            <hr>
            <p>SHIPPING</p>
            <select>
                <option class="text-muted">Standard-Delivery</option>
            </select>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <!-- <div class="col">TOTAL PRICE</div>
                <div class="col text-right">&euro; 137.00</div> -->
            </div>
            <button type="submit" name="buy_from_cart" class="btn btn-success">CHECKOUT</button>
            </form>
        </div>
    </div>

</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.increment').click(function() {
            const itemId = $(this).data('item-id');
            const cart = $(this).data('cart-id');
            const user = <?php echo $_SESSION['user_id']; ?>;

            $.ajax({
                url: "../../database/user_cart.php",
                type: "post",
                data: {
                    'increment': true,
                    'itemId': itemId,
                    'cart': cart,
                    'user': user
                },
                success: function(response) {
                    location.reload()
                }
            });
        });

        $('.decrement').click(function() {
            const itemId = $(this).data('item-id');
            const cart = $(this).data('cart-id');
            const user = <?php echo $_SESSION['user_id']; ?>;

            $.ajax({
                url: "../../database/user_cart.php",
                type: "post",
                data: {
                    'decrement': true,
                    'itemId': itemId,
                    'cart': cart,
                    'user': user
                },
                success: function(response) {
                    location.reload()
                }
            });
        });

        $('.delete_item').click(function() {
            const itemId = $(this).data('item-id');
            const cart = $(this).data('cart-id');
            const user = <?php echo $_SESSION['user_id']; ?>;
            console.log(itemId, cart, user)

            $.ajax({
                url: "../../database/user_cart.php",
                type: "post",
                data: {
                    'delete': true,
                    'itemId': itemId,
                    'cart': cart,
                    'user': user
                },
                success: function(response) {
                    location.reload()
                }
            });
        });

    });
</script>