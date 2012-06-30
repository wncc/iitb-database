$(document).ready(function() {
	$('#advancedSearchContainer').hide();
	$('#field').focus(function() {
		$(this).css('border' , 'solid 1px #e9a605');
	});

	$('#field').blur(function() {
		$(this).css('border' , 'solid 1px #c0c0c0');
	});
	$('#simpleSearchContainer a').click(function() {
		$('#simpleSearchContainer').hide();
		$('#advancedSearchContainer').show();
	});
	$('#advancedSearchContainer a').click(function() {
		$('#advancedSearchContainer').hide();
		$('#simpleSearchContainer').show();
	});
	
	$("#simpleSearchForm").submit(function() {
		var simpleSearch = $("#field").val();
		var simpleSearchLength = simpleSearch.length;
	  if (! simpleSearchLength) {
        alert("Text Box cannot be left blank");
        return false;
      }
      else
		return true;
    });
	$("#advancedSearchForm").submit(function() {
		
		var advancedName = $("#advancedName").val(); 
		var advancedLdapId = $("#advancedLdapId").val();
		var advancedRollNo = $("#advancedRollNo").val();
		var advancedDepartment = $("#advancedDepartment").val();
		var advancedBatch = $("#advancedBatch").val();
		var advancedCourseType = $("#advancedCourseType").val();
		var advancedHostel = $("#advancedHostel").val();
		var advancedEmail = $("#advancedEmail").val();
		if (!advancedName && !advancedLdapId && !advancedRollNo && (advancedDepartment == '0') && (advancedBatch == '0')  && (advancedCourseType == '0') && (advancedHostel == '0') && !advancedEmail) {
			alert("All fields cannot be left blank");
			return false;
		}
		else
			return true;
    });
	
});