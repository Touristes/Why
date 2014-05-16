<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>[Why]</title>
</head>

<?php
include "sessionInit.php";

if (!isset($_SESSION['check']))
{
		echo "<script type=\"text/javascript\">location =\"co.php\"</script>";
}
else if ($_SESSION['check'] != "1")
{
		echo "<script type=\"text/javascript\">location =\"co.php\"</script>";
}
else 
{
	echo "<script type=\"text/javascript\">location =\"accueil.php\"</script>";
}


?>
<body>
</body>
</html>
