<?php 
session_start();

require 'config/c_index.php';
require 'config/helper.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'login';
$_SESSION['page'] = $page;

switch ($page) {
    case 'login':
        $content = 'pages/auth/login.php';
        $title = 'Masuk';
        $layout = 'layouts/auth.php';
        break;
        
    case 'forgot_password':
        $content = 'pages/auth/forgot_password.php';
        $title = 'Lupa Kata Sandi';
        $layout = 'layouts/auth.php';
        break;
        
    case 'reset_password':
        $content = 'pages/auth/reset_password.php';
        $title = 'Reset Kata Sandi';
        $layout = 'layouts/auth.php';
        break;
        
    case 'register_guest':
        $content = 'pages/auth/register.php';
        $title = 'Registrasi Tamu';
        $layout = 'layouts/auth.php';
        break;
        
    case 'register':
        $content = 'pages/auth/register.php';
        $title = 'Registrasi';
        $layout = 'layouts/auth.php';
        break;
        
    case 'admin-dashboard':
        $content = 'pages/admin/dashboard.php';
        $title = 'Dashboard Admin';
        $layout = 'layouts/template.php';
        break;
        
    case 'kepsek-dashboard':
        $content = 'pages/admin/dashboard.php';
        $title = 'Dashboard Kepsek';
        $layout = 'layouts/template.php';
        break;
        
    case 'wakasek-dashboard':
        $content = 'pages/admin/dashboard.php';
        $title = 'Dashboard Kurikulum';
        $layout = 'layouts/template.php';
        break;
        
    case 'dashboard':
        $content = 'pages/admin/dashboard.php';
        $title = 'Dashboard';
        $layout = 'layouts/template.php';
        break;
        
    case 'ajukan-surat':
        $content = 'pages/users/surat_ajuan.php';
        $title = 'Ajukan Surat';
        $layout = 'layouts/template.php';
        break;
        
    case 'pengajuan-surat':
        $content = 'pages/admin/pengajuan_list.php';
        $title = 'Daftar Pengajuan';
        $layout = 'layouts/template.php';
        break;

    case 'list-pengajuan-user':
        $content = 'pages/users/surat_ajuan_list.php';
        $title = 'Daftar Pengajuan';
        $layout = 'layouts/template.php';
        break;

    case 'detail-pengajuan':
        $content = 'pages/admin/pengajuan_detail.php';
        $title = 'Detail Pengajuan Surat';
        $layout = 'layouts/template.php';
        break;

    case 'verifikasi-surat':
        $content = 'pages/admin/verifikasi.php';
        $title = 'Verifikasi Surat';
        $layout = 'layouts/template.php';
        break;

    case 'insert-nomor-surat':
        $content = 'pages/admin/nomor_surat.php';
        $title = 'Lihat Dokumen';
        $layout = 'layouts/template.php';
        break;
        
    case 'lacak-surat':
        $content = 'pages/users/surat_lacak.php';
        $title = 'Lacak Surat';
        $layout = 'layouts/template.php';
        break;
        
    case 'surat-masuk':
        $content = 'pages/admin/surat_masuk_list.php';
        $title = 'Surat Masuk';
        $layout = 'layouts/template.php';
        break;
        
    case 'detail-surat-masuk':
        $content = 'pages/admin/surat_masuk_detail.php';
        $title = 'Detail Surat Masuk';
        $layout = 'layouts/template.php';
        break;
        
    case 'tambah-surat-masuk':
        $content = 'pages/admin/surat_masuk_add.php';
        $title = 'Tambah Surat Masuk';
        $layout = 'layouts/template.php';
        break;

    case 'surat-masuk-pengusul':
        $content = 'pages/admin/surat_keluar_list.php';
        $title = 'Surat Masuk Pengusul';
        $layout = 'layouts/template.php';
        break;

    case 'masukan-surat':
        $content = 'pages/admin/surat_masuk_add.php';
        $title = 'Masukan Surat';
        $layout = 'layouts/template.php';
        break;
        
    case 'surat-keluar':
        $content = 'pages/admin/surat_keluar_list.php';
        $title = 'Surat Keluar';
        $layout = 'layouts/template.php';
        break;
        
    case 'lihat-surat-keluar':
        $content = 'pages/admin/surat_keluar_detail.php';
        $title = 'Lihat Surat Keluar';
        $layout = 'layouts/template.php';
        break;

    case 'keluarkan-surat':
        $content = 'pages/admin/surat_keluar_add.php';
        $title = 'Keluarkan Surat';
        $layout = 'layouts/template.php';
        break;    
        
    case 'jenis-surat-keluar':
        $content = 'pages/admin/surat_keluar_jenis.php';
        $title = 'Jenis Surat Keluar';
        $layout = 'layouts/template.php';
        break;

    case 'arsip-surat':
        $content = 'pages/admin/arsip.php';
        $title = 'Arsip';
        $layout = 'layouts/template.php';
        break;
        
    case 'profile':
        $content = 'pages/profile.php';
        $title = 'Profile';
        $layout = 'layouts/template.php';
        break;
        
    case 'pengguna':
        $content = 'pages/admin/pengguna_list.php';
        $title = 'Pengguna';
        $layout = 'layouts/template.php';
        break;
        
    case 'detail-pengguna':
        if (isset($_GET['id_number'])) {
            $id_number = $_GET['id_number'];
            $user = getUserByIdNumber($id_number);
            if ($user) {
                $content = 'pages/admin/pengguna_detail.php';
                $title = 'Detail Pengguna';
                $layout = 'layouts/template.php';
            } else {
                $title = 'Kesalahan';
                $layout = 'pages/error404.php';
            }
        } else {
            $title = 'Kesalahan';
            $layout = 'pages/error404.php';
        }
        break;
        
    case 'sistem':
        $content = 'pages/admin/system.php';
        $title = 'Pengaturan Sistem';
        $layout = 'layouts/template.php';
        break;
        
    default:
        $title = 'Eror404';
        $layout = 'pages/error404.php';
}

include $layout;
?>