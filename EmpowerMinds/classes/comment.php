<?php

include("connect.php");

class Comment
{
    private $conn;
    private $error = "";

     // Constructor to initialize the database connection
     public function __construct($conn){
         $this->conn = $conn;
     }
     public function create_comment($post_id, $user_id , $comment_text, $anonymous){
        if(!empty($comment_text))
        {
            $comment_text = mysqli_real_escape_string($this->conn, $comment_text);
            $comment_id = $this->create_comment_id();

            $query = "INSERT INTO comments (post_id,user_id,comment_id,comment_text,anonymous) VALUES ('$post_id','$user_id','$comment_id','$comment_text','$anonymous')";
            $result = mysqli_query($this->conn, $query);

            if($result){
                return true;//commented
            } else{
                return "Error: Unable to comment.";
            }
        }else{
            return "Please enter a comment before submitting.";
        }
     }
    
     //commentko laagi
    public function get_comments($post_id){
        $query = "SELECT *, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') AS comment_time FROM comments WHERE post_id = '$post_id' ORDER BY created_at DESC";
        $result = mysqli_query($this->conn, $query);

        if($result){
            $comments = array();
            while($row = mysqli_fetch_assoc($result)){
                $comments[] = $row;
            }
            return $comments;
        }else{
            return false;
        }
    }
    public function get_comment($comment_id)
{
    if (!is_numeric($comment_id)) {
        return false;
    }
    
    $query = "SELECT * FROM comments WHERE comment_id = '$comment_id'";
    $result = mysqli_query($this->conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}
     //unique comment id
     private function create_comment_id(){
        $length = rand(4,19);
        $number = "";
        for($i=0; $i<$length; $i++){
            $new_rand = rand(0,9);

            $number = $number . $new_rand;
        }
        return $number;
     }
     //comment delete garna
     public function delete_comment($comment_id){
        if(!is_numeric($comment_id)){
            return false;
        }
        $query = "DELETE FROM comments WHERE comment_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $comment_id);
        if($stmt->execute()){
            return true;
        } else{
            return $stmt->error;
        }
     }
     public function edit_comment($comment_id, $edited_comment_text) {
        // Prepare SQL statement to update the comment text
        $sql = "UPDATE comments SET comment_text = ? WHERE comment_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $edited_comment_text, $comment_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Return true if the comment is successfully updated
            return true;
        } else {
            // Return false if there is an error
            return false;
        }
    }
}
//instantiate comment class with DB connection
$comment = new Comment($conn);
?>