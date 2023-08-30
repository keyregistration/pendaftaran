<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pendaftaran";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $keySelection = $_POST['keySelection'];
    $purpose = $_POST["purpose"];
    $timeStart = $_POST['timeStart'];
    $timeFinish = $_POST['timeFinish'];
    $date = $_POST["date"];

    $sql = "INSERT INTO registrations (name, key_selection, purpose, time_start, time_finish, date) 
    VALUES ('$name', '$keySelection', '$purpose', '$timeStart', '$timeFinish', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo "Submission successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
