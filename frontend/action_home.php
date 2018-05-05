<?php
session_start();


function posts(){
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT u.first_name, u.last_name, p.text, p.timestamp, p.post_id
FROM posts p, users u WHERE (p.username = '".$_SESSION['myusername']."' AND p.username = u.username) OR (p.username != '".$_SESSION['myusername']."' AND (p.privacy = 'public' OR (p.privacy = 'contacts' AND ('".$_SESSION['myusername']."' = (SELECT c.username_user1 FROM contacts c WHERE c.username_user2 = p.username AND c.connected = 1 LIMIT 1) OR ('".$_SESSION['myusername']."' = (SELECT c.username_user2 FROM contacts c WHERE c.username_user1 = p.username AND c.connected = 1 LIMIT 1)))) OR ('".$_SESSION['myusername']."' = (SELECT g.username FROM group_member g WHERE g.group_id = p.privacy LIMIT 1)))AND u.username = p.username) ORDER BY p.timestamp DESC";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());

        while($data = mysqli_fetch_assoc($result)) {
        print '<h3 class="post-title">'.$data['first_name'].' '.$data['last_name'].'</h3>';
        print '<p class="post-content"></p>';
        print '<p class="post-content">'.$data['text'].'</p>';
        print '<div class="post-bottom">
                            <button onclick="" name="comment" class="submit-post" id="'.$data['post_id'].'"><img class="icon" alt="Go" src="img/menu/coment.png"></button>
                            <button name="like" class="submit-post" id="'.$data['post_id'].'"><img class="icon" alt="Go" src="img/menu/like.png">'.$data['post_id'].'</button>
                            <button onclick="" name="share" class="submit-post" id="'.$data['post_id'].'"><img class="icon" alt="Go" src="img/menu/share.png"></button>
               </div>';
        print '<span class="time-left">'.$data['timestamp'].'</span>';
    }

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}




function like(){ header('Location:home.php');
    /*$database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "INSERT INTO likes (username_user, post_id, timestamp) VALUES ('".$_SESSION["myusername"]."', '3', NOW());
".$_SESSION['myusername']."' THEN username_user2 
        WHEN username_user2 = '".$_SESSION['myusername']."' THEN username_user1 
        ELSE NULL 
        END AS NewField 
        FROM contacts WHERE (username_user2 = '".$_SESSION['myusername']."' OR username_user1 = '".$_SESSION['myusername']."') AND connected = 1)";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());

        $data = mysqli_fetch_assoc($result);
        echo $data['nb'];

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);*/}




    
    function nb_con(){
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT COUNT(*) AS nb FROM users WHERE username IN (SELECT 
        CASE WHEN username_user1 = '".$_SESSION['myusername']."' THEN username_user2 
        WHEN username_user2 = '".$_SESSION['myusername']."' THEN username_user1 
        ELSE NULL 
        END AS NewField 
        FROM contacts WHERE (username_user2 = '".$_SESSION['myusername']."' OR username_user1 = '".$_SESSION['myusername']."') AND connected = 1)";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());

        $data = mysqli_fetch_assoc($result);
        echo $data['nb'];

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}


    function nb_posts(){
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT COUNT(*) AS nb FROM posts WHERE username = '".$_SESSION["myusername"]."'";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());

        $data = mysqli_fetch_assoc($result);
        echo $data['nb'];

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}



function skills(){
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
        $sql = "SELECT concat (skill,' (', skill_level,')') AS sk FROM skills WHERE username = '".$_SESSION["myusername"]."'";

        $result = mysqli_query($db_handle, $sql) or die(mysql_error());

        while($data = mysqli_fetch_assoc($result)) {
        echo $data['sk'].'<br>';
    }

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}
    
function post($var,$group)
{
    $database='linkedoff';
    $db_handle=mysqli_connect('localhost', 'root', 'root');       
    $db_found=mysqli_select_db($db_handle,$database);

    if($db_found) {            
       $sql =  "INSERT INTO posts(post_id, username, privacy, type, text, content, timestamp, id_shared_post) VALUES('','".$_SESSION["myusername"]."','".$group."',null,'".$var."',null,NOW(),null)";
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        
        if($group != 'public') {
        $sql =  "SELECT post_id, username FROM posts WHERE 1 ORDER BY timestamp DESC LIMIT 1";
        $result = mysqli_query($db_handle, $sql) or die(mysql_error());
        $data = mysqli_fetch_assoc($result);
            
            if($group == 'contacts') {
                $sql = "SELECT username FROM users WHERE username IN (SELECT 
CASE WHEN username_user1 = '".$_SESSION['myusername']."' THEN username_user2 
	 WHEN username_user2 = '".$_SESSION['myusername']."' THEN username_user1 
     ELSE NULL 
     END AS NewField 
FROM contacts WHERE (username_user2 = '".$_SESSION['myusername']."' OR username_user1 = '".$_SESSION['myusername']."') AND connected = 1)";
                $result = mysqli_query($db_handle, $sql) or die(mysql_error());
                
                while($data2 = mysqli_fetch_assoc($result)) {
                    $sql =  "INSERT INTO notifications(notif_id, parent_id, type, seen, timestamp, user_create, user_receive) VALUES('','".$data['post_id']."','post','',NOW(),'".$data['username']."','".$data2['username']."')";
                    $result = mysqli_query($db_handle, $sql) or die(mysql_error());
                }
            }
        }
    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);
}
?>