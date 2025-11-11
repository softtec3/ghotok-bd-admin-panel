<?php
require_once("is_logged_in.php");
require_once("db_connect.php"); //delete after checking
$all_users = [];

try {
    $stmt = $conn->prepare("SELECT * FROM biodatas ORDER BY id DESC");
    if (!$stmt) {
        throw new Exception("SQL failed: " . $conn->error);
    }
    if (!$stmt->execute()) {
        throw new Exception("Execution failed: " . $stmt->error);
    }
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $all_users[] = $row;
        }
    }
} catch (Exception $e) {
    $msg_error = $e->getMessage();
    echo "<script>
    console.log('$msg_error')
    </script>";
}
