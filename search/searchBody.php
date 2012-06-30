<?php
//session_start();
if($_SESSION['folderLevel'] == 0){
	$searchPath = 'search/';
	$headerPath = '';
}
elseif($_SESSION['folderLevel'] == 1){
	$searchPath = '';
	$headerPath = '../';
}
?> 
<!doctype html>
<html>
<head>
<meta charset="utf8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <link rel="stylesheet" href="<?php echo $headerPath; ?>css/searchBody.css" />
    <script type="text/javascript" language="javascript" src="<?php echo $headerPath; ?>js/jquery.js"></script>
	<script src="<?php echo $headerPath; ?>js/search.js"></script>

</head>
<body>
<!-- Simple Search ----------------------------------------------------------------------------------------------------------->
	<div id="simpleSearchContainer">
	</br></br></br></br></br></br></br></br></br>
		<a href=# class="switch_link">Switch to Advanced Search</a>
		<form id="simpleSearchForm" action="<?php echo $searchPath; ?>simpleSearch.php" method="get">
			<input id="field" name="field" type="text" class="textInput" /></br></br>
			<div style="color:#1317c5;font-size:12px;margin-bottom:10px">Searches - <b>Name, LDAP ID, Roll No</b></div>
			<input id="submit" name="submit" type="submit" value="Search" />
		</form>
	</div>
	<!-- Advanced Search ----------------------------------------------------------------------------------------------------------->
	<div id="advancedSearchContainer">
	</br></br></br>
		<a href=# class="switch_link">Switch to Simple Search</a>
		<form id="advancedSearchForm" action="<?php echo $searchPath; ?>advancedSearch.php" method="post">
			<table width=30%>
				<tr>
					<td class=ralign>Name:</td>
					<td class=lalign><input id="advancedName" name="advancedName" type="text" class="textInput" /></td>
				</tr>
				<tr>
					<td class=ralign>LDAP ID:</td>
					<td class=lalign><input id="advancedLdapId" name="advancedLdapId" type="text" class="textInput" /></td>
				</tr>
				<tr>
					<td class=ralign>Roll Number:</td>
					<td class=lalign><input id="advancedRollNo" name="advancedRollNo" type="text" class="textInput" /></td>
				</tr>
				<tr>
					<td class=ralign>Department:</td>
					<td class=lalign>
						<select id="advancedDepartment" name="advancedDepartment">
							<option value=0>--Select--</option>
							<option value="aero">Aeronautical</option>
							<option value="che">Chemical</option>
							<option value="chem">Chemistry</option>
							<option value="civil">Civil</option>
							<option value="cse">Computer Science</option>
							<option value="ee">Electrical</option>
							<option value="phy">Engineering Physics</option>
							<option value="idc">IDC</option>
							<option value="math">Maths</option>
							<option value="me">Mechanical</option>
							<option value="met">Metallurgical</option>
							<option value="som">SOM</option>
							<option value="others">Others</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class=ralign>Batch:</td>
					<td class=lalign>
						<select id="advancedBatch" name="advancedBatch">
							<option value=0>--Select--</option>
							<option value=1>Freshie</option>
							<option value=2>Sophie</option>
							<option value=3>Thirdie</option>
							<option value=4>Fourthie</option>
							<option value=5>Fifthie</option>
							<option value="others">Others</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class=ralign>Course Type:</td>
					<td class=lalign>
						<select id="advancedCourseType" name="advancedCourseType">
							<option value=0>--Select--</option>
							<option value="ug">Under graduate</option>
							<option value="dd">Dual Degree</option>
							<option value="pg">Post graduate</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class=ralign>Hostel:</td>
					<td class=lalign>
						<select id="advancedHostel" name="advancedHostel">
							<option value=0>--Select--</option>
							<option value=1>1</option>
							<option value=2>2</option>
							<option value=3>3</option>
							<option value=4>4</option>
							<option value=5>5</option>
							<option value=6>6</option>
							<option value=7>7</option>
							<option value=8>8</option>
							<option value=9>9</option>
							<option value=10>10</option>
							<option value=11>11</option>
							<option value=12>12</option>
							<option value=13>13</option>
							<option value=14>14</option>
							<option value="tansa">Tansa</option>
						</select><!--&nbsp;&nbsp;
						<span class='extraFieldMessage'>Not available for all students</span>-->
					</td>
				</tr>
				<tr>
					<td class=ralign>Email ID:</td>
					<td class=lalign><input id="advancedEmail" name="advancedEmail" type="text" class="textInput" /><!--&nbsp;&nbsp;
					<span class='extraFieldMessage'>Not available for all students</span>-->
					</td>
				</tr>
			</table></br>
			<div style="color:#1317c5;font-size:12px;margin-bottom:10px">Some fields can be left blank</div>
			<input id="submit" name="submit" type="submit" value="Search" />
		</form>
	</div>
</body>
</html>