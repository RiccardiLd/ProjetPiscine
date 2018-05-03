<?php
/* Ci-dessous, la fonction qui prend un parametre le num utilisateur
et affiche son nom*/
function blabla($num_u)
{
	$database='linkece';
	$db_handle=mysqli_connect('localhost', 'root', '');
	$db_found=mysqli_select_db($db_handle,$database);
	
    if($db_found) {
		
		
		
		$sql = "SELECT* FROM users WHERE username = $num_u "; ///REQUETE SQL
		$result = mysqli_query($db_handle, $sql) or die(mysql_error())  ;
		while($data = mysqli_fetch_assoc($result)) {
		 echo $data['Nom'];
	}}
		
		}
    else { echo "Base de données non trouvée."; }

	mysqli_close($db_handle);
		
			
        }
				

?>