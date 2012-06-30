<?php
if($_SESSION['folderLevel'] == 0){
	$headerPath = '';
}
elseif($_SESSION['folderLevel'] == 1){
	$headerPath = '../';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<link rel='stylesheet' type="text/css" href="<?php echo $headerPath; ?>css/demo_page.css">
<link rel='stylesheet' type="text/css" href="<?php echo $headerPath; ?>css/jquery.dataTables_themeroller.css">
<link rel='stylesheet' type="text/css" href="<?php echo $headerPath; ?>css/jquery-ui-1.8.4.custom.css">

<script type="text/javascript" language="javascript" src="<?php echo $headerPath; ?>js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo $headerPath; ?>js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				var seen = {};
				$('#example tbody tr').each(function() {
					var txt = $(this).text();
					if (seen[txt])
						$(this).remove();
					else
						seen[txt] = true;
				});
				$('#example').dataTable( {
					"bJQueryUI": true,
					"sPaginationType": "full_numbers",
					"aaSorting": []
				} );
				/**  Remove duplicates from html table *********/
				
				
			});
		</script>
</head>
<body><div id="searchTableDiv">
<?php

function displayDepartment($input) {
	$displayDepartmentArray = array(
	'aero'	=>	'Aeronautical',
	'che'	=>	'Chemical',
	'chem'	=>	'Chemistry',
	'civil'	=>	'Civil',
	'cse'	=>	'Computer Science',
	'ee'	=>	'Electrical',
	'phy'	=>	'Engineering Physics',
	'idc'	=>	'IDC',
	'math'	=>	'Maths',
	'me'	=>	'Mechanical',
	'met'	=>	'Metallurgical',
	'som'	=>	'SOM'
	);
	if($displayDepartmentArray[$input])
		return $displayDepartmentArray[$input];
	else
		return strtoupper($input);
}

function displayTable($result1 = FALSE, $result2 = FALSE, $result3 = FALSE) {
	$htmlTable = 
	"<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"example\" width=\"100%\">
		<thead>
			<tr>
				<th>Name</th>
				<th>Roll No</th>
				<th>LDAP ID</th>
				<th>Course</th>
				<th>Department</th>
				<th>Hostel</th>
				<th>Room</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>";
	if($result1) {
		while($row = mysql_fetch_array($result1 , MYSQL_ASSOC)) {
			$htmlTable .=
			"<tr> 
				<td>".$row['fullName']."</td>
				<td>".$row['rollNo']."</td>
				<td>".$row['ldapId']."</td>
				<td class=\"center\">".$row['courseType']."</td>
				<td class=\"center\">".displayDepartment($row['department'])."</td>
				<td class=\"center\">".$row['hostel']."</td>
				<td class=\"center\">".$row['room']."</td>
				<td>".$row['email']."</td>
			</tr>";
		}
	}
	if($result2) {
		while($row = mysql_fetch_array($result2 , MYSQL_ASSOC)) {
			$htmlTable .=
			"<tr> 
				<td>".$row['fullName']."</td>
				<td>".$row['rollNo']."</td>
				<td>".$row['ldapId']."</td>
				<td class=\"center\">".$row['courseType']."</td>
				<td class=\"center\">".displayDepartment($row['department'])."</td>
				<td class=\"center\">".$row['hostel']."</td>
				<td class=\"center\">".$row['room']."</td>
				<td>".$row['email']."</td>
			</tr>";
		}
	}
	if($result3) {
		while($row = mysql_fetch_array($result3 , MYSQL_ASSOC)) {
			$htmlTable .=
			"<tr> 
				<td>".$row['fullName']."</td>
				<td>".$row['rollNo']."</td>
				<td>".$row['ldapId']."</td>
				<td class=\"center\">".$row['courseType']."</td>
				<td class=\"center\">".displayDepartment($row['department'])."</td>
				<td class=\"center\">".$row['hostel']."</td>
				<td class=\"center\">".$row['room']."</td>
				<td>".$row['email']."</td>
			</tr>";
		}
	}
	$htmlTable .= "</tbody><tfoot></table></div></body></html>";
	echo $htmlTable;
}

?>