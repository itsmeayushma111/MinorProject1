<?php

include("connect.php");
class User{
    private $conn;

    public function __construct($conn){
         $this->conn = $conn;
    }


    public function get_user($user_id){
        $query = "SELECT * FROM users WHERE user_id = '$user_id' limit 1";
        $result = mysqli_query($this->conn, $query);

        if ($result && mysqli_num_rows($result)>0){
            return mysqli_fetch_assoc($result);
        }else{
            return false;
        }
    }
}