<?php
require_once 'config.php';
require_once 'helper.php';

session_start();

unset($_SESSION['id_number']);
unset($_SESSION['role']);
// session_destroy();

header("Location:". BASE_URL);
?>