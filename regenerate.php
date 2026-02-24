<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['user_image'])) {
        $captured_image = $_POST['user_image'];
        $language       = $_POST['language'];
        // Set session values (flashdata equivalent)
        $_SESSION['orginalPath'] = $captured_image;
        $_SESSION['language']    = $language;
        // Redirect to user_dashboard.php
        header("Location: user_dashboard.php");
        exit;
    } else {
        echo "Something went wrong";
        exit;
    }
}
?>
