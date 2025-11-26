<title>ADIB - Photo Booth</title>
<?php
 if (session_status() === PHP_SESSION_NONE) {
       session_start();
        echo '<pre>'; print_r($_SESSION); 
      // exit;
   }
?>
<style>
   /* Existing CSS */
     @font-face {
         font-family: 'BlissPro';
         src: url('public/adib/fonts/BlissPro.ttf') format('truetype'),
         url('public/adib/fonts/BlissPro-Regular.woff') format('woff');
         font-weight: normal;
         font-style: normal;
         }
         @font-face {
          font-family: 'Adib-GSS-Medium';
           src: url('public/adib/fonts/GESSTwo-Medium.otf') format('truetype');
          }
   body {
   background-size: cover;
   margin: 0;
   padding: 0;
   min-height: 100vh;
   }
   .ai-photo-container {
   display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        background: url('public/bg/user-bg.png') no-repeat center center;
        background-size: cover;
        border-radius: 13px;
        min-height: 500px; /* Existing minimum height */
        margin: 0 auto;
        position: relative;
        transition: min-height 0.3s ease; /* Smooth height change */
   }
   p, .card-title {
   color: white;
   font-size: 20px;
   text-align: center;
   padding: 20px;
   }
   .generated-img {
   max-width: 100%;
   max-height: 100%;
   border-radius: 13px;
   }
   .row-container {
   display: flex;
   justify-content: space-evenly;
   align-items: center;
   margin-top: 20px;
   flex-wrap: wrap;
   flex-direction: row;
   gap:13px;
   }
   .capture-button {
   /* background: linear-gradient(284.58deg, #d4b384 2.07%, #d9b78a 37.91%, #408d58 76.38%, #B49E5F 97.87%); */
   background: #bc7e50;
   padding: 15px;
   margin: 10px auto;
   color: #fff;
   text-align: center;
   font-size: 16px;
   z-index: 1;
   border-radius: 6px;
   border: none;
   flex-grow: 1;
   max-width: 100%;
   font-weight: bold;
   }
   .email, .submit-btn, .regenerate-button {
   padding: 15px;
   margin: 10px auto;
   color: #fff;
   text-align: center;
   font-size: 16px;
   /* background: white; */
   background: #bc7e50;
   z-index: 1;
   border-radius: 6px;
   /* border: 1px solid #ffff; */
   border: none;
   flex-grow: 1;
   max-width: 100%;
   font-weight: bold;
   }
   .submit-btn {
   background: linear-gradient(90deg, #FF3BFF 0%, #ECBFBF 38.02%, #5C24FF 75.83%, #D94FD5 100%);
   }
   .capture-button:hover, .regenerate-button:hover, .submit-btn:hover {
   /* background: linear-gradient(90deg, #b49e5f 25%,#d5c888 45%, #dfda97 100%); */
   background: linear-gradient(#916544 , #bc7e50);
   border: none;
   /* border-color: #ffff; */
   color: #ffff;
   font-weight: bold;
   }
   @media screen and (max-width: 480px) {
   .generated-img {
   width: 250px !important;
   height: 250px !important;
   }
   .row-container {
   display: flex;
   flex-direction: column;
   gap: 0px;
   width: 100%;
   }
   .email-container {
   margin:15px;
   }
   .capture-button, .regenerate-button {
   width: 250px !important; /* Make the buttons take the full width of their container */
   }
   }
   @media screen and (min-width: 3000px) and (orientation: portrait) {
   .generated-img {
   width: 800px !important;
   height: 1200px !important;
   }
   p {
   font-size: 30px;
   }
   .submit-btn {
   width: 300px !important;
   font-size: 25px !important;
   }
   .capture-button, .regenerate-button {
   width: 250px !important;
   font-size: 20px !important;
   }
   .email {
   width: 400px;
   font-size: 20px;
   }
   }
   .email-container {
   display: flex;
   align-items: center;
   border-radius: 13px;
   background: #bc7e50;
   padding: 0;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
   overflow: hidden;
   height: 50px;
   font-weight: bold;
   }
   .email-input {
   border: none;
   outline: none;
   font-size: 16px;
   flex-grow: 1;
   color: #ffff;
   border-radius: 0; /* Remove border-radius for an integrated look */
   font-weight: bold;
   background:#546739 !important;
   }
   .send-button {
   /* background: #FFFFFF; */
   background: #bc7e50;
   outline: none;
   padding: 10px 20px;
   font-size: 16px;
   color: #ffff;
   /* color: #ffff; */
   cursor: pointer;
   transition: background 0.3s ease;
   border-radius: 6px;
   /* border: 3px solid #CDBA7B; */
   /* background: linear-gradient(284.58deg, #d4b384 2.07%, #d9b78a 37.91%, #408d58 76.38%, #B49E5F 97.87%); */
   background: #bc7e50;
   height: 50px;
   font-weight: bold;
   }
   .send-button:hover {
   /* background: linear-gradient(90deg, #dfda97 25%, #d5c888 45%, #b49e5f 100%); */
   background: linear-gradient(#916544 , #bc7e50);
   }
   .email-input::placeholder {
   color: #ffff;
   }
   .ai-photo-container .success-message {
   color: white;
   }
.bottom_space {height:680px}
.ic1on{
  margin-bottom:590px;
}
    @media screen and (max-width: 1600px) {
    .bottom_space {height:680px}
}
   @media screen and (max-width: 1440px) {
    .bottom_space {height:675px}
}
@media screen and (max-width: 900px) {
    .bottom_space {height:380px}
}
@media screen and (max-width: 700px) {
    .bottom_space {height:250px}
}
@media screen and (max-width: 400px) {
    .bottom_space {height:230px}
}
  <?php if ($_SESSION['language'] == 'ar'): ?>
    button {
        text-wrap: wrap;
        font-family: "Adib-GSS-Medium" !important;
    }
<?php else: ?>
    button {
        text-wrap: wrap;
        font-family: "Adib-Bliss-Light";
    }
<?php endif; ?>
</style>
<body>
      <div class="container m-0 p-0" >
      <div style="padding:20px;margin:0 auto;" id="mainContent">
         <div class="ai-photo-container" id="aiPhotoContainer">
            <div class="element">
               <div style="text-align: center;" id="imageContainer">
                  <?php if ($_SESSION['generated_path']) { ?>
                  <h4 class="card-title"></h4>
                  <img class="generated-img" src="<?= 'http://localhost/ai-photo-core-php'. $_SESSION['generated_path']; ?>" />
                  <?php } else { ?>
                  <h4 class="card-title"><?= ($_SESSION['language'] == 'ar') ? 'نتيجة الذكاء الاصطناعي للأزياء' : 'Please Upload Image to Get Result'; ?></h4>
                  <img class="generated-img" src="<?= base_url(); ?>public/faces/no-image.png" alt="image" />
                  <?php } ?>
               </div>
               <div class="row-container" id="actionButtons">
                  <form method="post" action="regenerate.php">
                     <input type="hidden" name="user_image" value="<?= $_SESSION['orginalPath'];; ?>">
                     <input type="hidden" name="language" value="<?= $_SESSION['language']; ?>">
                     <button type="submit" class="regenerate-button">
                     <?= ($_SESSION['language'] == 'ar') ? 'إعادة الإنشاء' : 'Re-generate'; ?>
                     </button>
                  </form>
                  <a href="index.php?lang=<?= $_SESSION['language']; ?>">
                  <button class="capture-button">
                  <?= ($_SESSION['language'] == 'ar') ? 'التقاط الصورة' : 'Capture image'; ?>
                  </button>
                  </a>
                  <a href="<?= 'http://localhost/ai-photo-core-php'. $_SESSION['generated_path']; ?>" download id="downloadButton">
                  <button class="capture-button download-button">
                  <?= ($_SESSION['language'] == 'ar') ? 'تحميل' : 'Download'; ?>
                  </button>
                  </a>
                  <form method="post" action="send_email.php" id="sendEmailForm">
                     <div class="email-container">
                        <input type="email" name="email" class="email-input email" placeholder="<?= ($_SESSION['language'] == 'ar') ? 'أدخل البريد الإلكتروني' : 'Enter email'; ?>" required />
                        <input type="hidden" name="generated_path" value="<?= 'http://localhost/ai-photo-core-php'. $_SESSION['generated_path']; ?>">
                        <input type="hidden" name="language" value="<?= $_SESSION['language']; ?>">
                        <button type="submit" name="submit" class="send-button submit-btn" value="Send">
                        <?= ($_SESSION['language'] == 'ar') ? 'إرسال' : 'Send'; ?>
                        </button>
                     </div>
                  </form>
               </div>
               <div id="successMessage" style="display:none; text-align:center; padding:20px; color: white; font-family: <?= ($_SESSION['language'] == 'ar') ? 'Adib-GSS-Medium' : 'Adib-Bliss-Light'; ?>;">
                  <div style="font-size: 50px; margin-bottom: 20px;">👍</div>
                  <h4 style="font-size: 20px; font-weight: bold; font-family: <?= ($_SESSION['language'] == 'ar') ? 'Adib-GSS-Medium' : 'Adib-Bliss-Light'; ?>;">
                     <?= ($_SESSION['language'] == 'ar') 
                           ? 'لقد أرسل لك تطبيق كشك التصوير بالذكاء الاصطناعي صورتك الى بريدك الإلكتروني' 
                           : 'AI Photobooth just dropped your image in your email.'; ?>
                  </h4>
                  <a href="index.php?lang=<?= ($_SESSION['language'] == 'ar') ? 'ar' : 'en'; ?>" 
                     class="back-home-button" 
                     style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: white; color: #0C2448; border-radius: 13px; text-decoration: none; font-weight: bold; font-family: <?= ($_SESSION['language'] == 'ar') ? 'Adib-GSS-Medium' : 'Adib-Bliss-Light'; ?>;">
                     <?= ($_SESSION['language'] == 'ar') 
                           ? 'العودة إلى الصفحة الرئيسية' 
                           : 'Back to AI Photobooth'; ?>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
  <div class="bottom_space_no" ></div>
</body>
</html>
 <script>
      $(document).ready(function() {
          // Handle the download button click
      $('#downloadButton').click(function() {
            $('#actionButtons').hide(); // Hide the main content
            $('#imageContainer').hide(); // Hide the main content
            // Get the language from session flashdata
            let language = '<?php echo $_SESSION['language']; ?>';
            // Define messages and styles based on the language
            let successMessage = language === "ar" 
               ? "تم تحميل الصورة بنجاح." 
               : "The image has been successfully downloaded.";
            let backButtonText = language === "ar" 
               ? "العودة الى تطبيق التصوير بالذكاء الاصطناعي" 
               : "Back to AI Photobooth";
            let backUrl = "index.php?lang=" + (language === "ar" ? "ar" : "en");
            let fontFamily = language === "ar" 
               ? "Adib-GSS-Medium" 
               : "Adib-Bliss-Light";
            // Show success message
            $('#successMessage')
               .html('<div style="font-size: 50px; margin-bottom: 20px;">👍</div><h4 style="font-size: 24px; font-family: ' + fontFamily + ';">' + successMessage + '</h4>')
               .append('<a href="' + backUrl + '" class="back-home-button" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: white; color: #0C2448; border-radius: 13px; text-decoration: none; font-weight: bold; font-family: ' + fontFamily + ';">' + backButtonText + '</a>')
               .show();
         });
          // Handle the form submission (email send)
          $('#sendEmailForm').submit(function(e) {
              e.preventDefault(); // Prevent default form submission
              $.ajax({
                  type: 'POST',
                  url: $(this).attr('action'),
                  data: $(this).serialize(),
                  success: function(response) {
                      $('#actionButtons').hide(); // Hide the main content
                      $('#imageContainer').hide(); // Hide the main content
                      $('#successMessage').show(); // Show success message
                  },
                  error: function() {
                      // Handle error if needed
                      $('#actionButtons').hide(); // Hide the main content
                      $('#imageContainer').hide(); // Hide the main content
                      $('#successMessage').show(); // Show success message
                  }
              });
          });
      });
   </script>