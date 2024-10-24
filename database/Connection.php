<?php

require __DIR__ . "/../vendor/autoload.php"; 

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$db = new mysqli(
    $_ENV["DATABASE_HOSTNAME"],
    $_ENV["DATABASE_USERNAME"],
    $_ENV["DATABASE_PASSWORD"],
    $_ENV["DATABASE_DBNAME"]
);


// if ($db->connect_error) {
//     die("Connection failed: " . $db->connect_error);
// } else {
//     echo "Connected successfully";
// }
