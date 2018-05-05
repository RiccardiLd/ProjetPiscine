<?php
session_start();

function myposts() {
$database='linkedoff';
$db_handle=mysqli_connect('localhost', 'root', 'root');       
$db_found=mysqli_select_db($db_handle,$database);

if($db_found) {            
    $sql = "SELECT u.first_name, u.last_name, p.text
FROM posts p, users u WHERE p.username = '".$_SESSION['myusername']."' AND p.username = u.username ORDER BY p.timestamp DESC"; 
    $result = mysqli_query($db_handle, $sql) or die(mysql_error());
    
    while($data = mysqli_fetch_assoc($result)) {
        echo ' -   '.$data['first_name'].' '.$data['last_name'].'<br>';
        echo $data['text'].'<br>'.'<br>';
}}
else { echo "Base de données non trouvée."; }

mysqli_close($db_handle); }

?>