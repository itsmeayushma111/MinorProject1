<?php
session_start();
require_once "../connect.php";

// Check if user is logged in and is an admin
if(!isset($_SESSION['valid']) || $_SESSION['user_is_admin'] != 1) {
    // Redirect non-admin users to the login page
    header('Location: ../login.php');
    exit();
}
?>