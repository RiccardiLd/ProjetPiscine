<?php
function delete_admin($user_delete)
{
    
    
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "DELETE FROM users WHERE '".$user_delete."' = username";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());

       
        
    

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);
}
?>