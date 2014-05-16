<?php
//Fichier à creer pour gérer l'affichage de la photo
// + controle sur le nom du fichier
// + contrôle taille du fichier
// + ajout du fichier sur le serveur (à ne pas mettre dans la partie vue :p)

//Ajoute le lien vers l'image dans la bdd
function addPicture($id_user, $id_post, $path) {
  $db =dbConnect();
  if ($db == FALSE)
    return (FALSE);
  initDefaultUserGroups();
  $query = "INSERT INTO picture (id_user, id_post, path, posted)"
  ." values (\"".$id_user."\",\"".$id_post."\",\"".$path."\",date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}

//Efface le lien vers l'image dans la bdd
function delPicture($id_picture) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "delete from picture where id_picture = \"".$id_picture."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}

//Recupere le chemin vers l'image
function getPicturePath($id_picture) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select path from image where id_picture = \"".$id_picture."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
		$path = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($path);
}

//Recupere la date à laquelle l'image a été postée
function getPicturePosted($id_picture) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select posted from image where id_picture = \"".$id_picture."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
		$posted = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($posted);
}

//Récupère l'ID de l'image à partir de son chemin d'accès
function getPictureIDWithPath($path) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_picture from image where path = \"".$path."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
		$id_picture = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($id_picture);
}

//Récupère l'ID de l'image à partir de l'identifiant du post
function getPictureID($id_post) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_picture from image where id_post = \"".$id_post."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
		$id_picture = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($id_picture);
}

//Récupère l'identifiant du post à partir de id_picture
function getPicturePostID($id_picture) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_post from image where id_picture = \"".$id_picture."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
		$id_post = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($id_post);
}

//Récupère l'identifiant de l'utilisateur à partir de id_picture
function getPictureUserID($id_picture) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_user from image where id_picture = \"".$id_picture."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
		$id_user = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($id_user);
}

?>
