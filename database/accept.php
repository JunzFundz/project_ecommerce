<?php
require_once('Classes/Admin.php');

use Classes\Admin;

$admin = new Admin();

if (isset($_POST['action'])) {
    // Sanitize and assign POST data
    $track = filter_input(INPUT_POST, 'track', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $token_in_order = filter_input(INPUT_POST, 'token_in_order', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    switch ($action) {
        case 'handed_over':
            $result = $admin->handleHandedOver( $track, $token_in_order);
            break;

        case 'on_the_way':
            $result = $admin->handleOnTheWay( $track, $token_in_order);
            break;

        case 'delivered':
            $result = $admin->handleDelivered( $track, $token_in_order);
            $result = $admin->set_tr_status($track, $token_in_order);
            break;

        default:
            echo 'Invalid action';
            break;
    }
} else {
    echo 'Invalid action';
}



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
            $admin->edit_item($quantities[$i], $items[$i]);
        }
    } else {
        $admin->edit($quantities, $variants, $items);
        $admin->edit_item($quantities, $items);
    }
    $transaction = $admin->start_transaction($order_token, $order_track, $total, $user_id);
    $update = $admin->set_one($order_token, $order_track, $user_id);
}