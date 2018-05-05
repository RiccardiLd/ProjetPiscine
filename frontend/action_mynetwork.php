<?php
session_start();

function mynetwork(){
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT concat (first_name,' ', last_name) as nom
FROM users
WHERE username IN (SELECT 
CASE WHEN username_user1 = '".$_SESSION['myusername']."' THEN username_user2 
	 WHEN username_user2 = '".$_SESSION['myusername']."' THEN username_user1 
     ELSE NULL 
     END AS NewField 
FROM contacts WHERE (username_user2 = '".$_SESSION['myusername']."' OR username_user1 = '".$_SESSION['myusername']."') AND connected = 1)";

         $result = mysqli_query($db_handle, $sql) or die(mysql_error());

        while($data = mysqli_fetch_assoc($result)) {
        echo ' -   '.$data['nom'].'<br>';
    }

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}

function myrequests(){
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT concat (u.first_name,' ', u.last_name) AS nom
FROM users u, contacts c
WHERE u.username = c.username_user2 
AND c.connected = 0
AND c.username_user1 = '".$_SESSION['myusername']."'";

         $result = mysqli_query($db_handle, $sql) or die(mysql_error());

        while($data = mysqli_fetch_assoc($result)) {
        echo ' -   '.$data['nom'].'<br>';
    }

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}

function search($var){
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
       $sql = "SELECT username, concat (first_name,' ', last_name) AS nom
FROM users
WHERE (first_name LIKE '".$var."%' OR last_name LIKE '".$var."%' OR '".$var."' = graduation)";

         $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        while($data = mysqli_fetch_assoc($result)) {
        echo ' -   '.$data['nom'].'<br>';
        $_SESSION['hisusername'] = $data['username'];
    }

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}


?>