<?php
   include "logic.php";
   if(isset($_GET['id'])){
       $id=filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

       $query="SELECT * FROM articles WHERE id=$id";
       $result=mysqli_query($conn,$query);

   if(mysqli_num_rows($result)==1){
    $post = mysqli_fetch_assoc($result);
    $thumbnail_name = $post['thumbnail'];
    $thumbnail_path = '../assets/images/' . $thumbnail_name;

    if($thumbnail_path){
        unlink($thumbnail_path);

        $delete_post_query = "DELETE FROM articles WHERE id=$id";
        $delete_post_result = mysqli_query($conn,$delete_post_query);

        if(!mysqli_errno($conn)){
            $_SESSION['delete-post-success']="Article deleted successfully";
        }
        }
   }
 }
header('location: dashboard.php');
die();
?>