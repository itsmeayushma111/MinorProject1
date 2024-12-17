<?php

include("connect.php");
include("classes/reply.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

// Check if post ID, comment ID, and reply ID are provided
if(isset($_GET['post_id']) && isset($_GET['comment_id']) && isset($_GET['reply_id'])){
    $post_id = $_GET['post_id'];
    $comment_id = $_GET['comment_id'];
    $reply_id = $_GET['reply_id'];

    // Retrieve the reply from the database
    $reply = new Reply($conn);
    $reply_details = $reply->get_reply($reply_id);

    // Ensure the reply exists and the user is the author
    if ($reply_details && $_SESSION['id'] == $reply_details['user_id']) {
        // Handle reply editing (if form is submitted)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $edited_reply_text = $_POST['edited_reply_text'];

            // Update the reply in the database
            $success = $reply->edit_reply($reply_id, $edited_reply_text);

            // Redirect back to view_comments.php after editing
            if ($success) {
                header("Location: view_replies.php?post_id=$post_id&comment_id=$comment_id");
                exit();
            }
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Reply</title>
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
                        <h2>Edit Reply</h2>
                        <textarea name="edited_reply_text" style="height: 30px; width: 80%; margin-top: 10px; border-radius: 7px; padding: 10px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: larger;"><?php echo $reply_details['reply_text']; ?></textarea>
                        <input type="submit" value="Save">
                    </form>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
} else {
    // Handle case where post ID, comment ID, or reply ID is missing
    echo "Invalid request.";
}
?>
