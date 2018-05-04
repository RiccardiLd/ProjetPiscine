<?php

    function login()
    {
        $database='linkedoff';
        $db_handle=mysqli_connect('localhost', 'root', 'root');
        $db_found=mysqli_select_db($db_handle,$database);
        
        if($db_found) {
            $sql = "SELECT* FROM skills WHERE skill = 'Procrastiner'"; ///REQUETE SQL
            $result = mysqli_query($db_handle, $sql) or die(mysql_error());
            while($data = mysqli_fetch_assoc($result)) {
                echo $data['username'];
            }
        }
        else { echo "Base de données non trouvée."; }

        mysqli_close($db_handle);
    }

?>