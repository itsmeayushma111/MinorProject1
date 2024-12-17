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

include("classes/post.php");
include("classes/user.php");
include("classes/comment.php");
include("connect.php");

// Check if user is logged in
if(!isset($_SESSION['valid'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}
$Post = new Post($conn);
$ROW = null;
$ERROR = "";

if(isset($_GET['post_id']) && !empty($_GET['post_id'])){

  $ROW = $Post->get_post($_GET['post_id']);

  if(!$ROW){$ERROR = "No such post was found!";}
}else{
  $ERROR = "No such post was found!";
}
//if something was posted
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $Post->delete_post_with_comments_and_replies($_POST['post_id']);
  $ROW = null;
  header("Location: message.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/post.css">
    <title>Delete</title>
</head>
<body>
    <!--posts area-->
    <div style="min-height: 400px; flex: 2.5; padding:20px; padding-right:0px;">
      <div style="border:solid thin #aaa; padding: 10px; background-color: white;">
          
          <form method="post">
              <br>
                 <?php 
                    if($ERROR != ""){ echo $ERROR; }
                    if($ROW){
                      echo "Are you sure you want to delete this post??<br><br>";
                      if(isset($ROW) && $ROW !== null){
                        $user = new User($conn);
                        $ROW_USER = $user->get_user($ROW['user_id']);
                        include("post_delete.php");
                      }else{
                        echo "No post was found.";
                      }
                    }
                  ?>
              <br>
             <input type="hidden" name="post_id" value="<?php echo $ROW['post_id'] ?>">
             <input id="post_button" type="submit" value="Delete">
             <br>
          </form>
      </div>

    </div>

     
</body>
</html>
