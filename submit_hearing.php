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
$case_id = $conn->real_escape_string($_POST['case_id'] ?? null);
$hearing_date = $conn->real_escape_string($_POST['hearing_date'] ?? null);
$court_name = $conn->real_escape_string($_POST['court_name'] ?? '');
$judge_name = $conn->real_escape_string($_POST['judge_name'] ?? '');
$outcome = $conn->real_escape_string($_POST['outcome'] ?? '');

// Insert into DB
$sql = "INSERT INTO hearing (case_id, hearing_date, court_name, judge_name, outcome)
        VALUES ('$case_id', '$hearing_date', '$court_name', '$judge_name', '$outcome')";

if ($conn->query($sql) === TRUE) {
    echo "<h3 style='color: green; text-align: center;'>Hearing scheduled successfully!</h3>";
} else {
    echo "<h3 style='color: red; text-align: center;'>Error: " . $conn->error . "</h3>";
}

$conn->close();
?>