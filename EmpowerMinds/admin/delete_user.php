<?php
session_start();
require_once "../connect.php";

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM users WHERE user_id=$id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) == 1){
        $delete_user_query = "DELETE FROM users WHERE user_id=$id";
        $delete_user_result = mysqli_query($conn, $delete_user_query);

        if($delete_user_result){
            $_SESSION['delete-user-success'] = "User deleted successfully";
        } else {
            $_SESSION['delete-user-error'] = "Error deleting user: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['delete-user-error'] = "User not found";
    }
}

mysqli_close($conn);
header('location: manage_users.php');
exit();
?>