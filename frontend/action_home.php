<?php
session_start();

    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT COUNT(*) AS nb FROM posts WHERE username = 'ECE'";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());

        $data = mysqli_fetch_assoc($result);
        echo $data['nb'];

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);
?>