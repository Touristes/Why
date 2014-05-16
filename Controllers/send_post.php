<?php

include "dataRef.php";

include "sessionInit.php";

$post[2] = $_POST["posts"];
$post[0] = $_SESSION["login"];
$post[1] = $_POST["title"];
$post[3] = 1; //category;
$post[4] = 2; //type;

addPost($post);
?>
<META http-EQUIV="Refresh" CONTENT="0; url=accueil.php">
