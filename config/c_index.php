<?php
function getUserByIdNumber($id_number) {
    require 'config.php';

    $id_number = mysqli_real_escape_string($conn, $id_number);

    $query = "SELECT * FROM users WHERE id_number = '$id_number'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $detailUser = mysqli_fetch_assoc($result);
        return $detailUser;
    } else {
        return false;
    }
}

function switchLinkDashboard($role) {
    $link_dashboard = '';

    switch ($role) {
        case 'Kepala Sekolah':
            $link_dashboard = 'index.php?page=kepsek-dashboard';
            break;
        case 'Wakasek Kurikulum':
            $link_dashboard = 'index.php?page=wakasek-dashboard';
            break;
        case 'Admin':
            $link_dashboard = 'index.php?page=admin-dashboard';
            break;
        default:
            $link_dashboard = 'index.php?page=dashboard';
            break;
    }

    return $link_dashboard;
}

    
?>