<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pasarutpreg";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the email of the logged-in user from the session
$email = $_SESSION['email'];

// Prepare and execute query to fetch user data
$sql = "SELECT * FROM info WHERE email = '$email'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Check if the query returned any results
    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();

        // Close the database connection
        $conn->close();
    } else {
        // No user found, handle accordingly
        $conn->close();
        die("No user found");
    }
} else {
    // Query execution failed, handle accordingly
    $conn->close();
    die("Query execution failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<!-- Navigation -->
<nav>
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="login.html">Logout</a></li>
        <!--nanti letak logout.html-->
    </ul>
</nav>

<!-- Profile Section -->
<section class="profile">
    <div class="container">
        <div class="profile-info">
            <h1>Welcome, <?php echo $row['email']; ?></h1>
            <div class="profile-details">
                <img src="profile.jpg" alt="User Profile Picture">
                <div class="details">
                    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                    <!-- Add more fields here as needed -->
                </div>
            </div>
            <div class="bio">
                <h2>Bio</h2>
                <p>put text here.</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <p>&copy; 2024 Pasar UTP. All rights reserved.</p>
    </div>
</footer>

<!-- Custom JavaScript -->
<script src="index.js"></script>
</body>
</html>
