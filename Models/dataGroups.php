<?php
require_once "dataConnect.php";
require_once "dataUser.php";

function initDefaultUserGroups() {
  $db =dbConnect();
  if ($db == FALSE)
    return (FALSE);
  if (isGroupExist("admin") == false) {
  $query = "INSERT INTO groups (name, id_user, created) values (\"admin\",\"root\",date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  }
  if (isGroupExist("user") == false) {
  $query = "INSERT INTO groups (name, id_user, created) values (\"user\",\"root\",date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  }
  dbClose($db);
  return (TRUE);
}
function addGroup($id_user,$group_name) {
  $db =dbConnect();
  if ($db == FALSE)
    return (FALSE);
  if ($group_name == "user" || $group_name == "admin")
    return (FALSE);
  $query = "INSERT INTO groups (name, id_user, created) values (\"".$group_name."\",\"".$id_user."\",date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  $id_groups = getGroupID($groupName);
  $query = "INSERT INTO belong (id_groups, id_user) values (\"".$id_groups."\",\"".$id_user."\");";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}
function addUserToGroup($id_groups, $id_user) {
  $db =dbConnect();
  if ($db == FALSE)
    return (FALSE);
  if ($group_name == "user" || $group_name == "admin")
    return (FALSE);
  $query = "INSERT INTO belong (id_groups, id_user) values (\"".$id_groups."\",\"".$id_user."\");";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}
function getGroupID($groupName) {
  $db = dbConnect();
  if ($db == FALSE)
    return (FALSE);
  $query = "select id_groups from groups where name like \"".$groupName."\";";
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
function isGroupExist($groupName) {
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select id_groups from groups where name like \"".$groupName."\";";
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
