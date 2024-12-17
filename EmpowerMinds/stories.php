<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/postBox.css">
  <style>
    body{
      background-color:#7a88c5;
    }
  </style>
<?php
session_start();
include("connect.php");
include("classes/post.php");
include("classes/user.php");
include("displayUsername.php");

if(!isset($_SESSION['valid'])){
    header("Location: login.php");
    exit();
}

$post = new Post($conn);
$other_posts = $post->get_otherPosts($_SESSION['id']);
$user_id = $_SESSION['id'];
$anonymous = isset($_POST['anonymous']) ? 1 : 0;
//check if user_id is set
if(!isset($user_id)){
  // or header("Location: login.php?error=user_id_not_set");
  echo "User Id is not set.";
  exit();
}
$user = new User($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Other People's Stories</title>
</head>
<body>

    <nav style="padding-left: 20px;">
        <ul>
            <li><a href="message.php">My Stories</a></li>
            
        </ul>
    </nav>

    <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color:white;">Other People's Stories</h1>

    <div>
    <?php foreach($other_posts as $other_post): ?>
        <?php $author = $user->get_user($other_post['user_id']); ?>
        
        <?php if($other_post['status'] == 'approved'): ?>
          <div id="post_bar">
        <?php if($other_post['anonymous'] == 1): ?>
        <p>Anonymously Posted</p>
        <?php endif; ?>
        <?php if($other_post['anonymous'] == 0): ?>
        <p>Posted by: <?php echo $author['username']; ?></p>
        <?php endif; ?>
            <img src="userProfile.png" alt="userprofile" style="width: 50px; height: 50px; margin-right: 4px;">
            <p>Post: <?php echo $other_post['post']; ?></p>
            <div class="post-content">
            <form action="submit_comment.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo $other_post['post_id']; ?>">
                <textarea name="comment_text" placeholder="Write a comment" style="width:99%"></textarea>
                <br>
                <input type="checkbox" name="anonymous" value="1">Comment Anonymously
                <input type="submit" value="Comment">
            </form>
            <br>
            <?php echo "<a href='view_comments.php?post_id=" . $other_post['post_id'] . "&post=" . urlencode($other_post['post']) . "'>View Comments</a>"; ?>
            <span style="color: #999;"><?php echo $other_post['date']; ?></span>
            </div>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
    
</body>
</html>