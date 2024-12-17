<?php
include("connect.php");

class Reply
{
    private $conn;
    private $error = "";

     // Constructor to initialize the database connection
     public function __construct($conn){
         $this->conn = $conn;
     }
     public function create_reply($comment_id, $user_id , $reply_text, $anonymous){
        if(!empty($reply_text))
        {
            $reply_text = mysqli_real_escape_string($this->conn, $reply_text);
            $reply_id = $this->create_reply_id();

            $query = "INSERT INTO replies (comment_id,user_id,reply_id,reply_text,anonymous) VALUES ('$comment_id','$user_id','$reply_id','$reply_text','$anonymous')";
            $result = mysqli_query($this->conn, $query);

            if($result){
                return true;//reply garyo
            } else{
                return "Error: Unable to reply.";
            }
        }else{
            return "Please enter a reply before submitting.";
        }
     }
    
     //replyko laagi
    public function get_replies($comment_id){
        $query = "SELECT *, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') AS reply_time FROM replies WHERE comment_id = '$comment_id' ORDER BY created_at DESC";
        $result = mysqli_query($this->conn, $query);

        if($result){
            $replies = array();
            while($row = mysqli_fetch_assoc($result)){
                $replies[] = $row;
            }
            return $replies;
        }else{
            return false;
        }
    }
    //euta reply ko laagi
    public function get_reply($reply_id) {
        $query = "SELECT * FROM replies WHERE reply_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $reply_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false; // Reply not found
        }
    }
    
     //unique reply id
     private function create_reply_id(){
        $length = rand(4,19);
        $number = "";
        for($i=0; $i<$length; $i++){
            $new_rand = rand(0,9);

            $number = $number . $new_rand;
        }
        return $number;
     }
     //reply delete garna
     public function delete_reply($reply_id){
        if(!is_numeric($reply_id)){
            return false;
        }
        $query = "DELETE FROM replies WHERE reply_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $reply_id);
        if($stmt->execute()){
            return true;
        } else{
            return $stmt->error;
        }
     }
     //commentko sabai reply delete
     public function delete_replies_for_comment($comment_id){
        $query = "DELETE FROM replies WHERE comment_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $comment_id);
        if($stmt->execute()){
            return true;
        } else{
            return $stmt->error;
        }
     }
     public function edit_reply($reply_id, $edited_reply_text) {
        // Prepare SQL statement to update the reply text
        $sql = "UPDATE replies SET reply_text = ? WHERE reply_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $edited_reply_text, $reply_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Return true if the reply is successfully updated
            return true;
        } else {
            // Return false if there is an error
            return false;
        }
    }
}
//instantiate comment class with DB connection
$reply = new Reply($conn);
?>