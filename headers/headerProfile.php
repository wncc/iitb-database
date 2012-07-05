<?php
if($_SESSION['folderLevel'] == 0){
	$headerPath = '';
}
elseif($_SESSION['folderLevel'] == 1){
	$headerPath = '../';
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>IITB Database</title>
    <link rel="stylesheet" href="<?php echo $headerPath; ?>css/profile_style.css" />
    <script type="text/javascript" language="javascript" src="<?php echo $headerPath; ?>js/jquery.js"></script>
    <script src="<?php echo $headerPath; ?>js/login.js"></script>
	<script>
$(document).ready(function() {
	$('.tab li a').click(function() {
		$('li').removeClass('active');
		$(this).parent().addClass('active');
	});
}); 
</script>
</head>
<body>
	<img id='logo' src='<?php echo $headerPath; ?>images/logo.png' alt='IITB Database'></img>
    <p class="headerPath" style="display:none;"><?php echo $headerPath; ?></p>
	<div id="topProfileContainer">
		<div><a href=#><img id='topRightProfilePic' src='<?php echo $headerPath; ?>profilePics/default-profile.png' alt='Name'></img></a></div>
		<div><a href=#>Raghav Sagar</a></div>
	</div>
	<!--<div id="topProfileSeparator">
		<img id='topRightProfilePic' src='images/separatorRed.png' alt=''></img>
	</div> -->
	<div id="navigationBar">
		<a href=#><div>Contact Us</div></a><!--
	 --><a href=#><div>My Profile</div></a><!--
	 --><a href=#><div>Search</div></a><!--
	 -->
	</div>
</body>
</html>