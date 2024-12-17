<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body{
      background-color:lavender;
      padding-left: 28px;
    }
  </style>

</head>
</html>
<?php
session_start();

if (!isset($_SESSION['valid'])){
    header("Location: login.php");
    exit();
}
include("connect.php");
include("classes/comment.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //retrieve gareko
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['id'];
    $comment_text = $_POST['comment_text'];

    $anonymous = isset($_POST['anonymous']) ? 1 : 0;

    //sanitize input data
    $post_id = mysqli_real_escape_string($conn, $post_id);
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $comment_text = mysqli_real_escape_string($conn, $comment_text);

    $comment = new Comment($conn);
//comment lai databasema insert
    $result = $comment->create_comment($post_id, $user_id, $comment_text,$anonymous);

    if ($result === true) {
        header("Location: view_comments.php?post_id=" . $post_id);
        exit();
    } else{
        echo "error:" . $result;
    }    
} else{
    header("Location: stories.php");
    exit();
}
?>