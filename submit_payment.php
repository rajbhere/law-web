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
$case_id = $conn->real_escape_string($_POST['case_id'] ?? null);
$amount = $conn->real_escape_string($_POST['amount'] ?? '');
$payment_date = $conn->real_escape_string($_POST['payment_date'] ?? null);
$payment_mode = $conn->real_escape_string($_POST['payment_mode'] ?? '');
$status = $conn->real_escape_string($_POST['status'] ?? '');

// Insert into DB
$sql = "INSERT INTO payment (client_id, case_id, amount, payment_date, payment_mode, status)
        VALUES ('$client_id', '$case_id', '$amount', '$payment_date', '$payment_mode', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "<h3 style='color: green; text-align: center;'>Payment recorded successfully!</h3>";
} else {
    echo "<h3 style='color: red; text-align: center;'>Error: " . $conn->error . "</h3>";
}

$conn->close();
?>