<?php
require_once 'Classes/Users.php';

use Classes\Users;

$cart = new Users();

if (isset($_SESSION['user_id'])) {
    $id =  filter_var($_SESSION['user_id'], FILTER_VALIDATE_INT);

    $view = $cart->user_cart2($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = filter_input(INPUT_POST, 'itemId', FILTER_SANITIZE_NUMBER_INT);
    $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_NUMBER_INT);
    $cartId = filter_input(INPUT_POST, 'cart', FILTER_SANITIZE_NUMBER_INT);

    if ($itemId === false || $user === false || $cartId === false) {
        die("Invalid input data.");
    }

    if (isset($_POST['increment'])) {
        $increment = $cart->increment($itemId, $user, $cartId);
    } elseif (isset($_POST['decrement'])) {
        $decrement = $cart->decrement($itemId, $user, $cartId);
    } elseif (isset($_POST['delete'])) {
        $delete = $cart->delete($itemId, $user, $cartId);
    }
}
