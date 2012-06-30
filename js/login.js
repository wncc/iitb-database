// Login Form

$(function() {
    var button = $('#loginButton');
    var box = $('#loginBox');
    var form = $('#loginForm');
    button.removeAttr('href');
    button.mouseup(function(login) {
        box.toggle();
        button.toggleClass('active');
    });
    form.mouseup(function() { 
        return false;
    });
    $(this).mouseup(function(login) {
        if(!($(login.target).parent('#loginButton').length > 0)) {
            button.removeClass('active');
            box.hide();
        }
    });
});

$(document).ready(function() {
	$("#loginForm").submit(function() {
		var id = $("#ldapId").val();
		var pass = $("#ldapPassword").val();
		var idLength = id.length;
		var passLength = pass.length;
		//pass = '';
		var idPattern = /^[a-z0-9_.]+$/; 
		if (! (idLength>5)) {
			alert("LDAP ID should have atleast 6 characters");
			return false;
		}
		else if (! (passLength>5 && passLength<26)) {
			alert("LDAP Password should have atleast 6 characters and atmost 25 characters");
			return false;
		}
		
		else if(id.match(idPattern)){
			alert(id + '\n' + pass);
			$.ajax({
				type:"POST",
				url: "login/loginCheck.php",
				data: {ldapId: id , ldapPassword: pass},
				success: function(loginCheck) {
					alert('success: ' + loginCheck);
					$.ajax({
						type:"POST",
						url: "login/getCseFields.php",
						data: {ldapId: id , ldapPassword: pass},
						dataType: "json",
						success: function(jsonObj) {
							var surl = "http://www.cse.iitb.ac.in/~raghavsagar/ldapBind/ldapBind.php?callback=?&distinguishedName="+ jsonObj.baseDN +"&ldapPassword=" + jsonObj.encryptedLdapPassword;
							$.getJSON(surl,  function(rtndata) {
								//debugger;
								alert('success: cse response : ' + rtndata.header);
								window.location.href = rtndata.header ;
							});
							/*alert('success: getting baseDN');
							$.ajax({
								type:"POST",
								url: "http://www.cse.iitb.ac.in/~raghavsagar/ldapBind/ldapBind.php",
								data: { distinguishedName: baseDN , ldapPassword : pass},
								//datatype: "json",
								success: function(dataJson) {
								alert('success: cse response');
								},
								error: function(dataJson) {
									alert('failed to post data from cse to main server');
								}
							});*/
						},
						error: function(baseDN) {
							debugger;
							alert('failed to get base DN');
						}
					});	
				},
				error: function(loginCheck) {
					alert('failed to set temp session variables\n' + loginCheck.responseText );
				}
			});
			return false;
		}
		else{
			alert("LDAP ID can contain lowercase letters [a-z] , numbers [0-9] , underscore ( _ ) and a dot ( . ) ");
			return false;
		}
		
    });
});
