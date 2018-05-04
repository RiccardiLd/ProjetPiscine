<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <title>LinkedOff: Log In or Sign Up</title>
        <link rel="icon" href="img/linkedoff_favicon.png">
        <link href="login.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class=global-wrapper>
            <div class="header">
                <div class="wrapper">
                    <h1>
                        <a href="login-page.html">
                            <img class="logo" src="img/linkedoff_logo_white.png" alt="LinkedOff Logo" />
                        </a>
                    </h1>
                    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Se connecter</button>
                </div>
            </div>

            <div id="id01" class="modal">

                <form class="modal-content animate" action="/action_login.php">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <img src="img/avatar.png" alt="Avatar" class="avatar">
                    </div>

                    <div class="container">
                        <label for="uname"><b>Pseudonyme</b></label>
                        <input type="text" placeholder="Entrez votre pseudonyme" name="uname" required>

                        <label for="psw"><b>Mot de passe</b></label>
                        <input type="password" placeholder="Entrez votre mot de passe" name="psw" required>
                    </div>

                    <div class="container" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn" value="annuler">Annuler</button>
                            <button type="submit" name="login" class="loginbtn">Se connecter</button> 
                    </div>
                </form>
            </div>

            <form id="regForm" class="reg-form" action="/action_signup.php" method="POST">
                <h2 class="title">Bienvenue chez LinkedOff</h2>

                <section class="form-body">
                    <label for="reg-firstname">Prénom</label>
                    <input type="text" name="firstName" id="reg-firstname" class="reg-firstname" aria-required="true" tabindex="1" placeholder="">
                    <label for="reg-lastname">Nom</label>
                    <input type="text" name="lastName" id="reg-lastname" class="reg-lastname" aria-required="true" tabindex="1" placeholder="">
                    <label for="reg-username">Pseudonyme</label>
                    <input type="text" name="username" class="reg-username" tabindex="1" id="reg-username" aria-required="true">
                    <label for="reg-email">Email</label>
                    <input type="text" name="email" class="reg-email" autocapitalize="off" tabindex="1" id="reg-email" aria-required="true" autofocus="autofocus">
                    <label for="reg-password">Mot de passe</label>
                    <input type="password" name="session_password" class="reg-password" id="reg-password" aria-required="true" tabindex="1" autocomplete="new-password">
                    <label for="reg-password">Confirmez le mot de passe</label>
                    <input type="password" name="session_password" class="reg-password" id="reg-password-confirm" aria-required="true" tabindex="1" autocomplete="new-password">
                    <input tabindex="4" id="registration-submit" class="registration submit-button" type="submit" name="signup" value="S'inscrire">
                </section>
            </form>
        </div>

        <div class="footer">
            <div class="copyright"><img class="logo-copyright" alt="LinkedOff" src="img/linkedoff_logo_white.png"> © 2018</div>
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
        </script>

    </body>
</html>