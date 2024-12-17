<?php
include 'connect.php'; // Include database connection

// Password to be hashed
$password = "admin_password";

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert data into the users table
$email = "admin@example.com";
$username = "Admin";

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to insert data
$sql = "INSERT INTO users (email, password, username, is_admin) VALUES ('$email', '$hashedPassword', '$username', 1)";

// Perform the query
if (mysqli_query($conn, $sql)) {
    echo "Admin data inserted successfully";
} else {
    var_dump($ERROR);
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>