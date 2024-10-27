<?php

require_once('Classes/Users.php');

use Classes\Users;

$users = new Users();

if (isset($_GET['item'])) {
    $item = $_GET['item'];
    $item_id = filter_var($item, FILTER_SANITIZE_NUMBER_INT);

    $review_lists = $users->get_ratings_list($item_id);
    
}