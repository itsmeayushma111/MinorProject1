<?php
   require_once "connect.php";
   session_start();
   $query = "SELECT * FROM articles ORDER BY id asc";
   $articles = mysqli_query($conn,$query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavBar</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="navdiv">
        <div class="logo">
        <img src="assets/images/logo.jpg" alt="logo" class=logo-icon/>
        <img src="assets/images/tea.png" alt="sprout" class="sprout"/>
        <span class="empower">Empower</span><span class="minds">Minds</span>
        </div>
            <ul>
             
                <li><a href="index.php">Home</a></li>
                <li><a href="">Articles</a></li>
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

<!--------------------------------------------featured------------------------------------------->
<!--
<section class="featured">
   <div class="container featured_container">
    <div class="post_thumbnail">
        <img src="assets/images/background.jpg">
    </div>
    <div class="post_info">
    <h2 class="post_title"><a href="article.html">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, quibusdam! Repellat illo in, earum, quisquam vitae!</a></h3>
    <p class="post_body">
     Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates, tempore aperiam dolor iusto repellendus quia necessitatibus odio debitis, distinctio voluptatum dignissimos adipisci harum.
    </p>
    </div>
   </div>
-->

</section>

            <section class="posts">
                <div class="container posts_container">
                    <?php while($article = mysqli_fetch_assoc($articles)): ?>

                    <article class="post">
                        <div class="post_thumbnail">
                            <img src="assets/images/<?= $article['thumbnail']?>">
                        </div>
                        <div class="post_info">
                            <h3 class="post_title">
                            <a href="article.php?id=<?= $article['id'] ?>"><?= $article['title']?></a>
                            </h3>
                            <div class="post_body">
                                <?= substr($article['body'],0,300) ?>
                            </div>
                            <p class="url-container"><strong>Source:</strong> <a href="<?= $article['url'] ?>" class='url-link'><?= $article['url'] ?> </a></p>
                        </div>
                    </article>
                    <?php endwhile ?>

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
</body>
</html>