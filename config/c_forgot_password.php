<?php
session_start();
require 'config.php';
require 'helper.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_number = $_POST['id_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    $check_idNumber = "SELECT * FROM users WHERE id_number = $id_number";
    $result_check_idNumber = mysqli_query($conn, $check_idNumber);
    
    $check_email = "SELECT email FROM users WHERE id_number = $id_number AND email = '$email'";
    $result_check_email = mysqli_query($conn, $check_email);
    
    // var_dump(mysqli_fetch_assoc($result_check_idNumber));
    // var_dump(mysqli_fetch_assoc($result_check_email));

    if (mysqli_num_rows($result_check_idNumber) > 0) {
        if (mysqli_num_rows($result_check_email) > 0) {
            if ($password != $repassword) {
                $_SESSION['password_not_match'] = true;
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $update_password = "UPDATE users SET password = '$hashed_password' WHERE email = '$email' AND id_number = '$id_number'";
            $result_update_password = mysqli_query($conn, $update_password);

            if ($result_update_password) {
                $_SESSION['password_reset_message'] = true;
            } else {
                $_SESSION['password_reset_message'] = false;
            }
            
            header("Location:" . BASE_URL . "index.php?page=forgot_password");
            exit;
        } else {
            $_SESSION['email_not_found'] = true;
            header("Location:" . BASE_URL . "index.php?page=forgot_password");
            exit;
        }
    } else {
        $_SESSION['idNumber_not_found'] = true;
        header("Location:" . BASE_URL . "index.php?page=forgot_password");
        exit;
    }
    
}
?>