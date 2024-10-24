<?php

require_once('Classes/Users.php');

use Classes\Users;

$users = new Users();

$items = $users->user_items();
$cat = $users->user_category();

if (isset($_GET['item'])) {
    $id = filter_input(INPUT_GET, 'item', FILTER_VALIDATE_INT);

    if ($id !== false && $id > 0) {
        try {
            $get = $users->user_get_item($id);
            $var = $users->user_get_variants($id);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            exit();
        }
    } else {
        error_log("Invalid item ID: " . htmlspecialchars($_GET['item']));
        exit();
    }
} else {
    exit();
}
