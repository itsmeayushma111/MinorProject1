<?php
   include "../connect.php";
   if(isset($_GET['id'])){
       $id=filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
       $query="SELECT * FROM articles WHERE id=$id";
       $result=mysqli_query($conn,$query);
       $article=mysqli_fetch_assoc($result);
   }else{
       header('location:dashboard.php');
       die();
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavBar</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="navdiv">
        <div class="logo">
        <img src="../assets/images/logo.jpg" alt="logo" class=logo-icon/>
        <img src="../assets/images/tea.png" alt="sprout" class="sprout">
        <span class="empower">Empower</span><span class="minds">Minds</span>
        </div>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../articles.php">Articles</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="../stories.php">Stories</a></li>
                <button ><a href="../login.php" class="btn">Login</a></button>
            </ul>
         </div>
    </nav>
    <section class="form_section">
        <div class="container form_section-container">
            <h2>Edit Post</h2>
            <form action="edit_article_logic.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $article['id'] ?>">
                <input type="hidden" name="previous_thumbnail_name" value="<?= $article['thumbnail'] ?>" placeholder="Title">
                <input type="text" name="title" value="<?= $article['title'] ?>" placeholder="Title">
                <textarea rows="10" name="body" placeholder="Body"><?= $article['body'] ?></textarea>
                <style>
                    textarea::placeholder {
                    color: white;
                    }
                </style>
                <input type="text" name="url" value="<?= $url ?? '' ?>" placeholder="URL of the source">
                <div class="form_control">
                    <label for="thumbnail">Change Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail">
                </div>
                <button type="submit" name="submit" class="btn">Update Post</button>
            </form>
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