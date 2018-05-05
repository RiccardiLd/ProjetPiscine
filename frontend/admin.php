<?php
session_start();
require 'action_admin.php';
?>


<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<title>LinkedOff: Admin</title>
<link rel="icon" href="img/linkedoff_favicon.png">
<link href="login.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class=global-wrapper>

        <form id="regForm" class="reg-form" action="/action_signup.php" method="POST">
            <h2 class="title">Inscrire quelqu'un</h2>

            <section class="form-body">
                <label for="reg-firstname">Prénom</label>
                <input type="text" name="firstName" id="reg-firstname" class="reg-firstname" aria-required="true" tabindex="1" placeholder="" required>
                <label for="reg-lastname">Nom</label>
                <input type="text" name="lastName" id="reg-lastname" class="reg-lastname" aria-required="true" tabindex="1" placeholder="" required>
                <label for="reg-username">Pseudonyme</label>
                <input type="text" name="username" class="reg-username" tabindex="1" id="reg-username" aria-required="true" required>
                <label for="reg-email">Email</label>
                <input type="text" name="email" class="reg-email" autocapitalize="off" tabindex="1" id="reg-email" aria-required="true" autofocus="autofocus" required>
                <label for="reg-graduation">Promo</label>
                <input type="text" name="graduation" id="reg-graduation" class="reg-graduation" aria-required="true" tabindex="1" placeholder="" required>
                <label for="reg-password">Mot de passe (8 caractères minimum)</label>
                <input type="password" name="session_password" class="reg-password" id="reg-password" aria-required="true" tabindex="1" autocomplete="new-password" onkeyup="checkPasswordMatch()" required>
                <label for="reg-password">Confirmez le mot de passe</label>
                <input type="password" name="session_password" class="reg-password" id="reg-password-confirm" aria-required="true" tabindex="1" autocomplete="new-password" onkeyup="checkPasswordMatch()" required>
                <input tabindex="4" id="registration-submit" class="registration submit-button" type="submit" name="signup" value="Inscrire">
            </section>
        </form>

    </div>

   <div class=global-wrapper>

            <form id='"regForm"' class="reg-form"  method="POST">
                <h2 class="title">Supprimer quelqu'un</h2>

                <section class="form-body">
                    <label for="reg-firstname">Username</label>
                    <input type="text" name="username" id="reg-firstname" class="reg-firstname" aria-required="true" tabindex="1" placeholder="" required>
                    
                    <?php 
                    if(admin())
                    {
                        echo '<input class="submit" type="submit" name="delete" value="Supprimer">' ;
                    }
                    
                    
                    ?>
                    
                    
                </section>
            </form>
          <?php  if(isset($_POST['delete'])){
        delete_admin($_POST['username']);
    }?>

        </div> 



    <div class="footer">
        <div class="copyright">
            <img class="logo-copyright" alt="LinkedOff" src="img/linkedoff_logo_white.png"> © 2018 -&nbsp;
            <a href="references.html" target="blank" class="footer__link">Bibliographie</a>
        </div>
        <div class="back-to-top"><a href="#" class="footer__link">Back to top</a></div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function checkPasswordMatch() {
            var i;
            var password = document.getElementById("reg-password");
            var confirmPassword = document.getElementById("reg-password-confirm");
            var regpassword = document.getElementsByClassName("reg-password");
            if (password.value != confirmPassword.value || password.value.length < 8) {
                for (i = 0; i < regpassword.length; i++) {
                    regpassword[i].style.borderColor = "#ef0000";
                }
                document.getElementById("registration-submit").disabled = true;
                document.getElementById("registration-submit").style.backgroundColor = "#79bfe5";
            }
            else {
                for (i = 0; i < regpassword.length; i++) {
                    regpassword[i].style.borderColor = "#00ef00";
                }
                document.getElementById("registration-submit").disabled = false;
                document.getElementById("registration-submit").style.backgroundColor = "#0073b1";
            }

        }
    </script>
</body>
</html>
