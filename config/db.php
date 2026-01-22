<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "real_estate_management_system";

// Connect to MySQL
$conn = mysqli_connect($host, $user, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
mysqli_select_db($conn, $dbName);

// Create admin table if not exists
$tableSql = "CREATE TABLE IF NOT EXISTS admin (
    admin_id VARCHAR(15) NOT NULL,
    name VARCHAR(15) NOT NULL,
    password VARCHAR(15) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    security_answer VARCHAR(15) NOT NULL
)";
if ($conn->query($tableSql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}

// Create user table if not exists
$userTableSql = "CREATE TABLE IF NOT EXISTS user (
    user_id VARCHAR(15) NOT NULL,
    name VARCHAR(15) NOT NULL,
    password VARCHAR(15) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    security_answer VARCHAR(15) NOT NULL
)";
if ($conn->query($userTableSql) !== TRUE) {
    die("Error creating user table: " . $conn->error);
}

// Create staff table if not exists
$staffTableSql = "CREATE TABLE IF NOT EXISTS staff (
    staff_id VARCHAR(15) NOT NULL,
    name VARCHAR(15) NOT NULL,
    password VARCHAR(15) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    security_answer VARCHAR(15) NOT NULL
)";
if ($conn->query($staffTableSql) !== TRUE) {
    die("Error creating staff table: " . $conn->error);
}

// Create property_owner table if not exists
$ownerTableSql = "CREATE TABLE IF NOT EXISTS property_owner (
    property_owner_id VARCHAR(15) NOT NULL,
    name VARCHAR(15) NOT NULL,
    password VARCHAR(15) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    security_answer VARCHAR(15) NOT NULL
)";
if ($conn->query($ownerTableSql) !== TRUE) {
    die("Error creating property_owner table: " . $conn->error);
}
?>
