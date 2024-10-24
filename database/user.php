<?php

require_once('Classes/Users.php');

use Classes\Users;

$users = new Users();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $get_orders = $users->user_view_orders($user_id);
}

if (isset($_SESSION['order_token'])) {
    $order_token = $_SESSION['order_token'];
    $token_data = $users->token($order_token);
}

if (isset($_POST['add_to_cart'])) {
    $item_id = filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
    $variant = filter_input(INPUT_POST, 'variant', FILTER_SANITIZE_NUMBER_INT);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $units = filter_input(INPUT_POST, 'units', FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
    $weight = filter_input(INPUT_POST, 'weight', FILTER_SANITIZE_NUMBER_INT);

    if (!$item_id || !$user_id || !$variant || !$price || !$units || !$quantity || !$weight) {
        echo "Invalid input data. Please check your entries.";
        exit;
    }

    $add = $users->user_add_to_cart($item_id, $user_id, $variant, $price, $units, $quantity, $weight);

    exit();
}

if (isset($_POST['buy_it_now'])) {
    $product_id = $_POST['item_id'];
    $user_id = $_POST['user_id'];
    $total_quantity = $_POST['quantity'];
    $variant = $_POST['variant'];
    $price = $_POST['price'];
    $units = $_POST['units'];
    $weight = $_POST['weight'];

    $total_weight_in_kg = 0;
    switch ($units) {
        case 3:
            $total_weight_in_kg += $total_quantity * $weight;
            break;
        case 2:
            $total_weight_in_kg += ($total_quantity * $weight) / 1000;
            break;
        case 1:
            $total_weight_in_kg += ($total_quantity * $weight) / 1000;
            break;
        default:
            echo "<p>Invalid unit type specified for product ID: {$product_id}</p>";
            exit();
    }
    $total_no_shipping = $price * $total_quantity;

    $product = $users->product($product_id);
    $get_variant = $users->unit($variant);
}

if (isset($_POST['users_id'])) {
    $userId = filter_input(INPUT_POST, 'users_id', FILTER_SANITIZE_NUMBER_INT);
    $user = $users->user_info($userId);

    header('Content-Type: application/json');
    echo json_encode($user);
    exit;
}

if (isset($_POST['buy_from_cart'])) {
    $product_ids = $_POST['item_id'];
    $user_ids = $_POST['user_id'];
    $quantities = $_POST['quantity'];
    $variants = $_POST['variant'];
    $prices = $_POST['price'];
    $units = $_POST['units'];
    $weights = $_POST['weight'];

    $total_no_shipping = 0;

    foreach ($product_ids as $index => $product_id) {
        $user_id = $user_ids[$index];
        $quantity = $quantities[$index];
        $price = $prices[$index];
        $variant = $variants[$index];
        $unit = $units[$index];
        $weight = $weights[$index];

        $quantity = (int)$quantity;
        $price = (float)str_replace(',', '', $price);

        $subtotal = $price * $quantity;

        $total_no_shipping += $subtotal;

        $fromcart = $users->product($product_id);
    }
}

if (isset($_POST['submit_data'])) {
    $product_id = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_NUMBER_INT);
    $user_id = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_NUMBER_INT);


    if ($user_id && $product_id) {
        $response = array(
            'success' => true,
            'user_id' => $user_id,
            'product_id' => $product_id
        );
    } else {
        $response = array(
            'success' => false
        );
    }

    echo json_encode($response);
    exit();
}

// if (isset($_POST['submit_data'])) {
//     $product_id = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_NUMBER_INT);
//     $user_id = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_NUMBER_INT);


//     if ($user_id && $product_id) {
//         $response = array(
//             'success' => true,
//             'user_id' => $user_id,
//             'product_id' => $product_id
//         );
//     } else {
//         $response = array(
//             'success' => false
//         );
//     }
//     echo json_encode($response);
//     exit();
// }
