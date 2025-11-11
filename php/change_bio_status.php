<?php
require_once("is_logged_in.php");
require_once("db_connect.php");
try {
    // active
    if (isset($_GET["active_bio"]) && !empty($_GET["active_bio"])) {
        $active_bio_id = $_GET["active_bio"] ?? null;
        $status = "active";
        $stmt = $conn->prepare("UPDATE biodatas SET status=? WHERE user_id=?");
        if (!$stmt) {
            throw new Exception("SQL failed: " . $conn->error);
        }
        $stmt->bind_param("ss", $status, $active_bio_id);
        if (!$stmt->execute()) {
            throw new Exception("Execution failed: " . $stmt->error);
        }
        if ($stmt->affected_rows > 0) {
            header("Location: ./admin.php");
        } else {
            echo "<script>
                alert('Failed to delete');
            </script>";
        }
    }
    // inactive
    if (isset($_GET["inactive_bio"]) && !empty($_GET["inactive_bio"])) {
        $inactive_bio_id = $_GET["inactive_bio"] ?? null;
        $status = "inactive";
        $stmt2 = $conn->prepare("UPDATE biodatas SET status=? WHERE user_id=?");
        if (!$stmt2) {
            throw new Exception("SQL failed: " . $conn->error);
        }
        $stmt2->bind_param("ss", $status, $inactive_bio_id);
        if (!$stmt2->execute()) {
            throw new Exception("Execution failed: " . $stmt2->error);
        }
        if ($stmt2->affected_rows > 0) {
            header("Location: ./admin.php");
        } else {
            echo "<script>
                alert('Failed to delete');
            </script>";
        }
    }
} catch (Exception $e) {
    $msg_error = $e->getMessage();
    echo "
        <script>
           console.log(\"$msg_error\");
        </script>
    ";
}
