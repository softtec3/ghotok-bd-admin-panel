<?php
require_once("is_logged_in.php");
require_once("db_connect.php");
try {
    if (isset($_GET["delete_user"]) && $_GET["delete_user"] != "") {
        $delete_user_id = $_GET["delete_user"] ?? null;
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");
        if (!$stmt) {
            throw new Exception("SQL failed: " . $conn->error);
        }
        $stmt->bind_param("s", $delete_user_id);
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
} catch (Exception $e) {
    $msg_error = $e->getMessage();
    echo "
        <script>
            console.log('$msg_error');
        </script>
    ";
}
