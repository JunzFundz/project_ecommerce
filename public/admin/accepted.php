<?php
require_once('../../database/Classes/Admin.php');

use Classes\Admin;

$admin = new Admin();
$accepted = $admin->accepted();
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
            <?php if (!empty($accepted)) : ?>
                <?php foreach ($accepted as $rows) : ?>
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
                            <?php if ($rows['order_status'] == 2) { ?>

                                <button class="btn-danger handed_over" type="button"
                                    data-track="<?= $rows['tracking_number'] ?>"
                                    data-token_in_order="<?= $rows['order_token'] ?>">&#129309;</button>

                                <button class="btn-primary on_the_way" type="button"
                                    data-track="<?= $rows['tracking_number'] ?>"
                                    data-token_in_order="<?= $rows['order_token'] ?>">&#128666;</button>

                                <button class="btn-success delivered" style="color: red;" type="button"
                                    data-track="<?= $rows['tracking_number'] ?>"
                                    data-token_in_order="<?= $rows['order_token'] ?>">&#10004;</button>

                            <?php } elseif ($rows['order_status'] == 3) { ?>

                                <button class="btn-primary on_the_way" type="button"
                                    data-track="<?= $rows['tracking_number'] ?>"
                                    data-token_in_order="<?= $rows['order_token'] ?>">&#128666;</button>

                                <button class="btn-success delivered" style="color: red;" type="button"
                                    data-track="<?= $rows['tracking_number'] ?>"
                                    data-token_in_order="<?= $rows['order_token'] ?>">&#10004;</button>

                            <?php } elseif ($rows['order_status'] == 4) { ?>

                                <button class="btn-success delivered" style="color: red;" type="button"
                                    data-track="<?= $rows['tracking_number'] ?>"
                                    data-token_in_order="<?= $rows['order_token'] ?>">&#10004;</button>

                            <?php } ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No products available.</p>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.handed_over, .on_the_way, .delivered').on('click', function() {
            const track = $(this).data('track');
            const token_in_order = $(this).data('token_in_order');
            let action;
            if ($(this).hasClass('handed_over')) {
                action = 'handed_over';
            } else if ($(this).hasClass('on_the_way')) {
                action = 'on_the_way';
            } else if ($(this).hasClass('delivered')) {
                action = 'delivered';
            }

            $.ajax({
                url: '../../database/accept.php',
                method: 'POST',
                data: {
                    'action': action,
                    'track': track,
                    'token_in_order': token_in_order
                },
                success: function(response) {
                    Swal.fire({
                        title: "Order placed",
                        text: "Your order has been placed successfully.",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    });
</script>