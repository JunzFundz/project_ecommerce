<?php
require_once('Classes/Admin.php');

use Classes\Admin;

$admin = new Admin();

if (isset($_POST['show_ordered'])) {

    $track = $_POST['track'];
    $token_in_order = $_POST['token_in_order'];

    $track = filter_var($track, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $token_in_order = filter_var($token_in_order, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $view = $admin->view($track, $token_in_order);

    foreach ($view as $rows):
        $variants = explode(',', $rows['variants_ordered']);
        $items = explode(',', $rows['item_ordered']);
        $price = explode(',', $rows['variants_prices']);

        $item_id_ordered = explode(',', $rows['item_id_ordered']);
        $variant_id_ordered = explode(',', $rows['variant_id_ordered']);
        $quantity_that_ordered = explode(',', $rows['quantity_that_ordered']);
?>

        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Number</th>
                    <th scope="col">Address</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $rows['fname'] . " " . $rows['lname'] ?></td>
                    <td><?= $rows['mobile'] ?></td>
                    <td><?= $rows['city'] ?></td>
                </tr>
            </tbody>
        </table>

        <br>
        <h5>Order</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item</th>
                    <th scope="col">Variant</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $subtotal = 0;

                foreach ($variants as $index => $variant):
                    $quantityOrdered = $quantity_that_ordered[$index];
                    $itemPrice = $price[$index];
                    $total = $quantityOrdered * $itemPrice;
                    $subtotal += $total;
                ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= $items[$index] ?></td>
                        <td><?= $variant ?></td>
                        <td>x<?= $quantityOrdered ?></td>
                        <td><?= number_format($itemPrice, 2) ?></td>
                        <td><?= number_format($total, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <th scope="row" colspan="5">Sub Total</th>
                    <td><?= number_format($subtotal, 2) ?></td>
                </tr>
                <tr>
                    <th scope="row" colspan="5">Shipping</th>
                    <td style="color: red">+ <?= number_format($rows['ship_fee'], 2) ?></td>
                </tr>
                <tr>
                    <th scope="row" colspan="5">Total</th>
                    <td style="color: red; font-size: 20px"><?= number_format($subtotal + $rows['ship_fee'], 2) ?></td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <button type="button" class="btn btn-success accept_order" style="float: right; padding: 5px"
            data-order_token="<?= $rows['order_token'] ?>"
            data-order_track="<?= $rows['tracking_number'] ?>"
            data-total="<?= $subtotal + $rows['ship_fee']; ?>"
            data-user_id="<?= $rows['user_id'] ?>"

            data-quantities="<?= $rows['quantity_that_ordered']; ?>"
            data-item="<?= $rows['item_id_ordered']; ?>"
            data-variants="<?= $rows['variant_id_ordered']; ?>">Accept</button>

        <button type="button" class="btn btn-danger btn_cancel_order" style="float: right; padding: 5px; margin-right: 10px"
            data-track="<?= $rows['tracking_number'] ?>"
            data-token_in_order="<?= $rows['order_token'] ?>"
            data-order_id="<?= $rows['order_id'] ?>">Cancel order?</button>
<?php
    endforeach;
} ?>

<script>
    $(document).ready(function() {
        $('.btn_cancel_order').on('click', function() {
            const track = $(this).data('track');
            const token_in_order = $(this).data('token_in_order');
            const order_id = $(this).data('order_id');

            $.ajax({
                url: '../../database/accept.php',
                method: 'POST',
                data: {
                    'cancel_order': true,
                    'track': track,
                    'token_in_order': token_in_order,
                    'order_id': order_id
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        $('.accept_order').on('click', function() {
            const order_token = $(this).data('order_token');
            const order_track = $(this).data('order_track');
            const total = $(this).data('total');
            const user_id = $(this).data('user_id');

            let quantities = $(this).data('quantities');
            let variants = $(this).data('variants');
            let item = $(this).data('item');

            if (typeof variants === 'string' && typeof quantities === 'string' && typeof item === 'string') {
                variants = variants.split(',');
                quantities = quantities.split(',');
                item = item.split(',');
            }

            console.log(variants, item, quantities);

            const dataToSend = {
                'accept_order': true,
                order_token: order_token,
                order_track: order_track,
                total: total,
                user_id: user_id,
                quantities: quantities,
                variants: variants,
                items: item
            };

            $.ajax({
                url: '../../database/accept.php',
                type: 'POST',
                data: dataToSend,
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error accepting order:', error);
                    alert('There was an error processing your order. Please try again.');
                }
            });
        });
    });
</script>