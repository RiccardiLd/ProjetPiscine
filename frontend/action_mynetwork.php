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
//CAS DES AMIS, affiche nom et prenom dans une seule case
 $sql = "concat (first_name,' ', last_name)
FROM users
WHERE username IN (SELECT 
CASE WHEN username_user1 = '".$_SESSION['myusername']."' THEN username_user2 
	 WHEN username_user2 = '".$_SESSION['myusername']."' THEN username_user1 
     ELSE NULL 
     END AS NewField 
FROM contacts WHERE (username_user2 = '".$_SESSION['myusername']."' OR username_user1 = '".$_SESSION['myusername']."') AND connected = 1)";

echo $sql;

//CAS des gens qui souhaite entrer dans votre réseau, rend juste NOM et Prénom dans une case
$sql = "SELECT concat (u.first_name,' ', u.last_name)
FROM users u, contacts c
WHERE u.username = c.username_user2 
AND c.connected = 0
AND c.username_user1 = '".$_SESSION['myusername']."'";
echo $sql;

///Cas de la recherche attention changer variable ! ici username alors que c'est les valeurs du champs recherches
$sql = "SELECT first_name, last_name
FROM users
WHERE (first_name LIKE '".$_SESSION['myusername']."%' OR last_name LIKE '".$_SESSION['myusername']."%' OR '".$_SESSION['myusername']."' = graduation)";
echo $sql;///ATTENTION
    
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