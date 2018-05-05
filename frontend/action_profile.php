<?php

function myposts() {
$database='linkedoff';
$db_handle=mysqli_connect('localhost', 'root', 'root');       
$db_found=mysqli_select_db($db_handle,$database);

if($db_found) {            
    $sql = "SELECT u.first_name, u.last_name, p.text
FROM posts p, users u WHERE p.username = '".$_SESSION['hisusername']."' AND p.username = u.username ORDER BY p.timestamp DESC"; 
    $result = mysqli_query($db_handle, $sql) or die(mysql_error());
    
    while($data = mysqli_fetch_assoc($result)) {
        print '<h3 class="post-title">'.$data['first_name'].' '.$data['last_name'].'</h3>';
        print '<p class="post-content"></p>';
        print '<p class="post-content">'.$data['text'].'</p>';
}}
else { echo "Base de données non trouvée."; }

mysqli_close($db_handle); }

function bio($var)
{
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {  
        $sql =  "UPDATE users SET summary = '".$var."' WHERE username = '".$_SESSION['myusername']."'";
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);
}

function profilepic($var)
{
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {  
        $sql =  "UPDATE users SET profile_photo = '".$var."' WHERE username = '".$_SESSION['myusername']."'";
        $result = mysqli_query($db_handle, $sql) or die(mysql_error()); 
    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);
}
        
function myinfos() {
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT * FROM users WHERE username = '".$_SESSION['hisusername']."'"; 
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
    
        $data = mysqli_fetch_assoc($result);
        echo '<br>'.$data['username'].'<br>'.'<br>'.$data['first_name'].' '.$data['last_name'].'<br>'.'<br>'.$data['email'].'<br>'.'<br>'.'Promo '.$data['graduation'].'<br>'.'<br>'.'<br>'.$data['summary'].'<br>'.'<br>'.'<br>';
        
        $sql = "SELECT concat (skill,' (', skill_level,')') AS sk FROM skills WHERE username = '".$_SESSION["hisusername"]."'";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());

        while($data = mysqli_fetch_assoc($result)) {
        echo $data['sk'].'<br>'; }
}
else { echo "Base de données non trouvée."; }

mysqli_close($db_handle);
}

function myprofilepic() {
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT profile_photo FROM users WHERE username = '".$_SESSION['hisusername']."'"; 
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
    
        $data = mysqli_fetch_assoc($result);
        $_SESSION['profilepic'] = $data['profile_photo'];
}
else { echo "Base de données non trouvée."; }

mysqli_close($db_handle);
}

function friend_request()
{
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "INSERT INTO contacts VALUES('".$_SESSION['hisusername']."','".$_SESSION['myusername']."', 'friend', '0', NOW())"; 
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
       
         $sql = "INSERT INTO notifications (notif_id, parent_id, type, seen, timestamp, user_create, user_receive)
                                    VALUES ('', null, 'invite','0', NOW(), '".$_SESSION["myusername"]."','".$_SESSION['hisusername']."')";
        
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
       
        $nameconv = $_SESSION["hisusername"]." ".$_SESSION["myusername"];
        
        $sql = "INSERT INTO conversations VALUES ('', '".$nameconv."')";
        
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        
        //$sql = "INSERT INTO member VALUES ((SELECT con, '".$nameconv."')";
        
       // $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        

        
}}
function friend_request_accept()
{
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);
    
    if($db_found) {            
        $sql = "UPDATE contacts SET connected = 1
        WHERE '".$_SESSION["hisusername"]."' = username_user2 
        AND  '".$_SESSION["myusername"]."' = username_user1"; 
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
       
         $sql = "INSERT INTO notifications (notif_id, parent_id, type, seen, timestamp, user_create, user_receive)
                                    VALUES ('', null, 'invite','0', NOW(), '".$_SESSION["hisusername"]."','".$_SESSION['myusername']."')";
        
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        

        
}}

function ifalreadyfriend()
{
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT COUNT(*) as nb FROM contacts WHERE (('".$_SESSION['hisusername']."' = username_user1 AND '".$_SESSION['myusername']."' = username_user2 AND connected = 1) OR ('".$_SESSION['hisusername']."' = username_user2 AND '".$_SESSION['myusername']."' = username_user1 AND connected = 1))"; 
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        $data = mysqli_fetch_assoc($result);
        //echo $data['nb'];
        if($data['nb']==0)
        {
            return false;
        }
            
        else
        {
            return true;
        }
        
        
        }
}

function iffriendasked()
{
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT COUNT(*) as nb FROM contacts 
        WHERE '".$_SESSION['hisusername']."' = username_user2 
        AND '".$_SESSION['myusername']."' = username_user1 
        AND connected = 0"; 
        
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        $data = mysqli_fetch_assoc($result);
        echo $data['nb'];
        if($data['nb']==0)
        {
            return false;
        }
            
        else
        {
            return true;
        }
        
        

        
}}
function ifIasked()
{
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT COUNT(*) as nb FROM contacts 
        WHERE '".$_SESSION['hisusername']."' = username_user1 
        AND '".$_SESSION['myusername']."' = username_user2 
        AND connected = 0"; 
        
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        $data = mysqli_fetch_assoc($result);
        echo $data['nb'];
        if($data['nb']==0)
        {
            return false;
        }
            
        else
        {
            return true;
        }
        
        

        
}}


?>