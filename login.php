<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Email and password are required!";
        exit();
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo "No user found with this email!";
        exit();
    }

    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        echo "Login successful!";
    } else {
        echo "Incorrect password!";
    }

} else {
    echo "Invalid request method.";
}

$conn->close();
?>
