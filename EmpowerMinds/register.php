<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">

        <?php
        
         include("connect.php");
         if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $v_code=bin2hex(random_bytes(16));

         //verifying the unique email

         $verify_query = mysqli_query($conn,"SELECT email FROM users WHERE email='$email'");

         if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message'>
                      <p>This email is used, Try another One Please!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
         }
         else{
            mysqli_query($conn,"INSERT INTO users(username,email,pwd) VALUES('$username','$email','$password')") or die("Error Occured");

            echo "<div class='message'>
                      <p>Registration Successful!</p>
                  </div> <br>";
            echo "<a href='login.php'><button class='btn'>Login Now</button></a>";
         }
         }else{

        ?>
            <header>Sign up</header>
            <form action="" method="post">

                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                    <img src="eye-closed.png" alt="Show/Hide Password" id="showPassword">
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>