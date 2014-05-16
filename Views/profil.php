<?php
include "sessionInit.php";

if (!isset($_SESSION['check']))
{
  echo "<script type=\"text/javascript\">alert(\"Accès interdit !!\");location =\"co.php\"</script>";
}
else if ($_SESSION['check'] != "1")
{
  echo "<script type=\"text/javascript\">alert(\"Accès interdit !!\");location =\"co.php\"</script>";
}

?>
<?php
include "sessionInit.php";
require_once "dataRef.php";
?>
<!doctype html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style3.css" />
  <link rel="stylesheet" type="text/css" href="styleFooter.css"/>

  <meta charset="UTF-8">
  <title>[Why] - Profil</title>
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
  #formUserMod {
    margin-left:20%;
    font-size:large;
  }
  #formUserMod button{
   width : 100px;
   height : 50px;
   position : absolute;
   left: 105px;
   top: 232px;
 }
 #formUserMod input{
  width : 300px;
  margin-left:+2%;
}
#formUserMod #but1{
}
#formUserMod #but2{
  top: 288px;
}
#formUserMod #but3{
  top: 344px;
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
<div id='cssmenu'>
  <ul>
   <li class='last'><a href='accueil.php'><span>Home</span></a></li>
   <li><a href='messages.php'><span>Messages</span></a></li>
   <li class='active'><a href='profil.php'><span>Mon Profil</span></a></li>
   <li><a href='abo.php'><span>Abonnements</span></a></li>
   <li class='last'><a href='deconnect.php'><span>Déconnexion</span></a></li>
 </ul>
</div>

<div id="sidebarl">
  <?php
  if(isset($_SESSION['login']))
  {
    $login = $_SESSION['login'];
    $id = getUserID($login);
    //Traitement du formulaire de mise a jour des donnees personnelles
    if (isset($_POST['login'])) {
      if (setUserField($id,"login",$_POST['login']) == false)
       echo "Error on field \"login\"";
     else {
      $login = $_POST['login'];
      $_SESSION['login'] = $login;
    }
  }
  if (isset($_POST['email'])) {
    if (setUserField($id,"email",$_POST['email']) == false)
      echo "Error on field \"email\"";
  }
  if (isset($_POST['name'])) {
    if (setUserField($id,"name",$_POST['name']) == false)
      echo "Error on field \"name\"";
  }
  if (isset($_POST['firstname'])) {
    if (setUserField($id,"firstname",$_POST['firstname']) == false)
      echo "Error on field \"firstname\"";
  }
  if (isset($_POST['postalcode'])) {
    if (setUserField($id,"postalcode",$_POST['postalcode']) == false)
      echo "Error on field \"postcode\"";
  }
    //Changement de mot de passe  et effacement de l utilisateur
  if (isset($_POST['deluser']) || isset($_POST['changepasswd'])) {
    	//suppression de l utilisateur avec controle du mot de passe
    if (isset($_POST['deluser'])) {
     if (isset($_POST['passwd'])) {
       if (userConnect($id,$login) == true) {
         delUser($id);
         echo "Votre compte a été supprimé avec succès !";
         include "deconnect.php";
       }
       else
         echo "Erreur de mot de passe.";
     }
     else {
       echo "Si vous souhaitez vraiment effacer votre utilisateur, merci de re-saisir votre mot de passe :";
       echo "<form method=\"POST\" action=\"profil.php\"><input type=hidden name=deluser /><input type=password name=passwd />";
       echo "<input type=submit value=\"Valider\"></form>";}
     }
     if (isset($_POST['changepasswd'])) {
      	//Changement du mot de passe
      if (isset($_POST['passwd']) || isset($_POST['newpasswd'])) {
        if (userConnect($id,$login) == true) {
          setUserField($id,"password",md5($_POST['newpasswd']));
          echo "Votre mot de passe a été modifié.";
        }
        else
          echo "Erreur de mot de passe.";
      }
      else {
       echo "Si vous souhaitez modifier votre mot de passe, merci de le saisir une nouvelle fois :";
       echo "<form method=\"POST\" action=\"profil.php\"><input type=hidden name=changepasswd /><input type=password name=passwd />";
       echo "<br>Veuillez saisir votre nouveau mot de passe : ";
       echo "<input type=password name=newpasswd />";
       echo "<br><input type=submit value=\"Valider\"></form>";}
     }
   }
    //Affichage des info personnelles
   else {?>
   <div class="ribbon">
    <div class="theribbon">
      Voici le compte-rendu de vos informations personnelles : </div>
      <div class="ribbon-background"></div>
    </div>
    <?php
    echo "</br>Nombre d'abonnés : ".getSubscriberNumber($id);
    echo "<form id=\"formUserMod\" method=\"POST\" action=\"profil.php\"></br>"
    ."User name : </br><input type=text name=login  value=\"".$login."\" <br>";
    echo "</br>E-Mail : </br><input type=text name=email  value=\"".getUserInfo("email",$id)."\" />";
    echo "</br>Name : </br><input type=text name=name  value=\"".getUserInfo("name",$id)."\" />";
    echo "</br>First name : </br><input type=text name=firstname  value=\"".getUserInfo("firstname",$id)."\" />";
    echo "</br>Postal code : </br><input type=text name=postalcode value=\"".getUserInfo("postalcode",$id)."\" /><br>";
    echo "<button id=\"but1\"type=submit value=\"Modifiez vos infos personnelles\"/>Modifiez vos infos personnelles</button>";
    echo "</form>";
    echo "<form id=\"formUserMod\" method=\"POST\" action=\"profil.php\">"
    ."<button id=\"but2\"type=submit value =\"Changer le mot de passe\" name=changepasswd>Changer le mot de passe</button></form>";
    echo "<form id=\"formUserMod\" method=\"POST\" action=\"profil.php\">"
    ."<button id=\"but3\"type=submit value=\"Effacer le compte\" name=deluser>Effacer le compte</button></form>";}
  }
  else
    header('Location: index.php');
  ?>

</div>

<div id="sidebarr">
<div id="affpost">

  <?php
//Affichage des Posts
  echo "<div class=\"theribbon1\">Voici la liste de vos posts :</div><br>";
  $post = showPostByUser($id);
  for ($i = 0; isset($post[0][$i]); $i++)
  {
    echo "<b>".$post[1][$i]."</b><br>";
    // echo "Catergorie ".getCategory($post[4][$i])."<br>";
    echo "| ".$post[3][$i]."<br>";
    //echo "Tags : ".$post[5][$i]."<br>";
    echo "<small>Publie le ".$post[7][$i]."</small><br>";
    echo "<br>";
  }
  ?>
 
  </div>
 <div id="affstat">
  <?php
//Affichage des Posts
  echo "<div class=\"theribbon1\">Voici la liste de vos stats :</div><br>";
  //$post = showPostByUser($id);
  for ($i = 0; isset($post[0][$i]); $i++)
  {
    echo "<b>".$post[1][$i]."</b><br>";
    // echo "Catergorie ".getCategory($post[4][$i])."<br>";
    echo "| ".$post[3][$i]."<br>";
    //echo "Tags : ".$post[5][$i]."<br>";
    echo "<small>Publie le ".$post[6][$i]."</small><br>";
    echo "<br>";
  }
  ?>
  </div>

 </div> 
<div id="cadrage-f">
	<div id="footer">
		<a href='contactForm.php'><span id="b-left">Contact</span></a>
		<a href='faq.php'><span id="b-middle">Faq</span></a>
		<a href='co.php'><span id="b-right">Inscription</span></a>
	</div>
</div>
</body>
</html>
