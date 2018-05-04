<?php
session_start();
function notifications(){
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT u.first_name, u.last_name, n.timestamp, n.type
FROM users u, notifications n
WHERE n.user_receive = '".$_SESSION['myusername']."' AND n.user_create = u.username";
       
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
      
        while($data = mysqli_fetch_assoc($result)) {
        echo $data['first_name'];
        echo " ";
        echo $data['last_name'];
        echo " ";
        if($data['type']=='post')
        {
            echo "a publié le ";
        }
            
        else if($data['type']=='like')
        {
            echo "a aimé votre publication du ";
        }
            
        else if($data['type']=='comment')
        {
            echo "a commenté votre publication du ";
        }
        
        else if($data['type']=='invite')
        {
            echo "a demandé à entrer dans votre réseau le ";
        }
        else if($data['type']=='accepted')
        {
            echo "a accepter votre demande le ";
        }
        echo $data['timestamp'];
        echo '<br>';
            
    }

    }
    else { echo "Base de données non trouvée."; }}
?>