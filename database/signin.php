<?php
require_once 'Classes/Users.php';
require_once 'Classes/Emails.php';

use Classes\Users;
use Classes\Emails;

$insert = new Users();
$send_mail = new Emails();

session_start();

if (isset($_POST['signin'])) {
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    function validate_inputs($mobile, $pass)
    {
        if (empty($mobile)) {
            return 'Mobile number cannot be empty!';
        }

        if (empty($pass)) {
            return 'Password cannot be empty!';
        }

        if (!ctype_digit($mobile)) {
            return 'Mobile number must contain only digits!';
        }

        if (strlen($mobile) < 10 || strlen($mobile) > 15) {
            return 'Mobile number must be between 10 to 15 digits!';
        }

        return true;
    }

    $validation_result = validate_inputs($mobile, $pass);

    if ($validation_result !== true) {
        echo '<script type="text/javascript">';
        echo 'alert("' . $validation_result . '");';
        echo 'window.location.href = "../pages/";';
        echo '</script>';
        exit();
    }

    $user = $insert->select($mobile);

    if ($user) {
        if (password_verify($pass, $user['pass'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['mobile'] = $user['mobile'];

            if ($user['user_id'] === 120) {
                header("Location: ../public/admin/");
            } else {
                header("Location: ../public/user/products.php");
            }
            exit();
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Incorrect Password");';
            echo 'window.location.href = "../pages/" ';
            echo '</script>';
        }
    } else {
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        $result = $insert->insert_user($mobile, $hashed_pass);

        if ($result) {
            $new_user = $insert->select($mobile);

            $_SESSION['user_id'] = $new_user['user_id'];
            $_SESSION['mobile'] = $new_user['mobile'];

            header("Location: ../public/user/");

            exit();
        } else {
            die('Error creating account');
        }
    }
}

if (isset($_POST['confirm'])) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_NUMBER_INT);

    $send = $send_mail->insert($email, $number);
    header('location: ../pages/verification.php');
}

if (isset($_POST['confirm_code'])) {
    $cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $vr_code = filter_var($_POST['vr_code'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $newpass = password_hash($cpass, PASSWORD_DEFAULT);

    try {
        $send = $insert->update_data($newpass, $vr_code);
        if ($send) {
            echo 'success';
        } else {
            echo 'Failed to update the password. Please try again.';
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


if (isset($_POST['confirm_newpass'])) {
    $cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);

    $newpass = password_hash($cpass, PASSWORD_DEFAULT);

    $send = $insert->update_pass($newpass, $user_id);
}
