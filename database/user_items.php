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

if (isset($_POST['get_ratings_count'])) {
    $item_id = filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);

        header('Content-Type: application/json');

        $rating_count = $users->getRatingCountByItemId($item_id);

        if ($rating_count) {
            echo json_encode([
                'success' => true,
                'total_ratings' => $rating_count
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'total_ratings' => $rating_count
            ]);
        }
}


