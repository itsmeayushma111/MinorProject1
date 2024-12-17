<?php
require_once "../connect.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['submit'])){
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    $thumbnail = $_FILES['thumbnail'];

    // Debugging: Print form data
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";

    if (!$title) {
        $_SESSION['add-post'] = "Enter post title";
    } elseif (!$body) {
        $_SESSION['add-post'] = "Enter post body";
    } elseif (!$url) {
        $_SESSION['add-post'] = "Enter URL of the source";
    }elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "Choose post thumbnail";
    } else {
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../assets/images/' . $thumbnail_name;

        $allowed_files = ['png', 'jpeg', 'jpg'];
        $extension = pathinfo($thumbnail_name, PATHINFO_EXTENSION);

        if (in_array($extension, $allowed_files)) {
            if ($thumbnail['size'] < 2_000_000) {
                if (move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path)) {
                    $query = "INSERT INTO articles (title, body, url, thumbnail) VALUES ('$title', '$body', '$url', '$thumbnail_name')";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        $_SESSION['add-post-success'] = "New post added successfully";
                        header("location: dashboard.php");
                        exit();
                    } else {
                        $_SESSION['add-post'] = "Error in adding post: " . mysqli_error($conn);
                    }
                } else {
                    $_SESSION['add-post'] = "Error in uploading thumbnail";
                }
            } else {
                $_SESSION['add-post'] = "File size too big. Should be less than 2MB";
            }
        } else {
            $_SESSION['add-post'] = "File should be png, jpg or jpeg";
        }
    }
    // Debugging: Check if control reaches here
    echo "Control reaches here";
    exit();
}
?>