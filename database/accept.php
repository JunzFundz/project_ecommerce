<?php
require_once('Classes/Admin.php');

use Classes\Admin;

$admin = new Admin();


if (isset($_POST['accept_order'])) {

    $order_token =  $_POST['order_token'];
    $order_track = $_POST['order_track'];
    $total = $_POST['total'];
    $user_id = $_POST['user_id'];

    $quantities = $_POST['quantities'];
    $variants = $_POST['variants'];
    $items = $_POST['items'];

    if (is_array($items) && is_array($quantities) && is_array($variants)) {
        for ($i = 0; $i < count($items); $i++) {
            $admin->edit($quantities[$i], $variants[$i], $items[$i]);
        }
    } else {
        $admin->edit($quantities, $variants, $items);
    }
    $transaction = $admin->start_transaction($order_token, $order_track, $total, $user_id, $quantities, $variants, $items);
}