<?php
   require_once "connect.php";
   session_start();
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
        <img src="assets/images/tea.png" alt="sprout" class="sprout"> 
        <span class="empower">Empower</span><span class="minds">Minds</span>
        </div>
            <ul>
             
                <li><a href="index.php">Home</a></li>
                <li><a href="articles.php">Articles</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="stories.php">Stories</a></li>
           <button ><a href="login.php" class="btn">Login</a></button>
            </ul>
         </div>
    </nav>
    
   <div id="home">
     <h1>
        Welcome To 
        <br>
        EmpowerMinds
     </h1>
     <div>
     <h2 id="three">
       Embracing Mental Wellness 
        <br>
         One Step at a Time  
        </h2>
    </div>
</div>
    

               <section class="posts">
                <div class="container posts_container">

                    <article class="post">
                        <div class="post_thumbnail">
                            <img src="assets/images/photo.png">
                        </div>
                        <div class="post_info">
                            <h3 class="post_title"><a href="article.html">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, quibusdam! Repellat illo in, earum, quisquam vitae!</a></h3>
                            <p class="post_body">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates, tempore aperiam dolor iusto repellendus quia necessitatibus odio debitis, distinctio voluptatum dignissimos adipisci harum.
                            </p>
                        </div>
                    </article>

                    <article class="post">
                        <div class="post_thumbnail">
                            <img src="assets/images/photo.png">
                        </div>
                        <div class="post_info">
                            <h3 class="post_title"><a href="article.html">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, quibusdam! Repellat illo in, earum, quisquam vitae!</a></h3>
                            <p class="post_body">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates, tempore aperiam dolor iusto repellendus quia necessitatibus odio debitis, distinctio voluptatum dignissimos adipisci harum.
                            </p>
                        </div>
                    </article>  
                    
                    <article class="post">
                        <div class="post_thumbnail">
                            <img src="assets/images/photo.png">
                        </div>
                        <div class="post_info">
                            <h3 class="post_title"><a href="article.html">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, quibusdam! Repellat illo in, earum, quisquam vitae!</a></h3>
                            <p class="post_body">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates, tempore aperiam dolor iusto repellendus quia necessitatibus odio debitis, distinctio voluptatum dignissimos adipisci harum.
                            </p>
                        </div>
                    </article>   
                    
                    <article class="post">
                        <div class="post_thumbnail">
                            <img src="assets/images/photo.png">
                        </div>
                        <div class="post_info">
                            <h3 class="post_title"><a href="article.html">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, quibusdam! Repellat illo in, earum, quisquam vitae!</a></h3>
                            <p class="post_body">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates, tempore aperiam dolor iusto repellendus quia necessitatibus odio debitis, distinctio voluptatum dignissimos adipisci harum.
                            </p>
                        </div>
                    </article>

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