<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("classes/user.php");
include("classes/comment.php");
include("classes/reply.php");
include("connect.php");

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Check if user is logged in
if(!isset($_SESSION['valid'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

if (!isset($_GET['reply_id'])) {
  echo "Reply ID not provided";
  exit();
}

$reply = new Reply($conn);
$reply_id = $_GET['reply_id'];
$result = $reply->delete_reply($reply_id);

if($result === true){
  if(isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    header("Location: view_comments.php?post_id=$post_id");
    exit();
  } else{
    header("Location: view_comments.php");
    exit();
  }
}else {
  echo "error!" . $result;
}
?>

