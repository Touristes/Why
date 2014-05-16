<?php
//Fichier à créeer pour gérer l'affichage de la video
//+ contrôle de l'url de la video

//ajoute le lien vers la video dans la bdd
function addVideo($id_video) {
  $db =dbConnect();
  if ($db == FALSE)
    return (FALSE);
  initDefaultUserGroups();
  $query = "INSERT INTO video (id_user, id_post, url, posted)"
  ." values (\"".$id_user."\",\"".$id_post."\",\"".$url."\",date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}

//Efface le lien vers la video de la base de données
function delVideo($id_video) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "delete from video where id_video = \"".$id_video."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}

//Récupère l'url de la vidéo
function getVideoUrl($id_video) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select url from video where id_video = \"".$id_video."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
		$url = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($url);
}

//Récupère la date à laquelle la vidéo a été postée
function getVideoPosted($id_video) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select posted from video where id_video = \"".$id_video."\";";
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

//Récupère l'ID de la vidéo
function getVideoID($id_post) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_video from video where id_post = \"".$id_post."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
		$id_video= $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($id_video);
}

//Récupère l'ID de la vidéo avec l'url
function getVideoIDWithUrl($url) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_video from video where url = \"".$url."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
		$id_video = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($id_video);
}

//Récupère l'indentifiant du post lié à la vidéo
function  getVideoPostID($id_video) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_post from video where id_video = \"".$id_video."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
		$id_post = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($id_video);
}

//Récupère l'indentifiant de l'utilisateur qui a posté la vidéo
function getVideoUserID($id_video) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_user from video where id_video = \"".$id_video."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
		$id_video = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($id_user);
}

?>