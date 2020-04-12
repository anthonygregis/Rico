<html>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intial-scale=1, shrink-to-fit=no">
    <!-- This website is an education recreation of ideas from Westworld -->
    <head>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/circular-std/style.css">
        <link rel="stylesheet" href="assets/css/dabcoin.style.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.css">
        <link rel="stylesheet" href="assets/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    </head>
    <body>
        <div class="header">
            <div class="glitch" data-text="RI₵O">RI₵O</div>
        </div>
        <section class="intro">
                <p>Rico is designed to allow discreet contracts to be carried out between employers and workers. Designed to protect both parties and achieve maximum effeciency.
                    Employing a reputation system for both parties to ensure that you are rewarded for providing / completing contracts effectively.</p> 
                <br>
                <input type="text" id="referral" name="referral" placeholder="Enter Refferal Code..">
        </section>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script>
            var input = document.getElementById("referral");
            input.addEventListener("keyup", function(event) {
              if (event.keyCode === 13) {
               event.preventDefault();
               if (input.value == 'morbvpn') {
               window.location.href = "http://nopixel.online/rico/test/";
               }
              }
            });
        </script>
    </body>
</html>