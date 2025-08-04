<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "law_firm");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("This script only accepts POST requests.");
}

// Collecting form data safely
$client_id = $conn->real_escape_string($_POST['client_id'] ?? null);
$lawyer_id = $conn->real_escape_string($_POST['lawyer_id'] ?? null);
$title = $conn->real_escape_string($_POST['title'] ?? '');
$case_type = $conn->real_escape_string($_POST['case_type'] ?? '');
$description = $conn->real_escape_string($_POST['description'] ?? '');
$status = $conn->real_escape_string($_POST['status'] ?? '');
$start_date = $conn->real_escape_string($_POST['start_date'] ?? null);
$end_date = $conn->real_escape_string($_POST['end_date'] ?? null);

// Insert into DB
$sql = "INSERT INTO cases (client_id, lawyer_id, title, case_type, description, status, start_date, end_date) 
        VALUES ('$client_id', '$lawyer_id', '$title', '$case_type', '$description', '$status', '$start_date', '$end_date')";

if ($conn->query($sql) === TRUE) {
    echo "<h3 style='color: green; text-align: center;'>Case registered successfully!</h3>";
} else {
    echo "<h3 style='color: red; text-align: center;'>Error: " . $conn->error . "</h3>";
}

$conn->close();
?>