<?php

require_once('Classes/Users.php');

use Classes\Users;

$users = new Users();

$items = $users->user_items();
$cat = $users->user_category();