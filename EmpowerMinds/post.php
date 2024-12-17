<style>
    #post{
        margin-bottom:10px;
    }
</style>
<div id="post">
    <div>
        <img src="myProfile.png" alt="userprofile" style="width: 50px; height: 50px; margin-right: 4px;">
    </div>
    <div>
        <div style="font-weight: bold; color:#405d9b">
            <?php 
                echo $ROW_USER['username']; 
                if($ROW['anonymous'] == 1) {
                    echo " (Anonymous)";
                }
            ?>
        </div>
        
        <?php echo $ROW['post']?>    <br><br>
        <span style="color:#999; float:right;">
        <a href="edit.php?post_id=<?php echo $ROW['post_id']?>" style="padding-right: 20px;">Edit Post</a>
        <a href="delete.php?post_id=<?php echo $ROW['post_id']?>" style="padding-right: 20px;">Delete Post</a>
        </span><br>
        

    </div>
    
</div>
