<?php
    
function jobs($val) {
        $database='linkedoff';
$db_handle=mysqli_connect('localhost', 'root', 'root');       
$db_found=mysqli_select_db($db_handle,$database);

if($db_found) {            
    $sql = "SELECT timestamp, text FROM posts WHERE type = 'emploi' ORDER BY timestamp DESC LIMIT 1 OFFSET ".$val.""; 
    $result = mysqli_query($db_handle, $sql) or die(mysql_error());
    $data = mysqli_fetch_assoc($result);
    echo "Le ".$data['timestamp']." :".'<br>'.$data['text'];
}
else { echo "Base de données non trouvée."; }

mysqli_close($db_handle); }

function name($val) {
        $database='linkedoff';
$db_handle=mysqli_connect('localhost', 'root', 'root');       
$db_found=mysqli_select_db($db_handle,$database);

if($db_found) {            
    $sql = "SELECT u.first_name, u.last_name FROM posts p, users u WHERE type = 'emploi' AND p.username = u.username ORDER BY timestamp DESC LIMIT 1 OFFSET ".$val.""; 
    $result = mysqli_query($db_handle, $sql) or die(mysql_error());
    $data = mysqli_fetch_assoc($result);
    echo $data['first_name'].' '.$data['last_name'];
}
else { echo "Base de données non trouvée."; }

mysqli_close($db_handle); }

?>