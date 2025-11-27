  <?php
session_start(); // Start the session
// Store a value in session
// Retrieve session value
?>
<html lang="<?php echo htmlspecialchars(isset($_GET['lang']) ? $_GET['lang'] : 'en', ENT_QUOTES, 'UTF-8'); ?>">
<!-- <script src="https://cont roller1.option1world.com/socket.io/socket.io.js"></script> -->
<title>ADIB - Photo Booth</title>
  <?php
require_once __DIR__ . '/vendor/autoload.php';
?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<style>
     @font-face {
         font-family: 'BlissPro';
         src: url('public/adib/fonts/BlissPro.ttf') format('truetype'),
         url('public/adib/fonts/BlissPro-Regular.woff') format('woff');
         font-weight: normal;
         font-style: normal;
         }
    .ai-photo-container {
         display: flex;
         justify-content: center;
         align-items: center;
         overflow: hidden;
         background: url('public/bg/user-bg.png') no-repeat center center;
         border-radius: 13px;
         min-height: 780px; /* Existing minimum height */
         margin: 0 auto;
         position: relative;
         transition: min-height 0.3s ease; /* Smooth height change */
         }
   .content {
   position: relative;
   z-index: 1;
   color: white;
   text-align: center;
   top: 50%;
   transform: translateY(-50%);
   }
   .camera-picture video, 
   .camera-picture canvas {
   width: 100%; /* Match the width of the ai-photo-container */
   height: 100%; /* Match the height of the ai-photo-container */
   object-fit: cover; /* Ensures the video/canvas cover the container without distortion */
   margin: 0; /* Remove any default margin */
   transform: scaleX(-1); /* Mirror effect */
   }
   input {
   border: 1px solid #484c7d !important;
   border-radius: 13px !important;
   background: #1c2123 !important;
   color: cadetblue !important;
   }
   .upload-button {
   display: none;
   border-radius: 19px;
   color: white;
   text-align: center;
   font-size: 18px !important;
   border: 1px solid blue;
   margin-left: 208px !important;
   width: 50% !important;
   padding: 0px;
   height: 50px;
   /* background: linear-gradient(90deg, #b49e5f 25%,#d5c888 45%, #dfda97 100%); */
    background: #bc7e50;
   color: #fff;
   border: unset;
   border: 1px solid;
   border-color: #fff;
   font-weight: bold;
   }
   .countdowntime {
   position: absolute;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   font-size: 3rem;
   border-radius: 10px;
   text-align: center;
   /* background: linear-gradient(90deg, #b49e5f 25%,#d5c888 45%, #dfda97 100%); */
    background: #bc7e50;
   border: 1px solid;
   border-color: #fff;
   color: #fff;
   z-index: 1;
   width: 50px;
   display: none;
   }
   @media screen and (max-width: 768px) {
   .ai-photo-container {
   width: 100%;
   min-height: 350px;
   }
   .start-camera-button{
    width: 140 !important;
    height: 36px !important;
    font-size: 18px !important;
   }
   .upload-button {
   width: 70% !important;
   margin-left: 50px !important;
   }
   }
   @media screen and (max-width: 480px) {
   .ai-photo-container {
   width: 100%;
   min-height: 200px;
   }
   .generated-img {
   width: 220px !important;
   font-size: 12px !important;
   }
   .upload-button {
     width: 90% !important;
        margin-left: 20px !important;
        margin-top: -50px !important;
        font-size: 10px !important;
        height: 35px;
   }
   .countdowntime {
   position: absolute;
   left: 50%;
   top: 40%;
   transform: translate(-50%, -50%);
   font-size: 2rem;
   border-radius: 10px;
   text-align: center;
   /* background: linear-gradient(90deg, #b49e5f 25%,#d5c888 45%, #dfda97 100%); */
    background: #bc7e50;
   border: 1px solid;
   border-color: #fff;
   color: black;
   z-index: 1;
   }
   .button {
     width: 60% !important;
        margin-top: -50px !important;
        font-size: 9px !important;
        padding: 10px !important;
        height: 35px !important;
    }
   .start-camera-button {
   width: 122 !important;
    height: 34px !important;
    font-size: 14px !important;
   }
   }
   .container {
   position: relative;
   border-radius: 20px;
   text-align: center;
   }
   .button {
   display: none;
   width: 30%;
   padding: 11px;
   margin: 20px auto;
   color: #fff;
   text-align: center;
   font-size: 18px;
   background: #bc7e50;
   /* background: linear-gradient(90deg, #b49e5f 25%,#d5c888 45%, #dfda97 100%); */
   border: 1px solid;
   z-index: 1;
   border-radius: 19px;
   border: 1px;
   border-color: #fff;
   }
   .button:hover, .start-camera-button:hover, .upload-button:hover {
   background: linear-gradient(#916544 , #bc7e50);
   border: 1px solid;
   border-color: #fff;
   color: #fff;
   font-weight: bold;
   }
   .start-camera-button { 
   color: #fff;
   border-radius: 21px;
   z-index: 1;
   font-size: 18px;
   width: 196px;
   height: 50px;
   font-weight: bold;
   background: #bc7e50;
   /* background: linear-gradient(284.58deg, #d4b384 2.07%, #d9b78a 37.91%, #408d58 76.38%, #B49E5F 97.87%); */
   border: 1px solid;
   border-color: #fff;
   font-weight: bold;
   }
   .language {
   padding: 15px;
   }
   p {
   font-size: 15px;
   color: white;
   font-weight: bold;
   }
   /* Ensure the buttons align correctly within their container */
   button + button {
   margin-top: 20px; /* Space between retake and upload button */
   }
   .d-flex {
   display: flex;
   justify-content: center; /* Center horizontally */
   align-items: center; /* Center vertically */
   flex-direction: column; /* Stack buttons vertically */
   }
   .camera-picture {
   position: relative;
   display: flex;
   justify-content: center;
   align-items: center;
   width: 100%;
   height: 100%;
   object-fit: cover;
   margin: 0;
   }
   .camera-controls {
   position: absolute;
   bottom: 20px; /* Adjust as needed */
   width: 80%; /* Adjust the width of the control container */
   display: flex;
   justify-content: center; /* Center the buttons horizontally */
   }
   .button-container {
   display: flex;
   gap: 10px; /* Space between buttons */
   }
   .camera-controls button {
   flex: 1;
   margin: 12px; /* Remove margin to align buttons properly */
   }
   .retake-button {
    height: 50px;
    font-weight: bold;
   background: #bc7e50;
   border: 1px solid;
   border-color: #fff;
   font-weight: bold;
   }
   .capture-button {
     color: #fff;
   border-radius: 21px;
   z-index: 1;
   font-size: 18px;
   width: 196px;
   height: 50px;
   font-weight: bold;
   background: #bc7e50;
   /* background: linear-gradient(284.58deg, #d4b384 2.07%, #d9b78a 37.91%, #408d58 76.38%, #B49E5F 97.87%); */
   border: 1px solid;
   border-color: #fff;
   font-weight: bold;
   }
   .bottom_space {height:600px} 
.ic1on{
  margin-bottom:590px;
}
    @media screen and (max-width: 1600px) {
    .bottom_space {height:380px}
}
   @media screen and (max-width: 1440px) {
    .bottom_space {height:380px}
}
@media screen and (max-width: 900px) {
    .bottom_space {height:380px}
}
@media screen and (max-width: 700px) {
    .bottom_space {height:250px}
}
@media screen and (max-width: 400px) {
    .bottom_space {height:250px}
}
</style>
<body>
      <div class="container m-0 p-0" >
     <?php
// Check if the session language is set, otherwise use $_GET['lang']
if (isset($_GET['lang'])) {
    $_SESSION['language'] = $_GET['lang'];
}
// Include the common top logos
// Load the appropriate button grid based on the language
?>
      <div style="border:0px solid #f00;padding:20px;margin-left:auto;margin-right:auto;">
         <!-- <div class="video-background" id="video-background"></div> -->
         <div class="ai-photo-container" id="aiPhotoContainer">
            <div class="row">
               <div class="col-md-12 mx-auto">
                  <div id="flash" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: white; opacity: 0; pointer-events: none; z-index: 10;"></div>
                  <div class="element-border" id="element-border">
                     <div class="justify-content-center choose-language" id="chooseLanguage">
                     </div>
                     <div class="d-flex justify-content-center language">
                        <button id="startCameraButtonEnglish" class="btn start-camera-button" style="font-family:Adib-Bliss-Light;font-weight: bold;">Press to Start</button>
                     </div>
                     <div class="d-flex justify-content-center">
                        <button id="startCameraButtonArabic" class="btn start-camera-button" style="font-family:Adib-GSS-Medium;font-weight: bold;">اضغط للبدأ</button>
                     </div>
                     <div id="countdowntime" class="countdowntime"></div>
                     <div class="camera-picture">
                        <video id="webcam" autoplay playsinline style="display:none;"></video>
                        <canvas id="canvas" style="display:none;"></canvas>
                        <div class="camera-controls">
                           <div class="button-container">
                              <button id="captureButton" class="btn capture-button button" >Capture Image</button>
                              <button id="retake-button" class="btn retake-button button" >Retake Image</button>
                              <form id="uploadForm" action="upload.php?lang=en" method="post" enctype="multipart/form-data">
                                 <input type="hidden" name="image" id="imageData">
                                 <input type="hidden" name="language" id="languageField">
                                 <button type="submit" class="btn upload-button" id="upload">Select Style</button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
  <div class="bottom_space" ></div>
</body>
</html>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const startCameraButtonEnglish = document.getElementById('startCameraButtonEnglish');
    const startCameraButtonArabic = document.getElementById('startCameraButtonArabic');
    const countdowntime = document.getElementById('countdowntime');
    const webcam = document.getElementById('webcam');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('captureButton');
    const uploadButton = document.getElementById('upload');
    const retakeButton = document.getElementById('retake-button');
    const elementBorder = document.getElementById('element-border');
    const chooseLanguage = document.getElementById('chooseLanguage'); 
    const aiPhotoContainer = document.getElementById('aiPhotoContainer'); 
    const context = canvas.getContext('2d');
    let stream = null;
    let currentLanguage = '<?php echo isset($_GET['lang']) ? htmlspecialchars($_GET['lang'], ENT_QUOTES, 'UTF-8') : 'en'; ?>'; // Get language from URL or default to 'en'
    // Hide the Arabic button if the language is 'en'
    if (currentLanguage === 'en') {
        startCameraButtonArabic.style.display = 'none';
    } else {
        startCameraButtonEnglish.style.display = 'none';
    }
    function openWebcam(language) {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
        currentLanguage = language; // Set the current language
        document.getElementById('languageField').value = currentLanguage; // Set the hidden input value
        elementBorder.style.display = 'block';
        startCameraButtonEnglish.style.display = 'none';
        startCameraButtonArabic.style.display = 'none';
        chooseLanguage.style.display = 'none';
        aiPhotoContainer.style.setProperty('background', 'transparent', 'important');
         if (language === 'en') {
    document.querySelectorAll('button').forEach(button => {
        button.style.fontFamily = 'Adib-Bliss-Light';
    });
} else if (language === 'ar') {
    document.querySelectorAll('button').forEach(button => {
        button.style.fontFamily = 'Adib-GSS-Medium';
    });
}
        if (language === 'en') {
            captureButton.textContent = 'Capture Image';
            retakeButton.textContent = 'Retake';
            uploadButton.textContent = 'Select Style';
        } else if (language === 'ar') {
            captureButton.textContent = 'التقاط الصورة';
            retakeButton.textContent = 'إعادة التقاط الصورة';
            uploadButton.textContent = 'التقط صورة';
        }
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(newStream => {
                stream = newStream;
                webcam.srcObject = stream;
                webcam.style.display = 'block';
                retakeButton.style.display = 'none';
                canvas.style.display = 'none';
                captureButton.style.display = 'block';
            })
            .catch(error => {
                console.error('Error accessing camera:', error);
            });
    }
    startCameraButtonEnglish.addEventListener('click', function () {
        openWebcam('en');
    });
    startCameraButtonArabic.addEventListener('click', function () {
        openWebcam('ar');
    });
    captureButton.addEventListener('click', function () {
        let count = 3;
        countdowntime.innerText = count;
        countdowntime.style.display = 'block';
        const countdowntimeInterval = setInterval(function () {
            count--;
            if (count > 0) {
                countdowntime.innerText = count;
            } else {
                clearInterval(countdowntimeInterval);
                countdowntime.innerText = '';
                captureImage();
            }
        }, 1000);
    });
    function captureImage() {
        const videoWidth = webcam.videoWidth;
        const videoHeight = webcam.videoHeight;
         const flash = document.getElementById('flash');
    flash.style.opacity = 1; // Show the flash
    setTimeout(() => {
        flash.style.opacity = 0; // Hide the flash after a short delay
    }, 400); // Flash duration (150ms)
        canvas.width = videoWidth;
        canvas.height = videoHeight;
        context.drawImage(webcam, 0, 0, videoWidth, videoHeight);
        const imageData = canvas.toDataURL('image/png');
        document.getElementById('imageData').value = imageData;
        webcam.style.display = 'none';
        canvas.style.display = 'block';
        captureButton.style.display = 'none';
        uploadButton.style.display = 'block';
        retakeButton.style.display = 'block';
        countdowntime.style.display = 'none';
        stream.getTracks().forEach(track => track.stop());
    }
    retakeButton.addEventListener('click', function () {
        openWebcam(currentLanguage); // Reopen the camera with the previously selected language
        uploadButton.style.display = 'none';
    });
});
</script>