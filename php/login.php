<?php

$servername = "localhost";
$username = "noah";
$password = "2020";
$dbname = "projectDB";

$conn = new mysqli($servername, $username, $password, $dbname);
error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["name"];
    $password = $_POST["password"];

    $sql = "SELECT password FROM form WHERE name = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPasswordFromDatabase = $row["password"];
        header('Content-Type: application/json; charset=utf-8');


        if (password_verify($password, $hashedPasswordFromDatabase)) {
            echo json_encode(["status" => "success", "message" => "Login successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid username or password. Please try again."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid username or password. Please try again."]);
    }
}

$conn->close();
?>
