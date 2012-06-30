<?php
include('dbConfig.php');
// using ldap bind
$ldap_id = $_POST['ldapId'];
$ldap_password = $_POST['ldapPassword'];
$result = mysql_query("select distinguishedName from mainiitbdb where ldapId=\"".$ldap_id."\";") or die(mysql_error());
if(mysql_num_rows($result)) {
$row = mysql_fetch_object($result);
$ldaprdn = $row->distinguishedName;   // ldap rdn or dn
$ldappass = '@nilthegreat';  // associated password

// connect to ldap server
$ldapconn = ldap_connect("ldap.iitb.ac.in")
    or die("Could not connect to LDAP server.");

if ($ldapconn) {

    // binding to ldap server
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldap_password);

    // verify binding
    if ($ldapbind) {
        echo "LDAP bind successful...";
    } else {
        echo "LDAP bind failed...";
    }


}
}
else
	echo "Incorrect username or password";
?>