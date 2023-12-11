<?php
session_start();
include 'connect.php'; // Include your database connection file

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials (you may need to adjust this based on your authentication mechanism)
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Authentication successful
        $_SESSION['username'] = $username;
        header('Location: home.php');
        exit;
    } else {
        // Authentication failed
        echo "Invalid username or password";
    }
}
?>
