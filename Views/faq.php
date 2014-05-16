<?php
require_once "dataRef.php";
include "sessionInit.php";
?>

<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styleFaq.css" />
	<meta charset="UTF-8">
	<title>[Why] - FAQ</title>
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
	<p>Une question ? Un problème ? Pas de soucis, la réponse est peut-être déjà ici ! Parcours les questions-réponses déjà disponibles, et si tu ne trouves pas ton bonheur, n'hésites-pas à <a href="contactForm.php">nous contacter</a> !</p>
	<h2>[ Questions : ]</h2>
	<?php $id = 1; ?>
	<ul>
		<li><a href="#faq_<?php echo $id++ ?>" id="links">En quoi consiste [Why] ?</a></li>
		<li><a href="#faq_<?php echo $id++ ?>" id="links">De quoi ai-je besoin pour utiliser [Why] ?</a></li>
		<li><a href="#faq_<?php echo $id++ ?>" id="links">Que signifie s'abonner à  quelqu'un sur [Why] ?</a></li>
		<li><a href="#faq_<?php echo $id++ ?>" id="links">Comment savoir à  quelles personnes je suis abonné ?</a></li>
	</ul>
</div>

<div id="middle">
	<?php $id = 1; ?>
	<ul>
		<li id="faq_<?php echo $id++ ?>">
			<h5>En quoi consiste [Why] ?</h5>
			<p>Le faux-texte (Ã©galement appelÃ© lorem ipsum, lipsum) est, en imprimerie, un texte sans valeur sÃ©mantique, permettant de remplir des pages lors d'une mise en forme afin d'en calibrer le contenu en l'absence du texte dÃ©finitif.</p>
		</li>

		<li id="faq_<?php echo $id++ ?>">
			<h5>De quoi ai-je besoin pour utiliser [Why] ?</h5>
			<p>GÃ©nÃ©ralement, on utilise un texte en faux latin (le texte ne veut rien dire, il a Ã©tÃ© modifiÃ©), le Lorem ipsum ou Lipsum, qui permet donc de faire office de texte d'attente. L'avantage de le mettre en latin est que l'opÃ©rateur sait au premier coup d'Å“il que la page contenant ces lignes n'est pas valide, et surtout l'attention du client n'est pas dÃ©rangÃ©e par le contenu, il demeure concentrÃ© seulement sur l'aspect graphique.</p>
		</li>
		<li id="faq_<?php echo $id++ ?>">
			<h5>Que signifie s'abonner Ã  quelquâ€™un sur [Why] ?</h5>
			<p>Il circule des centaines de versions diffÃ©rentes du Lorem ipsum, mais ce texte aurait originellement Ã©tÃ© tirÃ© de l'ouvrage de CicÃ©ron, De Finibus Bonorum et Malorum (Liber Primus, 32), texte populaire Ã  cette Ã©poque, dont l'une des premiÃ¨res phrases est : Â« Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit... Â» (Â« Il n'existe personne qui aime la souffrance pour elle-mÃªme, ni qui la recherche ni qui la veuille pour ce qu'elle est... Â»).</p>
		</li>
		<li id="faq_<?php echo $id++ ?>">
			<h5>Comment savoir Ã  quelles personnes je suis abonnÃ© ?</h5>
			<p>(En gras, le lipsum habituellement utilisÃ©) extrait de : CicÃ©ron 45 AC, De finibus bonorum et malorum, livre I, X, 32

	[32] Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. </p>
		</li>
	</ul>
</div>

<div id="footer">
	<a href='contactForm.php'><span id="b-left">Contact</span></a>
   	<a href='faq.php'><span id="b-middle">Faq</span></a>
   	<a href='co.php'><span id="b-right">Inscription</span></a>

</div>

</body>
</html>
