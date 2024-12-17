<div>
<img src="myProfile.png" alt="userprofile" style="width: 50px; height: 50px; padding-left: 70px;">
<?php
if (isset($_SESSION['username'])){
    echo "<div style='padding-left: 70px;'>";
    echo "<div id=username >" . $_SESSION['username'] . "</div>";
    echo "<form action='logout.php' method='post'>";
    echo "<input type='submit' value='Logout'>";
    echo "</form>";
    echo "</div>";
    
}
?>
</div>
<style>
    #username{
        color: white;
        font-family: 'Quicksand', sans-serif;
        font-weight: bold;
    }
</style>