<?php
session_start();
require 'action_mynetwork.php';
$_SESSION['hisusername'] = $_SESSION['myusername'];
$_SESSION['convId']=1;

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <title>LinkedOff - Mon Réseau</title>
        <link rel="icon" href="img/linkedoff_favicon.png">
        <link href="main.css" rel="stylesheet" type="text/css" />
    </head>
    <body> 
        <div class=global-wrapper>
            <div class="header">
                <div class="wrapper">
                    <h1>
                        <a href="home.php">
                            <img class="logo" src="img/linkedoff_logo_white.png" alt="LinkedOff Logo" />
                        </a>
                    </h1>
                    <ul class="nav-main display-flex full-height" role="navigation" aria-label="Primary">
                        <li id="home-nav-item" class="nav-item">
                            <a href="home.php" data-hover="Accueil" class="nav-item__link">
                                <span id="feed-tab-icon" class="nav-item__icon" aria-role="presentation">
                                    <li-icon aria-hidden="true" type="nav-small-home-icon" color="true">
                                        <img class="icon" src="img/menu/home-outline.png" alt="Home" />
                                    </li-icon>
                                </span> 
                                <span class="nav-item__title">Accueil</span>
                            </a>
                        </li>
                        <li id="profile-nav-item" class="nav-item">
                            <a href="profile.php" data-hover="Moi" class="nav-item__link">
                                <span id="profile-tab-icon" class="nav-item__icon" aria-role="presentation">
                                    <li-icon aria-hidden="true" type="nav-small-user-icon" color="true">
                                        <img class="icon" src="img/menu/user-outline.png" alt="Me" />
                                    </li-icon>
                                </span> 
                                <span class="nav-item__title">Ma Page</span>
                            </a>
                        </li>
                        <li id="mynetwork-nav-item" class="nav-item">
                            <a href="mynetwork.php" data-hover="Mon Réseau" class="nav-item__link current">
                                <span id="mynetwork-tab-icon" class="nav-item__icon" aria-role="presentation">
                                    <li-icon aria-hidden="true" type="nav-small-people-icon" color="true">
                                        <img class="icon" src="img/menu/my-network-outline.png" alt="Network" />
                                    </li-icon>
                                </span> 
                                <span class="nav-item__title">Mon Réseau</span>
                            </a>
                        </li>
                        <li id="notifications-nav-item" class="nav-item">
                            <a href="notifications.php" data-hover="Notifications" class="nav-item__link">
                                <span id="notifications-tab-icon" class="nav-item__icon" aria-role="presentation">
                                    <li-icon aria-hidden="true" type="nav-small-notifications-icon" color="true">
                                        <img class="icon" src="img/menu/notifications-bell-outline.png" alt="Notifications" />
                                    </li-icon>
                                </span> 
                                <span class="nav-item__title">Notifications</span>
                            </a>
                        </li>
                        <li id="messaging-nav-item" class="nav-item nav-item--messaging">
                            <a href="messages.php" data-hover="Messagerie" class="nav-item__link">
                                <span id="messaging-tab-icon" class="nav-item__icon" aria-role="presentation">
                                    <li-icon aria-hidden="true" type="nav-small-messaging-icon" color="true">
                                        <img class="icon" src="img/menu/speech-bubble-outline.png" alt="Messages" />
                                    </li-icon>
                                </span> 
                                <span class="nav-item__title">Messagerie</span>
                            </a>
                        </li>
                        <li id="jobs-nav-item" class="nav-item">
                            <a href="jobs.php" data-hover="Emplois" class="nav-item__link">
                                <span id="jobs-tab-icon" class="nav-item__icon" aria-role="presentation">
                                    <li-icon aria-hidden="true" type="nav-small-jobs-icon" color="true">
                                        <img class="icon" src="img/menu/work-briefcase-outline.png" alt="Jobs" />
                                    </li-icon>
                                </span> 
                                <span class="nav-item__title">Emplois</span>
                            </a>
                        </li>
                        <li id="logoff-nav-item" class="nav-item">
                            <a href="login-page.php" data-hover="Déconnexion" class="nav-item__link">
                                <span id="logoff-tab-icon" class="nav-item__icon" aria-role="presentation">
                                    <li-icon aria-hidden="true" type="nav-small-logoff-icon" color="true">
                                        <img class="icon" src="img/menu/power-button-off.png" alt="On/Off" />
                                    </li-icon>
                                </span> 
                                <span class="nav-item__title">Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="main-pane">
                <div class="tab">
                    <button id="defaultOpen" class="tablinks" onclick="openTab(event, 'Mes contacts')">Mes contacts</button>
                    <button class="tablinks" onclick="openTab(event, 'Mes invitations')">Mes invitations</button>
                    <button class="tablinks" onclick="openTab(event, 'Rechercher')">Rechercher</button>
                </div>

                <div id="Mes contacts" class="tabcontent">
                    <h3>Contacts</h3>
                    <p><?php mynetwork() ?></p>
                </div>

                <div id="Mes invitations" class="tabcontent">
                    <h3>Invitations</h3>
                    <p><?php myrequests() ?></p>
                </div>

                <div id="Rechercher" class="tabcontent">
                    <div class="search-container">
                        <form method="post" class="search-form">
                            <input type="text" placeholder="Recherche.." tabindex="1" name="search">
                            <button type="submit" class="submit-search" name = "bouton"><img class="icon" alt="Search" src="img/menu/search-icon.png">  </button>
                        </form>
                    </div>

                    <h3>Rechercher</h3>
                    <p> <?php 
    if(isset($_POST['bouton'])){
        search($_POST['search']);
    }
                        ?>
                    </p>
                </div>
            </div>

        </div>

        <div class="footer">
            <div class="copyright">
                <img class="logo-copyright" alt="LinkedOff" src="img/linkedoff_logo_white.png"> © 2018 -&nbsp;
                <a href="references.html" target="blank" class="footer__link">Bibliographie</a>
            </div>
            <div class="back-to-top"><a href="#" class="footer__link">Back to top</a></div>
        </div>
    </body>
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
</html>