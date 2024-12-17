<?php
session_start(); // Start the session if not already started
/*require_once "logic.php";*/  //Include necessary files
require_once "../connect.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    $username = filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $createpassword = filter_var($_POST['createpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'],FILTER_SANITIZE_NUMBER_INT);

    // Basic validation checks
    if (!$username) {
        $_SESSION['add-user'] = "Please enter your username";
    } elseif (!$email) {
        $_SESSION['add-user'] = "Please enter a valid email";
    } elseif ($createpassword != $confirmpassword) {
        $_SESSION['add-user'] = "Passwords do not match";
    } else {
        $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

        // Check if username or email already exists
        $user_check_query = "SELECT * FROM users WHERE email='$email' OR username='$username'";
        $user_check_result = mysqli_query($conn, $user_check_query);
        if (mysqli_num_rows($user_check_result) > 0) {
            $_SESSION['add-user'] = "Username or email already exists";
        } else {
            // Insert the user into the database
            $insert_user_query = "INSERT INTO users (username, email, pwd, is_admin) VALUES ('$username', '$email', '$hashed_password', '$is_admin')";
            $insert_user_result = mysqli_query($conn, $insert_user_query);

            if ($insert_user_result) {
                $_SESSION['add-user-success'] = "New user added successfully.";
                header("location: manage_users.php");
                exit();
            } else {
                $_SESSION['add-user'] = "Error in registration: " . mysqli_error($conn);
                header('location: add_user.php');
                exit();
            }
        }
    }
}

// If there are any errors, redirect back to the registration page
if (isset($_SESSION['add-user'])) {
    $_SESSION['add-user-data'] = $_POST;
    header('location: add_user.php');
    exit();
}
?>