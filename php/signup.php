<?php

$servername = "localhost";
$username = "noah";
$password = "2020";
$dbname = "projectDB";

$conn = new mysqli($servername, $username, $password, $dbname);
error_reporting(E_ALL);
ini_set('display_errors', '1');

header('Content-Type: application/json; charset=utf-8');

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email = $_POST["email"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email format. Please enter a valid email."]);
        exit;
    }

    // Check if the email or name or phone number already exists
    $checkDuplicateSql = "SELECT * FROM form WHERE email = '$email' OR name = '$name' OR phone = '$phone'";
    $duplicateResult = $conn->query($checkDuplicateSql);

    if ($duplicateResult->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Email, name, or phone number already exists. Please choose different credentials."]);
    } else {
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO form (email, name, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $name, $phone, $password);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Sign up successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
        }

        $stmt->close();
    }
}

$conn->close();
?>
