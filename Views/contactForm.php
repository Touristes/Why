<?php
require_once "dataRef.php";
include "sessionInit.php";
?>

<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styleContactForm.css" />
<meta charset="UTF-8">
<title>[Why] - Contact</title>
</head>
<body>

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
	   <li><a href='abo.php'><span>Abonnements</span></a></li>
	   <li class='last'><a href='deconnect.php'><span>Déconnexion</span></a></li>
	</ul>
</div>

<div id="middle">
	<p>Un <a href="faq.php">problème sans solution</a> ? Des suggestions à faire pour l'amélioration de [Why] ? Ou peut-être souhaites-tu simplement nous déclamer ton amour d'une prose enflammée (en vers, on accepte aussi !) ? N'hésites pas à nous écrire, ton message sera lu !</p>
	</br>
	<div id="align">
		<form id="signup" action="contactForm.php" method="post">
			<ul>
	<?php if ($_SESSION['check'] == "1"): ?>
				<p>Ton pseudo [Why]: <input type="text" name="pseudo" placeholder="ex: SuperWhyId" value="<?php echo getUserInfo("login", getUserID($_SESSION['login'])); ?>" size="25"></p>
				<p>Ton e-mail : <input type="text" name="e-mail" placeholder="ex: e@mail.why" value="<?php echo getUserInfo("email", getUserID($_SESSION['login'])); ?>" size="32"></p>
	<?php else: ?>
				<p>Ton nom : <input type="text" name="pseudo" placeholder="ex: SuperWhyId" style="width:241px;"></p>
				<p>Ton e-mail : <input type="text" name="e-mail" placeholder="ex: e@mail.why" size="32"></p>
	<?php endif; ?>
				<li><select required name="objet" method="post" action=""></li>
				<li><option value="default" disabled>Sélectionne l'objet de ton message</option></li>
				<li><option value="connexion_pb">Problème de connexion</option></li>
				<li><option value="press">Contact presse</option></li>
				<li><option value="other">Autre</option></li>
				</select>
				<br><br>
				Ton message :
				<br>
				<textarea rows="10" cols="40" name="message" placeholder="Tape ton message ici !"></textarea>
				<br>
				<input type="submit" value="Envoyer" style="text-align:center;">
			</ul>
		</form>
	</div>
</div>
<div id="footer">
	<a href='contactForm.php'><span id="b-left">Contact</span></a>
   	<a href='faq.php'><span id="b-middle">Faq</span></a>
   	<a href='co.php'><span id="b-right">Inscription</span></a>
</div>

</body>
</html>


<?php

if (!empty($_POST)){

	$to = "lotzer_a@etna-alternance.net";
	$subject = $_POST['objet'];
	$message = $_POST['message'];

	if (mail($to, $subject, $message))
	   echo "<script type=\"text/javascript\">alert(\"Ton e-mail a peut-être été envoyé !\");location =\"#\"</script>";
	else
		   echo "<script type=\"text/javascript\">alert(\"	On dirait que ton mail n'est pas parti...\");location =\"#\"</script>";
}

?>
