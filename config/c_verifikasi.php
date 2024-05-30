<?php 
session_start();

require 'config.php';
require 'helper.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tolak_surat_admin']) || isset($_POST['tolak_surat_wakasek'])) {
        $id_pengajuan = $_POST['id_pengajuan'];
        // $nomor_surat = NULL;
        $keterangan = $_POST['keterangan'];
        $status = 'Ditolak';
        $role = isset($_POST['role']) ? $_POST['role'] : '';

        $sql_check_jenis = "SELECT tipe_surat FROM pengajuan WHERE id = $id_pengajuan";
        $result_check_jenis = mysqli_query($conn, $sql_check_jenis);

        if (mysqli_num_rows($result_check_jenis) > 0) {
            $row = mysqli_fetch_assoc($result_check_jenis);
            $tipe_surat = $row['tipe_surat'];

            if ($tipe_surat == '4') {
                $jenis = 'Masuk';
            } else {
                $jenis = 'Keluar';
            }
        }

        $sql_update_status = "UPDATE pengajuan SET nomor_surat = null , status = '$status', posisi = '$role' WHERE id = $id_pengajuan";
        // $sql_verifikasi = "INSERT INTO verifikasi (id_pengajuan, jenis, status, posisi, keterangan, created_at, updated_at) VALUES ('$id_pengajuan', '$jenis', '$status', '$role', '$keterangan', NOW(), NOW())";

        if ($role == 'Admin') {
            $sql_verifikasi = "INSERT INTO verifikasi (id_pengajuan, jenis, status, posisi, keterangan, created_at, updated_at) VALUES ('$id_pengajuan', '$jenis', '$status', '$role', '$keterangan', NOW(), NOW())";
        } elseif ($role == 'Wakasek Kurikulum') {
            $sql_verifikasi = "UPDATE verifikasi SET status = '$status', posisi = '$role', keterangan = '$keterangan', updated_at = NOW() WHERE posisi = 'Wakasek Kurikulum'";
        } else {
            echo 'Error:' . mysqli_error($conn);
            exit;
        }
        
        if (mysqli_query($conn, $sql_update_status) && mysqli_query($conn, $sql_verifikasi)) {
            $_SESSION['tolak_pengajuan'] = true;
        } else {
            echo "Error: " . mysqli_error($conn);
            exit;
            // $_SESSION['tolak_pengajuan'] = false;
        }

        header("Location:". BASE_URL ."index.php?page=verifikasi-surat&id=$id_pengajuan");
        exit;
    }
    
    elseif (isset($_POST["posisi_kurikulum"]) || isset($_POST["posisi_kepala_sekolah"])) {
        // Logika untuk ubah posisi surat
        $id_pengajuan = $_POST['id_pengajuan'];
        $nomor_surat = $_POST['nomor_surat'];

        if (isset($_POST['role'])) {
            $role = $_POST['role'];
        } else {
            echo 'Role tidak ditemukan';
        }

        $sql_check_jenis = "SELECT tipe_surat FROM pengajuan WHERE id = $id_pengajuan";
        $result_check_jenis = mysqli_query($conn, $sql_check_jenis);

        if (mysqli_num_rows($result_check_jenis) > 0) {
            $row = mysqli_fetch_assoc($result_check_jenis);
            $tipe_surat = $row['tipe_surat'];

            if ($tipe_surat == '4') {
                $jenis = 'Masuk';
            } else {
                $jenis = 'Keluar';
            }
        }

        if ($role == 'Admin' && isset($_POST['posisi_kurikulum'])) {
            $posisi = 'Wakasek Kurikulum';
            $status = 'Dalam Proses';
            $posisi_admin = 'Admin';
            $status_admin = 'Diterima';

            $query_verifikasi_admin = "INSERT INTO verifikasi (id_pengajuan, jenis, status, posisi, created_at, updated_at) VALUES ('$id_pengajuan', '$jenis', '$status_admin', '$posisi_admin', NOW(), NOW())";
            $result_query_verifikasi_admin = mysqli_query($conn, $query_verifikasi_admin);

            if (!$result_query_verifikasi_admin) {
                echo 'Error:' . mysqli_error($conn);
                exit();
            }
        } elseif ($role == 'Admin' && isset($_POST['posisi_kepala_sekolah'])) {
            $posisi = 'Kepala Sekolah';
            $status = 'Dalam Proses';
            $posisi_admin = 'Admin';
            $status_admin = 'Diterima';

            $query_verifikasi_admin2 = "INSERT INTO verifikasi (id_pengajuan, jenis, status, posisi, created_at, updated_at) VALUES ('$id_pengajuan', '$jenis', '$status_admin', '$posisi_admin', NOW(), NOW())";
            $result_query_verifikasi_admin2 = mysqli_query($conn, $query_verifikasi_admin2);

            if (!$result_query_verifikasi_admin2) {
                echo 'Error:' . mysqli_error($conn);
                exit();
            }
        } elseif ($role == 'Wakasek Kurikulum' && isset($_POST['posisi_kepala_sekolah'])) {
            $posisi = 'Kepala Sekolah';
            $status = 'Dalam Proses';
            $posisi_wakasek = 'Wakasek Kurikulum';
            $status_wakasek = 'Diterima';

            $query_verifikasi_wakasek = "UPDATE verifikasi SET status = '$status_wakasek', updated_at = NOW() WHERE posisi = '$posisi_wakasek'";
            $result_query_verifikasi_wakasek = mysqli_query($conn, $query_verifikasi_wakasek);

            if (!$result_query_verifikasi_wakasek) {
                echo 'Error:' . mysqli_error($conn);
                exit();
            }
        } else {
            echo 'Error: Invalid role or position: '. mysqli_error($conn);
            exit;
        }

        $sql_update_pengajuan = "UPDATE pengajuan SET nomor_surat = '$nomor_surat', posisi = '$posisi' WHERE id = $id_pengajuan";
        $result_sql_update_pengajuan = mysqli_query($conn, $sql_update_pengajuan);

        if (!$result_sql_update_pengajuan) {
            echo 'Error:' . mysqli_error($conn);
            exit();
        }

        $query_verifikasi = "INSERT INTO verifikasi (id_pengajuan, jenis, status, posisi, created_at, updated_at) VALUES ('$id_pengajuan', '$jenis', '$status', '$posisi', NOW(), NOW())";
        $result_query_verifikasi = mysqli_query($conn, $query_verifikasi);

        if (!$result_query_verifikasi) {
            echo 'Error:' . mysqli_error($conn);
            exit();
        }

        // if ($role == 'Admin') {
        //     $sql_verifikasi_admin = "INSERT INTO verifikasi (id_pengajuan, jenis, status, posisi, created_at, updated_at) VALUES ('$id_pengajuan', '$jenis', '$status', '$posisi', NOW(), NOW())";
        //     $result_verifikasi_admin = mysqli_query($conn, $sql_verifikasi_admin);
        // } else {
        //     $sql_verifikasi_wakasek = "UPDATE verifikasi SET jenis = '$jenis', status = '$status', posisi = '$posisi', updated_at = NOW() WHERE id_pengajuan = $id_pengajuan";
        //     $result_verifikasi_wakasek = mysqli_query($conn, $sql_verifikasi_wakasek);
        // }
        
        if ($result_sql_update_pengajuan && $result_query_verifikasi) {
            $_SESSION['posisi'] = true;

            header("Location:". BASE_URL ."index.php?page=verifikasi-surat&id=$id_pengajuan");
            exit;
        } else {
            // $_SESSION['posisi'] = false;
            // header("Location:". BASE_URL ."index.php?page=verifikasi-surat&id=$id_pengajuan");
            // exit;

            echo 'Error:' .mysqli_error($conn);
            exit;
        }
    }
    
    elseif (isset($_POST['pengajuan_diterima']) || isset($_POST['disposisi_ke_tujuan'])) {
        if (isset($_POST['role'])) {
            $role = $_POST['role'];
        } else {
            echo 'Role tidak ditemukan';
            exit;
        }

        if (isset($_POST['nomor_surat'])) {
            $nomor_surat = $_POST['nomor_surat'];
        } else {
            echo 'Error: Nomor Surat Tidak ada';
            // echo 'Error:' . mysqli_error($conn);
            exit;
        }
        
        if (isset($_POST['id_pengajuan'])) {
            $id_pengajuan = $_POST['id_pengajuan'];
        } else {
            echo 'Error: ID surat tidak ada';
            // echo 'Error:' . mysqli_error($conn);
            exit;
        }

        $sql_check_jenis = "SELECT tipe_surat FROM pengajuan WHERE id = $id_pengajuan";
        $result_check_jenis = mysqli_query($conn, $sql_check_jenis);

        if (mysqli_num_rows($result_check_jenis) > 0) {
            $row = mysqli_fetch_assoc($result_check_jenis);
            $tipe_surat = $row['tipe_surat'];

            if ($tipe_surat == '4') {
                $jenis = 'Masuk';
            } elseif ($tipe_surat == '1') {
                $jenis = 'Keluar';
                $file = 'aktif_belajar.docx';
            } elseif ($tipe_surat == '2') { 
                $jenis = 'Keluar';
                $file = 'pendampingan_siswa.docx';
            } else {
                echo 'Tidak ada tipe surat yang valid';
                exit;
            }
        }

        $sql_get_pengajuan = "SELECT * FROM pengajuan WHERE id = $id_pengajuan";
        $result_get_pengajuan = mysqli_query($conn, $sql_get_pengajuan);

        $sql_get_verifikasi = "SELECT * FROM verifikasi WHERE id_pengajuan = $id_pengajuan AND status = 'Dalam Proses'";
        $result_get_verifikasi = mysqli_query($conn, $sql_get_verifikasi);

        if (!$result_get_pengajuan || !$result_get_verifikasi) {
            echo "Error: " . mysqli_error($conn);
            exit;
        }

        $surat_pengajuan = mysqli_fetch_assoc($result_get_pengajuan);
        $verifikasi = mysqli_fetch_assoc($result_get_verifikasi);

        if (isset($surat_pengajuan['tanggal_surat'])) {
            $tanggal_surat = $surat_pengajuan['tanggal_surat'];
        } else {
            $tanggal_surat = null;
        }

        if (isset($surat_pengajuan['tipe_surat'])) {
            $tipe_surat = $surat_pengajuan['tipe_surat'];
        } else {
            echo 'Tidak ada tipe surat';
            exit;
        }

        if (isset($surat_pengajuan['asal_surat'])) {
            $asal_surat = $surat_pengajuan['asal_surat'];
        } else {
            echo 'Tidak ada pengusul surat:' . mysqli_error($conn);
            exit;
        }

        if (isset($surat_pengajuan['kepada'])) {
            $kepada = $surat_pengajuan['kepada'];
        } else {
            $kepada = null;
        }

        if (isset($surat_pengajuan['perihal'])) {
            $perihal = $surat_pengajuan['perihal'];
        } else {
            echo 'Tidak ada perihal surat' . mysqli_error($conn);
            exit;
        }

        if (isset($surat_pengajuan['tanggal_mulai'])) {
            $tanggal_mulai = $surat_pengajuan['tanggal_mulai'];
        } else {
            $tanggal_mulai = null;
        }
        
        if (isset($surat_pengajuan['tanggal_selesai'])) {
            $tanggal_selesai = $surat_pengajuan['tanggal_selesai'];
        } else {
            $tanggal_selesai = null;
        }

        // if (isset($surat_pengajuan['file'])) {
        //     $file = $surat_pengajuan['file'];
        // } else {
        //     echo'File tidak ada';
        // }

        if (isset($verifikasi['keterangan'])) {
            $keterangan = $verifikasi['keterangan'];
        } elseif(isset($_POST['keterangan']) == '') {
            $keterangan = null;
        }elseif(isset($_POST['keterangan'])) {
            $keterangan = $_POST['keterangan'];
        }else {
            $keterangan = null;
        }

        if (isset($_POST['disposisi'])) {
            $disposisi = $_POST['disposisi'];
        } else {
            $disposisi = null;
        }
        
        $status = 'Diterima';

        $sql_get_pengusul = "SELECT * FROM users WHERE id_number = $asal_surat";
        $result_get_pengusul = mysqli_query($conn, $sql_get_pengusul);

        if (!$result_get_pengusul) {
            echo "Get Pengusul Error: " . mysqli_error($conn);
            exit;
        }

        $pengusul = mysqli_fetch_assoc($result_get_pengusul);

        if (isset($pengusul['instansi'])) {
            $instansi = $pengusul['instansi'];
        } else {
            echo "Get instansi Error:" . mysqli_error($conn);
        }
        
        // Prepared statement
        $stmt = $conn->prepare("INSERT INTO surat (jenis, nomor_surat, tanggal_surat, tipe_surat, dari, kepada, perihal, tanggal_mulai, tanggal_selesai, file, instansi, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");

        // Bind parameter
        $stmt->bind_param("sssissssssss", $jenis, $nomor_surat, $tanggal_surat, $tipe_surat, $asal_surat, $kepada, $perihal, $tanggal_mulai, $tanggal_selesai, $file, $instansi, $status);

        // Eksekusi prepared statement
        $stmt->execute();
        
        if ($stmt->error) {
            echo "Error: " . $stmt->error;
            exit;
        } else {
            $update_pengajuan = "UPDATE pengajuan SET nomor_surat = '$nomor_surat', status = '$status', posisi = '$role', updated_at = NOW() WHERE id = $id_pengajuan";
            $update_verifikasi = "UPDATE verifikasi SET status = '$status', keterangan = '$keterangan', disposisi = '$disposisi', updated_at = NOW() WHERE id_pengajuan = $id_pengajuan AND status = 'Dalam Proses'";
            
            if (mysqli_query($conn, $update_verifikasi) && mysqli_query($conn, $update_pengajuan)) {
                if (isset($_POST['pengajuan_diterima'])) {
                    $_SESSION['pengajuan_diterima'] = true;
                } else {
                    $_SESSION['disposisi_ke_tujuan'] = true;
                }
            } else {
                if (isset($_POST['pengajuan_diterima'])) {
                    $_SESSION['pengajuan_diterima'] = false;
                } else {
                    $_SESSION['disposisi_ke_tujuan'] = false;
                }
                // echo "Error: " . mysqli_error($conn);
            }

            header("Location:". BASE_URL ."index.php?page=verifikasi-surat&id=$id_pengajuan");
        }

        $stmt->close();
        exit;
    }
}
?>