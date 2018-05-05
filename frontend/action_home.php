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
        
        $sql2 = "SELECT v.first_name, v.last_name, com.timestamp AS time, com.content
FROM posts p, users u, users v, comments com WHERE (p.username = '".$_SESSION['myusername']."'  AND com.post_id = p.post_id AND com.username_user = v.username AND p.username = u.username) OR (p.username != '".$_SESSION['myusername']."' AND (p.privacy = 'public' OR (p.privacy = 'contacts' AND ('".$_SESSION['myusername']."' = (SELECT c.username_user1 FROM contacts c WHERE c.username_user2 = p.username AND c.connected = 1 LIMIT 1) OR ('".$_SESSION['myusername']."' = (SELECT c.username_user2 FROM contacts c WHERE c.username_user1 = p.username AND c.connected = 1 LIMIT 1)))) OR ('".$_SESSION['myusername']."' = (SELECT g.username FROM group_member g WHERE g.group_id = p.privacy LIMIT 1)))AND u.username = p.username) ORDER BY p.timestamp DESC";
        

        $result2 = mysqli_query($db_handle, $sql2) or die(mysql_error());
        
        
        while($data = mysqli_fetch_assoc($result)) {
        print '<h3 class="post-title">'.$data['first_name'].' '.$data['last_name'].'</h3>';
        print '<p class="post-content"></p>';
        print '<p class="post-content">'.$data['text'].'</p>';
        print '<div class="post-bottom">
                            <button onclick="'; echo "document.getElementById('".$data['post_id']."').style.display='block'";
                            print '" name="comment" class="submit-post" id=""><img class="icon" alt="Go" src="img/menu/list-with-dots.png"></button>
                            
               </div>';
        print '<span class="time-left">'.$data['timestamp'].'</span>';
        print '<div id="'.$data['post_id'].'" class="modal">

            <form class="modal-content animate" action="/action_comment.php" method="post">
                <div class="imgcontainer">
                    <span onclick="'; echo "document.getElementById('".$data['post_id']."').style.display='none'";
                    print '" class="close" title="Close Modal">&times;</span>
                </div>';
                while($data2 = mysqli_fetch_assoc($result2)) {
                    print '<h4 class="post-title">'.$data2['first_name'].' '.$data2['last_name'].' a commenté :</h4>';
                    print '<p class="comment-content">'.$data2['content'].'<span class="time-right">'.$data2['time'].'</span></p>';
                }
                print '
                <div class="container">
                    <label for="uname"><b>Votre commentaire :</b></label>
                    <input type="text" placeholder="Entrez ici votre commentaire" name="uname">
                </div>
                
                <input type="text" name="post_id" value="'.$data['post_id'].'"readonly>
                
                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="'; echo "document.getElementById('".$data['post_id']."').style.display='none'";
                    print '" class="cancelbtn" value="annuler">Annuler</button>
                    <button type="submit" name="post-comment" class="postbtn">Commenter</button>
                    <button type="submit" formaction="/action_like.php" name="like" class="submit-post" id=""><img class="icon" alt="like" src="img/menu/like.png"></button>
                    <button onclick="" name="share" class="submit-post" id=""><img class="icon" alt="share" src="img/menu/share.png"></button>
                </div>
            </form>
        </div>';
    }

    }
    else { echo "Base de données non trouvée."; }

    mysqli_close($db_handle);}


    
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