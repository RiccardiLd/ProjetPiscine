<?php

function conv_names(){
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
       $sql = "SELECT c.title FROM conversations c, member m
WHERE c.conv_id = m.conv_id AND m.username = '".$_SESSION["myusername"]."'";

         $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        while($data = mysqli_fetch_assoc($result)) {
        echo ' -   '.$data['title'].'<br>';
    }

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}


?>