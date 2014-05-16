<?php
include "sessionInit.php";
require_once "dataRef.php";
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
<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style1.css" />
	<link rel="stylesheet" type="text/css" href="styleFooter.css"/>

	<meta charset="UTF-8">
	<title>[Why] - Messagerie</title>
</head>

<body>
	<style>
	#formMenuBox {
		margin-top:0.4%;
		margin-left:0.4%;
	}
	#formMenuBox button {
		border:0;
		width:150px;
		height:40px;
		background-color:#aFaFaF;
	}
	#fromNewMessage{
		margin-left:0.4%;
		margin-top:0.1%;
	}
	#receiver {
		width:144px;
	}
	#content {
		width:455px;
		height:150px;
	}
	#fromNewMessage button{
		border:0;
		width:60px;
		height:30px;
		background-color:#a0F0a0;
	}
	#messageList {
		list-style-image: url('./triforce.png');;
	}
	#messageList button{
		height:20px;
		border:0;
		background-color:#F0F0F0;
		margin-top:+1px;
	}
	#delMessage {
		background: url('./DeleteButton.png') no-repeat;
		width:15px;
		height:15px;
		border:0;
		margin-left:0.4%;
	}
	#response {
		height:15px;
		border:0;
		background-color:#F0F0F0;
		position:absolute;
		margin-left:5px;
		margin-top:6px;
	}
	#messageContent {
		margin-left:1%;
	}
	#messageText {
		margin-left:2%;
	}
	#formProfilView {
		display:inline-block;
	}
	#userLink {
		border:0;
	}
	</style>
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
				<li class='last'><a href='accueil.php'><span>Home</span></a></li>
				<li class='active'><a href='messages.php'><span>Messages</span></a></li>    
				<li><a href='profil.php'><span>Mon Profil</span></a></li>
				<li><a href='abo.php'><span>Abonnements</span></a></li>
				<li class='last'><a href='deconnect.php'><span>Déconnexion</span></a></li>
			</ul>
		</div>
		<div id="post">
<?php //Boite de reception, boite d'envoi, nouveau message
$login = $_SESSION['login'];
$id = getUserID($login);
?>
<form id="formMenuBox" method="POST" action="messages.php" name="formMenuBox">
	<button type="submit" value ="newMessage" name="newMessage">Nouveau message</button>
	<button type="submit" value ="Boite de reception" name="receptionBox">Boîte de réception</button>
	<button type="submit" value ="Boite d'envoi" name="sendBox">Boîte d'envoi</button>
</form>
<?php //contenu de la page
//Nouveau message
if (isset($_POST['newMessage'])) {
	echo "<form id=\"fromNewMessage\" method=\"POST\" action=\"messages.php\" name=\"formNewMessage\">";
	if ($_POST['newMessage'] != "newMessage") {
		echo "<input id=\"receiver\" type=text name=messageReceiverLogin value=\"".$_POST['newMessage']."\" required />";
	}
	else
		echo "<input id=\"receiver\"type=text placeholder=\"login du destinataire\" name=messageReceiverLogin  required />";
	echo "<br><textarea id=\"content\"placeholder=\"Contenu de votre message\" name=messageContent cols=\"40\" rows=\"5\" required></textarea>"
	. "<br><button type=\"submit\" value =\"newMessageSend\" name=\"newMessageSend\">Envoyer</button>"
	. "</form>";
}
//Boite de reception
else if (isset($_POST['receptionBox'])) {
	$messageList = getMessageReceptionList($id);
	if ($messageList[0] == "")
		echo "<br>Votre boîte de reception est vide";
	echo "<ul id=\"messageList\">";
	for ($i = 0; isset($messageList[$i]); $i++)
	{
		echo "<li><form id=\"formMessageID\" method=\"POST\" action=\"messages.php\" name=\"formMessageID\">"
		."<button type=\"submit\" name =\"Message\" value=\"".$messageList[$i]."\">"
		.getMessageDate($messageList[$i])." : "
		.getUserInfo("login", getMessageSender($messageList[$i]))."</button></form></li>";
	}
	echo "</ul>";
}
//Boite d'envoi
else if (isset($_POST['sendBox'])) {
	$messageList = getMessageSendList($id);
	if ($messageList[0] == "")
		echo "<br>Votre boîte d'envoi est vide";
	echo "<ul id=\"messageList\">";
	for ($i = 0; isset($messageList[$i]); $i++)
	{
		echo "<li><form id=\"formMessageID\" method=\"POST\" action=\"messages.php\" name=\"formMessageID\">"
		."<button type=\"submit\" name=\"Message\" value=\"".$messageList[$i]."\">"
		.getMessageDate($messageList[$i])." : "
		.getUserInfo("login", getMessageReceiver($messageList[$i]))."</button></form></li>";
	}
	echo "</ul>";
}
//Envoi du noveau message
else if (isset($_POST['newMessageSend']))
{
	if (isUsernameExist($_POST['messageReceiverLogin']) == FALSE) {
		echo "<br>Le nom d'utilisateur ".$_POST['messageReceiverLogin']." n'existe pas.<br>";
	}
	else {
		addMessage($_POST['messageContent'], $id, getUserID($_POST['messageReceiverLogin']));
		echo "<br> Votre message a bien été envoyé.";
	}
}
//Contenu du message
else if (isset($_POST['Message']))
{
	$id_message = $_POST['Message'];
	$id_sender = getMessageSender($id_message);
	$id_receiver = getMessageReceiver($id_message);
	echo "<form id=\"formMessage\" method=\"POST\" action=\"messages.php\" name=\"formMessage\">";
	echo "<button id=\"delMessage\" type=\"submit\" value =\"".$id_message."\" name=\"delMessage\">"
	."</button>";
	if ($id == $id_sender)
		echo "<button id=\"response\" type=\"submit\" value =\"".getUserInfo("login",$id_receiver)."\" name=\"newMessage\">Relancer</button>";
	else if ($id == $id_receiver)
		echo "<button id=\"response\" type=\"submit\" value =\"".getUserInfo("login",$id_sender)."\" name=\"newMessage\">Repondre</button>";
	echo "</form>";
	echo "<div id=\"messageContent\">";
	if ($id == $id_sender)
		echo "<br><small>Message envoyé a ".profilLinkForm(getUserInfo("login", $id_receiver))."</small>";
	else if ($id == $id_receiver)
		echo "<br><small>Message reçu par ".profilLinkForm(getUserInfo("login", $id_receiver))."</small>";
	echo "<br><div id=\"messageText\">" . getMessageContent($id_message) ."</div>";
	echo "<small>Reçu le : ".getMessageDate($id_message)."</small>";
	echo "</div>";
}
//Effacement du message
else if (isset($_POST['delMessage']))
{
	$id_message = $_POST['delMessage'];
	if (delMessage($id_message))
		echo "<br>Votre message a bien été effacé.";
	else
		echo "<br>Le message que vous tentez d'effacer n'existe pas.";
}
//Affichage de la boite de reception par défaut
else {
	$messageList = getMessageReceptionList($id);
	if ($messageList[0] == "")
		echo "<br>Votre boîte de réception est vide";
	echo "<ul id=\"messageList\">";
	for ($i = 0; isset($messageList[$i]); $i++)
	{
		echo "<li><form id=\"formMessageID\" method=\"POST\" action=\"messages.php\" name=\"formMessageID\">"
		."<button type=\"submit\" name =\"Message\" value=\"".$messageList[$i]."\">"
		.getMessageDate($messageList[$i])." : "
		.getUserInfo("login", getMessageSender($messageList[$i]))."</button></form></li>";
	}
	echo "</ul>";
}
?>
</div>
<div id="footer">
	<a href='contactForm.php'><span id="b-left">Contact</span></a>
	<a href='faq.php'><span id="b-middle">Faq</span></a>
	<a href='co.php'><span id="b-right">Inscription</span></a>
</div>
</body>
</html>
