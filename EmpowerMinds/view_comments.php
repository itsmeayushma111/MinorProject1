<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body{
      background-color:#a2a8d6;
      padding-left: 28px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
  </style>

</head>
</html>
<?php
include("connect.php");
include("classes/post.php");
include("classes/comment.php");
include("classes/user.php");

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

$post = new Post($conn);
$comment = new Comment($conn);
$user = new User($conn);

if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
    $post_details = $post->get_post($post_id);
    if ($post_details) {
        $author = $post->get_post_author($post_details['user_id']);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>View Post and Comments</title>
        </head>
        <body>
            <div>
                <h2>Post by: <?php echo $author['username']; ?></h2> <!-- Display author's username -->
                <p><?php echo $post_details['post']; ?></p>
            </div>

            <h2>Comments</h2>
            <div>
                <!-- Display each comment -->
                <?php
                $comments = $comment->get_comments($post_id);

                if ($comments) {
                    foreach ($comments as $comment) {
                        $commenter_id = $comment['user_id'];
                        $commenter = $user->get_user($commenter_id);

                        $comment_time = strtotime($comment['created_at']);
                        echo "<hr>";
                        echo "<div>";
                        echo "<p>Commented on: " . date('Y-m-d H:i:s', $comment_time) . "</p>";
                        if ($comment['anonymous'] == 1) {
                            echo "<p>Anonymously Commented</p>";
                        } elseif ($comment['anonymous'] == 0) {
                            echo "<p>Comment by: " . $commenter['username'] . "</p>";
                        }
                        echo "<p>" . $comment['comment_text'] . "</p>";
                        //tyo write a reply wala
                        echo "<form action='submit_reply.php?post_id=$post_id' method='post'>";
                        echo "<input type='hidden' name='comment_id' value='" . $comment['comment_id'] . "'>";
                        echo "<textarea name='reply_text' placeholder='Write a Reply' style='width:50%'></textarea>";
                        echo "<input type='checkbox' name='anonymous' value='1'>Reply Anonymously";
                        echo "&nbsp;";
                        echo "<input type='submit' value='Reply'>";
                        echo "</form>";

                        //view reply button
                        echo "<form action='view_replies.php?post_id=$post_id' method='GET'>";
                        echo "<input type='hidden' name='comment_id' value='" . $comment['comment_id'] . "'>";
                        echo "<input type='hidden' name='post_id' value='$post_id'>";
                        echo "<button type='submit'>View Replies</button>";
                        echo "</form>";
                        echo "<br>";

                        //delete link
                        if ($_SESSION['id'] == $comment['user_id']){
                            echo "<span style='color:#999;'><a href='edit_comment.php?post_id=" . $post_id . "&comment_id=" . $comment['comment_id'] . "'>Edit Comment</a></span>";
                            echo "&nbsp;&nbsp;&nbsp;";
                            echo "<span style='color:#999;'><a href='deleteForCmts.php?post_id=" . $post_id . "&comment_id=" . $comment['comment_id'] . "'>Delete Comment</a></span>";
                        }
                        echo "</div>";
                    }
                } else {
                    echo "No comments yet.";
                }
                ?>
            </div>
            <!--logged in userle matra comment garnako laagi logged in cha ki nai-->
            <?php if(isset($_SESSION['id'])): ?>
                <hr>
                <h2>Add Comment</h2>
                <form action="submit_comment.php?post_id=<?php echo $post_id; ?>" method="post">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <textarea name="comment_text" placeholder="Write a comment" style="width:50%"></textarea>
                    <br>
                    <input type="checkbox" name="anonymous" value="1">Comment Anonymously
                    <input type="submit" value="Comment">
                </form>
            <?php else: ?>
                <p>You must be logged in to comment.</p>
            <?php endif; ?>
        </body>
        </html>
        <?php
    } //else {
    //     echo "Post not found.";
    // }
} else {
    echo "Deleted successfully.";
}
?>