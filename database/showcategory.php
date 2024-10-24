<?php
require('Connection.php');

$result = $db->query("SELECT * FROM categories");
$response = array();

if ($result->num_rows > 0) {
    $types = array();
    while ($row = $result->fetch_assoc()) {
        $types[] = array(
            'cat' => $row['cat'],
            'c_id' => $row['c_id'],
        );
    }
    $response['success'] = true;
    $response['types'] = $types;
    echo json_encode($response);
} else {
    $response['success'] = false;
    echo json_encode($response);
}