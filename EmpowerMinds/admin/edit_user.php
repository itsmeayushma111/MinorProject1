<?php
   include "logic.php";
   if(isset($_GET['id'])){
       $id=filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
       $query="SELECT * FROM users WHERE user_id=$id";
       $result=mysqli_query($conn,$query);
       $user=mysqli_fetch_assoc($result);
   }else{
       header('location:manage_users.php');
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
                <li><a href="../articles.php">Blogs</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="../stories.php">Stories</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li>
                        <img src="../myProfile.png" alt="userprofile" class="profile-image">
                        <span class="username"><?= $_SESSION['username'] ?></span>
                        <form action="logout.php" method="post">
                            <input type="submit" value="Logout">
                        </form>
                    </li>
                <?php else: ?>
                    <li><a href="../login.php" class="btn">Login</a></li>
                <?php endif; ?>
            </ul>
         </div>
    </nav>

    <section class="form_section">
        <div class="container form_section-container">
            <h2>Edit User</h2>
            <?php if(isset($_SESSION['add-user'])) : ?>
               <div class="alert_message success">
                <p>
                    <?= $_SESSION['add-user']; 
                    unset($_SESSION['add-user']);
                    ?>
                </p>
            </div>
        <?php endif ?>
            <form action="edit_user_logic.php" method="POST">
            <input type="hidden" name="id" value="<?= $user['user_id'] ?>">
                    <input type="text" name="username" value= "<?= $user['username'] ?>" id="username" placeholder="Username" autocomplete="off" required>
                    <select name="userrole">
                       <option value="0">User</option>
                       <option value="1">Admin</option>
                    </select>

                    <button type="submit" name="submit" class="btn">Update User</button>
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
</html>