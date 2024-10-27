<?php

require_once('Classes/Users.php');

use Classes\Users;

$users = new Users();

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

if (isset($_POST['get_average_rating'])) {
    $item_id = filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);
    $average_rating = $users->getAverageRatingByItemId($item_id);
    $rating_count = $users->getRatingCountByItemId($item_id);

    echo json_encode(['average_rating' => $average_rating, 'total_ratings' => $rating_count]);
}


