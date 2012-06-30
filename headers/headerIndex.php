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
    <link rel="stylesheet" href="<?php echo $headerPath; ?>css/headerIndex.css" />
    <script type="text/javascript" language="javascript" src="<?php echo $headerPath; ?>js/jquery.js"></script>
    <script src="<?php echo $headerPath; ?>js/login.js"></script>
	<!--<script src="../js/search.js"></script>-->
</head>
<body>
	<img id='logo' src='<?php echo $headerPath; ?>images/logo.png' alt='IITB Database'></img>
    <div id="bar">
        <div id="container">
            <!-- Login Starts Here -->
            <div id="loginContainer">
                <a href="#" id="loginButton"><span>Login</span><em></em></a>
                <div style="clear:both"></div>
                <div id="loginBox">                
                    <form name="loginForm" id="loginForm" action="<?php echo $headerPath; ?>login/loginCheck.php" method="post">
                        <fieldset id="body">
                            <fieldset>
                                <label for="email">LDAP ID</label>
                                <input type="text" name="ldapId" id="ldapId" />
                            </fieldset>
                            <fieldset>
                                <label for="password">LDAP Password</label>
                                <input type="password" name="ldapPassword" id="ldapPassword" />
                            </fieldset>
                            <input type="submit" id="login" value="Sign in" />
                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- Login Ends Here -->
        </div>
    </div> 
</body>
</html>