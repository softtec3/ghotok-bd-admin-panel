<?php
require_once("./db_connect.php");

try {
    // admin users table
    $stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS admin_users(
	id int PRIMARY KEY AUTO_INCREMENT,
    user_id varchar(100) NOT NULL,
    password varchar(50) NOT NULL,
    role varchar(20) DEFAULT 'admin',
    created_at timestamp DEFAULT CURRENT_TIMESTAMP
    )");
    if (!$stmt) {
        throw new Exception("SQL failed: " . $conn->error);
    }
    if (!$stmt->execute()) {
        throw new Exception("Table creation failed: " . $stmt->error);
    }
    echo "admin_users table successfully created";
    echo "<br/>";
    // advertisements table
    $stmt2 = $conn->prepare("CREATE TABLE IF NOT EXISTS advertisements(
	id int AUTO_INCREMENT PRIMARY KEY,
    ad_title TEXT DEFAULT NULL,
    ad_link TEXT DEFAULT NULL,
    ad_image TEXT NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at timestamp DEFAULT CURRENT_TIMESTAMP
    )");
    if (!$stmt2) {
        throw new Exception("SQL failed: " . $conn->error);
    }
    if (!$stmt2->execute()) {
        throw new Exception("Table creation failed: " . $stmt2->error);
    }
    echo "advertisements table successfully created";
} catch (Exception $e) {
    echo $e->getMessage();
}
