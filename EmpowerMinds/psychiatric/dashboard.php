<?php
require "logic.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $post_id = $_POST['post_id'];
    $action = $_POST['action']; // 'approve' or 'reject'

    // Update the status of the post in the database
    if ($action === 'approve') {
        $status = 'approved';
    } elseif ($action === 'reject') {
        $status = 'rejected';
    }

    // Update the status of the post in the database
    $update_query = "UPDATE posts SET status='$status' WHERE post_id='$post_id'";
    mysqli_query($conn, $update_query);
}

// Fetch posts from the database with status 'pending' and 'unapproved'
$query_pending = "SELECT post_id, user_id, post FROM posts WHERE status='pending' OR status='rejected'";
$result_pending = mysqli_query($conn, $query_pending);

// Fetch approved posts from the database
$query_approved = "SELECT post_id, user_id, post FROM posts WHERE status='approved'";
$result_approved = mysqli_query($conn, $query_approved);

$query_rejected = "SELECT post_id, user_id, post FROM posts WHERE status='rejected'";
$result_rejected = mysqli_query($conn, $query_rejected);


// Close database connection
mysqli_close($conn);
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



    <section class="dashboard">
    <div class="container dashboard_container">
        <aside>
                <li>
                    <a href="dashboard.php" class="active"><i class="uil uil-file-check-alt"></i>
                    <h4>Verify Stories</h4>
                    </a>
                </li>
            </ul>
        </aside>
        <main>
            <h2>Verify Posts</h2>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Post</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        // Display pending and unapproved posts
                        while ($row = mysqli_fetch_assoc($result_pending)) : 
                    ?>
                        <tr>
                            <td><?= $row['user_id'] ?></td>
                            <td><?= $row['post'] ?></td>
                            <td>
                                <form action="dashboard.php" method="post">
                                    <input type="hidden" name="post_id" value="<?= $row['post_id'] ?>">
                                    <button type="submit" name="action" class="btn sm" value="approve">Approve</button>
                                    <button type="submit" name="action" class="btn sm danger" value="reject">Reject</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
            
                    <?php 
                                            // Display approved posts
                                            while ($row = mysqli_fetch_assoc($result_approved)) : 
                                        ?>
                                            <tr>
                                                <td><?= $row['user_id'] ?></td>
                                                <td><?= $row['post'] ?></td>
                                                <td>Approved</td>
                                            </tr>
                    <?php endwhile; ?>

                    <?php 
                                            // Display rejected posts
                                            while ($row = mysqli_fetch_assoc($result_rejected)) : 
                                        ?>
                                            <tr>
                                                <td><?= $row['user_id'] ?></td>
                                                <td><?= $row['post'] ?></td>
                                                <td>Rejected</td>
                                            </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
</body>
</html>