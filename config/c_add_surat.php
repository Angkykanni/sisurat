<?php 
session_start();

require 'config.php';
require 'helper.php';

$page = isset($_SESSION['page']) ? $_SESSION['page'] : 'login';

if (isset($_POST["arsipkan"])) {
    $jenis = "Masuk";
    $nomor_surat = $_POST['nomor_surat'];
    $instansi = $_POST['instansi'];
    $kepada = $_POST['kepada'];
    $perihal = $_POST['perihal'];
    $tanggal_surat = $_POST['tanggal_surat'];
    $status = $_POST['status'];

    $file = $_FILES['file']['name'];
    $file_temp = $_FILES['file']['tmp_name'];
    $file_path = '../assets/uploads/files/' . $file;

    if (move_uploaded_file($file_temp, $file_path)) {
        // Menggunakan prepared statement untuk mencegah SQL Injection
        $sql = "INSERT INTO surat (jenis, nomor_surat, instansi, kepada, perihal, file, tanggal_surat, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
        
        // Persiapkan statement
        $stmt = $conn->prepare($sql);

        // Bind parameter
        $stmt->bind_param("ssssssss", $jenis, $nomor_surat, $instansi, $kepada, $perihal, $file, $tanggal_surat, $status);

        // Eksekusi statement
        $result = $stmt->execute();

        if ($result) {
            $_SESSION['arsip_surat'] = true;
        } else {
            // $_SESSION['arsip_surat'] = false;
            echo "Error: " . mysqli_error($conn);
            exit;
        }

        // Tutup statement
        $stmt->close();

        // Pastikan untuk menghentikan eksekusi setelah melakukan redirect
        header("Location: index.php?page=$page");
        exit;
    } else {
        // $_SESSION['arsip_surat'] = false;
        echo "Error: " . mysqli_error($conn);
        exit;
    }
}

if (isset($_POST['arsip_surat_keluar'])) {
    $dari = $_POST['dari'];
    
    if (isset($_POST['tipe_surat']) !== 4) {
        $tipe_surat = $_POST['tipe_surat'];
        $jenis = 'Keluar';
    } else {
        $_SESSION['arsip_surat_keluar'] = false;
    }

    $perihal = $_POST['perihal'];
    $kepada = $_POST['kepada'];
    $nomor_surat = $_POST['nomor_surat'];
    $tanggal_surat = $_POST['tanggal_surat'];
    $status = 'Diterima';
    $instansi = 'SMA Negeri 12 Kota Kupang';
    
    $file = $_FILES['file']['name'];
    $file_temp = $_FILES['file']['tmp_name'];
    $file_path = '../assets/uploads/files/' . $file;

    if (move_uploaded_file($file_temp, $file_path)) {
        // Menggunakan prepared statement untuk mencegah SQL Injection
        $sql = "INSERT INTO surat (dari, tipe_surat, jenis, perihal, kepada, nomor_surat, tanggal_surat, status, instansi, file, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
        
        // Persiapkan statement
        $stmt = $conn->prepare($sql);

        // Bind parameter
        $stmt->bind_param("iissssssss", $dari, $tipe_surat, $jenis, $perihal, $kepada, $nomor_surat, $tanggal_surat, $status, $instansi, $file);

        // Eksekusi statement
        $result = $stmt->execute();

        if ($result) {
            $_SESSION['arsip_surat_keluar'] = true;
        } else {
            // $_SESSION['arsip_surat'] = false;
            echo "Error: " . mysqli_error($conn);
            exit;
        }

        // Tutup statement
        $stmt->close();

        // Pastikan untuk menghentikan eksekusi setelah melakukan redirect
        header("Location: index.php?page=keluarkan-surat");
        exit;
    } else {
        // $_SESSION['arsip_surat'] = false;
        echo "Error: " . mysqli_error($conn);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['surat_id'])) {
        $surat_id = $_POST['surat_id'];

        $sql = "UPDATE surat SET status = 'Diterima' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $surat_id);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "error";
    }
} else {
    echo "error";
}