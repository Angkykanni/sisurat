<?php
session_start();

require 'helper.php';
require 'config.php';

if (isset($_POST["login"])) {
    $id_number = $_POST["id_number"];
    $password = $_POST["password"];

    if (is_numeric($id_number)) {
        $check = mysqli_query($conn, "SELECT * FROM users WHERE id_number = '$id_number'");
    } else {
        $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$id_number'");
    }

    if (mysqli_num_rows($check) === 1) {
        $row = mysqli_fetch_assoc($check);
        
        // Memeriksa apakah password yang dimasukkan sesuai dengan password yang tersimpan di database
        if (password_verify($password, $row["password"])) {
            $_SESSION['id_number'] = $row['id_number'];
            $_SESSION['role'] = $row['role'];
            
            // Mengarahkan pengguna ke dashboard sesuai dengan peran mereka
            if ($row['role'] == 'Admin') {
                header("Location:". BASE_URL ."index.php?page=admin-dashboard");
                exit();
            } elseif ($row['role'] == 'Kepala Sekolah') {
                header("Location:". BASE_URL ."index.php?page=kepsek-dashboard");
                exit();
            } elseif ($row['role'] == 'Wakasek Kurikulum') {
                header("Location:". BASE_URL ."index.php?page=wakasek-dashboard");
                exit();
            } else {
                header("Location:". BASE_URL ."index.php?page=dashboard");
                exit();
            }
            
        } else {
            $_SESSION['login_error'] = "Password salah!";
            header("Location:". BASE_URL);
            exit();
        }
    } else {
        $_SESSION['login_error'] = "NIP/NIS/Email salah!";
        header("Location:". BASE_URL);
        exit();
    }
}
?>