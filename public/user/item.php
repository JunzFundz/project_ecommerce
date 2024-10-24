<?php
session_start();
require_once('../../database/user_items.php');

$defaultImage = "../uploads/default.jpg";
$firstImage = $defaultImage;

if (!empty($get)) {
    $item = $get[0];
    $images = json_decode($item['img'], true);
    if (!empty($images) && is_array($images)) {
        $firstImage = "../../uploads/" . htmlspecialchars($images[0], ENT_QUOTES, 'UTF-8');
    }
}
?>
<style>
    .marker-1 {
        margin-inline: 10px;
    }

    label.radio {
        cursor: pointer;
    }

    label.radio input {
        position: absolute;
        top: 0;
        left: 0;
        visibility: hidden;
        pointer-events: none;
    }

    label.radio span {
        padding: 3px 5px;
        border: 2px solid black;
        display: inline-block;
        color: black;
        text-transform: uppercase;
    }

    label.radio input:checked+span {
        border-color: black;
        background-color: black;
        color: white;
    }

    body {
        background-color: #ecedee
    }

    .card {
        border: none;
        overflow: hidden
    }

    .thumbnail_images ul {
        list-style: none;
        justify-content: center;
        display: flex;
        align-items: center;
        margin-top: 10px
    }

    .thumbnail_images ul li {
        margin: 5px;
        padding: 10px;
        border: 2px solid #eee;
        cursor: pointer;
        transition: all 0.5s
    }

    .thumbnail_images ul li:hover {
        border: 2px solid #000
    }

    .main_image {
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #eee;
        height: 400px;
        width: 100%;
        overflow: hidden
    }

    .heart {
        height: 29px;
        width: 29px;
        background-color: #eaeaea;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center
    }

    .content p {
        font-size: 12px
    }

    .ratings span {
        font-size: 14px;
        margin-left: 12px
    }

    .colors {
        margin-top: 5px
    }

    .colors ul {
        list-style: none;
        display: flex;
        padding-left: 0px
    }

    .colors ul li {
        height: 20px;
        width: 20px;
        display: flex;
        border-radius: 50%;
        margin-right: 10px;
        cursor: pointer
    }


    .right-side {
        position: relative
    }

    .search-option {
        position: absolute;
        background-color: #000;
        overflow: hidden;
        align-items: center;
        color: #fff;
        width: 200px;
        height: 200px;
        border-radius: 49% 51% 50% 50% / 68% 69% 31% 32%;
        left: 30%;
        bottom: -250px;
        transition: all 0.5s;
        cursor: pointer
    }

    .search-option .first-search {
        position: absolute;
        top: 20px;
        left: 90px;
        font-size: 20px;
        opacity: 1000
    }

    .search-option .inputs {
        opacity: 0;
        transition: all 0.5s ease;
        transition-delay: 0.5s;
        position: relative
    }

    .search-option .inputs input {
        position: absolute;
        top: 200px;
        left: 30px;
        padding-left: 20px;
        background-color: transparent;
        width: 300px;
        border: none;
        color: #fff;
        border-bottom: 1px solid #eee;
        transition: all 0.5s;
        z-index: 10
    }

    .search-option .inputs input:focus {
        box-shadow: none;
        outline: none;
        z-index: 10
    }

    .search-option:hover {
        border-radius: 0px;
        width: 100%;
        left: 0px
    }

    .search-option:hover .inputs {
        opacity: 1
    }

    .search-option:hover .first-search {
        left: 27px;
        top: 25px;
        font-size: 15px
    }

    .search-option:hover .inputs input {
        top: 20px
    }

    .search-option .share {
        position: absolute;
        right: 20px;
        top: 22px
    }

    .buttons .btn {
        height: 50px;
        width: 150px;
        border-radius: 0px !important
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

<div class="container mt-5 mb-5">
    <div class="card border-0">
        <div class="row g-0">
            <div class="col-md-6 border">
                <div class="d-flex flex-column justify-content-center">
                    <div class="main_image">
                        <?php
                        $defaultImage = "../uploads/default.jpg";
                        $firstImage = $defaultImage;

                        if (!empty($get)) {
                            $item = $get[0];
                            $images = json_decode($item['img'], true);
                            if (!empty($images) && is_array($images)) {
                                $firstImage = "../../uploads/" . htmlspecialchars($images[0]);
                            }
                        }
                        ?>
                        <img src="<?= $firstImage ?>" id="main_product_image" width="350" alt="Main Image">
                    </div>
                    <div class="thumbnail_images" style="overflow-x: auto; overflow-y: hidden;">
                        <ul id="thumbnail">
                            <?php if (!empty($images) && is_array($images)) : ?>
                                <?php foreach ($images as $image) : ?>
                                    <li>
                                        <img onclick="changeImage(this)" src="../../uploads/<?= htmlspecialchars($image) ?>" width="70" alt="Thumbnail">
                                    </li>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <li>
                                    <img src="<?= $defaultImage ?>" width="70" alt="Default Thumbnail">
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <?php foreach ($get as $item) :  ?>
                <div class="col-md-6 border">
                    <div class="p-3 right-side">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3><?= $item['name'] ?></h3> <span class="heart"><i class='bx bx-heart'></i></span>
                        </div>
                        <div class="mt-2 pr-3 content">
                            <p><?= $item['des'] ?></p>
                        </div>
                        <h3 id="change-price">&#8369;<span id="price-display"><?= number_format($item['price'], 2) ?></span></h3>
                        <div class="ratings d-flex flex-row align-items-center">
                            <div class="d-flex flex-row"><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bx-star'></i> </div> <span>441 reviews</span>
                        </div>
                        <p>
                            <?php foreach ($var as $variants) :
                                $unit_get;
                                if (htmlspecialchars($item['units']) == 1) {
                                    echo $unit_get = htmlspecialchars($variants['v_weight'] . "ml ");
                                } else if (htmlspecialchars($item['units']) == 2) {
                                    echo $unit_get = htmlspecialchars($variants['v_weight'] . "g ");
                                } else if (htmlspecialchars($item['units']) == 3) {
                                    echo $unit_get = htmlspecialchars($variants['v_weight'] . "kg ");
                                } else {
                                    exit();
                                } ?>

                        <form action="payment.php" method="post">
                            <input type="hidden" name="weight" value="<?= htmlspecialchars($variants['v_weight']) ?>">

                        <?php endforeach; ?>
                        </p>
                        <p><?= htmlspecialchars($item['des']) ?></p>
                        <form action="payment.php" method="post">

                            <input type="hidden" name="price" value="<?= htmlspecialchars($item['price']) ?>">
                            <input type="hidden" name="units" value="<?php echo $_SESSION['units'] = $item['units']; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                            <input type="hidden" name="item_id" value="<?php echo $_SESSION['i_img'] = $item['i_img']; ?>">

                            <div class="mt-5"> <span class="fw-bold">Variants</span>
                                <div class="">
                                    <ul id="marker" style="padding-left: 0 !important; display: flex; flex-wrap: wrap; list-style: none">

                                        <?php foreach ($var as $variants) : ?>
                                            <li id="marker-1">
                                                <label class="radio" style="margin: 3px !important;">
                                                    <input
                                                        type="radio"
                                                        class="variant-option"
                                                        name="variant"
                                                        value="<?= htmlspecialchars($variants['var_id']) ?>"
                                                        data-price="<?= htmlspecialchars($variants['v_price']) ?>">
                                                    <span><?= htmlspecialchars($variants['variable']) ?></span>
                                                </label>
                                            </li>
                                        <?php endforeach; ?>

                                    </ul>
                                </div>
                            </div>
                            <div class="mt-5">
                                <p class="fw-bold">Quantity</p>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-outline-secondary px-3" id="decrement" style="border-radius: 0;">-</button>
                                    <input type="text" class="btn-outline-secondary form-control text-center total_quantity" id="total_quantity" name="quantity" value="1" min="1" style="width: 60px; border-radius: 0;">
                                    <button type="button" class="btn btn-outline-secondary px-3" id="increment" style="border-radius: 0;">+</button>
                                </div>
                            </div>
                            <div class="buttons d-flex flex-row mt-5 gap-3">
                                <button type="submit" name="buy_it_now" class="btn btn-outline-dark" id="buy_it_now">Buy Now</button>

                                <button type="button" class="btn btn-dark" id="add_to_cart">Add to Cart</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col-md border" style="margin-top: 20px;">
            <div class="right-side">
                <div class="container d-flex align-items-center justify-content-center">
                    <div class="bg-card" style="width: 100%;">
                        <div class="card centered-card">
                            <div class="card-header">
                                <h4 class="card-title mb-4 mt-4">
                                    Customer Reviews
                                </h4>
                                <div cass="table-responsive mb-4 rounded-1">
                                    <table class="table mb-0 align-middle">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://svgshare.com/i/17bj.svg" class="rounded-circle" width="30" height="30">
                                                        <div class="ms-3">
                                                            <h6 class="fs-6 fw-semibold mb-0 text-nowrap">Sunil Joshi</h6>
                                                            <div class="star d-flex align-items-center gap-1 mb-1" style="color: orange">
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>

                                                    <span class="mb-0 fw-normal fs-7 mt-2 text-muted">I like this design</span>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal fs-7 text-end text-nowrap text-muted">1 day ago</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.variant-option').on('change', function() {
            const selectedPrice = $(this).data('price');

            $('#price-display').text(selectedPrice.toFixed(2));
            $('input[name="price"]').val(selectedPrice);
        });
    });

    $(document).ready(function() {
        $('#add_to_cart').click(function() {

            const user_id = $('input[name="user_id"]').val();
            const item_id = $('input[name="item_id"]').val();
            const weight = $('input[name="weight"]').val();
            const variant = $('input[name="variant"]:checked').val();
            const units = $('input[name="units"]').val();
            const price = $('input[name="price"]').val();
            const quantity = $('input[name="quantity"]').val();

            console.log(item_id,
                user_id,
                variant,
                units,
                price,
                quantity)

            $.ajax({
                url: "../../database/user.php",
                type: "post",
                data: {
                    'add_to_cart': true,
                    'item_id': item_id,
                    'user_id': user_id,
                    'variant': variant,
                    'units': units,
                    'price': price,
                    'weight': weight,
                    'quantity': quantity
                },
                success: function(data) {
                    window.location.reload();
                }
            });
        })

        $('#buy_it_now').click(function() {
            const
                price = $(this).data('item_price'),
                item_id = $(this).data('item_id'),
                user_id = $(this).data('user_id'),
                variant = $('input[name="variant"]:checked').val(),
                new_quantity = $('.total_quantity').val();

            console.log(item_id, user_id, variant, new_quantity, price);

            $.ajax({
                url: "../../database/user.php",
                type: "post",
                data: {
                    'buy_now': true,
                    'price': price,
                    'item_id': item_id,
                    'new_quantity': new_quantity,
                    'variant': variant,
                    'user_id': user_id
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });


    })
    const quantityInput = document.getElementById('total_quantity');
    const incrementBtn = document.getElementById('increment');
    const decrementBtn = document.getElementById('decrement');

    incrementBtn.addEventListener('click', () => {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    decrementBtn.addEventListener('click', () => {
        if (quantityInput.value > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });

    function changeImage(element) {
        var main_prodcut_image = document.getElementById('main_product_image');
        main_prodcut_image.src = element.src;
    }
</script>