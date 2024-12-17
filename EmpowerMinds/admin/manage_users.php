<?php
   require_once "../connect.php";
   session_start();
   //fetch users from database but not current user
   $current_admin_id = $_SESSION['id'];
   echo "Current admin ID: $current_admin_id";
   error_reporting(E_ALL);
   ini_set('display_errors', 1);

   $query = "SELECT * FROM users WHERE NOT user_id = $current_admin_id";
   $users = mysqli_query($conn,$query);

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
             
                <li><a href="index.php">Home</a></li>
                <li><a href="articles.php">Blogs</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="stories.php">Stories</a></li>
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

<section class="dashboard">
        <?php if(isset($_SESSION['add-user-success'])) : ?>
               <div class="alert_message success">
                <p>
                    <?= $_SESSION['add-user-success']; 
                    unset($_SESSION['add-user-success']);
                    ?>
                </p>
            </div>

            <?php elseif(isset($_SESSION['edit-user-success'])) : ?>
               <div class="alert_message success">
                <p>
                    <?= $_SESSION['edit-user-success']; 
                    unset($_SESSION['edit-user-success']);
                    ?>
                </p>
            </div>

            <?php elseif(isset($_SESSION['edit-user'])) : ?>
               <div class="alert_message error">
                <p>
                    <?= $_SESSION['edit-user']; 
                    unset($_SESSION['edit-user']);
                    ?>
                </p>
            </div>

            <?php elseif(isset($_SESSION['delete-user-success'])) : ?>
               <div class="alert_message success">
                <p>
                    <?= $_SESSION['delete-user-success']; 
                    unset($_SESSION['delete-user-success']);
                    ?>
                </p>
            </div>
            <?php elseif(isset($_SESSION['delete-user-error'])) : ?>
               <div class="alert_message error">
                <p>
                    <?= $_SESSION['delete-user-error']; 
                    unset($_SESSION['delete-user-error']);
                    ?>
                </p>
        <?php endif ?>


    <div class="container dashboard_container">
        <aside>
            <ul>
                <li>
                    <a href="add_article.php"><i class="uil uil-pen"></i>
                    <h4>Add Article</h5>
                    </a>
                </li>
                <li>
                    <a href="dashboard.php"><i class="uil uil-list-ul"></i>
                    <h4>Manage Articles</h5>
                    </a>
                </li>
                <li>
                    <a href="add_user.php"><i class="uil uil-user-plus"></i>
                    <h4>Add User</h5>
                    </a>
                </li>
                <li>
                    <a href="manage_users.php" class="active"><i class="uil uil-postcard"></i>
                    <h4>Manage Users</h5>
                    </a>
                </li>
                <li>
                    <a href="verify_stories.php"><i class="uil uil-file-check-alt"></i>
                    <h4>Verify Stories</h5>
                    </a>
                </li>
            </ul>
        </aside>
        <main>
            <h2>Manage users</h2>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Admin</th>   
                    </tr>
                </thead>
                <tbody>
                    <?php while($user = mysqli_fetch_assoc($users)) : ?>
                    <tr>
                        <td><?= "{$user['username']}" ?></td>
                        <td><a href="edit_user.php?id=<?= $user['user_id'] ?>"  class="btn sm">Edit</a></td>
                        <td><a href="delete_user.php?id=<?= $user['user_id'] ?>"  class="btn sm danger">Delete</a></td>
                        <td><?= $user['is_admin']? 'Yes' : 'No' ?></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </main>
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
