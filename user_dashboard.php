<?php 
   // Start your session if it is not already started
   if (session_status() === PHP_SESSION_NONE) {
       session_start();
      //   echo '<pre>'; print_r($_SESSION); 
      // exit;
   }
   // Redirection logic
   if (!$_SESSION['orginalPath']) {
      echo '<pre></pre>'; print_r($_SESSION); 
      exit;
       header("Location: " . 'index.php');
       exit(); // Make sure to exit after the redirection to prevent further code execution
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>ADIB - Photo Booth</title>
      <style>
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
         .container {
         position: relative;
         padding-bottom: 100px;
         }
         .main-panel {
         padding: 20px;
         background-color: rgba(255, 255, 255, 0.9);
         border-radius: 13px;
         box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
         min-height: 100vh;
         }
         .page-body-wrapper {
         overflow-y: auto;
         max-height: 100vh;
         padding-top: 0 !important;
         }
         .card-body {
         border: 1px solid #3729d3;
         border-radius: 13px;
         background-color: black;
         }
         p {
         color: #9f9f9f;
         font-size: 15px;
         padding: 14px;
         text-align: left;
         background: #181818;
         width: 100%;
         border-radius: 13px;
         margin: 30px auto;
         padding-left: 35px;
         }
         .card-title {
         color: white !important;
         }
         .img-sm {
         border-radius: 13px;
         font-size: 20px;
         font-weight: bold;
         width: 250px;
         height: 80px;
         text-align: center;
         /* background: linear-gradient(180deg, #70dafe, #effbff); */
         background: transparent;
         border-color: #fff;
         color: #ffff;
         font-weight: bold;
         }
         .element {
         max-width: fit-content;
         margin: 0 auto;
         }
         .back-btn {
         color: #8b8b8b;
         border-radius: 13px;
         z-index: 1;
         font-size: 15px;
         width: 196px;
         height: 50px;
         font-weight: bold;
         background: white;
         border: 1px solid;
         border-color: #aaa;
         }
         .responsive-loader {
         width: 100%;
         max-width: 300px;
         height: auto;
         display: block;
         margin: 0 auto;
         }
         .prompt-container {
         text-align: center;
         }
          .action_image {
         gap:40px !important;
         }
         @media (min-width: 992px) {
         .pb-lg-3, .py-lg-3 {
         padding-bottom: 4rem !important;
         }
         }
         @media (max-width: 1024px) {
         .pb-lg-3, .py-lg-3 {
         padding-bottom: 0rem !important;
         }
         }
         @media (max-width: 768px) {
         #loader .responsive-loader {
         max-width: 250px;
         }
         .card-title {
         font-size: 30px !important;
         margin-top: 30px !important;
         }
         .prompt-container {
         padding-left: 40px !important;
         }
         .ai-photo-container {
         width: 100%;
         min-height: 350px;
         }
         }
         @media (max-width: 480px) {
         .img-sm { 
         font-size: 13px !important;
         width:220px !important;
         height:60px !important;
         }
         .card-title {
         margin-top: 30px !important;
         font-size: 20px !important;
         margin-bottom: -18px !important;
         }
         .prompt-container {
         padding-left: 60px !important;
         }
         .action_image {
         gap: 10px !important;
         }
         #loader .responsive-loader {
         width: 80px !important;
         }
         .ai-photo-container {
         min-height: unset; /* Remove the fixed minimum height */
         height: auto; /* Let the container height be determined by its content */
         }
         .ai-photo-container.loader-active {
         height: 200px; /* Apply reduced height in mobile view */
         }
         .loader-text {
         font-size: 15px !important;
         }
         }
         @media only screen and (min-width: 3000px) and (orientation: portrait) {
         .img-sm {
         width: 90%;
         max-width: 600px;
         border: 2px solid #0cb9ed;
         border-radius: 13px;
         }
         .carousel-indicators button {
         height: 20px;
         width: 20px;
         }
         .responsive-loader {
         max-width: 600px;
         }
         p {
         font-size: 30px;
         line-height: 1.5;
         }
         .warning {
         font-size: 28px;
         }
         .card-title {
         font-size: 40px;
         }
         .back-btn {
         width: 200px;
         font-size: 25px;
         margin-top: 40px;
         }
         .padding-style {
         padding: 30px;
         }
         .carousel-inner {
         padding: 40px;
         }
         }
         ul {
         list-style-type: none;
         }
         .warning {
         color: #ff00ff;
         font-weight: bold;
         }
         .img-sm:hover {
         box-shadow: 0px 0px 10px #aaa;
         /* background: linear-gradient(90deg, #b49e5f 25%,#d5c888 45%, #dfda97 100%); */
         background: linear-gradient(#916544 , #bc7e50);
         border: 1px solid;
         border-color: #ffff;
         color:#fff;
         font-weight: bold;
         }
         .back-btn:hover {
         /* background: linear-gradient(90deg, #b49e5f 25%,#d5c888 45%, #dfda97 100%); */
         background: linear-gradient(#916544 , #bc7e50);
         border: 1px solid;
         border-color: #ffff;
         color:#fff;
         font-weight: bold;
         }
         #loader {
         position: absolute; /* Position it absolutely within the container */
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         z-index: 9999; /* Ensure it's on top of other elements */
         display: none; /* Hide by default */
         }
         .loader-container {
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
         flex-direction: column;
         }
         .loader {
         display: flex;
         justify-content: space-between;
         width: 80px;
         }
         .loader div {
         width: 16px;
         height: 16px;
         border-radius: 50%;
         animation: grow-shrink 1.5s infinite;
         }
         .loader div:nth-child(1) {
         animation-delay: 0s;
         }
         .loader div:nth-child(2) {
         animation-delay: 0.3s;
         }
         .loader div:nth-child(3) {
         animation-delay: 0.6s;
         }
         @keyframes grow-shrink {
         0%, 100% {
         transform: scale(1);
         }
         50% {
         transform: scale(1.5);
         }
         }
         <?php if ($_SESSION['language'] == 'ar'): ?>
         input {
         text-wrap: wrap;
         font-family: "Adib-GSS-Medium" !important;
         }
         <?php else: ?>
         input {
         text-wrap: wrap;
         font-family: "Adib-Bliss-Light";
         }
         <?php endif; ?>
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
   </head>
   <body>
      <div class="container m-0 p-0" >
         <!-- English Language Section -->
         <?php if($_SESSION['language'] == 'en'): ?>
         <div style="border:0px solid #f00;padding:20px;margin-left:auto;margin-right:auto;">
            <div class="ai-photo-container" id="aiPhotoContainer">
               <div id="loader" class="element" style="display:none">
                  <div class="loader-container">
                     <div class="loader">
                        <div style="text-align: center;">
                           <img src="public/loader/adib-loader.gif" style="max-width: 60px; height: auto; display: block; margin: 0 auto;" />
                        </div>
                     </div>
                     <div class="loader-text" style="margin-top: 80px; text-align: center; color: white; font-family:Adib-Bliss-Light;  font-size: 20px; font-weight: bold; line-height: 20px; letter-spacing: 0.15px;">
                        Image generation may take 25-30 seconds..
                     </div>
                  </div>
               </div>
               <div class="row card-border">
                  <div class="element">
                     <h4 class="card-title">Please Select Any One Prompt</h4>
                  </div>
                  <div id="carouselExampleIndicators_desktop" class="carousel slide" data-bs-ride="carousel">
                     <div class="carousel-inner">
                        <?php
                           $styles = ['Pearl Diver', 'Bedouin Elder', 'Astronaut', 'Futuristic Emirati Citizen', 'Traditional Emirati Warrior', 'AI Falcon Trainer'];
                           $chunks = array_chunk($styles, 3, true);
                           $active = 'active';
                           foreach ($chunks as $chunk):
                           ?>
                        <div class="carousel-item <?= $active ?>">
                           <div class="prompt-container">
                              <ul style="display:flex; flex-wrap: wrap; justify-content: center;" class="action_image">
                                 <?php foreach ($chunk as $style): ?>
                                 <li class="col-lg-4 col-md-6 col-12">
                                    <div class="padding-style">
                                       <form method="post" action="generate.php">
                                          <div class="form-group">
                                             <input type="hidden" name="user_image" value="<?php echo $_SESSION['orginalPath']; ?>">
                                             <input type="hidden" name="prompt" value="<?php echo $style; ?>" class="prompt">
                                             <input type="hidden" name="language" value="<?php echo $_SESSION['language']; ?>">
                                             <input type="submit" class="img-sm" name="submit" value="<?php echo $style; ?>" onclick="loader_image()" />
                                          </div>
                                       </form>
                                    </div>
                                 </li>
                                 <?php endforeach; ?>
                              </ul>
                           </div>
                        </div>
                        <?php $active = ''; ?>
                        <?php endforeach; ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php endif; ?>
         <!-- Arabic Language Section -->
         <?php if($_SESSION['language'] == 'ar'): ?>
         <div style="border:0px solid #f00;padding:20px;margin-left:auto;margin-right:auto;">
            <div class="ai-photo-container" id="aiPhotoContainer">
               <!-- ----  -->
               <div id="loader" class="element" style="display:none">
                  <div class="loader-container">
                     <div class="loader">
                        <div style="text-align: center;">
                           <img src="public/loader/adib-loader.gif" style="max-width: 60px; height: auto; display: block; margin: 0 auto;" />
                        </div>
                     </div>
                     <div class="loader-text" style="margin-top: 80px; text-align: center; color: white; font-family:Adib-GSS-Medium; font-size: 20px; font-weight: bold; line-height: 20px; letter-spacing: 0.15px; ">
                        ...قد يستغرق إنشاء الصورة من 25 إلى 30 ثانية
                     </div>
                  </div>
               </div>
               <!-- ---- -->
               <div class="row card-border">
                  <div class="element">
                     <h4 class="card-title">الرجاء الاختيار</h4>
                  </div>
                  <div id="carouselExampleIndicators_desktop" class="carousel slide" data-bs-ride="carousel">
                     <div class="carousel-inner">
                        <?php
                           $styles = [
                              'Pearl Diver' => 'غواص اللؤلؤ',
                               'Bedouin Elder' => 'حكيم بدوي',
                               'Astronaut' => 'رائد فضاء',
                               'Futuristic Emirati Citizen' => 'مواطن إماراتي مستقبلي',
                               'Traditional Emirati Warrior' => 'فارس إماراتي أصيل ',
                               'AI Falcon Trainer' => 'مدرب صقور بالذكاء الاصطناعي'
                           ];
                           $chunks = array_chunk($styles, 3, true);
                           $active = 'active';
                           foreach ($chunks as $chunk): 
                           ?>
                        <div class="carousel-item <?= $active ?>">
                           <div class="prompt-container">
                              <ul style="display:flex; flex-wrap: wrap; justify-content: center;" class="action_image">
                                 <?php foreach ($chunk as $style_en => $style_ar): ?>
                                 <li class="col-lg-4 col-md-6 col-12 pb-lg-3">
                                    <div class="padding-style">
                                       <form method="post" id="frm_loader_form" name="frm_loader_form" action="generate.php">
                                          <div class="form-group">
                                             <input type="hidden" name="user_image" value="<?php echo $_SESSION['orginalPath']; ?>">
                                             <input type="hidden" name="prompt" value="<?php echo $style_en; ?>" class="prompt">
                                             <input type="hidden" name="language" value="<?php echo $_SESSION['language']; ?>">
                                             <input type="submit" class="img-sm" name="submit" value="<?php echo $style_ar; ?>" onclick="return loader_image()" />
                                          </div>
                                       </form>
                                    </div>
                                 </li>
                                 <?php endforeach; ?>
                              </ul>
                           </div>
                        </div>
                        <?php $active = ''; ?>
                        <?php endforeach; ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php endif; ?>
      </div>
      <div class="bottom_space" ></div>
   </body>
</html>
<script>
   function loader_image() {
       // alert("loader form lick");
       const loader = document.getElementById("loader");
       const prompts = document.getElementsByClassName("prompt");
       const aiPhotoContainer = document.getElementById("aiPhotoContainer");
       const frm_loader_form_c = document.getElementById("frm_loader_form");
       const language = "<?php echo $_SESSION['language']; ?>";
       if (prompts.length > 0 && prompts[0].value.trim() !== "") {
           // loader.innerHTML = `
           //     <div class="loader-container">
           //         <div class="loader">
           //             <div></div>
           //             <div></div>
           //             <div></div>
           //         </div>
           //     </div>
           //     <div class="loader-text" style="margin-top: 10px; text-align: center; color: white; font-size: 20px; font-weight: bold; line-height: 20px; letter-spacing: 0.15px;">
           //         ${loadingText}
           //     </div>`;
           //setTimeout(() => {
               // alert("set time");
               loader.style.display = 'block'; // Show the loader
               document.querySelector('.card-border').style.visibility = 'hidden';
               aiPhotoContainer.classList.add('loader-active');
               //document.frm_loader_form.submit();
             //   document.forms['frm_loader_form'].submit();
           //}, 1000); // Add a slight delay
           return true;
       }
   }
</script>