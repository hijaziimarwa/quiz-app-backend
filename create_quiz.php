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
    $quiz_name = $_POST['quiz_name'];
    $created_by = $_POST['created_by'];  

    if (empty($quiz_name) || empty($created_by)) {
        echo "Quiz name and creator are required!";
        exit();
    }

    $sql = "INSERT INTO quizzes (quiz_name, created_by) 
            VALUES ('$quiz_name', '$created_by')";

    if ($conn->query($sql) === TRUE) {
        echo "Quiz created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else {
    echo "Invalid request method.";
}

$conn->close();
?>
