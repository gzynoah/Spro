<?php
$servername = "localhost";
$username = "noah";
$password = "2020";
$dbname = "projectDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all data from the database
$sql = "SELECT * FROM content";
$result = $conn->query($sql);

$data = array(); // Initialize an array to store the results

while ($row = $result->fetch_assoc()) {
    $data[] = array(
        'id' => $row['id'],
        'img_src' => $row['img_src'],
        'alt_text' => $row['alt_text'],
        'name' => $row['name'],
        'type' => $row['type'],
        'price' => $row['price']
    );
}

// Close the database connection
$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
