<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'book';

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass);
// Check connection
if ($conn->connect_error) {
    die('Could not connect: ' . $conn->connect_error);
}
echo 'Connected successfully';

// Create database
$sql1 = 'CREATE DATABASE IF NOT EXISTS ' . $dbname;
if ($conn->query($sql1) === TRUE) {
    echo "Database $dbname created successfully\n";
} else {
    die('Could not create database: ' . $conn->error);
}

// Select database
$conn->select_db($dbname);

// Create table
$sql2 = 'CREATE TABLE IF NOT EXISTS appointments (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    contact VARCHAR(15) NOT NULL,
    date VARCHAR(100) NOT NULL,
    gender VARCHAR(50) NOT NULL
)';
if ($conn->query($sql2) === TRUE) {
    echo "Table created successfully\n";
} else {
    die('Could not create table: ' . $conn->error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['i1'];
    $contact = $_POST['i3'];
    $email = $_POST['i4'];
    $date = $_POST['i5'];
    $gender = isset($_POST['i6']) ? $_POST['i6'] : '';

    

    // Insert data into appointments table
    $sql = "INSERT INTO appointments (name, contact, email, date, gender)
            VALUES ('$name', '$contact', '$email', '$date', '$gender')";

    

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
