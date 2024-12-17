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
session_start();

if(!isset($_SESSION['valid'])){
    header("Location: login.php");
    exit();
}

include("connect.php");
include("classes/reply.php");
include("classes/user.php");
include("classes/comment.php");

if(isset($_GET['comment_id'])){
    $comment_id = $_GET['comment_id'];

    $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : null;

    $reply = new Reply($conn);
    $replies = $reply->get_replies($comment_id);

    $comment = new Comment($conn);
    $comment_details = $comment->get_comment($comment_id);

    if($comment_details){
        $commenter_id = $comment_details['user_id'];
        $commenter = new User($conn);
        $commenter_details = $commenter->get_user($commenter_id);
        $comment_username = $commenter_details['username'];


        
        echo "<div>";
        echo "<p>Commented on: " . date('Y-m-d H:i:s', strtotime($comment_details['created_at'])) . "</p>";
        if ($comment_details['anonymous'] == 1) {
            echo "<p>Anonymously Commented</p>";
        } elseif ($comment_details['anonymous'] == 0) {
            echo "<p>Comment by: $comment_username</p>";
        }
        echo "<p>{$comment_details['comment_text']}</p>";
        if ($_SESSION['id'] == $commenter_id) {
            echo "<span style='color:#999;'><a href='edit_comment.php?post_id=" . $post_id . "&comment_id=" . $comment_id . "'>Edit Comment</a></span>";
            echo "&nbsp;&nbsp;&nbsp;";
            echo "<span style='color:#999;'><a href='deleteForCmts.php?post_id=" . (isset($post_id) ? $post_id : '') . "&comment_id=$comment_id'>Delete Comment</a></span>";
        }
        echo "</div>";
        


        if($replies){
            $user = new User($conn);
            foreach($replies as $reply){
                $reply_time = date("Y-m-d H:i:s", strtotime($reply['created_at']));
                $replier = $user->get_user($reply['user_id']);
                $username = $replier['username'];
                echo "<div>";
                echo "<hr>";
                if ($reply['anonymous'] == 1) {
                    echo "<p>Anonymously Replied</p>";
                } elseif ($reply['anonymous'] == 0) {
                    echo "<p>Reply by: $username</p>";
                }
                echo "<p>{$reply['reply_text']}</p>";
                echo "<p>Reply time: $reply_time</p>";
                if ($_SESSION['id'] == $reply['user_id']) {
                    echo "<span style='color:#999;'><a href='edit_reply.php?post_id=$post_id&comment_id=$comment_id&reply_id={$reply['reply_id']}'>Edit Reply</a></span>";
                    echo "&nbsp;&nbsp;&nbsp;";
                    echo "<span style='color:#999;'><a href='delete_reply.php?post_id=$post_id&comment_id=$comment_id&reply_id={$reply['reply_id']}'>Delete Reply</a></span>";
                }
                echo "<hr>";
                echo "</div>";
            }
        }else{
            echo "<hr>";
            echo "<p>No replies yet</p>";
        }
        //tyo write a reply wala
        echo "<form action='submit_reply.php?post_id=' . (isset($post_id) ? $post_id : '') . method='post'>";
        echo "<input type='hidden' name='comment_id' value='" . $comment_id. "'>";
        echo "<textarea name='reply_text' placeholder='Write a Reply' style='width:50%'></textarea>";
        echo "<input type='checkbox' name='anonymous' value='1'>Reply Anonymously";
        echo "&nbsp;";
        echo "<input type='submit' value='Reply'>";
        echo "</form>";
     }else{
         echo "<p>Comment not found</p>";
    }
    
}else{
    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
        header("Location: view_comments.php?post_id=$post_id");
    }else{
        echo "post id not provided";
    }
    exit();
}
?>