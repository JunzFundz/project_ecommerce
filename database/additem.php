<?php
require_once('Connection.php');


if (isset($_POST['add_with_variants'])) {
    $uploadDirectory = isset($_POST['uploadDirectory']) ? $_POST['uploadDirectory'] : '../uploads/';
    $fileNames = array();

    if (!empty($_FILES['images']['size'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $fileName = $_FILES['images']['name'][$key];
            $targetFile = $uploadDirectory . basename($fileName);

            if (move_uploaded_file($tmp_name, $targetFile)) {
                $fileNames[] = $targetFile;
            } else {
                return 'error' . $fileName;
            }
        }
    } else {
        $fileNames = null;
    }

    $imgJson = json_encode($fileNames);

    $product = $_POST['product'];
    $category = $_POST['category'];
    $desc = $_POST['desc'];
    $units = $_POST['units'];
    $quantity = $_POST['quantity'];
    $expected_price = $_POST['expected_price'];

    $insert = $db->query("INSERT INTO items_data (category, img, name, des, units, quantity, price) VALUES ('$category', '$imgJson', '$product', '$desc', '$units', '$quantity', '$expected_price')");

    if ($insert) {
        $itemId = $db->insert_id;

        $variables = $_POST['variable'];
        $weights = $_POST['weight'];
        $prices = $_POST['prices'];
        $stocks = $_POST['stock'];

        foreach ($variables as $index => $variable) {
            $weight = isset($weights[$index]) ? (float)$weights[$index] : 0.0;
            $stock = isset($stocks[$index]) ? (int)$stocks[$index] : 0;
            $price = isset($prices[$index]) ? (int)$prices[$index] : 0;

            $variantInsert = $db->query("INSERT INTO product_variants (item_id, v_price, variable, stock, v_weight) VALUES ('$itemId', '$price', '$variable', '$stock', '$weight')");

            if (!$variantInsert) {
                echo "Error inserting variant: " . $db->error;
            }
        }

        echo "Product and variants added successfully.";
    } else {
        echo "Error inserting product: " . $db->error;
    }
}

if (isset($_POST['addcat'])) {
    $catname = $_POST['catname'];

    $insert = $db->query("INSERT INTO categories (cat) VALUES ('$catname')");

    header('location: ../public/admin/');
}

if (isset($_POST['check'])) {
    $itemid = $_POST['itemid'];

    $result = $db->query("SELECT * FROM items_data WHERE i_img = '$itemid'");

    $data_array = [];

    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $row) {
            array_push($data_array, $row);
            header('Content-Type: application/json');
            echo json_encode($data_array);
        }
    } else {
        echo "Error! No Data Found.";
    }
}

if (isset($_POST['update'])) {
    $itemid = $_POST['i_img'];
    $product = $_POST['product'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $desc = $_POST['desc'];
    $quantity = $_POST['quantity'];

    $result = $db->query("UPDATE items_data SET category='$category', name='$product', des='$desc', quantity= '$quantity', price = '$price' WHERE i_img='$itemid'");
    header('location: ../public/admin/');
}

if (isset($_POST['delete_item'])) {

    header('Content-Type: application/json');

    $item_id = filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);

    $stmt = $db->prepare("SELECT img FROM items_data WHERE i_img = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($img);
        $stmt->fetch();
        $stmt->close();

        $stmt = $db->prepare("DELETE FROM items_data WHERE i_img = ?");
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
        $stmt->close();

        $stmt = $db->prepare("DELETE FROM product_variants WHERE item_id = ?");
        $stmt->bind_param("i", $item_id);

        if ($stmt->execute()) {
            $uploadsDir = '../uploads/';
            $imagePath = $uploadsDir . basename($img);

            if ($img && file_exists($imagePath)) {
                unlink($imagePath);
            }

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete item from database.']);
        }

        $stmt->close();
    } else {

        echo json_encode(['success' => false, 'message' => 'Item not found.']);
    }

    $db->close();
}
