<?php
include "connect.php";
if(isset($_GET['id'])){
    $id=filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query="SELECT * FROM articles WHERE id=$id";
    $result=mysqli_query($conn,$query);
    $article=mysqli_fetch_assoc($result);
}else{
    header('location:articles.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavBar</title>
    <link rel="stylesheet" href="assets/css/article.css">
    <link rel="preconnect" href="https://fonostts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="navdiv">
        <div class="logo">
        <img src="assets/images/logo.jpg" alt="logo" class=logo-icon/>
        <img src="assets/images/tea.png" alt="sprout" class="sprout">
        <span class="empower">Empower</span><span class="minds">Minds</span>
        </div>
            <ul>
             
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Articles</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="stories.php">Stories</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li>
                        <img src="myProfile.png" alt="userprofile" class="profile-image">
                        <span class="username"><?= $_SESSION['username'] ?></span>
                        <form action="logout.php" method="post">
                            <input type="submit" value="Logout">
                        </form>
                    </li>
                <?php else: ?>
                    <li><a href="login.php" class="btn">Login</a></li>
                <?php endif; ?>
            </ul>
         </div>
    </nav>

    <section class="singlepost">
        <div class="container singlepost_container">
            <h2><?= $article['title'] ?></h2>
        <div class="singlepost_thumbnail">
            <img src="assets/images/<?= $article['thumbnail'] ?>">
        </div>
        <div class="post_body">
            <?= nl2br($article['body']) ?>
        </div>
        <p class="url-container"><strong>Source:</strong> <a href="<?= $article['url'] ?>" class='url-link'><?= $article['url'] ?></a></p>
        <style>
            .url-link{
                color:white;
            }
        </style>
        </div>
    </section>
    
    <footer class="footer">
        <div class="container">
        <div class="row">
         <div class="footer col">
          <h4>More on us </h4>
          <ul>
              <li>
                  <a href="#">about us</a>
              </li>
          </ul>
         </div>
         <div class="footer col">
          <h4>get help</h4>
          <ul>
              <li>
                  <a href="#">here</a>
              </li>
          </ul>
         </div>
         <div class="footer col">
          <h4>Details</h4>
          <ul>
              <li>
                  <a href="#">Remarks</a>
              </li>
          </ul>
         </div>
         <div class="footer col">
          <h4>follow us</h4>
          <div class="social-links">
                  <a href="#" class="one"><i class="fab fa-facebook-f"></i></a>
                  <a href="#" class="one" ><i class="fab fa-twitter"></i></a>
                  <a href="#" class="one"><i class="fab fa-instagram"></i></a>
          </div>
         </div>
        </div>
  </div>
</footer>
</body>
</html>