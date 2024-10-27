<?php

namespace Classes;

require_once __DIR__ . "/Connection.php";

use Exception;
use Classes\Connection;

class Users extends Connection
{

    public function set_zero($session)
    {
        try {
            $stmt = $this->getPdo()->prepare(
                "UPDATE orders 
                SET order_status = 0 
                WHERE order_token = :session"
            );

            $stmt->bindParam(':session', $session, \PDO::PARAM_STR);

            $set = $stmt->execute();
            return $set;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function get_ratings_list($item_id)
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT * FROM rating WHERE item_id = :item_id");
            $stmt->bindParam(':item_id', $item_id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $result; 
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            return 0; 
        }
    }

    public function getRatingCountByItemId($item_id)
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT COUNT(*) AS rating_count FROM rating WHERE item_id = :item_id");
            $stmt->bindParam(':item_id', $item_id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $result ? (int) $result['rating_count'] : 0; 
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            return 0; 
        }
    }

    public function getAverageRatingByItemId($item_id)
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT AVG(rate_data) AS average_rating FROM rating WHERE item_id = :item_id");
            $stmt->bindParam(':item_id', $item_id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $result ? round($result['average_rating'], 1) : 0;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function rating($insight, $item_rate_data, $user_id, $item_id, $session, $image)
    {
        try {
            $stmt = $this->getPdo()->prepare("INSERT INTO rating (rate_img, user_id, text, item_id, rate_data, date_added, rate_session) 
            VALUES (:image, :user_id, :insight, :item_id, :item_rate_data, NOW(), :session)");

            $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $stmt->bindParam(':insight', $insight, \PDO::PARAM_STR);
            $stmt->bindParam(':session', $session, \PDO::PARAM_STR);
            $stmt->bindParam(':item_id', $item_id, \PDO::PARAM_INT);
            $stmt->bindParam(':item_rate_data', $item_rate_data, \PDO::PARAM_INT);
            $stmt->bindParam(':image', $image, \PDO::PARAM_STR);

            $user = $stmt->execute();

            return $user;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function select($mobile)
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT * FROM users WHERE mobile = :mobile");
            $stmt->bindParam(':mobile', $mobile, \PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $user;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function insert_user($mobile, $hashed_pass)
    {
        try {
            $stmt = $this->getPdo()->prepare("INSERT INTO users (mobile, pass, created_at) VALUES (:mobile, :hashed_pass, NOW())");
            $stmt->bindParam(':mobile', $mobile, \PDO::PARAM_INT);
            $stmt->bindParam(':hashed_pass', $hashed_pass, \PDO::PARAM_STR);
            $user = $stmt->execute();
            return $user;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function user_info($userId)
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT * FROM users WHERE user_id = :userId");
            $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
            $stmt->execute();

            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $user;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function user_items()
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT * FROM items_data WHERE quantity NOT IN (0)");
            $stmt->execute();

            $items = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $items;
        } catch (\PDOException $e) {
            throw new Exception("Failed to fetch items: " . $e->getMessage());
        }
    }

    public function product($product_id)
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT * FROM items_data i INNER JOIN product_variants p ON i.i_img = p.item_id WHERE i_img = :product_id");

            $stmt->bindParam(':product_id', $product_id, \PDO::PARAM_INT);
            $stmt->execute();

            $product = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $product;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function unit($variant)
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT * FROM product_variants WHERE var_id = :variant");

            $stmt->bindParam(':variant', $variant, \PDO::PARAM_INT);
            $stmt->execute();

            $product = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $product;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function user_category()
    {
        try {
            $stmt = $this->getPdo()->query("SELECT * FROM categories");

            $cat = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $cat;
        } catch (\PDOException $e) {
            throw new Exception("Failed to fetch categories: " . $e->getMessage());
        }
    }

    public function user_show_items_by_category($id)
    {
        if (!is_numeric($id)) {
            throw new Exception("Invalid ID provided.");
        }

        try {
            $stmt = $this->getPdo()->prepare("
            SELECT categories.c_id, categories.name, items_data.i_img, items_data.name AS item_name, items_data.price
            FROM categories 
            INNER JOIN items_data ON categories.c_id = items_data.category 
            WHERE categories.c_id = :id
        ");

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();

            $items = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $items;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function user_show_items_price($id)
    {
        if (!is_numeric($id)) {
            throw new Exception("Invalid ID provided.");
        }

        try {
            $stmt = $this->getPdo()->prepare("
                SELECT * FROM categories 
                INNER JOIN items_data ON categories.c_id = items_data.category 
                WHERE items_data.category = :categoryId
            ");

            $stmt->bindParam(':categoryId', $id, \PDO::PARAM_INT);
            $stmt->execute();

            $items = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $items;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function user_get_item($id)
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT * FROM items_data WHERE i_img = :id");

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $get = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $get;
        } catch (\PDOException $e) {
            throw new Exception("Failed to fetch categories: " . $e->getMessage());
        }
    }

    public function user_get_variants($id)
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT * FROM product_variants WHERE item_id = :id");

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $var = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $var;
        } catch (\PDOException $e) {
            throw new Exception("Failed to fetch categories: " . $e->getMessage());
        }
    }

    public function increment($itemId, $user, $cartId)
    {
        try {
            $stmt = $this->getPdo()->prepare("UPDATE cart SET c_quantity = c_quantity + 1 WHERE item_id = :itemId AND user_id = :user AND cart_id = :cartId ");
            $stmt->bindParam(':itemId', $itemId, \PDO::PARAM_INT);
            $stmt->bindParam(':user', $user, \PDO::PARAM_INT);
            $stmt->bindParam(':cartId', $cartId, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            throw new Exception("Failed to update cart: " . $e->getMessage());
        }
    }

    public function decrement($itemId, $user, $cartId)
    {
        try {
            $stmt = $this->getPdo()->prepare("UPDATE cart SET c_quantity = c_quantity - 1 WHERE item_id = :itemId AND user_id = :user AND cart_id = :cartId ");
            $stmt->bindParam(':itemId', $itemId, \PDO::PARAM_INT);
            $stmt->bindParam(':user', $user, \PDO::PARAM_INT);
            $stmt->bindParam(':cartId', $cartId, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            throw new Exception("Failed to update cart: " . $e->getMessage());
        }
    }

    public function delete($itemId, $user, $cartId)
    {
        try {
            $stmt = $this->getPdo()->prepare("DELETE FROM cart WHERE item_id = :itemId AND user_id = :user AND cart_id = :cartId ");
            $stmt->bindParam(':itemId', $itemId, \PDO::PARAM_INT);
            $stmt->bindParam(':user', $user, \PDO::PARAM_INT);
            $stmt->bindParam(':cartId', $cartId, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            throw new Exception("Failed to delete from cart: " . $e->getMessage());
        }
    }

    public function user_cart2($id)
    {
        try {
            $stmt = $this->getPdo()->prepare(
                "SELECT * FROM cart c
                INNER JOIN items_data i ON c.item_id = i.i_img
                INNER JOIN product_variants p ON c.c_var = p.var_id
                WHERE c.user_id = :id"
            );

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $all_items_data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $all_items_data;
        } catch (\PDOException $e) {
            throw new Exception("Failed to fetch cart items: " . $e->getMessage());
        }
    }

    public function token($order_token)
    {
        try {
            $stmt = $this->getPdo()->prepare("
            SELECT 
                o.tracking_number, 
                i.img, 
                o.order_token, 
                o.order_id, 
                SUM(o.ship_fee) AS total_shipping_fee, 
                SUM(o.total_quantity) AS total_quantity,
                SUM(o.order_price * total_quantity) AS sub_total, 
                o.days,
                o.ship_fee,
                GROUP_CONCAT(DISTINCT o.item) AS items,
                GROUP_CONCAT(DISTINCT p.variable) AS variants,
                GROUP_CONCAT(DISTINCT i.i_img) AS images,
                o.order_date, 
                o.order_status 
            FROM orders o 
            INNER JOIN items_data i ON o.item = i.i_img 
            INNER JOIN product_variants p ON o.variant = p.var_id
            WHERE o.order_token = :order_token 
            GROUP BY o.tracking_number, o.order_token
        ");


            $stmt->bindParam(':order_token', $order_token, \PDO::PARAM_STR);
            $stmt->execute();
            $all_items_data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $all_items_data;
        } catch (\PDOException $e) {
            throw new Exception("Failed to fetch cart items: " . $e->getMessage());
        }
    }

    public function user_view_orders($user_id)
    {
        try {
            $stmt = $this->getPdo()->prepare("
                SELECT 
                    o.tracking_number, 
                    i.img, 
                    o.order_token, 
                    o.order_id, 
                    o.user,
                    o.item,
                    GROUP_CONCAT(DISTINCT o.item) AS items,
                    GROUP_CONCAT(DISTINCT p.var_id) AS variants,
                    GROUP_CONCAT(DISTINCT i.i_img) AS images,
                    o.order_date, 
                    o.order_status
                FROM orders o 
                INNER JOIN items_data i ON o.item = i.i_img 
                INNER JOIN product_variants p ON o.variant = p.var_id
                WHERE o.user = :user_id 
                GROUP BY o.tracking_number, o.order_token, o.order_status
            ");

            $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $stmt->execute();
            $all_items_data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $all_items_data;
        } catch (\PDOException $e) {
            throw new Exception("Failed to fetch cart items: " . $e->getMessage());
        }
    }

    public function user_cart($id)
    {
        try {
            $stmt = $this->getPdo()->prepare(
                "SELECT 
                    c.cart_id, 
                    i.*, 
                    v.var_id, 
                    v.variable, 
                    v.v_price,
                    v.stock, 
                    SUM(c.c_quantity) AS total_quantity
                FROM cart c
                INNER JOIN items_data i ON c.item_id = i.i_img
                LEFT JOIN product_variants v ON c.item_id = v.item_id AND c.c_var = v.var_id
                WHERE c.user_id = :id
                GROUP BY c.cart_id, c.item_id, v.var_id"
            );
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $all_items_data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $all_items_data;
        } catch (\PDOException $e) {
            throw new Exception("Failed to fetch cart items: " . $e->getMessage());
        }
    }

    public function user_add_to_cart($item_id, $user_id, $variant, $price, $units, $quantity, $weight)
    {
        try {

            $stmt = $this->getPdo()->prepare(
                "INSERT INTO cart (user_id, item_id, c_var, c_weight, c_price, units, c_quantity)
                 VALUES (:user_id, :item_id, :variant, :weight, :price, :units, :quantity)"
            );

            $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $stmt->bindParam(':item_id', $item_id, \PDO::PARAM_INT);
            $stmt->bindParam(':variant', $variant, \PDO::PARAM_INT);
            $stmt->bindParam(':weight', $weight, \PDO::PARAM_INT);
            $stmt->bindParam(':price', $price, \PDO::PARAM_INT);
            $stmt->bindParam(':units', $units, \PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, \PDO::PARAM_INT);

            $stmt->execute();

            return true;
        } catch (\PDOException $e) {
            throw new Exception("Failed to add item to cart: " . $e->getMessage());
        }
    }

    public function update_data($newpass, $vr_code)
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT device_token FROM users WHERE device_token = :vr_code");
            $stmt->bindParam(':vr_code', $vr_code, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    
            if (!$result) {
                throw new Exception("Invalid verification code. Update failed.");
            }
    
            $stmt = $this->getPdo()->prepare("UPDATE users SET pass = :newpass WHERE device_token = :vr_code");
            $stmt->bindParam(':newpass', $newpass, \PDO::PARAM_STR);
            $stmt->bindParam(':vr_code', $vr_code, \PDO::PARAM_STR);
            $updateResult = $stmt->execute();
    
            return $updateResult;
        } catch (\PDOException $e) {
            throw new Exception("Failed to update password: " . $e->getMessage());
        }
    }
    

    public function update_pass($newpass, $user_id)
    {
        try {
            $stmt = $this->getPdo()->prepare("UPDATE users SET pass = :newpass WHERE user_id = :user_id");
            $stmt->bindParam(':newpass', $newpass, \PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $result = $stmt->execute();

            return $result;
        } catch (\PDOException $e) {
            throw new Exception("Failed to update cart: " . $e->getMessage());
        }
    }

}
