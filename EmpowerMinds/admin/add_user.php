<?php
require_once "logic.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;

unset($_SESSION['add-user-data']);
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
                <li><a href="#">Home</a></li>
                <li><a href="#">Blogs</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Stories</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li>
                        <img src="../myProfile.png" alt="userprofile" class="profile-image">
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
    <section class="form_section">
        <div class="container form_section-container">
            <h2>Add User</h2>
            <?php if(isset($_SESSION['add-user'])) : ?>
               <div class="alert_message success">
                <p>
                    <?= $_SESSION['add-user']; 
                    unset($_SESSION['add-user']);
                    ?>
                </p>
            </div>
        <?php endif ?>
            <form action="add_user_logic.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="username" value= "<?= $username ?>" id="username" placeholder="Username" autocomplete="off" required>
                    <input type="email" name="email" value= "<?= $email ?>" id="email" placeholder="Email" autocomplete="off" required>
                    <input type="password" name="createpassword" value= "<?= $createpassword ?>" id="password" placeholder="Create password" autocomplete="off" required>
                    <input type="password" name="confirmpassword" value= "<?= $confirmpassword ?>" id="password" placeholder="Confirm password" autocomplete="off" required>
                    <select name="userrole">
                       <option value="0">User</option>
                       <option value="1">Admin</option>
                    </select>

                    <button type="submit" name="submit" class="btn">Add User</button>
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