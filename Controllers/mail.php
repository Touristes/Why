<?php
require_once("dataRef.php");
//Generation d un mot de passe aleatoire
function generatePassword() {
  $password = substr(str_shuffle(md5(mt_rand())), 0, 8);
  return ($password);
}

function renewPassword($id) {
  $password = generatePassword();
  $mail = getUserInfo("email", $id);
  $login = getUserInfo("login", $id);
  if (isEmailExist($mail) == false) {
    echo "\nCette adresse mail n'est pas associée à un compte.\n";
    return (false);
  }
  setUserField($id, "password", md5($password));
  if (!sendPasswordMail($mail, $password, $login)) {
    echo "\nErreur technique le mail n'a pas pu être envoyé.\n";
    return (false);
  }
  echo "<br>Vous allez recevoir votre nouveau mot de passe par e-mail.<br>";
  return (true);
}
//Definition du contenu du mail de renouvellement de mot de passe avant envoi
function sendPasswordMail($mail, $password, $login) {
  $passage_ligne = "\n";
  $sujet = "Your new password for why";

  $message_txt = "Bonjour ".$login.",".$passage_ligne;
  $message_txt .= "Un renouvellement de mot de passe a ete demande pour votre compte.".$passage_ligne;
  $message_txt .= "Voici votre nouveau mot de passe : ".$password.$passage_ligne;

  if (sendMail($mail, $message_txt, $sujet, $passage_ligne) == false)
    return (false);
  else
    return (true);
}
//Definition du contenu du mail de suppression de compte avant envoi
function sendDeletingAccountMail($mail, $login) {
  $passage_ligne = "\n";
  $sujet = "Good bye from why";

  $message_txt = "Bonjour ".$login.",".$passage_ligne;
  $message_txt .= "Nous vous confirmons l'effacement de votre comtpe.".$passage_ligne;
  $message_txt .= "Au revoir !".$passage_ligne;

  if (sendMail($mail, $message_txt, $sujet, $passage_ligne) == false)
    return (false);
  else
    return (true);
}
//Definition du contenu du mail de creation de compte avant envoi
function sendCreatingAccountMail($mail, $login) {
  $passage_ligne = "\n";
  $sujet = "Welcome in why";

  $message_txt = "Bonjour ".$login.",".$passage_ligne;
  $message_txt .= "Nous vous confirmons la creation de votre comtpe.".$passage_ligne;

  if (sendMail($mail, $message_txt, $sujet, $passage_ligne) == false)
    return (false);
  else
    return (true);
}
//Definition du contenu du mail de creation notification de message prive avant envoi
function sendMPNotificationMail($mail, $login, $login_sender) {
  $passage_ligne = "\n";
  $sujet = "Why : vous avez recu un nouveau message";

  $message_txt = "Bonjour ".$login.",".$passage_ligne;
  $message_txt .= "Vous avez recu un nouveau message de ".$login_sender." .".$passage_ligne;

  if (sendMail($mail, $message_txt, $sujet, $passage_ligne) == false)
    return (false);
  else
    return (true);
}
//Definition du contenu du mail de contact
function sendContactMail($login, $message) {
  $mail = "whyproject.2sn@gmail.com";
  $passage_ligne = "\n";
  $sujet = "New message from ".$login;

  $message_txt = "Bonjour dieu,".$passage_ligne;
  $message_txt .= "L'utilisateur répondant au nom de ".$login.$passage_ligne;
  $message_txt .= "vous a laissé un message :".$passage_ligne;
  $message_txt .= textToMail($message, $passage_ligne);
  $message_txt .= $passage_ligne;
  
  if (sendMail($mail, $message_txt, $sujet, $passage_ligne) == false)
    return (false);
  else
    return (true);
}
//Définition de la fonction permettant de mettre en forme un texte pour  l'envoyer par mail
function textToMail($message, $passage_ligne) {
	$final_message = wordwrap($message, 60, $passage_ligne, true);
	return ($final_message);
}
//Configuration automatique du SMTP
function configureSMTP() {
  ini_set( "SMTP", "ssl://smtp.gmail.com" );
  ini_set( "smtp_port", "465" );
  ini_set( "username", "whyproject.2sn@gmail.com");
  ini_set( "password", "whypassword");
  ini_set( "sendmail_from", "whyproject.2sn@gmail.com" );
  return (true);
}
//Definition du header du mail et envoi
function sendMail($mail, $message_txt, $sujet, $passage_ligne) {
  $boundary = "-----=".md5(mt_rand());
  $header = "From: \"Why project\"<noreply@whyproject.com>".$passage_ligne;
  $header .= "Reply-to: \"why project\" <whyproject.2sn@gmail.com>".$passage_ligne;
  $header .= "MIME-Version: 1.0".$passage_ligne;
  $header .= "Content-Type: multipart/alternative; boundary=\"$boundary\"".$passage_ligne;
  $header .= $passage_ligne.$passage_ligne;
  $message = $passage_ligne."--".$boundary.$passage_ligne;
  $message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
  $message .= "Content-Transfer-Encoding: 8bit".$passage_ligne;
  $message .= $passage_ligne.$message_txt.$passage_ligne;
  $message .= $passage_ligne."--".$boundary."--".$passage_ligne;

  configureSMTP();
  if (mail($mail,$sujet,$message,$header))
    return (true);
  else
    return (false);
}
?>
