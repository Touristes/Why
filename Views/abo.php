<?php
include "sessionInit.php";
require_once "userProfilModel.php";

if (!isset($_SESSION['check']))
{
	echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
else if ($_SESSION['check'] != "1")
{
	echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}

?>
<?php
include "sessionInit.php";
require_once "dataRef.php";
$login = $_SESSION['login'];
?>
<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style3.css" />
	<link rel="stylesheet" type="text/css" href="styleFooter.css"/>

	<meta charset="UTF-8">
	<title>[Why] - Abonnements</title>
</head>

<body>
	<style>
	.ribbon {padding-left:0px}
	.ribbon-background {position:absolute;top:0;right:0;font-size:8px;color:#cccccc;}
	.ribbon-background a {color:#cccccc;text-decoration:none;font-weight:normal;}
	.ribbon-background a:hover {color:#cccccc;text-decoration:none;font-weight:normal;}
	.theribbon{position: relative;width: 465px;font-size: 1.5em;font-weight: bold;padding: 6px 20px 6px 35px;margin: 0px 0px 10px -30px;color: #fefefe;background-color: #2493ff;text-shadow: 0px 1px 2px #bbb;-webkit-box-shadow: 0px 2px 4px #888;-moz-box-shadow: 0px 2px 4px #888;box-shadow: 0px 2px 4px #888;}
	.theribbon1{position: relative;width: 250px;font-size: 1.5em;font-weight: bold;padding: 6px 20px 6px 35px;margin: 0px 0px 10px -30px;color: #fefefe;background-color: #2493ff;text-shadow: 0px 1px 2px #bbb;-webkit-box-shadow: 0px 2px 4px #888;-moz-box-shadow: 0px 2px 4px #888;box-shadow: 0px 2px 4px #888;}
	.theribbon:before, .theribbon:after {content: ' ';position: absolute;width: 0;height: 0;}
	.theribbon:before{}
	.theribbon:after{left: 0px;top: 100%;border-width: 5px 10px;border-style: solid;border-color: #666666 #666666 transparent transparent;}
	.theribbon1:before, .theribbon1:after {content: ' ';position: absolute;width: 0;height: 0;}
	.theribbon1:before{}
	.theribbon1:after{left: 0px;top: 100%;border-width: 5px 10px;border-style: solid;border-color: #666666 #666666 transparent transparent;}
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
			<li><a href='profil.php'><span>Mon Profil</span></a></li>
			<li class='active'><a href='abo.php'><span>Abonnements</span></a></li>
			<li class='last'><a href='deconnect.php'><span>Déconnexion</span></a></li>
		</ul>
	</div>
	<div id="sidebarl">
		<?
if(isset($_POST['requete']) && $_POST['requete'] != NULL) // on vérifie d'abord l'existence du POST et aussi si la requete n'est pas vide.
{
	$requete = htmlspecialchars($_POST['requete']); // on crée une variable $requete pour faciliter l'écriture de la requête SQL, mais aussi pour empêcher les éventuels malins qui utiliseraient du PHP ou du JS, avec la fonction htmlspecialchars().
	$result = SearchUser($requete);
	if($result != FALSE) // si le nombre de résultats est supérieur à 0, on continue
{
	echo "<h3>Resultat de votre recherche :</h3></br>";
	?>
	<form name="abo" action="" method="POST">
		<?
		if ($val != $login && isSubrscriberOf(getUserID($login), getUserID($result)) == "false")
		{
			?>

			<input type="checkbox" name="choice[]" value="<? echo $result; ?>"> <? echo $result; ?><br>
			<?
		}
		echo "</br><button type=submit value=\"Ajouter a mes abonnements !\"/>Ajouter a mes abonnements !</button>";
		?>
	</form>
	<br/>
	<br/>
	<a href="abo.php">Faire une nouvelle recherche</a></p>
	<?
} // Fini d'afficher les résultats ! Maintenant, nous allons afficher l'éventuelle erreur en cas d'échec de recherche et le formulaire.
else
{ // de nouveau, un peu de HTML
	?>
	<div class="ribbon">
		<div class="theribbon1">
			Pas de résultats
		</div>
		<div class="ribbon-background"></div>
	</div>
	<p>Nous n'avons trouvé aucun résultat pour votre requête "<? echo $_POST['requete']; ?>". <a href="abo.php">Réessayez</a> avec autre chose.</p>
	<?
}// Fini d'afficher l'erreur ^^
}
else
{ // et voilà le formulaire, en HTML de nouveau !
	?>
	<div class="ribbon">
		<div class="theribbon">Vous pouvez rechercher un User particulier :</div>
		<div class="ribbon-background"></div>
	</div>
	<form action="abo.php" method="Post">
		<input type="text" name="requete" size="20">
		<input type="submit" value="Ok">
	</form>
	<?
}
?>
</br>
</br>
<div class="ribbon">
	<div class="theribbon1">
		Liste de tous les Users :</div>
		<div class="ribbon-background"></div>
	</div>
	<?
	$tab = getUserList();
	?>
	<form name="abo" action="" method="POST">
		<?
		foreach($tab as $val)
		{
			if ($val != $login && isSubrscriberOf(getUserID($login), getUserID($val)) == "false")
			{
				?>

				<input type="checkbox" name="choice[]" value="<? echo $val; ?>"> <? echo profilLinkInForm($val); ?><br>
				<?
			}
		}
		echo "</br><button type=submit value=\"Ajouter a mes abonnements !\"/>Ajouter a mes abonnements !</button>";
		?>
	</form>
	<?
	if(isset($_POST['choice']))
	{
		$choice = $_POST['choice'];
		for ($i = 0; isset($choice[$i]); $i++)
		{
			addSubscription(getUserID($login), getUserID($choice[$i]));
		}
		?>
		<meta http-equiv="refresh" content="0">
		<?
	}
	?>
</div>
<div id="sidebarr">
	<div class="ribbon">
		<div class="theribbon1">
			Mes abonnements :</div>
			<div class="ribbon-background"></div>
		</div>
		<?
		$tab = getSubscriptionList(getUserID($login));
		?>
		<form name="delabo" action="" method="POST">
			<?
			for ($i = 0; isset($tab[$i]); $i++)
			{
				?>
				<input type="checkbox" name="choice1[]" value="<? echo $tab[$i]; ?>"> <? echo profilLinkInForm($tab[$i]); ?><br>
				<?
			}
			echo "</br><button type=submit value=\"Supprimer de mes abonnements !\"/>Supprimer de mes abonnements !</button>";
			?>
		</form>
		<?
		if(isset($_POST['choice1']))
		{
			$choice1 = $_POST['choice1'];
			for ($i = 0; isset($choice1[$i]); $i++)
			{
				delSubscription(getUserID($login), getUserID($choice1[$i]));
			}
			?>
			<meta http-equiv="refresh" content="0">
			<?
		}
		?>
	</br>
	<div class="ribbon">
		<div class="theribbon1">
			Mes abonnés :
		</div>
		<div class="ribbon-background"></div>
	</div>
	<?
	$tab1 = getSubscriberList(getUserID($login));

	for ($i = 0; isset($tab1[$i]); $i++)
	{
// echo "> ";
		echo profilLinkForm($tab1[$i]);
		echo "<br>";
	}
	?>
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
