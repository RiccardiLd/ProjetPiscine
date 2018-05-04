<?php
session_start();

//function mynetwork1(){
/*SELECT first_name , last_name 
FROM users
WHERE username IN (SELECT 
CASE WHEN username_user1 = '".$_SESSION['myusername']."' THEN username_user2 
	 WHEN username_user2 = '".$_SESSION['myusername']."' THEN username_user1 
     ELSE NULL 
     END AS NewField 
FROM contacts WHERE username_user2 = '".$_SESSION['myusername']."' OR username_user1 = '".$_SESSION['myusername']."')

 */

 $sql = "SELECT first_name , last_name 
FROM users
WHERE username IN (SELECT 
CASE WHEN username_user1 = '".$_SESSION['myusername']."' THEN username_user2 
	 WHEN username_user2 = '".$_SESSION['myusername']."' THEN username_user1 
     ELSE NULL 
     END AS NewField 
FROM contacts WHERE (username_user2 = '".$_SESSION['myusername']."' OR username_user1 = '".$_SESSION['myusername']."') AND connected = 1)";
;
echo $sql;
    
/*$database='linkedoff';
$db_handle=mysqli_connect('localhost', 'root', 'root');       
$db_found=mysqli_select_db($db_handle,$database);

if($db_found) {            
   // $sql = "SELECT username FROM users WHERE username = '".$_POST["uname"]."'"; 
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
//}
*/

?>