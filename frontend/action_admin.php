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
function admin()
{
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT status FROM users WHERE '".$_SESSION['myusername']."' = username";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
            while($data = mysqli_fetch_assoc($result)) {
          if($data['status']=="admin")
          {
              return true;
          }
                else
                {
                    return false;
                }
            
        }
       
        
    

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);
}
?>