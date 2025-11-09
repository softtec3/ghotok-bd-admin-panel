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
} catch (Exception $e) {
    echo $e->getMessage();
}
