<?php
// Database credentials
$host = "localhost";
$user = "root";
$password = "";
$database = "portfolio"; // Your DB name

// Connect to MySQL
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data safely
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);

// Insert into DB
$sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
  echo "Message sent successfully!";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
