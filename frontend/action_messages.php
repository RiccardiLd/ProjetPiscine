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

function messages(){
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {   
       
       $sql = "SELECT  m.content, u.first_name, u.last_name, m.timestamp
FROM messages m, member mem, conversations c, users u
WHERE u.username = m.username
AND m.username = mem.username
AND c.conv_id = m.conv_id
AND mem.conv_id = c.conv_id
AND mem.conv_id = '".$_SESSION['convId']."'
ORDER BY m.timestamp DESC";

         $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        while($data = mysqli_fetch_assoc($result)) {
            echo "<p>  '".$data['first_name']."'  </p>";
            echo " ";
            echo $data['last_name'];
            echo " : '";
            echo $data['content'];
            echo "' à : ";
            echo $data['timestamp'];
            echo '<br>';
            echo '<br>';
    }

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}

function write($var,$group)
{   
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);
    $$_SESSION['convId'] = $group;
    if($db_found) {            
       $sql =  "INSERT INTO `messages` (`message_id`, `conv_id`, `username`, `content`, `timestamp`) VALUES (NULL, '".$group."', '".$_SESSION['myusername']."', '".$var."', NOW())";
        
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
          
    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);
}
?>