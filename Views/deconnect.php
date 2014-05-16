<?php
include "sessionInit.php";
	$_SESSION['check'] = "0";
	include "sessionDestroy.php";
	echo "<script type=\"text/javascript\">alert(\"Vous êtes déconnecté !!\");location =\"co.php\"</script>";
?>
