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
include("classes/reply.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //retrieve gareko
    $comment_id = $_POST['comment_id'];
    $user_id = $_SESSION['id'];
    $reply_text = $_POST['reply_text'];
    $anonymous = isset($_POST['anonymous']) ? 1 : 0;
    //sanitize input data
    $comment_id = mysqli_real_escape_string($conn, $comment_id);
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $reply_text = mysqli_real_escape_string($conn, $reply_text);

    $reply = new Reply($conn);
//reply lai databasema insert
    $result = $reply->create_reply($comment_id, $user_id, $reply_text,$anonymous);

    if ($result === true) {
        header("Location: view_replies.php?comment_id=$comment_id");
        exit();
    } else{
        echo "error:" . $result;
    }    
} else{
    header("Location: view_comments.php");
    exit();
}