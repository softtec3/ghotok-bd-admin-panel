<?php
session_start();
require_once("./php/db_connect.php");
$error = "";
try {
    if (isset($_POST["user_id"])) {
        $user_id = $_POST["user_id"] ?? null;
        $password = $_POST["password"] ?? null;

        $stmt  = $conn->prepare("SELECT password, user_id FROM admin_users WHERE user_id=?");
        if (!$stmt) {
            throw new Exception("SQL failed: " . $conn->error);
        }
        $stmt->bind_param("s", $user_id);
        if (!$stmt->execute()) {
            throw new Exception("Failed to find: " . $stmt->error);
        }
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($user["password"] == $password) {
                $_SESSION["admin_id"] = $user["user_id"];
                header("Location: ./admin.php");
            } else {
                $error = "Password not matched";
            }
        } else {
            $error = "User id not found";
        }
    }
} catch (Exception $e) {
    $msg_error =  $e->getMessage();
    echo "<script>
        console.log('$msg_error');
    </script>";
}
