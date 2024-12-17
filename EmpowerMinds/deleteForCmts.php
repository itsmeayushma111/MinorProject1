<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
      body{
        background-color:#a2a8d6;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
  </style>

</head>
</html>
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

if (!isset($_GET['comment_id'])) {
  echo "Comment ID not provided";
  exit();
}

$comment = new Comment($conn);
$comment_id = $_GET['comment_id'];
$comment_details = $comment->get_comment($comment_id);

if(!$comment_details){
  header("Location: view_comments.php");
  exit();
}else{
  $user = new User($conn);
  $commenter = $user->get_user($comment_details['user_id']);
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if (isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];

    //reply haru paila delete garni
    $reply = new Reply($conn);
    $result = $reply->delete_replies_for_comment($comment_id);

    if($result === true){
      $result = $comment->delete_comment($comment_id);

      if($result === true){
        if(isset($_GET['post_id'])) {
          $post_id = $_GET['post_id'];
          header("Location: view_comments.php");//?post_id=$post_id
          exit();
        } else {
          header("Location: view_comments.php");
          exit();
        }
      }else{
        echo "error:" . $result;
      }
    }else{
      echo "error:" . $result;
    }
  }else{
    echo "comment id not provided";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/post.css">
    <title>Delete Comment</title>
</head>
<body>
    <!--posts area-->
    <div style="min-height: 400px; flex: 2.5; padding:20px; padding-right:0px;">
      <div style="border:solid thin #aaa; padding: 10px; background-color: white;">
          
          <form method="post">
             <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']; ?>">
              <br>
                 <?php 
                   echo "Are you sure you want to delete this comment??<br><br>";
                   echo "<p>Comment by:" . $commenter['username'] . "</p>";
                   echo "<p>" . $comment_details['comment_text'] . "</p>";
                  ?>
              <br>
             <input id="post_button" type="submit" value="Delete">
             <br>
          </form>
      </div>

    </div>

     
</body>
</html>
