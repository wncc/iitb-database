<?php

include('../config/dbConfig.php');
// using ldap bind
$ldapId = $_POST['ldapId'];
$result = mysql_query("select distinguishedName from mainiitbdb where ldapId=\"".$ldapId."\";") or die(mysql_error());
if(mysql_num_rows($result)) {
	$row = mysql_fetch_object($result);
	$baseDN = $row->distinguishedName;
	$ldapPassword = $_POST['ldapPassword']; $key="XiTo74dOO09N48YeUmuvbL0E";
	$encryptedLdapPassword = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $ldapPassword, MCRYPT_MODE_CBC, md5(md5($key))));
	$arr = array('baseDN' => $baseDN , 'encryptedLdapPassword' => $encryptedLdapPassword);
	echo json_encode($arr);
}


?>
