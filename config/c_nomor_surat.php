<?php 
session_start();

require 'config.php';
require 'helper.php';

if (isset($_POST["keluarkan_surat"])) {
    $nomor_surat = $_POST['nomor_surat'];
    $id_pengajuan = $_POST['id_pengajuan'];
    $jenis = "Keluar";
    $sql_get_surat = "SELECT * FROM pengajuan WHERE id = $id_pengajuan";
    $result = mysqli_query($conn, $sql_get_surat);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        exit;
    }

    $surat_pengajuan = mysqli_fetch_assoc($result);
    $tipe_surat = isset($surat_pengajuan['tipe_surat']) ? $surat_pengajuan['tipe_surat'] : 'NULL';
    $nomor_surat = isset($surat_pengajuan['nomor_surat']) ? "'" . mysqli_real_escape_string($conn, $surat_pengajuan['nomor_surat']) . "'" : 'NULL';
    $asal_surat = isset($surat_pengajuan['asal_surat']) ? "'" . mysqli_real_escape_string($conn, $surat_pengajuan['asal_surat']) . "'" : 'NULL';
    $kepada = isset($surat_pengajuan['kepada']) ? "'" . mysqli_real_escape_string($conn, $surat_pengajuan['kepada']) . "'" : 'NULL';
    $perihal = isset($surat_pengajuan['perihal']) ? "'" . mysqli_real_escape_string($conn, $surat_pengajuan['perihal']) . "'" : 'NULL';
    $tanggal_mulai = isset($surat_pengajuan['tanggal_mulai']) ? "'" . $surat_pengajuan['tanggal_mulai'] . "'" : 'NULL';
    $tanggal_selesai = isset($surat_pengajuan['tanggal_selesai']) ? "'" . $surat_pengajuan['tanggal_selesai'] . "'" : 'NULL';

    $sql_insert_surat = "INSERT INTO surat (jenis,
                                            nomor_surat, 
                                            tipe_surat, 
                                            dari,
                                            kepada, 
                                            perihal, 
                                            tanggal_mulai, 
                                            tanggal_selesai, 
                                            status, 
                                            created_at, 
                                            updated_at) 
                                            VALUES ('$jenis', 
                                            '$nomor_surat', 
                                            $tipe_surat, 
                                            $asal_surat, 
                                            $kepada, 
                                            $perihal, 
                                            $tanggal_mulai, 
                                            $tanggal_selesai, 
                                            'Diterima', 
                                            NOW(), 
                                            NOW())";
        
    if (mysqli_query($conn, $sql_insert_surat)) {
        $delete_verifikasi = "DELETE FROM verifikasi WHERE id_pengajuan = $id_pengajuan";
        $delete_pengajuan = "DELETE FROM pengajuan WHERE id = $id_pengajuan";
        
        if (mysqli_query($conn, $delete_verifikasi) && mysqli_query($conn, $delete_pengajuan)) {
            $_SESSION['penomoran_surat'] = true;
        } else {
            echo "Error: " . mysqli_error($conn);
            exit;
        }

        // header("Location:". BASE_URL ."index.php?page=insert-nomor-surat&id=$id_pengajuan");
        header("Location:". BASE_URL ."index.php?page=surat-keluar");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
}
?>