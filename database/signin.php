<?php

require_once '../database/Connection.php';

session_start();

// if (isset($_COOKIE['device_token'])) {
//     $device_token = $_COOKIE['device_token'];

//     $stmt = $db->prepare("SELECT * FROM users WHERE device_token = ?");
//     $stmt->bind_param("s", $device_token);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows > 0) {
//         $user = $result->fetch_assoc();
//         $_SESSION['user_id'] = $user['user_id'];
//         $_SESSION['mobile'] = $user['mobile'];

//         if ($user['user_id'] === 89) {
//             header("Location: ../public/admin/");
//         } else {
//             header("Location: ../public/user/");
//         }
//         exit();
//     }
// }

if (isset($_POST['signin'])) {
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);

    if (!empty($mobile) && is_numeric($mobile)) {
        $stmt = $db->prepare("SELECT user_id, mobile, device_token FROM users WHERE mobile = ?");
        if ($stmt === false) {
            die("Error preparing the query: " . $db->error);
        }

        $stmt->bind_param("s", $mobile);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['mobile'] = $user['mobile'];

            if ($user['device_token'] === $_COOKIE['device_token']) {
                if ($user['user_id'] === 89) {
                    header("Location: ../public/admin/");
                } else {
                    header("Location: ../public/user/");
                }
                exit();
            } else {
                $device_token = bin2hex(random_bytes(16));
                $stmt = $db->prepare("UPDATE users SET device_token = ? WHERE user_id = ?");
                $stmt->bind_param("si", $device_token, $user['user_id']);
                $stmt->execute();

                setcookie('device_token', $device_token, time() + (86400 * 30), "/");

                if ($user['user_id'] === 89) {
                    header("Location: ../public/admin/");
                } else {
                    header("Location: ../public/user/");
                }
                exit();
            }
        } else {
            $stmt = $db->prepare("INSERT INTO users (mobile, created_at, device_token) VALUES (?, NOW(), ?)");
            if ($stmt === false) {
                die("Error preparing the insert query: " . $db->error);
            }

            $device_token = bin2hex(random_bytes(16));
            $stmt->bind_param("ss", $mobile, $device_token);

            if ($stmt->execute()) {

                $userId = $db->insert_id;
                $_SESSION['user_id'] = $userId;
                $_SESSION['mobile'] = $mobile;

                setcookie('device_token', $device_token, time() + (86400 * 30), "/");

                if ($userId === 89) {
                    header("Location: ../public/admin/");
                } else {
                    header("Location: ../public/user/");
                }
                exit();
            } else {
                return false;
            }
        }

        $stmt->close();
    } else {
        return false;
    }
}

$db->close();
