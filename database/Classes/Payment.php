<?php

namespace Classes;

require_once __DIR__ . "/Connection.php";

use Exception;
use Classes\Connection;

class Payment extends Connection
{
    public function generateTrackingNumber()
    {
        $gen = strtoupper(bin2hex(random_bytes(3)));
        $gen2 = strtoupper(bin2hex(random_bytes(4)));
        return "ZL-" . $gen . "-" . $gen2;
    }

    public function generateOrderToken()
    {
        return strtoupper(bin2hex(random_bytes(4)));
    }

    public function place_all_order($user_id, $product_id, $quantity, $price, $variant, $shipping, $tracking_number, $order_token)
    {
        try {
            $stmt_order = $this->getPdo()->prepare("
                INSERT INTO orders (
                    user, 
                    item, 
                    variant, 
                    order_price, 
                    total_quantity, 
                    ship_fee, 
                    tracking_number, 
                    order_token, 
                    order_date, 
                    order_status
                ) 
                VALUES (
                    :user_id, 
                    :product_id, 
                    :variant, 
                    :price, 
                    :quantity, 
                    :shipping, 
                    :tracking_number, 
                    :order_token, 
                    NOW(), 
                    1
                )
            ");
    
            $stmt_order->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $stmt_order->bindParam(':product_id', $product_id, \PDO::PARAM_INT);
            $stmt_order->bindParam(':variant', $variant, \PDO::PARAM_STR);
            $stmt_order->bindParam(':price', $price, \PDO::PARAM_STR);
            $stmt_order->bindParam(':quantity', $quantity, \PDO::PARAM_INT);
            $stmt_order->bindParam(':shipping', $shipping, \PDO::PARAM_STR);
            $stmt_order->bindParam(':tracking_number', $tracking_number, \PDO::PARAM_STR);
            $stmt_order->bindParam(':order_token', $order_token, \PDO::PARAM_STR);
    
            $stmt_order->execute();
            $placed = $this->getPdo()->lastInsertId();
    
            $stmt_delete_cart = $this->getPdo()->prepare("
                DELETE FROM cart 
                WHERE user_id = :user_id 
                AND item_id = :product_id
                AND c_var = :variant
            ");
    
            $stmt_delete_cart->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $stmt_delete_cart->bindParam(':product_id', $product_id, \PDO::PARAM_INT);
            $stmt_delete_cart->bindParam(':variant', $variant, \PDO::PARAM_STR);
    
            $stmt_delete_cart->execute();
            return $placed;
        } catch (\PDOException $e) {
            throw new Exception("Failed to place order: " . $e->getMessage());
        }
    }
    

    public function place_order($user_id, $product_id, $quantity, $price, $variant, $shipping)
    {
        try {
            $tracking_number = $this->generateTrackingNumber();
            $order_token = $this->generateOrderToken();

            $stmt_order = $this->getPdo()->prepare("INSERT INTO orders (user, item, variant, order_price, total_quantity, ship_fee, tracking_number, order_token, order_date , order_status) VALUES 
            
            (:user_id, :product_id, :variant, :price, :quantity, :shipping, :tracking_number, :order_token, NOW(), 1)");

            $stmt_order->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $stmt_order->bindParam(':product_id', $product_id, \PDO::PARAM_INT);
            $stmt_order->bindParam(':variant', $variant, \PDO::PARAM_INT);
            $stmt_order->bindParam(':price', $price, \PDO::PARAM_INT);
            $stmt_order->bindParam(':quantity', $quantity, \PDO::PARAM_INT);
            $stmt_order->bindParam(':shipping', $shipping, \PDO::PARAM_INT);
            $stmt_order->bindParam(':tracking_number', $tracking_number, \PDO::PARAM_STR);
            $stmt_order->bindParam(':order_token', $order_token, \PDO::PARAM_STR);

            $stmt_order->execute();
            $placed = $this->getPdo()->lastInsertId();

            return $placed;
        } catch (\PDOException $e) {
            throw new Exception("Failed to place order: " . $e->getMessage());
        }
    }

    public function units($product_id, $quantity, $density = 1.0)
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT * FROM items_data WHERE i_img = :product_id");
            $stmt->bindParam(':product_id', $product_id, \PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$data) {
                throw new Exception('Product not found.');
            }

            $units = $data['units'];
            $weight = $data['weight'];
            $weightInKg = 0;

            if ($units == 1) {
                $weightInKg = (($quantity * $weight) * $density) / 1000;
            } elseif ($units == 2) {
                $weightInKg = ($quantity * $weight) / 1000;
            } elseif ($units == 3) {
                $weightInKg = $weight * $quantity;
            } else {
                $weightInKg = 0;
                echo "Invalid unit type specified.";
            }

            if ($weightInKg < 0.5) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM delivery WHERE zipcodes = :zipcode AND _5 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if (!empty($zipData)) {
                    $result_total = $zipData[0]['_5'] * $quantity;
                    return $result_total;
                }
            } elseif ($weightInKg >= 0.5 && $weightInKg < 1.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM delivery WHERE zipcodes = :zipcode AND 5_1 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if (!empty($zipData)) {
                    $result_total = $zipData[0]['5_1'] * $quantity;
                    return $result_total;
                }
            } elseif ($weightInKg >= 1.0 && $weightInKg < 3.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM delivery WHERE zipcodes = :zipcode AND 1_3 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if (!empty($zipData)) {
                    $result_total = $zipData[0]['1_3'] * $quantity;
                    return $result_total;
                }
            } elseif ($weightInKg >= 3.0 && $weightInKg < 4.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM delivery WHERE zipcodes = :zipcode AND 3_4 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if (!empty($zipData)) {
                    $result_total = $zipData[0]['3_4'] * $quantity;
                    return $result_total;
                }
            } elseif ($weightInKg >= 4.0 && $weightInKg < 5.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM delivery WHERE zipcodes = :zipcode AND 4_5 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if (!empty($zipData)) {
                    $result_total = $zipData[0]['4_5'] * $quantity;
                    return $result_total;
                }
            } elseif ($weightInKg >= 5.0 && $weightInKg < 6.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM delivery WHERE zipcodes = :zipcode AND 5_6 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if (!empty($zipData)) {
                    $result_total = $zipData[0]['5_6'] * $quantity;
                    return $result_total;
                }
            } else {
                echo "Limit exceeded";
            }

            return $weightInKg;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.']);
            exit;
        } catch (\Exception $e) {
            error_log("Error: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }
    }

    public function search_zip($zipcode, $product_id, $quantity, $density = 1.0)
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT * FROM items_data WHERE i_img = :product_id");
            $stmt->bindParam(':product_id', $product_id, \PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$data) {
                throw new Exception('Product not found.');
            }

            $units = $data['units'];
            $weight = $data['weight'];
            $weightInKg = 0;

            if ($units == 1) {
                $weightInKg = (($quantity * $weight) * $density) / 1000;
            } elseif ($units == 2) {
                $weightInKg = ($quantity * $weight) / 1000;
            } elseif ($units == 3) {
                $weightInKg = $weight * $quantity;
            } else {
                $weightInKg = 0;
                echo "Invalid unit type specified.";
            }

            if ($weightInKg < 0.5) {

                $stmt = $this->getPdo()->prepare("SELECT * FROM delivery WHERE zipcodes = :zipcode AND _5 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if (!empty($zipData)) {
                    $result_total = $zipData[0]['_5'] * $quantity;
                    return $result_total;
                }
            } elseif ($weightInKg >= 0.5 && $weightInKg < 1.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM delivery WHERE zipcodes = :zipcode AND 5_1 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if (!empty($zipData)) {
                    $result_total = $zipData[0]['5_1'] * $quantity;
                    return $result_total;
                }
            } elseif ($weightInKg >= 1.0 && $weightInKg < 3.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM delivery WHERE zipcodes = :zipcode AND 1_3 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if (!empty($zipData)) {
                    $result_total = $zipData[0]['1_3'] * $quantity;
                    return $result_total;
                }
            } elseif ($weightInKg >= 3.0 && $weightInKg < 4.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM delivery WHERE zipcodes = :zipcode AND 3_4 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if (!empty($zipData)) {
                    $result_total = $zipData[0]['3_4'] * $quantity;
                    return $result_total;
                }
            } elseif ($weightInKg >= 4.0 && $weightInKg < 5.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM delivery WHERE zipcodes = :zipcode AND 4_5 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if (!empty($zipData)) {
                    $result_total = $zipData[0]['4_5'] * $quantity;
                    return $result_total;
                }
            } elseif ($weightInKg >= 5.0 && $weightInKg < 6.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM delivery WHERE zipcodes = :zipcode AND 5_6 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if (!empty($zipData)) {
                    $result_total = $zipData[0]['5_6'] * $quantity;
                    return $result_total;
                }
            } else {
                echo "Limit exceeded";
            }

            return $weightInKg;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.']);
            exit;
        } catch (\Exception $e) {
            error_log("Error: " . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }
    }

    public function cart_zip($zipcode, $weight)
    {
        try {
            if ($weight < 0.5) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM j_t WHERE zipcodes = :zipcode AND _500 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return !empty($zipData) ? $zipData[0]['_500'] : 0;
            } elseif ($weight >= 0.5 && $weight < 1.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM j_t WHERE zipcodes = :zipcode AND 500_1000 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return !empty($zipData) ? $zipData[0]['500_1000'] : 0;
            } elseif ($weight >= 1.0 && $weight < 3.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM j_t WHERE zipcodes = :zipcode AND 1000_3000 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return !empty($zipData) ? $zipData[0]['1000_3000'] : 0;
            } elseif ($weight >= 3.0 && $weight < 4.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM j_t WHERE zipcodes = :zipcode AND 3000_4000 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return !empty($zipData) ? $zipData[0]['3000_4000'] : 0;
            } elseif ($weight >= 4.0 && $weight < 5.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM j_t WHERE zipcodes = :zipcode AND 4000_5000 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return !empty($zipData) ? $zipData[0]['4000_5000'] : 0;
            } elseif ($weight >= 5.0 && $weight < 6.0) {
                $stmt = $this->getPdo()->prepare("SELECT * FROM j_t WHERE zipcodes = :zipcode AND 5000_6000 IS NOT NULL");
                $stmt->bindParam(':zipcode', $zipcode, \PDO::PARAM_INT);
                $stmt->execute();
                $zipData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return !empty($zipData) ? $zipData[0]['5000_6000'] : 0;
            } else {
                return 0;
            }
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            return 0;
        } catch (\Exception $e) {
            error_log("Error: " . $e->getMessage());
            return 0; // Handle other errors
        }
    }

    public function update_info($mobile, $fname, $lname, $house, $address, $zip, $city, $region, $user_id)
    {
        try {
            $stmt_user = $this->getPdo()->prepare("
            UPDATE users 
            SET mobile = :mobile, 
                fname = :fname, 
                lname = :lname, 
                house = :house, 
                brgy = :address, 
                zip = :zip, 
                city = :city, 
                region = :region
            WHERE user_id = :user_id
        ");

            $stmt_user->bindParam(':mobile', $mobile, \PDO::PARAM_STR);
            $stmt_user->bindParam(':fname', $fname, \PDO::PARAM_STR);
            $stmt_user->bindParam(':lname', $lname, \PDO::PARAM_STR);
            $stmt_user->bindParam(':house', $house, \PDO::PARAM_STR);
            $stmt_user->bindParam(':address', $address, \PDO::PARAM_STR);
            $stmt_user->bindParam(':zip', $zip, \PDO::PARAM_INT);
            $stmt_user->bindParam(':city', $city, \PDO::PARAM_STR);
            $stmt_user->bindParam(':region', $region, \PDO::PARAM_STR);
            $stmt_user->bindParam(':user_id', $user_id, \PDO::PARAM_INT);

            $stmt_user->execute();

            $info = $stmt_user->rowCount() > 0;
            return $info;
        } catch (\PDOException $e) {
            throw new Exception("Failed to update user information: " . $e->getMessage());
        }
    }
}
