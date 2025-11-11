<?php
require_once("is_logged_in.php");
require_once("db_connect.php");
$target_bio = [];
try {
    if (isset($_GET["view"]) && !empty($_GET["view"])) {
        $target_id = $_GET["view"] ?? "";
        $filtered_bio = array_filter($all_users, function ($user) use ($target_id) {
            return $user["user_id"] == $target_id;
        });
        $target_bio = array_values($filtered_bio)[0];
    }
} catch (Exception $e) {
    $msg_error = $e->getMessage();
    echo "
        <script>
            console.log(\"$msg_error\");
        </script>
    ";
}
