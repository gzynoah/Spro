<?php

$servername = "localhost";
$username = "noah";
$password = "2020";
$dbname = "projectDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["name"];
    $password = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM form WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPasswordFromDatabase);
        $stmt->fetch();
        header('Content-Type: application/json; charset=utf-8');

        if (password_verify($password, $hashedPasswordFromDatabase)) {
            echo json_encode(["status" => "success", "message" => "Login successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid username or password. Please try again."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid username or password. Please try again."]);
    }

    $stmt->close();
}

$conn->close();
?>
