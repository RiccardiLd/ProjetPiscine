<?php
session_start();
$sql = "SELECT u.first_name, u.last_name, n.timestamp
FROM users u, notifications n
WHERE n.user_receive = '".$_SESSION['myusername']."' AND n.user_create = u.username";
echo $sql;

?>