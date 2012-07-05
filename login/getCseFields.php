<?php
include('../config/dbConfig.php');
include('../functions/encryption.php');
// using ldap bind
$ldapId = $_POST['ldapId'];
$result = mysql_query("select distinguishedName from mainiitbdb where ldapId=\"".$ldapId."\";") or die(mysql_error());
if(mysql_num_rows($result)) {
	$row = mysql_fetch_object($result);
	$baseDN = $row->distinguishedName;
	$ldapPassword = $_POST['ldapPassword']; 
        $key = 'the quick brown fox jumps over the lazy ';
        $encryptedLdapPassword = enc_encrypt($ldapPassword, $key);
	$arr = array('baseDN' => $baseDN , 'encryptedLdapPassword' => $encryptedLdapPassword);
	//print_r($arr);
        echo json_encode($arr);
}


?>
	