<?php
session_start();
// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read POST values
    $captured_image = $_POST["user_image"] ?? null;
    $language       = $_POST["language"] ?? '';
    $prompt         = $_POST["prompt"] ?? '';
    // Map prompts to long descriptions
    if ($prompt == "Pearl Diver") {
        $prompt = "A diver wearing a complete, traditional-style diving suit swims gracefully underwater, surrounded by a vibrant coral reef...";
    }
    if ($prompt == "Bedouin Elder") {
        $prompt = "An elderly Bedouin woman sits proudly in the vast UAE desert...";
    }
    if ($prompt == "Astronaut") {
        $prompt = "An Emirati astronaut in a sleek, futuristic spacesuit stands on the surface of an alien moon...";
    }
    if ($prompt == "Futuristic Emirati Citizen") {
        $prompt = "A futuristic Emirati man and woman walking through a technologically advanced version of the UAE...";
    }
    if ($prompt == "Traditional Emirati Warrior") {
        $prompt = "A proud Emirati warrior stands tall in the vast desert...";
    }
    if ($prompt == "AI Falcon Trainer") {
        $prompt = "A futuristic falcon trainer standing in a desert with a falcon perched clearly on his gloved hand...";
    }
    // Prepare API payload
    $payload = [
        "key" => "25cuffKMgltL0AxyCmP9zAb6GUInDWzhPZt2ZJJVy7Y4iyNn7LYqCEzmDo8n",
        "prompt" => $prompt,
        "negative_prompt" => "flag, logo, banner, insignia, symbol, green cloth, anime...",
        "face_image" => "https://i.ibb.co/8LM5v87w/male.jpg",
        "width" => "512",
        "height" => "512",
        "samples" => "1",
        "num_inference_steps" => "41",
        "safety_checker" => true,
        "safety_checker_type" => "blur",
        "base64" => false,
        "seed" => null,
        "guidance_scale" => 7.5,
        "webhook" => null,
        "track_id" => null,
    ];
    // Make cURL request
    $ch = curl_init("https://modelslab.com/api/v6/image_editing/head_shot");
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 100,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_HTTPHEADER => ["Content-Type: application/json"]
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    if ($response === false) {
        die("API request failed.");
    }
    $result = json_decode($response);
    if (!$result || empty($result->future_links[0])) {
        die("Invalid API response.");
    }
    $url = $result->future_links[0]; // AI image URL
    // ------------------------------------
    //      Generate QR Code
    // ------------------------------------
    require_once __DIR__ . '/vendor/autoload.php';
    $qrText = $url;
    $qrCode = new \Endroid\QrCode\QrCode($qrText);
    $qrCode->setSize(300);
    $qrCode->setMargin(10);
    $writer = new \Endroid\QrCode\Writer\PngWriter();
    $qrImage = $writer->write($qrCode);
    // Save QR code
    $filename = time() . '-ai-generated-qrcode.png';
    $savePath = __DIR__ . '/public/qr-codes/' . $filename;
    $qrImage->saveToFile($savePath);
    // Public URL to QR
    $relativePath = "/public/qr-codes/" . $filename;
    // ------------------------------------
    //        WAIT FOR IMAGE + SAVE
    // ------------------------------------
  // ------------------------------------
//        WAIT FOR IMAGE + SAVE
// ------------------------------------
while (true) {
    $headers = @get_headers($url);
    if ($headers && strpos($headers[0], '200') !== false) {
        // Download final generated image
        $imageData = file_get_contents($url);
        // Create folder if not exists
        $saveFolder = __DIR__ . "/public/ai_results/";
        if (!is_dir($saveFolder)) {
            mkdir($saveFolder, 0777, true);
        }
        // Create filename
        $newImageName = time() . "-ai-generated.png";
        $localImagePath = $saveFolder . $newImageName;
        // Save image
        file_put_contents($localImagePath, $imageData);
        // Public path
        $publicGeneratedImage = "/public/ai_results/" . $newImageName;
        // Save session data
        $_SESSION["message"]         = "Generated Successfully!";
        $_SESSION["alert-class"]     = "alert-success";
        $_SESSION["generated_path"]  = $publicGeneratedImage;
        $_SESSION["orginalPath"]  = $captured_image;
        $_SESSION["qr_code_path"]    = $relativePath;
        $_SESSION["language"]        = $language;
        // Redirect safely (no echo before this)
        header("Location: ai-image-result.php");
        exit;
    }
    // DO NOT ECHO ANYTHING — prevents header errors
    sleep(5);
}
}
// Invalid request
echo "Invalid request";
exit;
?>
