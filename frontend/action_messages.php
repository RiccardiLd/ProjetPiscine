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

        $sql = "SELECT  c.title, m.content, u.first_name, u.last_name, m.timestamp
FROM messages m, member mem, conversations c, users u
WHERE u.username = m.username
AND m.username = mem.username
AND c.conv_id = m.conv_id
AND mem.conv_id = c.conv_id
AND mem.conv_id = '".$_SESSION['convId']."'
ORDER BY m.timestamp DESC";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        $data = mysqli_fetch_assoc($result);
        echo "<h3>  ".$data['title']." </h3>";
        mysqli_data_seek($result, 0);
        while($data = mysqli_fetch_assoc($result)) {

            print '<h4 class="post-title">'.$data['first_name'].' '.$data['last_name'].'</h4>';
            print '<p class="post-content"></p>';
            print '<p class="post-content">'.$data['content'].'</p>';
            print '<span class="time-left">'.$data['timestamp'].'</span>';
        }

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}

function write($var)
{   
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);


    if($db_found) {            
        $sql =  "INSERT INTO `messages` (`message_id`, `conv_id`, `username`, `content`, `timestamp`) VALUES (NULL, '".$_SESSION['convId']."', '".$_SESSION['myusername']."', '".$var."', NOW())";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);
}
function actual_conv($conv)
{
    $_SESSION['convId'] = $conv;
}
function numconv()
{
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);
    //$_SESSION['convId'] = $group;

    if($db_found) {            
        $sql =  "SELECT c.title FROM conversations c, member m
WHERE m.username = '".$_SESSION['myusername']."' 
AND c.conv_id = m.conv_id";
        $i=1;
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        while($data = mysqli_fetch_assoc($result)) {
            /* <option value="2"><?php numconv(1)?></option>*/
            echo "<option value = '".$i."' > ".$data['title']." </option>";
            $i++;
            
        }

    }}

function show_members()
{
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);
    //$_SESSION['convId'] = $group;

    if($db_found) {            
        $sql =  "SELECT concat (u.first_name,' ', u.last_name) as nom
        FROM conversations c, member m, users u
        WHERE c.conv_id = '".$_SESSION['convId']."'
        AND c.conv_id = m.conv_id
        AND m.username = u.username
        ";
        //echo $sql;
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        while($data = mysqli_fetch_assoc($result)) {
          echo $data['nom'];
            echo '<br>';
            
        }

    }
}




?>