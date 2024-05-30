<?php 
session_start();

require 'config.php';
require 'helper.php';

if (isset($_POST["updateProfile"])) {
    $profilePage = isset($_SESSION['page']) ? $_SESSION['page'] : 'profile';
    
    $id_number = mysqli_real_escape_string($conn, $_POST['id_number']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $instansi = mysqli_real_escape_string($conn, $_POST['instansi']);

    // Check if a photo is uploaded
    if (!empty($_FILES['photo']['name'])) {
        // Delete previous photo from database and directory
        $sql_select_photo = "SELECT photo FROM users WHERE id_number='$id_number'";
        $result_select_photo = $conn->query($sql_select_photo);
        if ($result_select_photo->num_rows > 0) {
            $row = $result_select_photo->fetch_assoc();
            $prev_photo = $row['photo'];
            if ($prev_photo) {
                $prev_photo_path = '../assets/uploads/' . $prev_photo;
                if (file_exists($prev_photo_path)) {
                    unlink($prev_photo_path);
                }
            }
        }

        // Upload new photo
        $photo = $_FILES['photo']['name']; 
        $photo_temp = $_FILES['photo']['tmp_name'];
        $photo_path = '../assets/uploads/' . $photo;

        if (move_uploaded_file($photo_temp, $photo_path)) {
            // If photo is uploaded successfully, include it in the update query
            $sql = "UPDATE users 
                    SET nama='$nama', email='$email', instansi='$instansi', photo='$photo', updated_at=NOW() 
                    WHERE id_number='$id_number'";
            
            $result = $conn->query($sql);

            if ($result) {
                $_SESSION['update_success'] = true;
            } else {
                $_SESSION['update_success'] = false;
            }
        } else {
            $_SESSION['update_success'] = false;
        }
    } else {
        // If no photo is uploaded, perform update without changing the photo
        $sql = "UPDATE users 
                SET nama='$nama', email='$email', instansi='$instansi', updated_at=NOW() 
                WHERE id_number='$id_number'";
        
        $result = $conn->query($sql);

        if ($result) {
            $_SESSION['update_success'] = true;
        } else {
            $_SESSION['update_success'] = false;
        }
    }

    header("Location: " . BASE_URL . "index.php?page=$profilePage");
    exit;
}


if (isset($_POST["updatePassword"])) {
    $profilePage = isset($_SESSION['page']) ? $_SESSION['page'] : 'profile';
    
    $id_number = mysqli_real_escape_string($conn, $_SESSION['id_number']); // Anda perlu menentukan bagaimana Anda menyimpan ID pengguna
    $currentPassword = mysqli_real_escape_string($conn, $_POST['password']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $reNewPassword = mysqli_real_escape_string($conn, $_POST['reNewPassword']);

    // Periksa apakah password baru dan konfirmasi password baru cocok
    if ($newPassword != $reNewPassword) {
        $_SESSION['password_update_message'] = "Password baru dan konfirmasi password tidak cocok";
        header("Location: " . BASE_URL . "index.php?page=$profilePage");
        exit;
    }

    // Periksa apakah password yang dimasukkan oleh pengguna sesuai dengan password yang tersimpan di database
    $sql = "SELECT password FROM users WHERE id_number='$id_number'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (!password_verify($currentPassword, $row['password'])) {
            $_SESSION['password_update_message'] = "Password yang anda masukan salah!";
            header("Location: " . BASE_URL . "index.php?page=$profilePage");
            exit;
        }
    } else {
        $_SESSION['password_update_message'] = "Pengguna tidak ditemukan";
        header("Location: " . BASE_URL . "index.php?page=$profilePage");
        exit;
    }

    // Enkripsi password baru sebelum menyimpannya ke database
    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update password di database
    $sql = "UPDATE users SET password='$hashed_password' WHERE id_number='$id_number'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['password_update_message'] = "Password berhasil diubah";
    } else {
        $_SESSION['password_update_message'] = "Terjadi kesalahan saat mengubah password";
    }

    header("Location: " . BASE_URL . "index.php?page=$profilePage");
    exit;
}
?>