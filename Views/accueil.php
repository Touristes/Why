<?php
include "sessionInit.php";
include "dataRef.php";

if (!isset($_SESSION['check']))
{
	echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
else if ($_SESSION['check'] != "1")
{
	echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}

?>
<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style1.css" />
	<link rel="stylesheet" type="text/css" href="styleFooter.css"/>

	<meta charset="UTF-8">
	<title>[Why] - Accueil</title>
</head>

<body>
	<div id="cadrage">
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
				<li class='active'><a href='accueil.php'><span>Home</span></a></li>
				<li ><a href='messages.php'><span>Messages</span></a></li> 
				<li><a href='profil.php'><span>Mon Profil</span></a></li>
				<li><a href='abo.php'><span>Abonnements</span></a></li>
				<li class='last'><a href='deconnect.php'><span>Déconnexion</span></a></li>
			</ul>
		</div>
		<div id="post">
			<form id="signup" name="monform" method="post" action="send_post.php">
				<textarea cols="60" rows="1" name="title" placeholder="title" required></textarea>
				<textarea cols="60" rows="5" name="posts" required></textarea>
				<div id="post1">
					Type:
					<select>
						<option value="news">News</option>
						<option selected value="troll">Troll</option>
					</select>
					Tags: -- 
					Ajouter un fichier: 
					<div id="fichier">
						<input type="file" name="file"/>
					</div>
				</div>
	 <?php /* <div id="post1">
	  <input type="text" placeholder="Ajoute un lien" name="mail"   required>
	</div>*/ ?>
	<button type="submit">Post !</button>
</form>
</div>

<div id="sidebarl">
	test
	test2
</div>

<div id="gen">
	<?php
	$post = showAllPost();

	for ($i = 0 ; $post[0][$i] ; $i++)
	{
		echo "<div>";
		echo $post[6][$i];
		echo " -- ";
		echo $post[1][$i];
		echo " par: ";
		$login =  getUserInfo("login", $post[2][$i]);
		echo $login;
		echo "</br>";
		echo $post[3][$i];
		echo "<br/>";
		echo "</div>";
		echo"<br/>";
	}
	?>
</div>

<div id="sidebarr">
	test
</div>
<div id="footer">
	<a href='contactForm.php'><span id="b-left">Contact</span></a>
	<a href='faq.php'><span id="b-middle">Faq</span></a>
	<a href='co.php'><span id="b-right">Inscription</span></a>
</div>
</div>
</body>
</html>
