<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['image'])) {
        // Base64 encoded image string
        $encodedImage = $_POST['image'];
        // Remove the data URI prefix
        $encodedImage = str_replace('data:image/png;base64,', '', $encodedImage);
        $encodedImage = str_replace(' ', '+', $encodedImage);
        // Decode base64 string
        $imageData = base64_decode($encodedImage);
        // New file name
        $newName = time() . "-ai-user.png";
        // Public URL path (Adjust domain if required)
        $filepath = "public/users/" . $newName;
        // Server path (make sure this path is correct)
        $filePath = __DIR__ . '/public/users/' . $newName;
        // Save image
        file_put_contents($filePath, $imageData);
        // Read language from session
        $language = isset($_SESSION['language']) ? $_SESSION['language'] : '';
        // Set session flash messages
        $_SESSION['message']      = "Created Successfully!";
        $_SESSION['alert-class']  = "alert-success";
        $_SESSION['orginalPath']  = $filepath;
        $_SESSION['language']     = $language;
        // Redirect to user dashboard
        header("Location: user_dashboard.php");
        exit;
    } else {
        echo "Something went wrong";
        header("Location: user.php");
        exit;
    }
} else {
    echo "Invalid request";
    exit;
}
?>
