<?php

namespace Classes;

require_once __DIR__ . "/Connection.php";

use Exception;
use Classes\Connection;

class Admin extends Connection
{
    public function generateOrderToken()
    {
        return strtoupper(bin2hex(random_bytes(16)));
    }

    public function edit_item($quantity, $item)
    {
        try {
            $stmt = $this->getPdo()->prepare(
                "UPDATE items_data 
                SET quantity = quantity - :quantity 
                WHERE i_img = :item"
            );

            $stmt->bindParam(':quantity', $quantity, \PDO::PARAM_INT);
            $stmt->bindParam(':item', $item, \PDO::PARAM_INT);

            $result = $stmt->execute();
            return $result;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }
    public function edit($quantity, $variant, $item)
    {
        try {
            $stmt = $this->getPdo()->prepare(
                "UPDATE product_variants 
                SET stock = stock - :quantity 
                WHERE item_id = :item AND var_id = :variant"
            );

            $stmt->bindParam(':quantity', $quantity, \PDO::PARAM_INT);
            $stmt->bindParam(':variant', $variant, \PDO::PARAM_STR);
            $stmt->bindParam(':item', $item, \PDO::PARAM_INT);

            $transaction = $stmt->execute();
            return $transaction;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function set_one($order_token, $order_track, $user_id)
    {
        try {
            $stmt = $this->getPdo()->prepare(
                "UPDATE orders 
                SET order_status = 2 
                WHERE tracking_number = :order_track AND order_token = :order_token AND user = :user_id"
            );

            $stmt->bindParam(':order_track', $order_track, \PDO::PARAM_STR);
            $stmt->bindParam(':order_token', $order_token, \PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);

            $set = $stmt->execute();
            return $set;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function see_transactions()
    {
        try {
            $stmt = $this->getPdo()->query("SELECT t.*, u.*
                FROM transactions t
                INNER JOIN users u ON t.tr_user_id = u.user_id");
            $stmt->execute();
            $see_tr = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
            return $see_tr;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }
    

    public function start_transaction($order_token, $order_track, $total, $user_id)
    {
        $token = $this->generateOrderToken();
        try {
            $stmt = $this->getPdo()->prepare("INSERT INTO transactions (tr_order_number,tr_order_token,tr_user_id,tr_total_pay, tr_date, tr_token_pay, tr_status) VALUES(:order_track, :order_token, :user_id, :total, NOW(), :token, 1)");

            $stmt->bindParam(':order_track', $order_track, \PDO::PARAM_STR);
            $stmt->bindParam(':order_token', $order_token, \PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $stmt->bindParam(':total', $total, \PDO::PARAM_INT);
            $stmt->bindParam(':token', $token, \PDO::PARAM_STR);
            $transaction = $stmt->execute();
            return $transaction;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function view($track, $token_in_order)
    {
        try {
            $stmt = $this->getPdo()->prepare("SELECT o.*, u.*, i.*,
                GROUP_CONCAT(p.variable) AS variants_ordered,
                GROUP_CONCAT(i.name) AS item_ordered,
                GROUP_CONCAT(o.order_price) AS variants_prices,
                GROUP_CONCAT(o.item) AS item_id_ordered,
                GROUP_CONCAT(o.variant) AS variant_id_ordered,
                GROUP_CONCAT(o.total_quantity) AS quantity_that_ordered
                FROM orders o
                INNER JOIN users u ON o.user = u.user_id
                INNER JOIN product_variants p ON o.variant = p.var_id
                INNER JOIN items_data i ON o.item = i.i_img
                WHERE o.tracking_number = :track
                AND o.order_token = :token_in_order
                AND o.order_status = 1
                GROUP BY o.tracking_number, o.order_token
            ");

            $stmt->bindParam(':track', $track, \PDO::PARAM_STR);
            $stmt->bindParam(':token_in_order', $token_in_order, \PDO::PARAM_STR);
            $stmt->execute();

            $orders = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $orders;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function orders()
    {
        try {
            $stmt = $this->getPdo()->query("SELECT o.*, u.*, p.*, i.*, 
                COUNT(o.tracking_number) AS total_number_orders,
                SUM(o.order_price * o.total_quantity) AS total_orders,
                GROUP_CONCAT(o.order_price) AS variants_prices,
                GROUP_CONCAT(p.variable) AS variants_ordered,
                GROUP_CONCAT(i.i_img) AS item_ids,
                GROUP_CONCAT(o.variant) AS variants_ordered_in,
                GROUP_CONCAT(i.name) AS items_ordered,
                GROUP_CONCAT(o.total_quantity) AS quantity_ordered
                FROM orders o 
                INNER JOIN users u ON o.user = u.user_id
                INNER JOIN product_variants p ON o.variant = p.var_id
                INNER JOIN items_data i ON o.item = i.i_img
                WHERE o.order_status = 1
                GROUP BY o.tracking_number, o.order_token
            ");
            $stmt->execute();
            $orders = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $orders;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function accepted()
    {
        try {
            $stmt = $this->getPdo()->query("SELECT o.*, u.*, p.*, i.*, 
                COUNT(o.tracking_number) AS total_number_orders,
                SUM(o.order_price * o.total_quantity) AS total_orders,
                GROUP_CONCAT(o.order_price) AS variants_prices,
                GROUP_CONCAT(p.variable) AS variants_ordered,
                GROUP_CONCAT(i.i_img) AS item_ids,
                GROUP_CONCAT(o.variant) AS variants_ordered_in,
                GROUP_CONCAT(i.name) AS items_ordered,
                GROUP_CONCAT(o.total_quantity) AS quantity_ordered
                FROM orders o 
                INNER JOIN users u ON o.user = u.user_id
                INNER JOIN product_variants p ON o.variant = p.var_id
                INNER JOIN items_data i ON o.item = i.i_img
                WHERE o.order_status NOT IN (1, 5)
                GROUP BY o.tracking_number, o.order_token
            ");
            $stmt->execute();
            $orders = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $orders;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function handleHandedOver($track, $token_in_order)
    {
        try {
            $stmt = $this->getPdo()->prepare(
                "UPDATE orders 
                SET order_status = 3 
                WHERE tracking_number = :track AND order_token = :token_in_order"
            );

            $stmt->bindParam(':track', $track, \PDO::PARAM_STR);
            $stmt->bindParam(':token_in_order', $token_in_order, \PDO::PARAM_STR);

            $set = $stmt->execute();
            return $set;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function handleOnTheWay($track, $token_in_order)
    {
        try {
            $stmt = $this->getPdo()->prepare(
                "UPDATE orders 
                SET order_status = 4 
                WHERE tracking_number = :track AND order_token = :token_in_order"
            );

            $stmt->bindParam(':track', $track, \PDO::PARAM_STR);
            $stmt->bindParam(':token_in_order', $token_in_order, \PDO::PARAM_STR);

            $set = $stmt->execute();
            return $set;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function set_tr_status($track, $token_in_order)
    {
        try {
            $stmt = $this->getPdo()->prepare(
                "UPDATE transactions 
                SET tr_status = 2
                WHERE tr_order_number = :track AND tr_order_token = :token_in_order"
            );

            $stmt->bindParam(':track', $track, \PDO::PARAM_STR);
            $stmt->bindParam(':token_in_order', $token_in_order, \PDO::PARAM_STR);

            $set = $stmt->execute();
            return $set;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function handleDelivered($track, $token_in_order)
    {
        try {
            $stmt = $this->getPdo()->prepare(
                "UPDATE orders 
                SET order_status = 5 
                WHERE tracking_number = :track AND order_token = :token_in_order"
            );

            $stmt->bindParam(':track', $track, \PDO::PARAM_STR);
            $stmt->bindParam(':token_in_order', $token_in_order, \PDO::PARAM_STR);

            $set = $stmt->execute();
            return $set;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }

    public function handleCancelOrder($track, $token_in_order, $order_id)
    {
        try {
            $stmt = $this->getPdo()->prepare(
                "UPDATE orders 
                SET order_status = 6 
                WHERE tracking_number = :track AND order_token = :token_in_order AND order_id = :order_id"
            );

            $stmt->bindParam(':track', $track, \PDO::PARAM_STR);
            $stmt->bindParam(':token_in_order', $token_in_order, \PDO::PARAM_STR);
            $stmt->bindParam(':order_id', $order_id, \PDO::PARAM_INT);

            $set = $stmt->execute();
            return $set;
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }
}
