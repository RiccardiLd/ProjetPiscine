<?php
session_start();

    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {           
        $sql = "INSERT INTO comments (comment_id, post_id, username_user, content, timestamp) VALUES ('', '".$_POST["post_id"]."','".$_SESSION["myusername"]."','".$_POST["uname"]."', NOW())";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        
        $sql = "INSERT INTO notifications (notif_id, parent_id, type, seen, timestamp, user_create, user_receive) VALUES ('', '".$_POST["post_id"]."', 'comment','0', NOW(), '".$_SESSION["myusername"]."', (SELECT username FROM posts WHERE post_id = ".$_POST["post_id"]."))";
        
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);

    header('Location:home.php');
?>