<?php
require_once "dataConnect.php";
require_once "dataGroups.php";

//Permet de rechercher un utilisateur
function SearchUser($search) {
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select login from user where login like \"".$search."\" limit 1;";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
        $login = $row[$i];
    }
  dbClose($db);
  if ($i == 0)
    return (FALSE);
  else
    return ($login);
}

//Ajoute un utilisateur 
function addUser($login, $email, $password) {
  $db =dbConnect();
  if ($db == FALSE)
    return (FALSE);
  initDefaultUserGroups();
  $query = "INSERT INTO user (login, email, password, created, modified, last_connection) values (\"".$login."\",\"".$email."\",\"".md5($password)."\",date('now'),date('now'),date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  $ID = getUserID($login);
  $ID_groups = getGroupID("user");
  $query = "INSERT INTO belong (id_groups, id_user) values (\"".$ID_groups."\",\"".$ID."\");";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}
//Ajoute un administrateur
function addAdmin($login, $email, $password) {
  $db =dbConnect();
  if ($db == FALSE)
    return (FALSE);
  initDefaultUserGroups();
  $query = "INSERT INTO user (login, email, password, created, modified, last_connection) values (\"".$login."\",\"".$email."\",\"".md5($password)."\",date('now'),date('now'),date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  $ID = getUserID($login);
  $ID_groups = getGroupID("admin");
  $query = "INSERT INTO belong (id_groups, id_user) values (\"".$ID_groups."\",\"".$ID."\");";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}
//Recupere l'id d'un utilisateur à partir de son login
function getUserID($login) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_user from user where login like \"".$login."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
       $ID = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($ID);
}
//Recupère un ID d'un utliisateur à partir de son ID, wait what ? Cette fonction n'est pas de moi.
function getIDuser($id_user) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select login from user where id_user like \"".$id_user."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
       $ID = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($ID);
}

//Récupère l'ID d'un utilisateur à partir de son email
function getUserIDWithMail($email) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_user from user where email like \"".$email."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
	$ID = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($ID);
}
//Recupère n'importe quel info de l'utilisateur à partir de son ID
function getUserInfo($field, $ID) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select \"".$field."\" from user where id_user like \"".$ID."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
	$info = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($info);
}
//Renvoie un tableau contenant la liste des utilisateurs
function getUserList() {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select login from user;";
  $result = $db->query($query);
  for ($i = 0 ;$row = $result->fetchArray(); $i++)
    {
        $array[$i] = $row[0];
    }
  dbClose($db);
  return ($array);
}
//Efface un utilisateur
function delUser($id) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "delete from user where id_user = \"".$id."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  $query = "delete from groups where id_user = \"".$id."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  $query = "delete from belong where id_user = \"".$id."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  $query = "delete from subscriber where id_user = \"".$id."\" or id_subscriber = \"".$id."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}
//Teste si un login existe
function isUsernameExist($login){
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select id_user from user where login like \"".$login."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
	$ID = $row[$i];
    }
  dbClose($db);
  if ($i > 0)
    return (TRUE);
  return (FALSE);
}
//Teste si un email est dans la base
function isEmailExist($email){
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select id_user from user where email like \"".$email."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
        $ID = $row[$i];
    }
  dbClose($db);
  if ($i > 0)
    return (TRUE);
  return (FALSE);
}
//Connexion d'un utilisateur
function userConnect($login, $password){
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $id = getUserID($login);
  $query = "select id_user from user where id_user = \"".$id."\" and password = \"".md5($password)."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
        $ID = $row[$i];
    }
  if ($i > 0)
    {
      $query = "update user set last_connection = date('now') where id_user = \"".$id."\";";
      $result = $db->query($query);
      dbClose($db);
      return (TRUE);
    }
  dbClose($db);
  return (FALSE);
}
//Modifier une information d'un utilisateur à partir de son ID
function setUserField($id, $field, $newContent){
  $db = dbConnect();
  if ($db == FALSE)
    return (FALSE);
  $query = "update user set \"".$field."\"=\"".$newContent."\" where id_user = \"".$id."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  $query = "update user set modified = date('now') where id_user = \"".$id."\";";
  $result = $db->query($query);
  dbClose($db);
  return (TRUE);
}
//Test si un utlisateur est administrateur
function isUserAdmin($id){
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $id_groups = getGroupID("admin");
  $query = "select id_user from belong where id_groups = \"".$id_groups."\" and id_user = \"".$id."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
        $ID = $row[$i];
    }
  dbClose($db);
  if ($i > 0)
    return (TRUE);
  return (FALSE);
}
?>
