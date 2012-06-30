<?php

include('../config/dbConfig.php');
// using ldap bind
$ldapId = $_POST['ldapId'];
$result = mysql_query("select distinguishedName from mainiitbdb where ldapId=\"".$ldapId."\";") or die(mysql_error());
if(mysql_num_rows($result)) {
	$row = mysql_fetch_object($result);
	echo $row->distinguishedName;
}

?>
