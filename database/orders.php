<?php

require_once('Connection.php');

if (isset($_POST['check_order'])) {
    $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
    $item_id = filter_var($_POST['item_id'], FILTER_SANITIZE_NUMBER_INT);
    $total_quantity = filter_var($_POST['total_quantity'], FILTER_SANITIZE_NUMBER_INT);

    $select = $db->query("SELECT * FROM orders INNER JOIN users ON orders.user_id = users.user_id INNER JOIN items_data ON orders.item_id=items_data.i_img WHERE orders.user_id= '$user_id' AND items_data.i_img= '$item_id'");


    foreach ($select as $row): ?>

        <div>
            <h6>Order id: <?= $row['order_id'] ?></h6>

            <h6>Contact</h6>
            <div class="row g-3 mt-2 mb-6">
                <div class="col-sm pr-0">
                    <p>First Name: <?= $row['fname'] ?></p>
                </div>
                <div class="col-sm pr-0">
                    <p>Last Name: <?= $row['lname'] ?></p>
                </div>
                <div class="col-sm pr-0">
                    <p>Mobile: <?= $row['mobile'] ?></p>
                </div>
            </div>

            <h6>Delivery</h6>
            <div class="row g-3 mt-2">
                <div class="col-sm pr-0">
                    <p>Address: <?= $row['city'] ?></p>
                </div>
                <div class="col-sm pr-0">
                    <p>Street,apartment,block,etc: <?= $row['house'] ?></p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-sm pr-0">
                    <p>Postal Code: <?= $row['zip'] ?></p>
                </div>
                <div class="col-sm pr-0">
                    <p>City: <?= $row['city'] ?></p>
                </div>
                <div class="col-sm pr-0">
                    <p>Region: <?= $row['region'] ?></p>
                </div>
            </div>

            <h6 class="mt-4">Item Info</h6>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="font-style: oblique;">
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                </tbody>
            </table>
        </div>
<?php endforeach;
}
