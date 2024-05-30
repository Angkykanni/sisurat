<?php
require_once 'config.php';

// Pastikan hanya menerima permintaan POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah ada data pengguna yang akan dihapus
    if (isset($_POST['userId'])) {
        $userId = $_POST['userId'];
        
        // Buat query untuk menghapus pengguna berdasarkan ID
        $query = "DELETE FROM users WHERE id_number = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $userId);
        
        // Lakukan penghapusan dan kirim respons sesuai hasilnya
        if (mysqli_stmt_execute($stmt)) {
            http_response_code(200);
            echo json_encode(array("message" => "User successfully deleted."));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Failed to delete user."));
        }
    } else {
        // Jika parameter userId tidak ada dalam permintaan
        http_response_code(400);
        echo json_encode(array("message" => "User ID not provided."));
    }
} else {
    // Jika bukan permintaan POST
    http_response_code(405);
    echo json_encode(array("message" => "Method not allowed."));
}
?>