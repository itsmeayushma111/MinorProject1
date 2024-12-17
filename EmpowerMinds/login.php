<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

  //logout query parameter set vacha ki nai
if(isset($_GET['logout'])){
    echo "<div class='message'><p>You have been successfully logged out.</p></div>";
    unset($_GET['logout']);
 }

 if(isset($_SESSION['valid'])) {
    echo "<div class='message'><p>You are already logged in as " . $_SESSION['username'] . ".</p></div>";
    echo "<form action='logout.php' method='post'>";
        echo "<input type='submit' value='Logout'>";
    echo "</form>";
}else{
    displayLoginForm();
}
function displayLoginForm(){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/login.css">
        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <div class="box form-box">
             <?php
             include("connect.php");
             if (isset($_POST['submit'])) {
                 $email = mysqli_real_escape_string($conn, $_POST['email']);
                 $password = mysqli_real_escape_string($conn, $_POST['password']);
             
                 $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'") or die("Select Error");
                 $row = mysqli_fetch_assoc($result);
             
                 if ($row && password_verify($password, $row['pwd'])) {
                    // Successful login
                    $_SESSION['valid'] = $row['email'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['id'] = $row['user_id'];
                    $_SESSION['is_admin'] = $row['is_admin']; // Set the is_admin session variable
                    $_SESSION['is_psychiatric'] = $row['is_psychiatric']; 
                
                    session_regenerate_id(true);
                
                    if ($_SESSION['is_admin'] == 1) { 
                        // Check admin status
                        $_SESSION['user_is_admin'] = true;
                        header('location: admin/dashboard.php'); // Redirect to admin dashboard
                        exit;
                    } elseif($_SESSION['is_psychiatric'] == 1) { 
                            // Check admin status
                            $_SESSION['user_is_psychiatric'] = true;
                            header('location: psychiatric/dashboard.php'); // Redirect to psychiatric dashboard
                            exit;
                    }else {
                        header('location: message.php'); // Redirect to regular user page
                        exit;
                    }
                }
                 else {
                     // Incorrect password or non-existent user
                     $userCheck = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
                     $existingUser = mysqli_fetch_assoc($userCheck);
             
                     if (is_array($existingUser) && !empty($existingUser)) {
                         // Incorrect password
                         echo "<div class='message'><p>Incorrect Password</p></div> <br>";
                     } else {
                         // User does not exist
                         echo "<div class='message'><p>User does not exist</p></div> <br>";
                     }
                     echo "<a href='login.php'><button class='btn'>Go back</button></a>";
                 }
                 } else {
             ?>
                <header>Login</header>
                <form action="" method="post">

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off" required>
                        <img src="eye-closed.png" alt="Show/Hide Password" id="showPassword">
                    </div>

                    <div class="option_field">
                        <a href="reset-password.php" class="forgot_pw">Forgot password?</a>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Login" required>
                    </div>
                    <div class="links">
                        Don't have an account? <a href="register.php">Sign Up Now</a>
                    </div>
                </form>
            </div>
        </div>

        <script src="assets/js/script.js"></script>
    </body>
    </html>
    <?php
}
}
?>




