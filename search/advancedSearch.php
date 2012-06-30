<?php
session_start();
$_SESSION['folderLevel'] = 1;
include('../headers/headerIndex.php'); echo '</br></br></br></br></br></br></br></br>';
include('../config/dbConfig.php');
//---------------------------------------------------------------------------------------------------------------
function nullResult($mainTable){
	$query = "SELECT * FROM " .$mainTable. " WHERE id=111111111;";
	$result = mysql_query($query)  or die(mysql_error());
	return $result;
}
function bottomRemarks($emailConsider , $hostelConsider) {
	if(!$emailConsider && !$hostelConsider) 
		echo "<p style='color:red;'>&nbsp;*Hostel & Email were ignored as they gave empty results</p>";
	elseif(!$emailConsider)
		echo "<p style='color:red;'>&nbsp;*Email was ignored as it gave an empty result</p>";
	elseif(!$hostelConsider)
		echo "<p style='color:red;'>&nbsp;*Hostel was ignored as it gave an empty result</p>";
}
function batchToRollNo($batch) {
	$july15_2012 = 1342310400; //  time() value
	$timeNow = time();
	$diff = $timeNow - $july15_2012;
	$year = 2012; // end year... this means acad year 2011-2012
	while($diff > 0) {
		$diff -= 365*24*3600;
		$year++;
	}
	return str_pad(((($year % 1000) - $batch) % 100), 2, "0", STR_PAD_LEFT); // this is the first 2 digits of a roll number;
}
//----------------------------------------------------------------------------------------------------
function departmentSearch($department , $whereAnd) {
	if($department == "others")
		return ($whereAnd . "department NOT IN ('aero', 'che', 'chem' , 'civil' , 'cse' , 'ee' , 'phy' , 'idc' , 'math' , 'me' , 'met' , 'som') "); 
	elseif($department)
		return ($whereAnd . "department='".$department."' "); 
	else
		return '';
}

//----------------------------------------------------------------------------------------------------
function batchSearch($batch , $whereAnd) {
	if($batch == "others")
		return ($whereAnd . "rollNo NOT LIKE '".batchToRollNo(1)."%' AND " . 
							"rollNo NOT LIKE '".batchToRollNo(2)."%' AND " . 
							"rollNo NOT LIKE '".batchToRollNo(3)."%' AND " . 
							"rollNo NOT LIKE '".batchToRollNo(4)."%' AND " .
							"rollNo NOT LIKE '".batchToRollNo(5)."%' "); 
	elseif($batch)
		return ($whereAnd . "rollNo LIKE '".batchToRollNo($batch)."%' "); 
	else
		return '';
}

//----------------------------------------------------------------------------------------------------

$whereAnd = '';
$mainTable = "mainiitbdb";
$name = mysql_real_escape_string($_POST['advancedName']);
$ldapId = mysql_real_escape_string($_POST['advancedLdapId']);
$rollNo = mysql_real_escape_string($_POST['advancedRollNo']);
$department = mysql_real_escape_string($_POST['advancedDepartment']);
$batch = mysql_real_escape_string($_POST['advancedBatch']);
$courseType = mysql_real_escape_string($_POST['advancedCourseType']);
$hostel = mysql_real_escape_string($_POST['advancedHostel']);
$email = mysql_real_escape_string($_POST['advancedEmail']);
//----------------------------------------------------------------------------------------------------
$emailConsider = true;
$hostelConsider = true;
//----------------------------------------------------------------------------------------------------
if($email){
	$emailQuery =  "SELECT * FROM " .$mainTable. " WHERE email='".$email."' ;"; 
	$emailResult = mysql_query($emailQuery)  or die(mysql_error());
	if(mysql_num_rows($emailResult))
		$effectiveEmail = $email;
	else{
		$effectiveEmail = '';
		$emailConsider = false;
	}

}
else
	$effectiveEmail = '';
//----------------------------------------------------------------------------------------------------
if($hostel){
	$hostelQuery =  "SELECT * FROM " .$mainTable. " WHERE hostel='".$hostel."' ;";
	$hostelResult = mysql_query($hostelQuery)  or die(mysql_error()); 
	if(mysql_num_rows($hostelResult))
		$effectiveHostel = $hostel;
	else{
		$effectiveHostel = '';
		$hostelConsider = false;
	}
}
else
	$effectiveHostel = '';
//----------------------------------------------------------------------------------------------------
$threshold1 = 100;
$basicQuery = "SELECT * FROM " .$mainTable. " WHERE ";
$query1 = $basicQuery;

if($name != null) {
	$query1 .= "MATCH (fullName) AGAINST ('" .$name. "' IN NATURAL LANGUAGE MODE) ";
	$whereAnd = "AND ";
}
if($ldapId != null) {
	$query1 .= $whereAnd . "ldapId='".$ldapId."' "; 
	$whereAnd = "AND ";
}
if($rollNo != null) {
	$query1 .= $whereAnd . "rollNo='".$rollNo."' "; 
	$whereAnd = "AND ";
}
if($subquery = departmentSearch($department , $whereAnd)) {
	$query1 .= $subquery; 
	$whereAnd = "AND ";
}
if($subquery = batchSearch($batch , $whereAnd)) {
	$query1 .= $subquery; 
	$whereAnd = "AND ";
}
if($courseType) {
	$query1 .= $whereAnd . "courseType='".$courseType."' "; 
	$whereAnd = "AND ";
}
if($effectiveHostel) {
	$query1 .= $whereAnd . "hostel='".$hostel."' "; 
	$whereAnd = "AND ";
}
if($effectiveEmail != null) {
	$query1 .= $whereAnd . "email='".$email."' "; 
	$whereAnd = "AND ";
}
if($query1 != $basicQuery)
	$result1 = mysql_query($query1)  or die(mysql_error());
else
	$result1 = nullResult($mainTable);

if(mysql_num_rows($result1) < $threshold1) {
	$query2 = $basicQuery;
	$whereAnd = "";
	if($name != null) {
		$pieces = explode(" ", $name);
		foreach ($pieces as &$value) {
			$value = $value . '*';
		}
		$pieces[0] = '>' . $pieces[0];
		$booleanSearchName='';
		foreach ($pieces as $value) {
			$booleanSearchName .= $value . ' ';
		}
		$booleanSearchName = trim($booleanSearchName);
		$query2 .= "MATCH (fullName) AGAINST ('" .$booleanSearchName. "' IN BOOLEAN MODE) ";
		$whereAnd = "AND ";
	}
	if($ldapId != null) {
	$query2 .= $whereAnd . "ldapId='%".$ldapId."%' "; 
	$whereAnd = "AND ";
	}
	if($rollNo != null) {
		$query2 .= $whereAnd . "rollNo='%".$rollNo."' "; 
		$whereAnd = "AND ";
	}
	if($subquery = departmentSearch($department , $whereAnd)) {
		$query2 .= $subquery; 
		$whereAnd = "AND ";
	}
	if($subquery = batchSearch($batch , $whereAnd)) {
		$query2 .= $subquery; 
		$whereAnd = "AND ";
	}
	if($courseType) {
		$query2 .= $whereAnd . "courseType='".$courseType."' "; 
		$whereAnd = "AND ";
	}
	if($effectiveHostel) {
		$query2 .= $whereAnd . "hostel='".$hostel."' "; 
		$whereAnd = "AND ";
	}
	if($effectiveEmail != null) {
		$query2 .= $whereAnd . "email='%".$email."%' "; 
		$whereAnd = "AND ";
	}
	if($query2 != $basicQuery) {
		$result2 = mysql_query($query2)  or die(mysql_error());
		include('displayTable.php');
		displayTable($result1 , $result2);
		bottomRemarks($emailConsider , $hostelConsider);
	}
	else{
		$result = nullResult($mainTable);
		include('displayTable.php');
		displayTable($result);
		bottomRemarks($emailConsider , $hostelConsider);
	}	
}	
else {
	include('displayTable.php');
	displayTable($result1);
	bottomRemarks($emailConsider , $hostelConsider);
	
}

?>