<?php
require_once "mail.php";
require_once "dataRef.php";

//Traitement du formulaire de renouvellement de mot de passe
if (isset($_POST['reinitPassword'])) {
    if ($_POST['mail'] == "") {
      echo "<b>Veuillez renseigner une adresse mail.</b>";
    }
    else if (isEmailExist($_POST['mail']) == false) {
      echo "<b>Veuillez renseigner une adresse mail valide.</b>";
      }
    else if (isEmailExist($_POST['mail']) == true) {
      $id = getUserIDWithMail($_POST['mail']);
      renewPassword($id);
      //redirection a 10 sec apres envoi du mail
      header('Refresh: 10; url=index.php');
    }
}
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<meta charset="UTF-8">
  <title>[Why] - Réinitialisation de mot de passe</title>
</head>
<body>
<?php //Affichage du formulaire de renouvellement de mot de passe ?>
<div id="resetmdp">
  Si vous avez perdu votre mot de passe, veuillez saisir votre e-mail ci-dessous.
  Un nouveau mot de passe vous y sera envoyé.<br />
<form id="signup" name="reinitPassword" method="POST" action="reinitPassword.php">
<input type="email" placeholder="john.doe@email.com" name="mail" required>
  <button type="submit" value="Reinitialiser le mot de passe" name="reinitPassword">Réinitialiser mon mot de passe</button>
</form>
<br><a href="index.php">Retour vers la page de connexion.</a>
</div>
</body>
</html>
