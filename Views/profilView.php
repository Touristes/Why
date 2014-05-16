<?php
include "sessionInit.php";
require_once "dataRef.php";
require_once "userProfilModel.php";

//Test si l'utilisateur sest connecté
if (!isset($_SESSION['check']))
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
else if ($_SESSION['check'] != "1")
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
if (isUsernameExist($_POST['loginProfilView']) == false) {
  echo "<SCRIPT LANGUAGE=\"JavaScript\">document.location.href=\"accueil.php\"</SCRIPT>";
}
$login = $_POST['loginProfilView'];
if ($login == $_SESSION['login']) {
  echo "<SCRIPT LANGUAGE=\"JavaScript\">document.location.href=\"profil.php\"</SCRIPT>";
}
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style3.css" />

<meta charset="UTF-8">
  <title>[Why] - <?php echo $login ?></title>
</head>

<body>
<style>
  .ribbon {padding-left:0px}
.ribbon-background {position:absolute;top:0;right:0;font-size:8px;color:#cccccc;}
.ribbon-background a {color:#cccccc;text-decoration:none;font-weight:normal;}
.ribbon-background a:hover {color:#cccccc;text-decoration:none;font-weight:normal;}
.theribbon{position: relative;width: 465px;font-size: 1.5em;font-weight: bold;padding: 6px 20px 6px 35px;margin: 0px 0px 10px -30px;color: #fefefe;background-color: #2493ff;text-shadow: 0px 1px 2px #bbb;-webkit-box-shadow: 0px 2px 4px #888;-moz-box-shadow: 0px 2px 4px #888;box-shadow: 0px 2px 4px #888;}
.theribbon1{position: relative;width: 300px;font-size: 1.5em;font-weight: bold;padding: 6px 20px 6px 35px;margin: 0px 0px 10px -30px;color: #fefefe;background-color: #2493ff;text-shadow: 0px 1px 2px #bbb;-webkit-box-shadow: 0px 2px 4px #888;-moz-box-shadow: 0px 2px 4px #888;box-shadow: 0px 2px 4px #888;}
.theribbon:before, .theribbon:after {content: ' ';position: absolute;width: 0;height: 0;}
.theribbon:before{}
.theribbon:after{left: 0px;top: 100%;border-width: 5px 10px;border-style: solid;border-color: #666666 #666666 transparent transparent;}
.theribbon1:before, .theribbon1:after {content: ' ';position: absolute;width: 0;height: 0;}
.theribbon1:before{}
.theribbon1:after{left: 0px;top: 100%;border-width: 05px 10px;border-style: solid;border-color: #666666 #666666 transparent transparent;}

#delButton {
background: url('./DeleteButton.png') no-repeat;
width:15px;
height:15px;
border:0;
}
#deletingAccount {
background: url('./DeleteButton.png') no-repeat;
border:0;
width:150px;
height:40px;
margin-top:+1px;
background-color:#aFaFaF;
}
#passwordConfirm {
display:none;
}
#formDelAccount:hover #passwordConfirm {
display:block;
}
#formNewMessage button{
background: url('./message.png') no-repeat;
border:0;
width:150px;
height:40px;
background-color:#aFaFaF;
}
#formSubscribe button{
background: url('./abo.png') no-repeat;
border:0;
width:150px;
height:40px;
margin-top:+1px;
background-color:#aFaFaF;
}
#formUnsubscribe button{
background: url('./abo.png') no-repeat;
border:0;
width:150px;
height:40px;
margin-top:+1px;
background-color:#aFaFaF;
}
</style>
<script>
$('#cssmenu').prepend('<div id="menu-button">Menu</div>');
	$('#cssmenu #menu-button').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
		}
		else {
			menu.addClass('open');
		}
	});
	</script>
<?php //Menu ?>
<div id='cssmenu'>
<ul>
   <li class='last'><a href='accueil.php'><span>Home</span></a></li>
   <li><a href='messages.php'><span>Messages</span></a></li>    
   <li class='last'><a href='profil.php'><span>Mon Profil</span></a></li>
   <li><a href='abo.php'><span>Abonnements</span></a></li>
   <li class='last'><a href='deconnect.php'><span>Déconnexion</span></a></li>
</ul>
</div>




<div id="sidebarl">
<?php
	//Traitement formulaire abonnement
	//Abonnement
	  if (isset($_POST['Subscribe'])) {
	addSubscription(getUserID($_SESSION['login']), getUserID($login));
	}
	//Désabonnement
	  else if (isset($_POST['Unsubscribe'])) {
	delSubscription(getUserID($_SESSION['login']), getUserID($login));
	}
	//Supression de compte si admin
          else if (isset($_POST['delAccount']) && (isUserAdmin(getUserID($_SESSION['login'])) == true)) {
	    if (md5($_POST['rootPassword']) == getUserInfo("password", getUserID($_SESSION['login']))) {
	      delUser(getUserID($login));
	      echo "<script type=\"text/javascript\">alert(\"Le compte a ete suprime !\");document.location.href=\"accueil.php\"</script>";
	    }
	    else {
	      echo "<script type=\"text/javascript\">alert(\"Mauvais mot de passe !\");\"</script>";
		}
	}
	//Supression de post si admin
	  else if (isset($_POST['delPost']) && (isUserAdmin(getUserID($_SESSION['login'])) == true)) {
	    delPost($_POST['delPost']);
	  }
    //Informations utilisateur
    $id = getUserID($login);
    echo "Profil de l'utilisateur ".$login."<br>"
    ."Nombre d'abonnes : ".getSubscriberNumber($id)."<br>"
    ."Nombre d'abonnements : ".getSubscriptionNumber($id)."<br>";
	//Formulaire d'envoi de message, renvoie vers message.php
    echo "<form id=\"formNewMessage\" method=\"POST\" action=\"messages.php\"><button type=\"submit\" value=\""
    .$login."\" name=\"newMessage\">Envoyer un message</button></form>";
	//Bouton abonnement ou désabonnement
	if (isSubrscriberOf(getUserID($_SESSION['login']), getUserID($login)) == "false") {
		echo "<form id=\"formSubscribe\" method=\"POST\" action=\"profilView.php\">"
			."<input type=\"hidden\" name=\"loginProfilView\" value=\"".$login."\">"
			."<button type=\"submit\" value=\"Subscribe\" name=\"Subscribe\">S'abonner</button></form>";
			}
	else {
		echo "<form id=\"formUnsubscribe\" method=\"POST\" action=\"profilView.php\">"
			."<input type=\"hidden\" name=\"loginProfilView\" value=\"".$login."\">"
			."<button type=\"submit\" value=\"Unsubscribe\" name=\"Unsubscribe\">Se désabonner</button></form>";
			}
	//Bouton supression de compte accessible uniquement a l admin
if (isUserAdmin(getUserID($_SESSION['login'])) == true) {
                echo "<form id=\"formDelAccount\" method=\"POST\" action=\"profilView.php\">"
                        ."<input type=\"hidden\" name=\"loginProfilView\" value=\"".$login."\">"
		  ."<button id=\"deletingAccount\" type=\"submit\""
		  ."value=\"delAccount\" name=\"delAccount\">Supprimer le compte</button>"
                  ."<p id=\"passwordConfirm\"> Confirmez par mot de passe : "
		  ."<input type=\"password\" name=\"rootPassword\" required /></p>"
                  ."<br><br><br></form>";
}
?>
</div>
<div id="sidebarr">
      <?php
      //Affichage des Posts
      //(id_post integer primary key autoincrement, title varchar, id_user integer, text varchar, id_category , id_type, created date
      $post = showPostByUser($id);
echo "<form id=\"formPostList\" method=\"POST\" action=\"profilView.php\">"
	."<input type=\"hidden\" name=\"loginProfilView\" value=\"".$login."\">";
for ($i = 0; isset($post[0][$i]); $i++)
	  {
	    //Bouton supprimer accessible uniquement a l admin
	    if (isUserAdmin(getUserID($_SESSION['login'])) == true) {
	      echo "<button type=\"submit\" id=\"delButton\" name=\"delPost\" value=\"".$post[0][$i]."\"></button>";
	    }
	    echo "<b>".$post[1][$i]."</b><br>";
	    // echo "Catergorie ".getCategory($post[4][$i])."<br>";
	    echo "| ".$post[3][$i]."<br>";
	    //echo "Tags : ".$post[5][$i]."<br>";
	    echo "<small>Publie le ".$post[7][$i]."</small><br>";
	    echo "<br>";
	  }
echo "</form>";
	  ?>
</div>

<div id="footer">


</div>

</body>
</html>
