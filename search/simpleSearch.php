<?php
session_start();
$_SESSION['folderLevel'] = 1;
include('../headers/headerIndex.php'); echo '</br></br></br></br></br></br></br></br>';
include('../config/dbConfig.php');
//---------------------------------------------------------------------------------------------------------------
$searchString = mysql_real_escape_string($_GET['field']);
$threshold1 = 250;
$threshold2 = 100;
$mainTable = "mainiitbdb";
$query1 = "SELECT * FROM " .$mainTable. " WHERE MATCH (fullName , ldapId , rollNo) AGAINST ('" .$searchString. "' IN NATURAL LANGUAGE MODE);";
$result1 = mysql_query($query1)  or die(mysql_error());

if(mysql_num_rows($result1) < $threshold1) {
	$pieces = explode(" ", $searchString);
	foreach ($pieces as &$value) {
		$value = $value . '*';
	}
	$pieces[0] = '>' . $pieces[0];
	$booleanSearchString='';
	foreach ($pieces as $value) {
		$booleanSearchString .= $value . ' ';
	}
	$booleanSearchString = trim($booleanSearchString);
	$query2 = "SELECT * FROM " .$mainTable. " WHERE MATCH (fullName , ldapId , rollNo) AGAINST ('" .$booleanSearchString. "' IN BOOLEAN MODE);";
	$result2 = mysql_query($query2)  or die(mysql_error());
	if(mysql_num_rows($result2) < $threshold2) {
		$query3 ="SELECT * FROM " .$mainTable. " WHERE fullName like '%".$searchString."%' or ldapId like '%".$searchString."%' or rollNo like '%".$searchString."%';";
		$result3 = mysql_query($query3)  or die(mysql_error());
		include('displayTable.php');
		displayTable($result1 , $result2 , $result3);
	}
	else {
		include('displayTable.php');
		displayTable($result1 , $result2);
		
	}
}
else {
	include('displayTable.php');
	displayTable($result1);
}

?>