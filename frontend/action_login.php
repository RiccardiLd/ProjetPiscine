<?php
$database='linkedoff';
$db_handle=mysqli_connect('localhost', 'root', 'root');       $db_found=mysqli_select_db($db_handle,$database);

if($db_found) {            
    $sql = "SELECT password FROM users WHERE username = '".$_POST["uname"]."'"; 
    $result = mysqli_query($db_handle, $sql) or die(mysql_error());
    
    while($data = mysqli_fetch_assoc($result)) {
        $psw= $data['password'];
    }
    
    if($psw == $_POST["psw"]) {
        header("Location:home.php");
        echo "ok";
    }
    else {
        header("Location:login-page.php");
        echo "Mauvais identifiants";
    }
}
else { echo "Base de données non trouvée."; }

mysqli_close($db_handle);

?>