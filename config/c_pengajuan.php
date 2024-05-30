<?php 
session_start();

require 'config.php';
require 'helper.php';

if (isset($_POST["aktifBelajar"])) {
    $role = $_POST['role'];
    $tipe_surat = $_POST['tipe_surat'];

    // if ($_POST['tipe_surat'] == '4') {
    //     $jenis = 'Masuk';
    // } else {
    //     $jenis= 'Keluar';
    // }
    
    $asal_surat = $_POST['asal_surat'];
    $perihal = $_POST['perihal'];
    $status = 'Dalam Proses';
    // $posisi = 'Admin';

    $file = $_FILES['file']['name'];
    $file_temp = $_FILES['file']['tmp_name'];
    $file_path = '../assets/uploads/files/' . $file;

    if (move_uploaded_file($file_temp, $file_path)) {
        // $verifikasi_insert =  "INSERT INTO verifikasi (id_pengajuan, jenis, status, posisi) VALUES ($id_pengajuan, $jenis, $status, $posisi)";
        // $result_verifikasi_insert = mysqli_query($conn, $verifikasi_insert);
        
        // Menggunakan prepared statement untuk mencegah SQL Injection
        $sql = "INSERT INTO pengajuan (tipe_surat, asal_surat, perihal, file, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
        
        // Persiapkan statement
        $stmt = $conn->prepare($sql);

        // Bind parameter
        $stmt->bind_param("issss", $tipe_surat, $asal_surat, $perihal, $file, $status);

        // Eksekusi statement
        $result = $stmt->execute();

        if ($result) {
            $_SESSION['aktif_belajar_message'] = true;
        } else {
            // $_SESSION['aktif_belajar_message'] = false;
            echo "Error: " . mysqli_error($conn);
            exit;
        }

        // Tutup statement
        $stmt->close();

        if ($role == 'Admin') {
            header("Location:". BASE_URL . "index.php?page=keluarkan-surat");
            exit;
        } else {
            header("Location:". BASE_URL ."index.php?page=ajukan-surat");
            exit;
        }
    } else {
        // $_SESSION['aktif_belajar_message'] = false;
        echo "Error: " . mysqli_error($conn);
        exit;
    }
}

if (isset($_POST["pendampingan_siswa"])) {
    $role = $_POST['role'];
    $tipe_surat = $_POST['tipe_surat'];
    $asal_surat = $_POST['asal_surat'];
    $kepada = !empty($_POST['kepada']) ? $_POST['kepada'] : null;
    $perihal = $_POST['perihal'];
    $tanggal_mulai = !empty($_POST['tanggal_mulai']) ? $_POST['tanggal_mulai'] : null;
    $tanggal_selesai = !empty($_POST['tanggal_selesai']) ? $_POST['tanggal_selesai'] : null;
    $status = $_POST['status'];

    $file = $_FILES['file']['name'];
    $file_temp = $_FILES['file']['tmp_name'];
    $file_path = '../assets/uploads/files/' . $file;

    if (move_uploaded_file($file_temp, $file_path)) {
        // Menggunakan prepared statement untuk mencegah SQL Injection
        $sql = "INSERT INTO pengajuan (tipe_surat, asal_surat, kepada, perihal, tanggal_mulai, tanggal_selesai, file, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
        
        // Persiapkan statement
        $stmt = $conn->prepare($sql);

        // Bind parameter
        $stmt->bind_param("isssssss", $tipe_surat, $asal_surat, $kepada, $perihal, $tanggal_mulai, $tanggal_selesai, $file, $status);

        // Eksekusi statement
        $result = $stmt->execute();

        if ($result) {
            $_SESSION['pendampingan_siswa_message'] = true;
        } else {
            $_SESSION['pendampingan_siswa_message'] = false;
        }

        // Tutup statement
        $stmt->close();

        if ($role == 'Admin') {
            header("Location:". BASE_URL . "index.php?page=keluarkan-surat");
            exit;
        } else {
            header("Location:". BASE_URL ."index.php?page=ajukan-surat");
            exit;
        }
    } else {
        $_SESSION['pendampingan_siswa_message'] = false;
    }
}

if (isset($_POST["surat_masuk"])) {
    $tipe_surat = 4;
    $nomor_surat = $_POST['nomor_surat'];
    $asal_surat = $_POST['asal_surat'];
    $kepada = $_POST['kepada'];
    $perihal = $_POST['perihal'];
    $keterangan = $_POST['keterangan'];
    $status = 'Dalam Proses';

    $file = $_FILES['file']['name'];
    $file_temp = $_FILES['file']['tmp_name'];
    $file_path = '../assets/uploads/files/' . $file;

    if (move_uploaded_file($file_temp, $file_path)) {
        // Menggunakan prepared statement untuk mencegah SQL Injection
        $sql = "INSERT INTO pengajuan (tipe_surat, nomor_surat, asal_surat, kepada, perihal, keterangan, file, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
        
        // Persiapkan statement
        $stmt = $conn->prepare($sql);

        // Bind parameter
        $stmt->bind_param("isisssss", $tipe_surat, $nomor_surat, $asal_surat, $kepada, $perihal, $keterangan, $file, $status);

        // Eksekusi statement
        $result = $stmt->execute();

        if ($result) {
            $_SESSION['surat_masuk_message'] = true;
        } else {
            $_SESSION['surat_masuk_message'] = false;
            // echo 'Error:' . mysqli_error($conn);
        }

        // Tutup statement
        $stmt->close();

        // Pastikan untuk menghentikan eksekusi setelah melakukan redirect
        header("Location:". BASE_URL ."index.php?page=ajukan-surat");
        exit; // tambahkan exit
    } else {
        $_SESSION['surat_masuk_message'] = false;
        exit;
        // echo 'Error:' . mysqli_error($conn);
    }
}

// $pagePengajuan = isset($_SESSION['page']) ? $_SESSION['page'] : 'ajukan-surat';

// if (isset($_POST["aktifBelajar"])) {
//     $tipe_surat = $_POST['tipe_surat'];
//     $asal_surat = $_POST['asal_surat'];
//     $perihal = $_POST['perihal'];
//     $status = $_POST['status'];

//     $file = $_FILES['file']['name'];
//     $file_temp = $_FILES['file']['tmp_name'];
//     $file_path = '../assets/uploads/files/' . $file;

//     if (move_uploaded_file($file_temp, $file_path)) {
//         $sql = "INSERT INTO surat_keluar (tipe_surat, asal_surat, perihal, file, status, created_at, updated_at) VALUES ('$tipe_surat', $asal_surat, '$perihal', $file, '$status', NOW(), NOW())";

//         $result = $conn ->query($sql);

//         if ($result) {
//             $_SESSION['aktif_belajar_message'] = true;
//         } else {
//             $_SESSION['aktif_belajar_message'] = false;
//         }

//         header("Location:". BASE_URL ."index.php?page=$pagePengajuan");
//     } else {
//         $_SESSION['aktif_belajar_message'] = false;
//     }
// }
?>