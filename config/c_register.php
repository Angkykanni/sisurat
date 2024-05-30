<?php 
session_start();

require 'config.php';
require 'helper.php';

$page = isset($_SESSION['page']) ? $_SESSION['page'] : 'login';

if (isset($_POST["register"])) {
    $role = $_POST['role'];
    $id_number = $_POST['id_number'];
    $nama = $_POST['nama'];
    $ttl = $_POST['ttl'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $orangtua = $_POST['orangtua'];
    $kelas = $_POST['kelas'];
    $instansi = $_POST['instansi'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_id_number = "SELECT * FROM users WHERE id_number = '$id_number'";
    $check_id_number_result = $conn->query($check_id_number);

    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $check_email_result = $conn->query($check_email_query);

    if ($check_id_number_result->num_rows > 0 && $check_email_result->num_rows > 0) {
        $_SESSION['registration_error_message'] = "NIP/NIS dan email yang anda masukan sudah digunakan. Silakan gunakan NIP/NIS dan email lain.";
    } elseif ($check_id_number_result->num_rows > 0) {
        $_SESSION['registration_error_message'] = "NIP/NIS yang anda masukan sudah digunakan. Silakan gunakan NIP/NIS yang lain.";
    } elseif ($check_email_result->num_rows > 0) {
        $_SESSION['registration_error_message'] = "Email yang anda masukan sudah digunakan. Silakan gunakan email lain.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (id_number, nama, ttl, jenis_kelamin, orangtua, kelas, email, instansi, password, role, created_at, updated_at) 
                VALUES ('$id_number', '$nama', '$ttl', '$jenis_kelamin', '$orangtua', '$kelas', '$email', '$instansi', '$hashed_password', '$role', NOW(), NOW())";

        $result = $conn->query($sql);

        if ($result) {
            $_SESSION['registration_success'] = true;
        } else {
            $_SESSION['registration_success'] = false;
        }
    }

    header("Location:". BASE_URL ."index.php?page=$page");
    exit;
}

?>