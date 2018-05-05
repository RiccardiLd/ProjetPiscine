<?php
session_start();

    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {   
        $sql = "SELECT COUNT(*) AS cnt FROM likes WHERE username_user = '".$_SESSION["myusername"]."' AND post_id = '".$_POST["post_id"]."'";
        
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        $data = mysqli_fetch_assoc($result);

        if($data['cnt']==0) {
        $sql = "INSERT INTO likes (username_user, post_id, timestamp) VALUES ('".$_SESSION["myusername"]."','".$_POST["post_id"]."', NOW())";
        
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        
        $sql = "INSERT INTO notifications (notif_id, parent_id, type, seen, timestamp, user_create, user_receive) VALUES ('', '".$_POST["post_id"]."', 'like','0', NOW(), '".$_SESSION["myusername"]."', (SELECT username FROM posts WHERE post_id = ".$_POST["post_id"]."))";
        
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());}
    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);

    header('Location:home.php');
?>