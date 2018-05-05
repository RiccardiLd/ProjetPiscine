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

?>