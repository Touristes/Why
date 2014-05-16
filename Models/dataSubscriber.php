<?php
require_once "dataConnect.php";
require_once "dataUser.php";

function addSubscription($id_subscriber, $id_user) {
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "INSERT INTO subscriber (id_user, id_subscriber) VALUES (\"".$id_user."\",\"".$id_subscriber."\");";
  $result = $db->query($query);
  if ($result == FALSE)
    return (FALSE);
  dbClose($db);
  return (TRUE);
}

function delSubscription($id_subscriber, $id_user) {
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "DELETE FROM subscriber WHERE id_user = \"".$id_user."\" AND id_subscriber = \"".$id_subscriber."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    return (FALSE);
  dbClose($db);
  return (TRUE);
}

function getSubscriberNumber($id_user){
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select id_user from subscriber where id_user = \"".$id_user."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
        $ID = $row[$i];
    }
  dbClose($db);
  return ($i);
}
function getSubscriptionNumber($id_user){
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select id_user from subscriber where id_subscriber = \"".$id_user."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
        $ID = $row[$i];
    }
  dbClose($db);
  return ($i);
}
function getSubscriberList($id_user) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_subscriber from subscriber where id_user = \"".$id_user."\";";
  $result = $db->query($query);
  for ($i = 0 ;$row = $result->fetchArray(); $i++)
    {
      $array[$i] = getUserInfo("login",$row[0]);
    }
  dbClose($db);
  return ($array);
}
function getSubscriptionList($id_user) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_user from subscriber where id_subscriber = \"".$id_user."\";";
  $result = $db->query($query);
  for ($i = 0 ;$row = $result->fetchArray(); $i++)
    {
      $array[$i] = getUserInfo("login",$row[0]);
    }
  dbClose($db);
  return ($array);
}
function isSubrscriberOf($id_subscriber, $id_user) {
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select id_user from subscriber where id_subscriber = \"".$id_subscriber."\" and id_user = \"".$id_user."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
	$ID = $row[$i];
    }
  dbClose($db);
  if ($i > 0)
    return ("true");
  return ("false");
}
?>
