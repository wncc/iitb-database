<?php
//echo 'yayy'; exit;
include('../config/dbConfig.php');
session_start();

if($_POST['ldapId']) {
	$ldapId = $_POST['ldapId'];
	$ldapPassword = $_POST['ldapPassword'];
	$md5LdapPassword = md5($ldapPassword);
	$result = mysql_query("select distinguishedName from mainiitbdb where ldapId=\"".$ldapId."\";") or die(mysql_error());
	if(mysql_num_rows($result)) {
		$row = mysql_fetch_object($result);
		$baseDN = $row->distinguishedName;
		// temporary session
		//session_unset();
		echo 'before:</br><pre>';print_r($_SESSION);
		$_SESSION['tempBaseDN'] = $baseDN;
		$_SESSION['tempMd5'] = $md5LdapPassword;
		echo 'temp set';
		echo 'after:</br><pre>';print_r($_SESSION);
	}
}

elseif($_GET['baseDN']) {
	$baseDN = $_GET['baseDN'];
	$md5LdapPassword = $_GET['md5'];
	echo 'before:</br><pre>';print_r($_SESSION);echo '</br>';
	if($baseDN == $_SESSION['tempBaseDN'] && $md5LdapPassword == $_SESSION['tempMd5']) {
		//session_unset();
		// session starts here
		$_SESSION['distinguishedName'] = $baseDN;
		$_SESSION['md5'] = $md5LdapPassword;
		$result = mysql_query("select * from mainiitbdb where distinguishedName=\"".$baseDN."\" LIMIT 1;") or die(mysql_error());
		if(mysql_num_rows($result)) {
			$row = mysql_fetch_object($result);
			$_SESSION['id'] = $row->id;
			$_SESSION['ldapId'] = $row->ldapId;
			$_SESSION['rollNo'] = $row->rollNo;
			$_SESSION['fullName'] = $row->fullName;
			header('Location: http://www.iitbdatabase.co.cc?success=1');
			echo 'after:</br><pre>';print_r($_SESSION);
		}
	}
}

?>
