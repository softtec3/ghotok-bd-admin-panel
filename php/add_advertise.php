<?php
require_once("is_logged_in.php");
require_once("db_connect.php");
$success = "";
// upload file and get name
function upload_file_get_name($name)
{
    // Check if the file input exists and a file was uploaded
    if (isset($_FILES[$name]) && $_FILES[$name]['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "./uploads/";
        $fileName = basename($_FILES[$name]["name"]);
        $saved_file_name = "uploads/" . $fileName;
        $targetPath = $uploadDir . $fileName;

        // Move the uploaded file
        if (move_uploaded_file($_FILES[$name]["tmp_name"], $targetPath)) {
            return $saved_file_name;
        } else {
            // Failed to move file
            return null;
        }
    } else {
        // No file uploaded or some error occurred
        return null;
    }
}
try {
    if (isset($_POST["ad_title"]) && !empty($_POST["ad_title"])) {
        $success = "";
        $ad_title = $_POST["ad_title"] ?? "";
        $ad_link = $_POST["ad_link"] ?? "";
        $ad_image = upload_file_get_name("ad_image") ?? null;

        $stmt = $conn->prepare("INSERT INTO advertisements(ad_title, ad_link, ad_image) VALUES (?,?,?)");

        if (!$stmt) {
            throw new Exception("SQL failed: " . $conn->error);
        }
        $stmt->bind_param("sss", $ad_title, $ad_link, $ad_image);
        if (!$stmt->execute()) {
            throw new Exception("Failed to insert: " . $stmt->error);
        }
        if ($stmt->insert_id) {
            $success = "Successfully added";
            header("Location: ./admin.php");
        }
    }
} catch (Exception $e) {
    $msg_error = $e->getMessage();
    echo "<script>
    console.log('$msg_error');
    </script>";
}
