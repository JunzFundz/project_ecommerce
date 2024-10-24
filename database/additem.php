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

    if ($insert) {
        header('location: adminitems.php');
    }
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

if (isset($_POST['deleteImage'])) {

    $imageName = $_POST['imageName'];
    $itemid = $_POST['itemid'];

    $imagePath = '../uploads/' . $imageName;


    if (file_exists($imagePath)) {
        if (unlink($imagePath)) {
            
            $stmt = $conn->prepare("SELECT i_img, img FROM items_data WHERE i_img = ? AND name = ?");
            $stmt->bind_param("is", $itemid, $imageName);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $images = json_decode($row['img'], true);

                if (($key = array_search($imageName, $images)) !== false) {
                    unset($images[$key]);
                    $images = array_values($images);
                }

                $updatedImages = json_encode($images);

                $updateStmt = $conn->prepare("UPDATE items SET img = ? WHERE id = ?");
                $updateStmt->bind_param("si", $updatedImages, $itemid);

                if ($updateStmt->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Image deleted successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update the database.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Item not found.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete the image file.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Image not found.']);
    }
    exit;
}
?>
