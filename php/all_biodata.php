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
        // get connects
        foreach ($all_users as $idx => $user) {
            $user_id = trim($user["user_id"]) ?? null;
            $stmt2 = $conn->prepare("SELECT connects FROM users WHERE user_id=?");
            if (!$stmt2) {
                throw new Exception("SQL failed users: " . $conn->error);
            }
            $stmt2->bind_param("s", $user_id);
            if (!$stmt2->execute()) {
                throw new Exception("Failed to fetch: " . $stmt2->error);
            }
            $result2 = $stmt2->get_result();
            if ($result2 && $result2->num_rows > 0) {
                $target_user = $result2->fetch_assoc();
                $target_user_connects = $target_user["connects"];
                $all_users[$idx]["connects"] = $target_user_connects;
            }
        }
    }
} catch (mysqli_sql_exception $e) {
    $msg_error = $e->getMessage();
    echo "<script>
   console.log(\"$msg_error\");
    </script>";
}
