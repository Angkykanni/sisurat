<?php
require_once 'config.php';

// Mulai session jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_number']) || empty($_SESSION['id_number'])) {  
    header("Location:". BASE_URL);
    exit();
}

// Simpan id number dan peran dari session
$id_number = $_SESSION['id_number'];
$role = $_SESSION['role'];

// Inisialisasi variabel users
$users = array();

$get_pengajuan_dalam_proses = "SELECT * FROM pengajuan WHERE status = 'Dalam Proses'";
$result_get_pengajuan_dalam_proses = mysqli_query($conn, $get_pengajuan_dalam_proses);
$pengajuan_DP = mysqli_num_rows($result_get_pengajuan_dalam_proses) > 0;

$get_settings = "SELECT * FROM settings";
$result_get_settings = mysqli_query($conn, $get_settings);
$settings = mysqli_fetch_array($result_get_settings);

// $total_dalam_proses = "SELECT COUNT(*) AS total_dalam_proses FROM pengajuan WHERE status = 'Dalam Proses'";
// $result_total_dalam_proses = mysqli_query($conn, $total_dalam_proses);
// $total_dalam_proses = mysqli_fetch_assoc($result_total_dalam_proses);

// $get_notif_verifikasi = "SELECT * FROM verifikasi WHERE status = 'Diterima' OR status = 'Ditolak'";
// $result_notif_verifikasi = mysqli_query($conn, $get_notif_verifikasi);
// $get_notif_user = mysqli_num_rows($result_notif_verifikasi) > 0;


// Ambil data pengguna berdasarkan peran
if ($role == 'Admin' || $role == 'Kepala Sekolah' || $role == 'Wakasek Kurikulum') {
    // Query untuk mendapatkan semua pengguna
    $get_users = "SELECT * FROM users ORDER BY FIELD(role, 'Kepala Sekolah', 'Wakasek Kurikulum', 'Admin', 'GTK', 'Siswa', 'Tamu'), nama ASC";
    $result_get_users = mysqli_query($conn, $get_users);
    // Mendapatkan data pengguna yang sedang login
    if ($result_get_users) {
        $users = mysqli_fetch_all($result_get_users, MYSQLI_ASSOC);
        foreach ($users as $user) {
            if ($user['id_number'] == $id_number) {
                $display_name = $user['nama'];
                $photo = $user["photo"];
                $photo_path = !empty($photo) ? "uploads/" . $photo : "uploads/userLogin.png";
                break;
            }
        }
    }

    $get_tipe_surat = "SELECT * FROM tipe_surat";

    // Query untuk mendapatkan surat pengajuan
    $get_surat_pengajuan = "SELECT pengajuan.id,
                            tipe_surat.nama_tipe AS jenis_surat, 
                            users.nama AS pengusul_surat, 
                            pengajuan.kepada,
                            pengajuan.perihal, 
                            pengajuan.tanggal_mulai, 
                            pengajuan.tanggal_selesai, 
                            pengajuan.file, 
                            pengajuan.status, 
                            pengajuan.created_at, 
                            pengajuan.updated_at,
                            pengajuan.asal_surat,
                            pengajuan.posisi
                        FROM pengajuan
                        JOIN users ON pengajuan.asal_surat = users.id_number
                        JOIN tipe_surat ON pengajuan.tipe_surat = tipe_surat.id";
                        
    // Query untuk mendapatkan surat keluar
    $get_surat_keluar = "SELECT 
                            surat.id,
                            surat.jenis,
                            surat.nomor_surat,
                            tipe_surat.nama_tipe AS jenis_surat,
                            tipe_surat.template AS file_template,
                            users.nama AS pengusul_surat,
                            surat.dari,
                            surat.kepada,
                            surat.perihal,
                            surat.tanggal_mulai,
                            surat.tanggal_selesai,
                            surat.file,
                            surat.instansi,
                            surat.status,
                            surat.created_at,
                            role.roleName AS peran_pengguna
                        FROM 
                            surat
                        JOIN 
                            users ON surat.dari = users.id_number
                        JOIN 
                            tipe_surat ON surat.tipe_surat = tipe_surat.id
                        JOIN 
                            role ON users.role = role.roleName
                        WHERE 
                            surat.jenis = 'Keluar'";
                            
    // Query untuk mendapatkan surat masuk
    $get_surat_masuk_arsip = "SELECT 
                            surat.id,
                            surat.jenis,
                            surat.nomor_surat,
                            surat.tanggal_surat,
                            surat.dari,
                            surat.kepada,
                            surat.perihal,
                            surat.tanggal_mulai,
                            surat.tanggal_selesai,
                            surat.instansi,
                            surat.file,
                            surat.status,
                            surat.created_at
                        FROM 
                            surat
                        WHERE 
                            surat.jenis = 'Masuk'AND
                            surat.status = 'Diterima'";

    $get_surat_masuk_list = "SELECT 
                            surat.id,
                            surat.jenis,
                            surat.nomor_surat,
                            surat.tanggal_surat,
                            surat.dari,
                            surat.kepada,
                            surat.perihal,
                            surat.tanggal_mulai,
                            surat.tanggal_selesai,
                            surat.instansi,
                            surat.file,
                            surat.status,
                            surat.created_at
                        FROM 
                            surat
                        WHERE 
                            surat.jenis = 'Masuk'";
                            
    // Menambahkan kondisi untuk Kepala Sekolah dan Wakasek Kurikulum
    if ($role == 'Kepala Sekolah') {
        $get_surat_pengajuan .= " WHERE pengajuan.posisi = 'Kepala Sekolah'";
    } elseif ($role == 'Wakasek Kurikulum') {
        $get_surat_pengajuan .= " WHERE pengajuan.posisi = 'Wakasek Kurikulum'";
    }
    
    // Eksekusi query dan memperoleh hasilnya
    $result_get_tipe_surat = mysqli_query($conn, $get_tipe_surat);
    $result_get_surat_pengajuan = mysqli_query($conn, $get_surat_pengajuan);
    $result_get_surat_keluar = mysqli_query($conn, $get_surat_keluar);
    $get_surat_masuk_arsip = mysqli_query($conn, $get_surat_masuk_arsip);
    $get_surat_masuk_list = mysqli_query($conn, $get_surat_masuk_list);
    // Memeriksa apakah query berhasil dieksekusi
    if (!$result_get_surat_pengajuan || !$result_get_surat_keluar || !$get_surat_masuk_arsip || !$get_surat_masuk_list) {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
    // Mendapatkan data surat pengajuan, keluar, dan masuk
    $ts = mysqli_fetch_all($result_get_tipe_surat, MYSQLI_ASSOC);
    $pengajuan_surat = mysqli_fetch_all($result_get_surat_pengajuan, MYSQLI_ASSOC);
    $surat_keluar = mysqli_fetch_all($result_get_surat_keluar, MYSQLI_ASSOC);
    $surat_masuk_arsip = mysqli_fetch_all($get_surat_masuk_arsip, MYSQLI_ASSOC);
    $surat_masuk_list = mysqli_fetch_all($get_surat_masuk_list, MYSQLI_ASSOC);
} else {
    $get_user = "SELECT * FROM users WHERE id_number = '$id_number'";

    $get_surat_pengajuan = "SELECT pengajuan.id,
                            tipe_surat.nama_tipe AS jenis_surat, 
                            users.nama AS pengusul_surat, 
                            pengajuan.kepada,
                            pengajuan.perihal, 
                            pengajuan.tanggal_mulai, 
                            pengajuan.tanggal_selesai, 
                            pengajuan.file, 
                            pengajuan.status, 
                            pengajuan.created_at, 
                            pengajuan.updated_at,
                            pengajuan.asal_surat,
                            pengajuan.posisi
                        FROM pengajuan
                        JOIN users ON pengajuan.asal_surat = users.id_number
                        JOIN tipe_surat ON pengajuan.tipe_surat = tipe_surat.id
                        WHERE users.id_number = '$id_number'";

    // Query untuk mendapatkan surat keluar
    $get_surat_masuk_pengusul = "SELECT 
                            surat.id,
                            surat.jenis,
                            surat.nomor_surat,
                            tipe_surat.nama_tipe AS jenis_surat,
                            tipe_surat.template AS file_template,
                            users.nama AS pengusul_surat,
                            users.kelas AS kelas_pengusul,
                            surat.dari,
                            surat.kepada,
                            surat.perihal,
                            surat.tanggal_mulai,
                            surat.tanggal_selesai,
                            surat.file,
                            surat.instansi,
                            surat.status,
                            surat.created_at,
                            role.roleName AS peran_pengguna
                        FROM 
                            surat
                        JOIN 
                            users ON surat.dari = users.id_number
                        JOIN 
                            tipe_surat ON surat.tipe_surat = tipe_surat.id
                        JOIN 
                            role ON users.role = role.roleName
                        WHERE 
                            surat.jenis = 'Keluar'
                        AND
                            surat.dari = '$id_number'";

    $result_get_user = mysqli_query($conn, $get_user);
    $result_get_surat_pengajuan = mysqli_query($conn, $get_surat_pengajuan);
    $result_get_surat_masuk_pengusul = mysqli_query($conn, $get_surat_masuk_pengusul);

    if (!$result_get_surat_pengajuan || !$result_get_user || !$result_get_surat_masuk_pengusul) {
        echo "Error: " . mysqli_error($conn);
        exit;
    }

    if ($result_get_user) {
        $users = mysqli_fetch_all($result_get_user, MYSQLI_ASSOC);
        // Pastikan hanya ada satu pengguna yang sesuai
        if (count($users) == 1) {
            $display_name = $users[0]['nama'];
            if (!empty($users)) {
                // Tentukan alamat file foto profil
                $photo = $users[0]["photo"];
                if (!empty($photo)) {
                    $photo_path = "uploads/" . $photo;
                } else {
                    $photo_path = "uploads/userLogin.png";
                }
            } else {
                $photo_path = "uploads/userLogin.png";
            }
        }
    }

    $pengajuan_surat = mysqli_fetch_all($result_get_surat_pengajuan, MYSQLI_ASSOC);
    $surat_masuk_pengusul = mysqli_fetch_all($result_get_surat_masuk_pengusul, MYSQLI_ASSOC);
}

// Periksa apakah ada hasil dari kueri SQL sebelum mengakses elemen array
if (empty($users)) {
    $display_name = $_SESSION['nama'];
}

?>