<?php
session_start();

$database='linkedoff';
$db_handle=mysqli_connect('localhost', 'root', 'root');       $db_found=mysqli_select_db($db_handle,$database);

if($db_found) {            
    $sql = "SELECT * FROM users WHERE username = '".$_POST["username"]."'"; 
    $result = mysqli_query($db_handle, $sql) or die(mysql_error());
    
    while($data = mysqli_fetch_assoc($result)) {
        $uname= $data['username'];
    }
    
    if(empty($uname)) {
        $sql =  "INSERT INTO users(username, email, password, first_name, last_name, profile_photo, summary, status, graduation) VALUES('".$_POST["username"]."','".$_POST["email"]."','".$_POST["session_password"]."','".$_POST["firstName"]."','".$_POST["lastName"]."','img/avatar.png','','normal user',null)";
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        
        $sql =  "INSERT INTO contacts(username_user1, username_user2, type, connected, timestamp) VALUES('ECE','".$_POST["username"]."','professional',1,NOW())";
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        
        $_SESSION['myusername'] = $_POST["uname"];
        
        header("Location:home.php");
        echo "ok";
    }
    else {
        header("Location:login-page.php");
        echo "existe déjà";
    }
}
else { echo "Base de données non trouvée."; }

mysqli_close($db_handle);

?>