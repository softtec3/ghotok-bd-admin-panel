<?php
require_once("is_logged_in.php");
require_once("db_connect.php");
try {
    if (isset($_GET["ad_inactive"]) && !empty($_GET["ad_inactive"])) {
        $inactive_id = (int) $_GET["ad_inactive"] ?? 0;
        $inactive_status = "inactive";
        $stmt = $conn->prepare("UPDATE advertisements SET status=? WHERE id=?");
        if (!$stmt) {
            throw new Exception("SQL failed: " . $conn->error);
        }
        $stmt->bind_param("si", $inactive_status, $inactive_id);
        if (!$stmt->execute()) {
            throw new Exception("Failed to update: " . $stmt->error);
        }
        if ($stmt->affected_rows > 0) {
            header("Location: ./admin.php");
        }
    }
    if (isset($_GET["ad_active"]) && !empty($_GET["ad_active"])) {
        $active_status = "active";
        $active_id = $_GET["ad_active"] ?? 0;
        $stmt2 = $conn->prepare("UPDATE advertisements SET status=? WHERE id=?");
        if (!$stmt2) {
            throw new Exception("SQL failed: " . $conn->error);
        }
        $stmt2->bind_param("si", $active_status, $active_id);
        if (!$stmt2->execute()) {
            throw new Exception("Failed to update: " . $stmt2->error);
        }
        if ($stmt2->affected_rows > 0) {
            header("Location: ./admin.php");
        }
    }
} catch (Exception $e) {
    $msg_error = $e->getMessage();
    echo "<script>
    console.log('$msg_error');
    </script>";
}
