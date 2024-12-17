<?php

include("connect.php");
include("classes/comment.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

// Check if post ID and comment ID are provided
if(isset($_GET['post_id']) && isset($_GET['comment_id'])){
    $post_id = $_GET['post_id'];
    $comment_id = $_GET['comment_id'];

    // Retrieve the comment from the database
    $comment = new Comment($conn);
    $comment_details = $comment->get_comment($comment_id);

    // Ensure the comment exists and the user is the author
    if ($comment_details && $_SESSION['id'] == $comment_details['user_id']) {
        // Handle comment editing (if form is submitted)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $edited_comment_text = $_POST['edited_comment_text'];

            // Update the comment in the database
            $success = $comment->edit_comment($comment_id, $edited_comment_text);

            // Redirect back to view_comments.php after editing
            if ($success) {
                header("Location: view_comments.php?post_id=$post_id");
                exit();
            }
        }
        ?>
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
        <body>
            <div style="min-height: 400px; padding: 20px;">
                <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                    <form action="" method="post">
                        <h3>Edit Comment</h3>
                        <textarea name="edited_comment_text" style="height: 30px; width: 80%; margin-top: 10px; border-radius: 7px; padding: 10px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: larger;"><?php echo $comment_details['comment_text']; ?></textarea>
                        <input type="submit" value="Save">
                    </form>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
} else {
    // Handle case where post ID or comment ID is missing
    echo "Invalid request.";
}
?>
