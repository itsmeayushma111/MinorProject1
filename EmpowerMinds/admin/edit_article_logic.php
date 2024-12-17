<?php
require_once "../connect.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    $thumbnail = $_FILES['thumbnail'];

    if (!$title || !$body) {
        $_SESSION['edit-post'] = "Couldn't update article.";
    } else {
        if($thumbnail['name']){
            $previous_thumbnail_path = '../assets/images/' . $previous_thumbnail_name;
            if(file_exists($previous_thumbnail_path)){
            unlink($previous_thumbnail_path);
            }

            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../assets/images/' . $thumbnail_name;

            $allowed_files = ['png', 'jpeg', 'jpg'];
            $extension = explode('.',$thumbnail_name);
            $extension = end($extension);
            if (in_array($extension, $allowed_files)) {
                if ($thumbnail['size'] < 2_000_000) {
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION['edit-post'] = "File size too big. Should be less than 2MB";
                }
            } else {
                $_SESSION['edit-post'] = "File should be png, jpg or jpeg";
            }
        }
        
        if(isset($_SESSION['edit-post'])){ // Corrected session variable check
            header('location: dashboard.php');
            exit(); // Terminating script execution after redirection
        }else{
            $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

            $query = "UPDATE articles SET title='$title', body='$body', url='$url', thumbnail='$thumbnail_to_insert' WHERE id=$id";
            $result=mysqli_query($conn,$query);

            if(!mysqli_errno($conn)){
                $_SESSION['edit-post-success']="Article updated successfully";
                header('location: dashboard.php');
                exit(); // Terminating script execution after redirection
            }
        }
    }
}
?>
