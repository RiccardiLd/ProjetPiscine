<?php
session_start();
    function nb_con(){
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT COUNT(*) AS nb FROM users WHERE username IN (SELECT 
        CASE WHEN username_user1 = '".$_SESSION['myusername']."' THEN username_user2 
        WHEN username_user2 = '".$_SESSION['myusername']."' THEN username_user1 
        ELSE NULL 
        END AS NewField 
        FROM contacts WHERE (username_user2 = '".$_SESSION['myusername']."' OR username_user1 = '".$_SESSION['myusername']."') AND connected = 1)";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());

        $data = mysqli_fetch_assoc($result);
        echo $data['nb'];

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}


    function nb_posts(){
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT COUNT(*) AS nb FROM posts WHERE username = '".$_SESSION["myusername"]."'";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());

        $data = mysqli_fetch_assoc($result);
        echo $data['nb'];

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}



function skills(){
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT concat (skill,' (', skill_level,')') AS sk FROM skills WHERE username = '".$_SESSION["myusername"]."'";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());

        while($data = mysqli_fetch_assoc($result)) {
        echo $data['sk'].'<br>';
    }

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}
    
?>