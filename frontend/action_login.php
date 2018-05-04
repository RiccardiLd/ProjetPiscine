<?php
$database='linkedoff';
$db_handle=mysqli_connect('localhost', 'root', 'root');       $db_found=mysqli_select_db($db_handle,$database);

if($db_found) {            
    $sql = "SELECT password FROM users WHERE username = '".$_POST["uname"]."'"; 
    $result = mysqli_query($db_handle, $sql) or die(mysql_error());
    
    while($data = mysqli_fetch_assoc($result)) {
        echo $data['password'];
    }
    
    if($data['password'] == $_POST["psw"]) {
        echo "ok";
    }
    else {
        echo $data['password'];
        echo $_POST["psw"];
    }
}
else { echo "Base de données non trouvée."; }

mysqli_close($db_handle);

?>