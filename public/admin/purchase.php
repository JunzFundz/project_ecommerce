<?php
include('../../database/Classes/Admin.php');

use Classes\Admin;

$admin = new Admin();
$orders = $admin->orders();
?>

<br>
<div class="table-responsive">
    <table class="table table-hover text-center text-nowrap">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Shipping</th>
                <th scope="col">Total</th>
                <th scope="col">Total Orders</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)) : ?>
                <?php foreach ($orders as $rows) : ?>
                    <tr>
                        <th scope="row">
                            <?php echo $rows['fname'] . ' ' . $rows['lname']  ?>
                        </th>
                        <td>
                            <span class="text-danger">
                                <i class="fas fa-caret-down me-1"></i><span><?php echo $rows['items_ordered'] ?></span>
                            </span>
                        </td>
                        <td>
                            <span class="text-danger">
                                <i class="fas fa-caret-down me-1"></i><span>₱ <?php echo $rows['variants_prices'] ?></span>
                            </span>
                        </td>
                        <td>
                            <span class="text-danger">
                                <i class="fas fa-caret-up me-1"></i><span>+<?php echo number_format($rows['ship_fee'], 2) ?></span>
                            </span>
                        </td>
                        <td>
                            <span class="text-success">
                                <i class="fas fa-caret-up me-1"></i><span><?php echo number_format($rows['total_orders'] + $rows['ship_fee'], 2) ?></span>
                            </span>
                        </td>
                        <td>
                            <span class="text-success">
                                <i class="fas fa-caret-up me-1"></i><span><?php echo $rows['total_number_orders'] ?></span>
                            </span>
                        </td>
                        <td>
                            <button class="btn-primary view_ordered" type="button" data-track="<?= $rows['tracking_number'] ?>" 
                            data-token_in_order="<?= $rows['order_token'] ?>" 
                            data-variant="<?= $rows['variants_ordered_in'] ?>" data-order_id="<?= $rows['order_id'] ?>"
                            data-total_quantity="<?= $rows['quantity_ordered'] ?>"
                            >&#9998;</button>

                            <button class="btn-link" style="color: red;" type="button" onclick="deleteItem('<?php echo $rows['item']; ?>')">cancel</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No products available.</p>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('.view_ordered').on('click', function() {
        const track = $(this).data('track');
        const token_in_order = $(this).data('token_in_order');  

        console.log(track, token_in_order); 
        $.ajax({
            url: '../../database/admin.php',
            method: 'POST',
            data: {
                'show_ordered': true,
                'track': track,
                'token_in_order': token_in_order
            },
            success: function(response) {
                $('.modal-body').html(response);
                $('#orders_modal').modal('show');
            }
        });

    });
});

</script>