<?php
require_once 'Classes/Payment.php';

use Classes\Payment;

$payment = new Payment();


if (isset($_POST['placed_order_now'])) {
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $house = filter_input(INPUT_POST, 'house', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_NUMBER_INT);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $region = filter_input(INPUT_POST, 'region', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
    $variant = filter_input(INPUT_POST, 'variant', FILTER_SANITIZE_NUMBER_INT);
    $shipping = filter_input(INPUT_POST, 'shipping', FILTER_SANITIZE_NUMBER_INT);

    $total = floatval($price) * intval($quantity);
    $tracking_number = $payment->generateTrackingNumber();
    $order_token = $payment->generateOrderToken();

    try {
        
        $placed = $payment->place_all_order($user_id, $product_id, $quantity, $price, $variant, $shipping, $tracking_number, $order_token);
        $info = $payment->update_info($mobile, $fname, $lname, $house, $address, $zip, $city, $region, $user_id);

    } catch (PDOException $e) {
        die ("Database error: " . $e->getMessage());
    }
}

if (isset($_POST['placed_order_all'])) {
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $house = filter_input(INPUT_POST, 'house', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_NUMBER_INT);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $region = filter_input(INPUT_POST, 'region', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
    $shipping = filter_input(INPUT_POST, 'shipping', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $productDetails = json_decode($_POST['productDetails'], true);

    $tracking_number = $payment->generateTrackingNumber();
    $order_token = $payment->generateOrderToken();

    try {
        foreach ($productDetails as $product) {
            $product_id = filter_var($product['product_id'], FILTER_SANITIZE_NUMBER_INT);
            $quantity = filter_var($product['quantity'], FILTER_SANITIZE_NUMBER_INT);
            $price = filter_var($product['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $variant = filter_var($product['variant'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($product_id && $quantity && $price && $variant) {
                $total = floatval($price) * intval($quantity);

                $placed = $payment->place_all_order($user_id, $product_id, $quantity, $price, $variant, $shipping, $tracking_number, $order_token);
                
            } else {
                throw new Exception("Invalid product data: Some fields are missing.");
            }
        }

        $info = $payment->update_info($mobile, $fname, $lname, $house, $address, $zip, $city, $region, $user_id);

    } catch (Exception $e) {
        die("Database error: " . $e->getMessage());
    }
}

if (isset($_POST['search_zip'])) {

    $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_NUMBER_INT);
    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
    $subtotal = filter_input(INPUT_POST, 'subtotal', FILTER_SANITIZE_NUMBER_INT);

    $shipping_fee = $payment->search_zip($zipcode, $product_id, $quantity, $density = 1.0);

    header('Content-Type: application/json');

    if (is_numeric($shipping_fee) && $shipping_fee > 0) {
        echo json_encode([
            'success' => true,
            'shipping_fee' => htmlspecialchars($shipping_fee),
            'estimated_days' => htmlspecialchars($result['days']),
            'total_pay' => htmlspecialchars($shipping_fee + $subtotal)
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Fee not available or limit exceeded'
        ]);
    }
    exit;
}

if (isset($_POST['cart_zipcode'])) {
    $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_NUMBER_INT);
    $subtotal = filter_input(INPUT_POST, 'subtotal', FILTER_SANITIZE_NUMBER_INT);
    $weight = filter_input(INPUT_POST, 'weight', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $cart_fee = $payment->cart_zip($zipcode, $weight);

    header('Content-Type: application/json');

    if (is_numeric($cart_fee) && $cart_fee > 0) {
        echo json_encode([
            'success' => true,
            'shipping_fee' => htmlspecialchars($cart_fee),
            'total_pay' => htmlspecialchars(number_format($cart_fee + $subtotal, 2)),
            'total_pay2' => htmlspecialchars($cart_fee + $subtotal)
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Fee not available or limit exceeded'
        ]);
    }
    exit;
}
