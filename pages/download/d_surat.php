<?php
if(isset($_GET['file_template'])){
    $template = $_GET['file_template'];

    $template_path = '../../assets/uploads/surat/' . $template;

    if (file_exists($template_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($template_path) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($template_path));
        readfile($template_path);
        exit;
    } else {
        echo 'File tidak ditemukan.';
    }
} else {
    echo 'Parameter file tidak ditemukan dalam URL.';
}
?>