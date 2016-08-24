// constants to define the title of the alert and button text.

function test()
{
	alert("Hi......");
}


function dateDifference(Start, End){
	var date1 = new Date(Start)//converts string to date object
	//alert(date1);
	var date2 = new Date(End)
	//alert(date2);

	var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
	//var diffDays = Math.abs((date1.getTime() - date2.getTime()) / (oneDay));
	var diffDays = (date2.getTime() - date1.getTime()) / (oneDay);
	//alert(diffDays);
	return diffDays;
}

function isDate(txtDate, separator) {
	var aoDate,           // needed for creating array and object
		ms,               // date in milliseconds
		month, day, year; // (integer) month, day and year
	// if separator is not defined then set '/'
	if (separator === undefined) {
		separator = '/';
	}
	// split input date to month, day and year
	aoDate = txtDate.split(separator);
	// array length should be exactly 3 (no more no less)
	if (aoDate.length !== 3) {
		return false;
	}
	// define month, day and year from array (expected format is m/d/yyyy)
	// subtraction will cast variables to integer implicitly
	//month = aoDate[0] - 1; // because months in JS start from 0
	//day = aoDate[1] - 0;
	//year = aoDate[2] - 0;

	// year = aoDate[0] - 0;
	// month = aoDate[1] - 1; // because months in JS start from 0
	// day = aoDate[2] - 0;


	month = aoDate[0] - 1; // because months in JS start from 0
	day = aoDate[1] - 0;
	year = aoDate[2] - 0;
    
	// alert("year :- " + year);
	// alert("month :- " + month);
	// alert("day :- " + day);

	// test year range
	if (year < 1000 || year > 3000) {
		return false;
	}
	// convert input date to milliseconds
	ms = (new Date(year, month, day)).getTime();
	// initialize Date() object from milliseconds (reuse aoDate variable)
	aoDate = new Date();
	aoDate.setTime(ms);
	// compare input date and parts from Date() object
	// if difference exists then input date is not valid
	if (aoDate.getFullYear() !== year ||
		aoDate.getMonth() !== month ||
		aoDate.getDate() !== day) {
		return false;
	}
	// date is OK, return true
	return true;
}

function trim(stringToTrim)
{
	return stringToTrim.replace(/^\s+|\s+$/g,"");

}	// function trim(stringToTrim)
function trim(stringToTrim)
{
	return stringToTrim.replace(/^\s+|\s+$/g,"");

}	// function trim(stringToTrim)


function ltrim(stringToTrim)
{
	return stringToTrim.replace(/^\s+/,"");

}	// function ltrim(stringToTrim)


function rtrim(stringToTrim)
{
	return stringToTrim.replace(/\s+$/,"");

}	// function rtrim(stringToTrim)

function IsNumeric(e) {
	var keyCode = e.which ? e.which : e.keyCode
	var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
	document.getElementById("error").style.display = ret ? "none" : "inline";
	return ret;
}

function onlyNos(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode(key);
	var regex = /^[0-9.,]+$/;
	if (!regex.test(key)) {
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}

}

function only_Alpha_Numeric_Space(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode(key);
	if (key.length == 0) return;
	var regex = /^[0-9,\b \d,a-z,A-Z]+$/;
	if (!regex.test(key)) {
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}
	//var charCode = (evt.which) ? evt.which : event.keyCode
	//if ((charCode > 31 && charCode > 44) && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
	//	return false;
	//return true;
}

function only_Alpha_Numeric_Comma(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode(key);
	if (key.length == 0) return;
	var regex = /^[0-9,\b,\d,a-z,A-Z]+$/;
	if (!regex.test(key)) {
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}
	//var charCode = (evt.which) ? evt.which : event.keyCode
	//if ((charCode > 31 && charCode > 44) && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
	//	return false;
	//return true;
}

function only_Alpha_Space(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode(key);
	if (key.length == 0) return;
	var regex = /^[ \b,\d,a-z,A-Z]+$/;
	if (!regex.test(key)) {
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}
	//var charCode = (evt.which) ? evt.which : event.keyCode
	//if ((charCode > 31 && charCode > 44) && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
	//	return false;
	//return true;
}

function only_Alpha_Numeric(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode(key);
	if (key.length == 0) return;
	var regex = /^[0-9,\b\d,a-z,A-Z]+$/;
	if (!regex.test(key)) {
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}
	//var charCode = (evt.which) ? evt.which : event.keyCode
	//if ((charCode > 31 && charCode > 44) && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
	//	return false;
	//return true;
}

function only_Alpha_Numeric_Comma_Space(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode(key);
	if (key.length == 0) return;
	var regex = /^[0-9, ,\b,\d,a-z,A-Z]+$/;
	if (!regex.test(key)) {
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}
	//var charCode = (evt.which) ? evt.which : event.keyCode
	//if ((charCode > 31 && charCode > 44) && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
	//	return false;
	//return true;
}

function only_Alpha_Numeric_Comma_Plus(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode(key);
	if (key.length == 0) return;
	var regex = /^[0-9,+,\b,\d,a-z,A-Z]+$/;
	if (!regex.test(key)) {
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}
	//var charCode = (evt.which) ? evt.which : event.keyCode
	//if ((charCode > 31 && charCode > 44) && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
	//	return false;
	//return true;
}

function only_Alpha_Numeric_underscore_dot(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode(key);
	if (key.length == 0) return;
	var regex = /^[0-9,_,.,\b,\d,a-z,A-Z]+$/;
	if (!regex.test(key)) {
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}
	//var charCode = (evt.which) ? evt.which : event.keyCode
	//if ((charCode > 31 && charCode > 44) && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
	//	return false;
	//return true;
}

// constants to define the title of the alert and button text.
function only_Numeric_Dot(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode(key);
	if (key.length == 0) return;
	var regex = /^[0-9.\b\d]+$/;
	if (!regex.test(key)) {
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}
	//var charCode = (evt.which) ? evt.which : event.keyCode
	//if ((charCode > 31 && charCode > 44) && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
	//	return false;
	//return true;
}

// constants to define the title of the alert and button text.
function only_Numeric_Comma(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode(key);
	if (key.length == 0) return;
	var regex = /^[0-9,\b,\d]+$/;
	if (!regex.test(key)) {
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}
	//var charCode = (evt.which) ? evt.which : event.keyCode
	//if ((charCode > 31 && charCode > 44) && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
	//	return false;
	//return true;
}

// constants to define the title of the alert and button text.
function only_Alpha_Numeric(evt) {
	//var theEvent = evt || window.event;
	//var key = theEvent.keyCode || theEvent.which;
	//key = String.fromCharCode(key);
	//if (key.length == 0) return;
	//var regex = /^[0-9,\b,a-z,A-Z]+$/;
	//if (!regex.test(key)) {
	//	theEvent.returnValue = false;
	//	if (theEvent.preventDefault) theEvent.preventDefault();
	//}
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
		return false;
	return true;
}

// constants to define the title of the alert and button text.
function only_Numeric(evt) {
	//var theEvent = evt || window.event;
	//var key = theEvent.keyCode || theEvent.which;
	//key = String.fromCharCode(key);
	//if (key.length == 0) return;
	//var regex = /^[0-9\b]+$/;
	//if (!regex.test(key)) {
	//	theEvent.returnValue = false;
	//	if (theEvent.preventDefault) theEvent.preventDefault();
	//}
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

function only_Alpha_Numeric_Hyphen_Space(evt) {
	//var theEvent = evt || window.event;
	//var key = theEvent.keyCode || theEvent.which;
	//key = String.fromCharCode(key);
	//if (key.length == 0) return;
	//var regex = /^[a-zA-Z ']+$/;
	//if (!regex.test(key)) {
	//	theEvent.returnValue = false;
	//	if (theEvent.preventDefault) theEvent.preventDefault();
	//}
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && (charCode < 48 || charCode > 57) && (charCode < 45 || charCode > 45) && (charCode < 32 || charCode > 32))
		return false;
	return true;
}

function only_Alpha_Numeric_Apostrophy_Space(evt) {
	//var theEvent = evt || window.event;
	//var key = theEvent.keyCode || theEvent.which;
	//key = String.fromCharCode(key);
	//if (key.length == 0) return;
	//var regex = /^[a-zA-Z ']+$/;
	//if (!regex.test(key)) {
	//	theEvent.returnValue = false;
	//	if (theEvent.preventDefault) theEvent.preventDefault();
	//}
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && (charCode < 48 || charCode > 57) && (charCode < 39 || charCode > 39) && (charCode < 32 || charCode > 32))
		return false;
	return true;
}

function only_Alpha_Space(evt) {
	//var theEvent = evt || window.event;
	//var key = theEvent.keyCode || theEvent.which;
	//key = String.fromCharCode(key);
	//if (key.length == 0) return;
	//var regex = /^[a-zA-Z ']+$/;
	//if (!regex.test(key)) {
	//	theEvent.returnValue = false;
	//	if (theEvent.preventDefault) theEvent.preventDefault();
	//}
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && (charCode < 32 || charCode > 32))
		return false;
	return true;
}

function only_Alpha_Apostrophy_Space(evt) {
	//var theEvent = evt || window.event;
	//var key = theEvent.keyCode || theEvent.which;
	//key = String.fromCharCode(key);
	//if (key.length == 0) return;
	//var regex = /^[a-zA-Z ']+$/;
	//if (!regex.test(key)) {
	//	theEvent.returnValue = false;
	//	if (theEvent.preventDefault) theEvent.preventDefault();
	//}
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && (charCode < 39 || charCode > 39) && (charCode < 32 || charCode > 32))
		return false;
	return true;
}

	// constants to define the title of the alert and button text.
	function only_Alpha_Apostrophy(evt) {
		//var theEvent = evt || window.event;
		//var key = theEvent.keyCode || theEvent.which;
		//key = String.fromCharCode(key);
		//if (key.length == 0) return;
		//var regex = /^[a-zA-Z ']+$/;
		//if (!regex.test(key)) {
		//	theEvent.returnValue = false;
		//	if (theEvent.preventDefault) theEvent.preventDefault();
		//}
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && (charCode < 39 || charCode > 39))
			return false;
		return true;
	}


	function validateEmail(email) {
		var chrbeforAt = email.substr(0, email.indexOf('@'));
		if (!($.trim(email).length > 127)) {
			if (chrbeforAt.length >= 2) {
				var re = /^(([^<>()[\]{}'^?\\.,!|//#%*-+=&;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
				return re.test(email);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

function show_newlyaddedlist(pagename, divname)
{
	if(pagename!="" && divname!="")
	{
		var div_name = "#"+divname;
		var page_name = pagename;
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {pagename:pagename},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function add_designation()
{
	//alert("Hi...");
	var frm=document.designation;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var designation=trim(frm.designation.value);
	if(designation.length <= 0 || designation == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Designation" + "\n";
		frm.designation.focus();
	}


	designationencryption=trim(frm.designationencryption.value);
	if(designationencryption.length <= 0 || designationencryption == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter code" + "\n";
		frm.designationencryption.focus();
	}
	else
	{
		var p = hex_sha512(designationencryption);
	}

	if(Number(error_count) == 0)
	{
		var div_name = "#div_designation";
		var page_name = "save_designation.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {designation:designation, p:p},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function ClearAllControls_Only(formno) {
	document.getElementById("AddEdit").value=0;
	for (i = 0; i < document.forms[formno].length; i++) {
		doc = document.forms[formno].elements[i];
		//alert("doc.type :- " + doc.type);
		doc.style.backgroundColor="";
		switch (doc.type) {
			case "text":
				doc.value = "";
				break;
			case "email":
				doc.value = "";
				break;
			case "password":
				doc.value = "";
				break;
			case "textarea":
				doc.value = "";
				break;
			case "checkbox":
				doc.checked = false;
				break;
			case "radio":
				doc.checked = false;
				break;
			case "select-one":
				doc.selectedIndex = 0;
				break;
			case "select-multiple":
				doc.selectedIndex = 0;
				break;
			default:
				break;
		}
	}
	$("input:text:visible:first").focus();
}

function ClearAllControls(formno) {
	document.getElementById("AddEdit").value=0;
	for (i = 0; i < document.forms[formno].length; i++) {
		doc = document.forms[formno].elements[i];
		//alert("doc.type :- " + doc.type);
		doc.style.backgroundColor="";
		switch (doc.type) {
			case "text":
				doc.value = "";
				break;
			case "email":
				doc.value = "";
				break;
			case "password":
				doc.value = "";
				break;
			case "textarea":
				doc.value = "";
				break;
			case "checkbox":
				doc.checked = false;
				break;
			case "radio":
				doc.checked = false;
				break;
			case "select-one":
				doc.selectedIndex = 0;
				break;
			case "select-multiple":
				doc.selectedIndex = 0;
				break;
			default:
				break;
		}
	}
	$("input:text:visible:first").focus();
	
	new PNotify({
		title: 'Success notice',
		text: 'Check me out! I\'m a notice.',
		icon: 'icon-checkmark3',
		type: 'success'
	});
}

function clearText(PrvControlName, ControlName)
{
	PrvControlName=document.getElementById(PrvControlName).value;
	if(PrvControlName.length <= 0 || PrvControlName == ""){
		var ControlName="#"+ControlName;
		$(ControlName).val("");
	}
}

function searchlogin(searchvalue, searchin)
{
	// alert("Hi...");

	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	// var searchvalue=trim(frm.searchvalue_company.value);
	// alert("searchvalue :- " + searchvalue);
	if(searchvalue.length <= 0 || searchvalue == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Search Value" + "\n";
		// frm.searchvalue.focus();
	}

	if(searchin.length <= 0 || searchin == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Where to Search In " + "\n";
		// frm.searchvalue.focus();
	}


	if(Number(error_count) == 0)
	{
		var div_name = "#div_searchlogin";
		var page_name = "add_login_2.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {searchvalue:searchvalue, searchin:searchin},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function searchconsignee(searchvalue, searchin)
{
	// alert("Hi...");

	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	// var searchvalue=trim(frm.searchvalue_company.value);
	// alert("searchvalue :- " + searchvalue);
	if(searchvalue.length <= 0 || searchvalue == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Search Value" + "\n";
		// frm.searchvalue.focus();
	}

	if(searchin.length <= 0 || searchin == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Where to Search In " + "\n";
		// frm.searchvalue.focus();
	}


	if(Number(error_count) == 0)
	{
		var div_name = "#div_searchconsignee";
		var page_name = "add_consignee_2.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {searchvalue:searchvalue, searchin:searchin},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function searchform1(searchvalue, searchin, divName, formName)
{
	// alert("Hi...");
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	// var searchvalue=trim(frm.searchvalue_company.value);
	// alert("searchvalue :- " + searchvalue);
	if(searchvalue.length <= 0 || searchvalue == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Search Value" + "\n";
		// frm.searchvalue.focus();
	}

	if(searchin.length <= 0 || searchin == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Where to Search In " + "\n";
		// frm.searchvalue.focus();
	}


	if(Number(error_count) == 0)
	{
		var div_name = "#"+divName;
		var page_name = formName;
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {searchvalue:searchvalue, searchin:searchin},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}


function searchvehicleownership(searchvalue, searchin)
{
	// alert("Hi...");

	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	// var searchvalue=trim(frm.searchvalue_company.value);
	// alert("searchvalue :- " + searchvalue);
	if(searchvalue.length <= 0 || searchvalue == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Search Value" + "\n";
		// frm.searchvalue.focus();
	}

	if(searchin.length <= 0 || searchin == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Where to Search In " + "\n";
		// frm.searchvalue.focus();
	}


	if(Number(error_count) == 0)
	{
		var div_name = "#div_searchvehicleownership";
		var page_name = "add_vehicleownership_2.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {searchvalue:searchvalue, searchin:searchin},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function searchmenu(searchvalue, searchin)
{
	// alert("Hi...");

	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	// var searchvalue=trim(frm.searchvalue_company.value);
	// alert("searchvalue :- " + searchvalue);
	if(searchvalue.length <= 0 || searchvalue == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Search Value" + "\n";
		// frm.searchvalue.focus();
	}

	if(searchin.length <= 0 || searchin == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Where to Search In " + "\n";
		// frm.searchvalue.focus();
	}


	if(Number(error_count) == 0)
	{
		var div_name = "#div_searchmenu";
		var page_name = "add_pages_2.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {searchvalue:searchvalue, searchin:searchin},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}


function searchmerchant(searchvalue, searchin)
{
	// alert("Hi...");
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	// var searchvalue=trim(frm.searchvalue_company.value);
	// alert("searchvalue :- " + searchvalue);
	if(searchvalue.length <= 0 || searchvalue == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Search Value" + "\n";
		// frm.searchvalue.focus();
	}

	if(searchin.length <= 0 || searchin == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Where to Search In " + "\n";
		// frm.searchvalue.focus();
	}


	if(Number(error_count) == 0)
	{
		var div_name = "#div_searchmerchant";
		var page_name = "add_merchant_2.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {searchvalue:searchvalue, searchin:searchin},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function editlogin(loginid, CreationDate, ModificationDate, Creator, ip, UserName, UserID, last_login, Active)
{
	// alert("ID :- " + id);
	document.getElementById("AddEdit").value="1";
	if(Number(loginid) > 0)
	{
		document.getElementById("AddEdit").value=loginid;
		document.getElementById("username").value=UserName;
		document.getElementById("userid").value=UserID;

		document.getElementById("userpassword").value="";
		document.getElementById("designation").selectedIndex=0;
		document.getElementById("designation").disabled=true;

		document.getElementById("username").focus();

		// $('#div_merchantcontrols').addClass('animated swing');
		document.getElementById('div_merchantcontrols').style.borderColor='#b8b894';
		document.getElementById('div_merchantcontrols').style.borderTopWidth='3px';
		document.getElementById('div_panel').style.backgroundColor='#b8b894';

		// $("#div_merchantcontrols").css({ 'border-color': "#00c0ef" });
		// $( "#div_merchantcontrols" ).css( "border-top", "3px solid red");
		document.getElementById("span_pageName").innerHTML="Update - " +UserName;
		document.getElementById("span_pageButton").innerHTML="Update";

	}
	else
	{
		alert("Login ID is Blank. Please check......");
	}
}

function editconsignee(cnid, companyname,url, cnaid, address, pincode, city, telephone,  email, amid, AreaName, consignoraddressid, ConsignorName)
{
	// alert("ConsignorName :- " + ConsignorName);
	document.getElementById("AddEdit").value=cnid;
	document.getElementById("AddEdit1").value=cnaid;
	document.getElementById("AddEdit4").value=amid;
	edited_consignoraddressid=document.getElementById("consignoraddressid").value;

	if(Number(cnid) > 0 && Number(cnaid) > 0 && Number(amid) > 0)
	{
		document.getElementById("companyname").value=companyname;
		document.getElementById("url").value=url;
		document.getElementById("address").value=address;
		document.getElementById("area").value=AreaName;
		document.getElementById("pincode").value=pincode;
		document.getElementById("city").value=city;
		document.getElementById("telephone").value=telephone;
		document.getElementById("email").value=email;

		if(edited_consignoraddressid!=consignoraddressid) {
			var oForm = document.forms["consignee_form"];
			$("#consignoraddressid option").eq(0).before($('<option>', {
				value: consignoraddressid,
				text: ConsignorName
			}));
			document.getElementById("consignoraddressid").selectedIndex = 0;
		}

		document.getElementById("companyname").focus();

		// $('#div_merchantcontrols').addClass('animated swing');
		document.getElementById('div_merchantcontrols').style.borderColor='#b8b894';
		document.getElementById('div_merchantcontrols').style.borderTopWidth='3px';
		document.getElementById('div_panel').style.backgroundColor='#b8b894';

		// $("#div_merchantcontrols").css({ 'border-color': "#00c0ef" });
		// $( "#div_merchantcontrols" ).css( "border-top", "3px solid red");
		document.getElementById("span_pageName").innerHTML="Update - " +companyname;
		document.getElementById("span_pageButton").innerHTML="Update";
	}
	else
	{
		alert("Consignee / Address ID is Blank. Please check......");
	}
}

function editproduct(pmid, CreationDate, ModificationDate, Creator, ip, ProductName, Active)
{
	// alert("ID :- " + id);
	document.getElementById("AddEdit").value=pmid;
	if(Number(pmid) > 0)
	{
		document.getElementById("productname").value=ProductName;
		document.getElementById("productname").focus();

		// $('#div_merchantcontrols').addClass('animated swing');
		document.getElementById('div_merchantcontrols').style.borderColor='#b8b894';
		document.getElementById('div_merchantcontrols').style.borderTopWidth='3px';
		document.getElementById('div_panel').style.backgroundColor='#b8b894';

		// $("#div_merchantcontrols").css({ 'border-color': "#00c0ef" });
		// $( "#div_merchantcontrols" ).css( "border-top", "3px solid red");
		document.getElementById("span_pageName").innerHTML="Update - " +ProductName;
		document.getElementById("span_pageButton").innerHTML="Update";
	}
	else
	{
		alert("Consignee / Address ID is Blank. Please check......");
	}
}

 function edittransporter(tmid, CreationDate, ModificationDate, Creator, ip, TransporterName, Address, MobileNumber, LicenceNumber, Active)
{
	// alert("ID :- " + id);
	document.getElementById("AddEdit").value=tmid;
	if(Number(tmid) > 0)
	{
		document.getElementById("transportername").value=TransporterName;
		document.getElementById("address").value=Address;
		document.getElementById("mobilenumber").value=MobileNumber;
		document.getElementById("licencenumber").value=LicenceNumber;

		document.getElementById("transportername").focus();

		// $('#div_merchantcontrols').addClass('animated swing');
		document.getElementById('div_merchantcontrols').style.borderColor='#b8b894';
		document.getElementById('div_merchantcontrols').style.borderTopWidth='3px';
		document.getElementById('div_panel').style.backgroundColor='#b8b894';

		// $("#div_merchantcontrols").css({ 'border-color': "#00c0ef" });
		// $( "#div_merchantcontrols" ).css( "border-top", "3px solid red");
		document.getElementById("span_pageName").innerHTML="Update - " +TransporterName;
		document.getElementById("span_pageButton").innerHTML="Update";

	}
	else
	{
		alert("Consignee / Address ID is Blank. Please check......");
	}
}

function editvehicle(vmid, CreationDate, ModificationDate, Creator, ip, vo_id, VehicleOwnershipName, VehicleName, VehicleNumber, RCBookNumber, Active, RegistrationYear, PermitNo, PermitExpiry, InsuranceNo, InsuranceExpiry)
{
	// alert("ID :- " + id);

	ClearAllControls_Only(0);
	edited_vehicleownershipname=document.getElementById("vehicleownershipname").value;
	document.getElementById("AddEdit").value=vmid;
	if(Number(vmid) > 0)
	{
		document.getElementById("vehiclename").value=VehicleName;
		document.getElementById("vehiclenumber").value=VehicleNumber;
		document.getElementById("vehiclercbooknumber").value=RCBookNumber;
		if(edited_vehicleownershipname!=vo_id) {
			var oForm = document.forms["vehicle_form"];
			$("#vehicleownershipname option").eq(0).before($('<option>', {
				value: vo_id,
				text: VehicleOwnershipName
			}));

			document.getElementById("vehicleownershipname").selectedIndex = 0;
		}

		document.getElementById("registrationyear").value=RegistrationYear;
		document.getElementById("permitnumber").value=PermitNo;
		// alert("PermitExpiry :- " + PermitExpiry);
		if(PermitExpiry!="0000-00-00" && PermitExpiry!="") {
			document.getElementById("vehiclepermitexpiredate").value = PermitExpiry;
		}

		document.getElementById("insurancenumber").value=InsuranceNo;
		if(InsuranceExpiry!="0000-00-00" && InsuranceExpiry!="") {
			document.getElementById("insuranceexpiredate").value = InsuranceExpiry;
		}
		document.getElementById("vehiclename").focus();

		// $('#div_merchantcontrols').addClass('animated swing');
		document.getElementById('div_merchantcontrols').style.borderColor='#b8b894';
		document.getElementById('div_merchantcontrols').style.borderTopWidth='3px';
		document.getElementById('div_panel').style.backgroundColor='#b8b894';

		// $("#div_merchantcontrols").css({ 'border-color': "#00c0ef" });
		// $( "#div_merchantcontrols" ).css( "border-top", "3px solid red");
		document.getElementById("span_pageName").innerHTML="Update - " +VehicleNumber;
		document.getElementById("span_pageButton").innerHTML="Update";

	}
	else
	{
		alert("Consignee / Address ID is Blank. Please check......");
	}
}

function editvehicleownership(vo_id, CreationDate, ModificationDate, Creator, ip, Owner, Active)
{
	// alert("ID :- " + id);
	document.getElementById("AddEdit").value=vo_id;
	if(Number(vo_id) > 0)
	{
		document.getElementById("vehicleownershipname").value=Owner;
		document.getElementById("vehicleownershipname").focus();

		// $('#div_merchantcontrols').addClass('animated swing');
		document.getElementById('div_merchantcontrols').style.borderColor='#b8b894';
		document.getElementById('div_merchantcontrols').style.borderTopWidth='3px';
		document.getElementById('div_panel').style.backgroundColor='#b8b894';

		// $("#div_merchantcontrols").css({ 'border-color': "#00c0ef" });
		// $( "#div_merchantcontrols" ).css( "border-top", "3px solid red");
		document.getElementById("span_pageName").innerHTML="Update - " +Owner;
		document.getElementById("span_pageButton").innerHTML="Update";
	}
	else
	{
		alert("Ownership ID is Blank. Please check......");
	}
}

function editcategory(cmid, CreationDate, ModificationDate, Creator, ip, CategoryName, Octroi, Active)
{
	// alert("ID :- " + id);
	document.getElementById("AddEdit").value=cmid;
	if(Number(cmid) > 0)
	{
		document.getElementById("categoryname").value=CategoryName;
		document.getElementById("octroi").value=Octroi;
		document.getElementById("categoryname").focus();
	}
	else
	{
		alert("Category ID is Blank. Please check......");
	}
}

function editcontacttype(ctmid, CreationDate, ModificationDate, Creator, ip, ContactName, Active)
{
	// alert("ID :- " + id);
	document.getElementById("AddEdit").value=ctmid;
	if(Number(ctmid) > 0)
	{
		document.getElementById("contacttypename").value=ContactName;
		document.getElementById("contacttypename").focus();

		// $('#div_merchantcontrols').addClass('animated swing');
		document.getElementById('div_merchantcontrols').style.borderColor='#b8b894';
		document.getElementById('div_merchantcontrols').style.borderTopWidth='3px';
		document.getElementById('div_panel').style.backgroundColor='#b8b894';

		// $("#div_merchantcontrols").css({ 'border-color': "#00c0ef" });
		// $( "#div_merchantcontrols" ).css( "border-top", "3px solid red");
		document.getElementById("span_pageName").innerHTML="Update - " + ContactName;
		document.getElementById("span_pageButton").innerHTML="Update";

	}
	else
	{
		alert("Menu ID is Blank. Please check......");
	}
}

function editadditionalcharge(acmid, CreationDate, ModificationDate, Creator, ip, ChargeName, ChargePercentage, ChargeFix, Active)
{
	// alert("ID :- " + id);
	document.getElementById("AddEdit").value=acmid;
	if(Number(acmid) > 0)
	{
		document.getElementById("additionalchargename").value=ChargeName;
		document.getElementById("chargepercentage").value=ChargePercentage;
		document.getElementById("chargefix").value=ChargeFix;
		document.getElementById("additionalchargename").focus();
	}
	else
	{
		alert("Additional Charge ID is Blank. Please check......");
	}
}

function editrate(rmid, CreationDate, ModificationDate, Creator, ip, caid, cnid, pmid, MinimumRate, CartoonRate, ItemRate, Active, ConsignorName, ProductName, ConsigneeName)
{
	// alert("ID :- " + id);

	edited_consignorid=document.getElementById("consignorid").value;
	edited_consigneeid=document.getElementById("consigneeid").value;
	edited_productid=document.getElementById("productid").value;

	document.getElementById("AddEdit").value=rmid;
	if(Number(rmid) > 0)
	{
		if(edited_consignorid!=caid) {
			var oForm = document.forms["rate_form"];
			$("#consignorid option").eq(0).before($('<option>', {
				value: caid,
				text: ConsignorName
			}));
			document.getElementById("consignorid").selectedIndex = 0;
		}

		if(edited_productid!=pmid) {
			var oForm = document.forms["rate_form"];
			$("#productid option").eq(0).before($('<option>', {
				value: pmid,
				text: ProductName
			}));
			document.getElementById("productid").selectedIndex = 0;
		}

		if(edited_consigneeid!=cnid) {
			var oForm = document.forms["rate_form"];
			$("#consigneeid option").eq(0).before($('<option>', {
				value: cnid,
				text: ConsigneeName
			}));
			document.getElementById("consigneeid").selectedIndex = 0;
		}


		document.getElementById("minimumrate").value=MinimumRate;
		document.getElementById("cartoonrate").value=CartoonRate;
		document.getElementById("itemrate").value=ItemRate;

		document.getElementById("consignorid").focus();

	}
	else
	{
		alert("Rate ID is Blank. Please check......");
	}
}

function editarea(amid, CreationDate, ModificationDate, Creator, ip, AreaName, Active)
{
	// alert("ID :- " + id);
	document.getElementById("AddEdit").value=amid;
	if(Number(amid) > 0)
	{
		document.getElementById("areaname").value=AreaName;
		document.getElementById("areaname").focus();
	}
	else
	{
		alert("Area ID is Blank. Please check......");
	}
}

function editlrentry(lrid)
{
	// alert("LRID :- " + lrid);
	document.getElementById("AddEdit").value=lrid;
	if(Number(lrid) > 0)
	{
		document.getElementById("additionalcharges").checked=false;
		displayAdditionalCharges(6, '::1');
		document.getElementById("div_pageheader").innerHTML = "Edit LREntry " + lrid;

		document.getElementById("invoicenumber").focus();

	}
	else
	{
		alert("Menu ID is Blank. Please check......");
	}
}

function editmenu(menusub_id, CreationDate, ModificationDate, Creator, ip, url, urlDescription, Active)
{
	// alert("ID :- " + id);
	document.getElementById("AddEdit").value=menusub_id;
	if(Number(menusub_id) > 0)
	{
		document.getElementById("menuname").value=url;
		document.getElementById("pagedescription").value=urlDescription;
		document.getElementById("menuname").focus();
	}
	else
	{
		alert("Menu ID is Blank. Please check......");
	}
}


 function editmerchant(mmid, CreationDate, ModificationDate, Creator, ip, Company, Address, amid, AreaName, Pincode, City, Telephone, Email, Website, Pancard, Active)
{
	// alert("ID :- " + id);
	document.getElementById("AddEdit").value=mmid;
	document.getElementById("AddEdit1").value=amid;
	if(Number(mmid) > 0)
	{
		document.getElementById("companyname").value=Company;
		document.getElementById("address").value=Address;
		document.getElementById("area").value=AreaName;
		document.getElementById("pincode").value=Pincode;
		document.getElementById("city").value=City;
		document.getElementById("telephone").value=Telephone;
		document.getElementById("email").value=Email;
		document.getElementById("url").value=Website;
		document.getElementById("panno").value=Pancard;
		document.getElementById("companyname").focus();

		// $('#div_merchantcontrols').addClass('animated swing');
		document.getElementById('div_merchantcontrols').style.borderColor='#b8b894';
		document.getElementById('div_merchantcontrols').style.borderTopWidth='3px';
		document.getElementById('div_panel').style.backgroundColor='#b8b894';

		// $("#div_merchantcontrols").css({ 'border-color': "#00c0ef" });
		// $( "#div_merchantcontrols" ).css( "border-top", "3px solid red");
		document.getElementById("span_pageName").innerHTML="Update - " +UserName;
		document.getElementById("span_pageButton").innerHTML="Update";
	}
	else
	{
		alert("Merchant ID is Blank. Please check......");
	}
}

function editpageaccess(id, CreationDate, ModificationDate, Creator, ip, menusub_id, PageName, designation_id, LoginName, Active)
{
	// alert("ID :- " + id);
	edited_PageID=document.getElementById("pagename").value;
	edited_LoginID=document.getElementById("username").value;

	document.getElementById("AddEdit").value="1";
	if(Number(menusub_id) > 0)
	{
		document.getElementById("AddEdit").value=id;

		if(edited_PageID!=menusub_id) {
			var oForm = document.forms["pageaccess_form"];
			$("#pagename option").eq(0).before($('<option>', {
				value: menusub_id,
				text: PageName
			}));
			document.getElementById("pagename").selectedIndex = 0;
		}

		if(edited_LoginID!=designation_id) {
			var oForm = document.forms["pageaccess_form"];
			$("#username option").eq(0).before($('<option>', {
				value: designation_id,
				text: LoginName
			}));
			document.getElementById("username").selectedIndex = 0;
		}

	}
	else
	{
		alert("Merchant ID is Blank. Please check......");
	}
}

function add_pageaccess()
{
	// alert("Hi...");
	var frm=document.pageaccess_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var pagename=trim(frm.pagename.value);
	if(pagename.length <= 0 || pagename == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Page Name" + "\n";
		frm.pagename.focus();
	}

	var username=trim(frm.username.value);
	if(username.length <= 0 || username == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select User Name" + "\n";
		frm.username.focus();
	}

	if(Number(error_count) == 0)
	{
		var div_name = "#div_pageacess";
		var page_name = "save_pageaccess.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, pagename:pagename, username:username},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
	else
	{
		alert(error_msg);
		return false;
	}
}

function add_product()
{
	// alert("Hi...");
	var frm=document.product_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var productname=trim(frm.productname.value);
	if(productname.length <= 0 || productname == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Product Name" + "\n";
		frm.productname.focus();
	}

	if(Number(error_count) == 0)
	{
		var div_name = "#div_product";
		var page_name = "save_addproduct.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, productname:productname},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function add_contacttype()
{
	// alert("Hi...");
	var frm=document.contacttype_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var contacttypename=trim(frm.contacttypename.value);
	if(contacttypename.length <= 0 || contacttypename == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Contact Type Name" + "\n";
		frm.contacttypename.focus();
	}

	if(Number(error_count) == 0)
	{
		var div_name = "#div_contacttypename";
		var page_name = "save_addcontacttype.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, contacttypename:contacttypename},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function add_additionalcharge()
{
	// alert("Hi...");
	var frm=document.additionalcharge_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var additionalchargename=trim(frm.additionalchargename.value);
	if(additionalchargename.length <= 0 || additionalchargename == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Additional Charge Name" + "\n";
		frm.additionalchargename.focus();
	}

	var chargepercentage=trim(frm.chargepercentage.value);
	if(chargepercentage.length <= 0 || chargepercentage == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Additional Charge in Percentage" + "\n";
		frm.chargepercentage.focus();
	}

	var chargefix=trim(frm.chargefix.value);
	if(chargefix.length <= 0 || chargefix == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Additional Charge in Fix" + "\n";
		frm.chargefix.focus();
	}


	if(Number(error_count) == 0)
	{
		var div_name = "#div_additionalcharges";
		var page_name = "save_addadditionalcharge.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, additionalchargename:additionalchargename, chargepercentage:chargepercentage, chargefix:chargefix},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function add_additionalcharge()
{
	// alert("Hi...");
	var frm=document.additionalcharge_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var additionalchargename=trim(frm.additionalchargename.value);
	if(additionalchargename.length <= 0 || additionalchargename == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Additional Charge Name" + "\n";
		frm.additionalchargename.focus();
	}

	var chargepercentage=trim(frm.chargepercentage.value);
	if(chargepercentage.length <= 0 || chargepercentage == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Charges in Percentage" + "\n";
		frm.chargepercentage.focus();
	}

	var chargefix=trim(frm.chargefix.value);
	if(chargefix.length <= 0 || chargefix == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Charges in Fix" + "\n";
		frm.chargefix.focus();
	}

	if(Number(error_count) == 0)
	{
		var div_name = "#div_additionalcharges";
		var page_name = "save_addadditionalcharge.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, additionalchargename:additionalchargename, chargepercentage:chargepercentage, chargefix:chargefix},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}


function add_area()
{
	// alert("Hi...");
	var frm=document.area_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var areaname=trim(frm.areaname.value);
	if(areaname.length <= 0 || areaname == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Area Name" + "\n";
		frm.areaname.focus();
	}

	if(Number(error_count) == 0)
	{
		var div_name = "#div_area";
		var page_name = "save_addarea.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, areaname:areaname},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}


function lrentry_disabled(Values, ControlName)
{
	if(Values.length > 0 || Values != "")
	{
		document.getElementById(ControlName).disabled=true;
	}
}

function add_lrentry()
{
	// alert("Hi...");
	var frm=document.lrentry_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var financialyear=trim(frm.financialyear.value);
	if(financialyear.length <= 0 || financialyear == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Financial Year" + "\n";
		frm.financialyear.focus();
	}





	FromDate=trim(frm.todaysdate.value);
	if(FromDate.length <= 0 || FromDate == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " From Date is blank." + "\n";
		//frm.order.focus();
	}
	else {
		FromDate_Valid = isDate(FromDate, "/");
		if (FromDate_Valid == false) {
			error_count = error_count + 1;
			error_msg = error_msg + error_count + ") " + " From Date is invalid. Please enter date in mm/dd/yyyy Format.";
		}
	}

	ToDate=trim(frm.lrdate.value);
	if(ToDate.length <= 0 || ToDate == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please select LR date." + "\n";
		document.getElementById("lrdate").focus();
	}
	else {
		ToDate_Valid = isDate(ToDate, "/")
		//alert("FinishDate_Valid :- " + FinishDate_Valid);
		if (ToDate_Valid == false) {
			error_count = error_count + 1;
			error_msg = error_msg + error_count + ") " + " LR Date is invalid. Please enter date in mm/dd/yyyy Format.";
			document.getElementById("lrdate").focus();
		}
	}

	if (FromDate_Valid==true && ToDate_Valid==true){
		Difference=dateDifference(FromDate, ToDate)
		// alert("Difference :- " + Difference);
		if (Difference > 0){
			error_count = error_count + 1;
			error_msg  =  error_msg + error_count + ") " + " No future date.";
			document.getElementById("lrdate").focus();
		}
	}





	var invoicenumber=trim(frm.invoicenumber.value);
	if(invoicenumber.length <= 0 || invoicenumber == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Invoice Number" + "\n";
		frm.invoicenumber.focus();
	}

	var vehicleid=trim(frm.vehicleid.value);
	if(vehicleid.length <= 0 || vehicleid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Vehicle" + "\n";
		frm.vehicleid.focus();
	}

	var consignorid=trim(frm.consignorid.value);
	if(consignorid.length <= 0 || consignorid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Consignor" + "\n";
		frm.consignorid.focus();
	}

	var consigneeid=trim(frm.consigneeid.value);
	if(consigneeid.length <= 0 || consigneeid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Consignee" + "\n";
		frm.consigneeid.focus();
	}
	var productid=trim(frm.productid.value);
	if(productid.length <= 0 || productid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Product" + "\n";
		frm.productid.focus();
	}
	var packagetype=trim(frm.packagetype.value);
	if(packagetype.length <= 0 || packagetype == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Package Type" + "\n";
		frm.packagetype.focus();
	}

	var productrate=trim(frm.productrate.value);
	if(productrate.length <= 0 || productrate == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Check Product Rate" + "\n";
		frm.productrate.focus();
	}
	var qauntity=trim(frm.qauntity.value);
	if(qauntity.length <= 0 || qauntity == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Quantity" + "\n";
		frm.qauntity.focus();
	}
	var shippingcharge=trim(frm.shippingcharge.value);
	if(shippingcharge.length <= 0 || shippingcharge == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Shipping Charges" + "\n";
		frm.shippingcharge.focus();
	}

	var biltycharge=trim(frm.biltycharge.value);
	
	var servicetax=trim(frm.servicetax.value);

	var additionalchargesentry="";
	var additionalchargeTick="";
	additionalchargeTick=frm.additionalcharges.checked;
	if(additionalchargeTick==true){
		additionalchargesentry=frm.additionalchargesentry.value;
	}

	var paidlramount=trim(frm.paidlramount.value);

	// alert("additionalchargesentry :- " + additionalchargesentry);
	// return false;

	if(Number(error_count) == 0)
	{
		var div_name = "#div_lrentry";
		var page_name = "save_lrentry.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, financialyear:financialyear, ToDate:ToDate, invoicenumber:invoicenumber, vehicleid:vehicleid, consignorid:consignorid, consigneeid:consigneeid, productid:productid, packagetype:packagetype, productrate:productrate, qauntity:qauntity, paidlramount:paidlramount, shippingcharge:shippingcharge, biltycharge:biltycharge, servicetax:servicetax, additionalchargesentry:additionalchargesentry},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
	else{
		alert(error_msg);
		return false;
	}

}

function add_transporter()
{
	// alert("Hi...");
	var frm=document.transporter_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}


	var transportername=trim(frm.transportername.value);
	if(transportername.length <= 0 || transportername == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Transporter Name" + "\n";
		frm.transportername.focus();
	}

	var address=trim(frm.address.value);

	var mobilenumber=trim(frm.mobilenumber.value);
	if(mobilenumber.length <= 0 || mobilenumber == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Mobile Number" + "\n";
		frm.mobilenumber.focus();
	}

	var licencenumber=trim(frm.licencenumber.value);


	if(Number(error_count) == 0)
	{
		var div_name = "#div_transporter";
		var page_name = "save_addtransporter.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, transportername:transportername, address:address, mobilenumber:mobilenumber, licencenumber:licencenumber},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
	else{
		alert(error_msg);
		return false;
	}
}

function add_vehicle()
{
	// alert("Hi...");
	var frm=document.vehicle_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var vehiclename=trim(frm.vehiclename.value);
	if(vehiclename.length <= 0 || vehiclename == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Vehicle Name" + "\n";
		frm.vehicleownershipname.focus();
	}

	var vehiclenumber=trim(frm.vehiclenumber.value);
	if(vehiclenumber.length <= 0 || vehiclenumber == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Vehicle Number" + "\n";
		frm.vehicleownershipname.focus();
	}

	var vehiclercbooknumber=trim(frm.vehiclercbooknumber.value);


	var vehicleownershipname=trim(frm.vehicleownershipname.value);
	if(vehicleownershipname.length <= 0 || vehicleownershipname == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Vehicle Ownership" + "\n";
		frm.vehicleownershipname.focus();
	}

	var registrationyear=trim(frm.registrationyear.value);

	var permitnumber=trim(frm.permitnumber.value);
	var vehiclepermitexpiredate=trim(frm.vehiclepermitexpiredate.value);
	if(permitnumber.length > 0 && (vehiclepermitexpiredate.length <= 0 || vehiclepermitexpiredate == ""))
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Permit Expiry date " + "\n";
		frm.vehiclepermitexpiredate.focus();
	}

	if(vehiclepermitexpiredate.length > 0 && (permitnumber.length <= 0 || permitnumber == ""))
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Permit Number" + "\n";
		frm.permitnumber.focus();
	}

	var insurancenumber=trim(frm.insurancenumber.value);
	var insuranceexpiredate=trim(frm.insuranceexpiredate.value);
	if(insurancenumber.length > 0 && (insuranceexpiredate.length <= 0 || insuranceexpiredate == ""))
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Insurance Expiry date" + "\n";
		frm.insuranceexpiredate.focus();
	}
	if(insuranceexpiredate.length > 0 && (insurancenumber.length <= 0 || insurancenumber == ""))
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Insurance Number" + "\n";
		frm.insurancenumber.focus();
	}

	if(Number(error_count) == 0)
	{
		var div_name = "#div_vehicle";
		var page_name = "save_addvehicle.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, vehiclename:vehiclename, vehiclenumber:vehiclenumber, vehiclercbooknumber:vehiclercbooknumber, vehicleownershipname:vehicleownershipname, registrationyear:registrationyear, permitnumber:permitnumber, vehiclepermitexpiredate:vehiclepermitexpiredate, insurancenumber:insurancenumber, insuranceexpiredate:insuranceexpiredate},
			function(data) {
				$(div_name).html(data);
			}
		);
		return false;
	}
	else
	{
		alert(error_msg);
		return false;
	}
}


function add_vehicleownership()
{
	// alert("Hi...");
	var frm=document.vehicleownershipmenu_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var vehicleownershipname=trim(frm.vehicleownershipname.value);
	if(vehicleownershipname.length <= 0 || vehicleownershipname == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Vehicle Ownership Name" + "\n";
		frm.vehicleownershipname.focus();
	}

	if(Number(error_count) == 0)
	{
		var div_name = "#div_vehicleownership";
		var page_name = "save_addvehicleownership.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, vehicleownershipname:vehicleownershipname},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function add_category()
{
	// alert("Hi...");
	var frm=document.category_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var categoryname=trim(frm.categoryname.value);
	if(categoryname.length <= 0 || categoryname == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Category Name" + "\n";
		frm.menuname.focus();
	}

	var octroi=trim(frm.octroi.value);

	if(Number(error_count) == 0)
	{
		var div_name = "#div_category";
		var page_name = "save_addcategory.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, categoryname:categoryname, octroi:octroi},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function add_rate()
{
	// alert("Hi...");
	var frm=document.rate_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var consignorid=trim(frm.consignorid.value);
	if(consignorid.length <= 0 || consignorid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Consignor" + "\n";
		frm.consignorid.focus();
	}

	var consigneeid=trim(frm.consigneeid.value);
	if(consigneeid.length <= 0 || consigneeid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Consignee" + "\n";
		frm.consigneeid.focus();
	}

	var productid=trim(frm.productid.value);
	if(productid.length <= 0 || productid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Product" + "\n";
		frm.productid.focus();
	}

	var minimumrate=trim(frm.minimumrate.value);
	if(minimumrate.length <= 0 || minimumrate == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Minimum Rate" + "\n";
		frm.minimumrate.focus();
	}

	var cartoonrate=trim(frm.cartoonrate.value);
	if(cartoonrate.length <= 0 || cartoonrate == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Cartoon Rate" + "\n";
		frm.cartoonrate.focus();
	}

	var itemrate=trim(frm.itemrate.value);
	if(itemrate.length <= 0 || itemrate == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Item Rate" + "\n";
		frm.itemrate.focus();
	}


	if(Number(error_count) == 0)
	{
		var div_name = "#div_rate";
		var page_name = "save_addrate.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, consignorid:consignorid, consigneeid:consigneeid, productid:productid, minimumrate:minimumrate, cartoonrate:cartoonrate, itemrate:itemrate},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function add_menu()
{
	// alert("Hi...");
	var frm=document.menu_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var menuname=trim(frm.menuname.value);
	if(menuname.length <= 0 || menuname == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Menu Name" + "\n";
		frm.menuname.focus();
	}

	var pagedescription=trim(frm.pagedescription.value);
	if(pagedescription.length <= 0 || pagedescription == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Page Description" + "\n";
		frm.pagedescription.focus();
	}

	if(Number(error_count) == 0)
	{
		var div_name = "#div_menu";
		var page_name = "save_pages.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, menuname:menuname, pagedescription:pagedescription},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function add_consignor()
{
	// alert("Hi...");
	var frm=document.consignor_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);
	var AddEdit1=trim(frm.AddEdit1.value);
	var AddEdit2=trim(frm.AddEdit2.value);
	var AddEdit3=trim(frm.AddEdit3.value);
	var AddEdit4=trim(frm.AddEdit4.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var consignorname=trim(frm.consignorname.value);
	if(consignorname.length <= 0 || consignorname == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Consignor Name" + "\n";
		frm.consignorname.focus();
	}

	var address=trim(frm.address.value);
	if(address.length <= 0 || address == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Address" + "\n";
		frm.address.focus();
	}

	var area=trim(frm.area.value);
	if(area.length <= 0 || area == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Area" + "\n";
		frm.area.focus();
	}


	var pincode=trim(frm.pincode.value);
	if(pincode.length <= 0 || pincode == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Pincode" + "\n";
		frm.pincode.focus();
	}

	var city=trim(frm.city.value);
	if(city.length <= 0 || city == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter City" + "\n";
		frm.city.focus();
	}

	var panno=trim(frm.panno.value);
	if(panno.length <= 0 || panno == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Pancard Number" + "\n";
		frm.panno.focus();
	}



	var telephone1=trim(frm.telephone1.value);
	if(telephone1.length <= 0 || telephone1 == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Telephone 1" + "\n";
		frm.telephone1.focus();
	}

	var telephone2=trim(frm.telephone2.value);

	var telephone3=trim(frm.telephone3.value);


	var email=trim(frm.email.value);
	if(email.length <= 0 || email == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Email" + "\n";
		frm.email.focus();
	}

	var url=trim(frm.url.value);
	if(url.length <= 0 || url == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Website" + "\n";
		frm.url.focus();
	}

	var j=0;
	var selectedvalue="";
	var product_len=document.getElementById("product").length;
	for($i=0; $i<product_len; $i++)
	{
		var selected=document.getElementById("product").options[$i].selected;
		if(selected==true){
			j=j+1;
			if(j==1) {
				selectedvalue = document.getElementById("product").options[$i].value;
			}
			else{
				selectedvalue = selectedvalue+","+document.getElementById("product").options[$i].value;
			}
		}
	}

	if(selectedvalue.length <= 0 || selectedvalue == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Product" + "\n";
		frm.product.focus();
	}
	// alert($('product option').length);

	var remark=trim(frm.remark.value);
	var servicetax=0;
	var servicetax_tick=frm.servicetax.checked;
	// alert("servicetax_tick :- " + servicetax_tick);
	if(servicetax_tick==true)
	{
		servicetax=1;
	}
	if(Number(error_count) == 0)
	{
		var div_name = "#div_consignor";
		var page_name = "save_addconsignor.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, AddEdit1:AddEdit1, AddEdit2:AddEdit2, AddEdit3:AddEdit3, session_userid:session_userid, session_ip:session_ip, consignorname:consignorname, address:address, area:area, pincode:pincode, city:city, panno:panno, telephone1:telephone1, telephone2:telephone2, telephone3:telephone3, email:email, url:url, selectedvalue:selectedvalue, remark:remark, servicetax:servicetax},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
	else
	{
		alert(error_msg);
		return false;
	}
}

function t()
{

	// alert("Selected Value :- " + selectedvalue);
}

function add_consignee()
{
	// alert("Hi...");
	var frm=document.consignee_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);
	var AddEdit1=trim(frm.AddEdit1.value);
	var AddEdit4=trim(frm.AddEdit4.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var consignoraddressid=trim(frm.consignoraddressid.value);
	if(consignoraddressid.length <= 0 || consignoraddressid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Consignor Name" + "\n";
		frm.consignoraddressid.focus();
	}

	var companyname=trim(frm.companyname.value);
	if(companyname.length <= 0 || companyname == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Company Name" + "\n";
		frm.username.focus();
	}

	var address=trim(frm.address.value);
	if(address.length <= 0 || address == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Address" + "\n";
		frm.userid.focus();
	}

	var area=trim(frm.area.value);
	if(area.length <= 0 || area == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Area" + "\n";
		frm.area.focus();
	}

	var pincode=trim(frm.pincode.value);
	if(pincode.length <= 0 || pincode == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Pincode" + "\n";
		frm.pincode.focus();
	}

	var city=trim(frm.city.value);
	if(city.length <= 0 || city == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter City" + "\n";
		frm.city.focus();
	}

	var telephone=trim(frm.telephone.value);
	if(telephone.length <= 0 || telephone == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Telephone" + "\n";
		frm.telephone.focus();
	}

	var email=trim(frm.email.value);
	if(email.length <= 0 || email == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Email" + "\n";
		frm.email.focus();
	}

	var url=trim(frm.url.value);
	if(url.length <= 0 || url == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Website" + "\n";
		frm.url.focus();
	}



	if(Number(error_count) == 0)
	{
		var div_name = "#div_consignee";
		var page_name = "save_consignee.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, AddEdit1:AddEdit1, AddEdit4:AddEdit4, session_userid:session_userid, session_ip:session_ip, consignoraddressid:consignoraddressid, companyname:companyname, address:address, area:area, pincode:pincode, city:city, telephone:telephone, email:email, url:url},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}

function add_merchant()
{
	// alert("Hi...");
	var frm=document.merchant_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);
	var AddEdit1=trim(frm.AddEdit1.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" +
			"" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}
	
	var companyname=trim(frm.companyname.value);
	if(companyname.length <= 0 || companyname == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Company Name" + "\n";
		frm.username.focus();
	}

	var address=trim(frm.address.value);
	if(address.length <= 0 || address == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Address" + "\n";
		frm.userid.focus();
	}

	var area=trim(frm.area.value);
	if(area.length <= 0 || area == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter area" + "\n";
		frm.area.focus();
	}

	var pincode=trim(frm.pincode.value);
	if(pincode.length <= 0 || pincode == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Pincode" + "\n";
		frm.pincode.focus();
	}

	var city=trim(frm.city.value);
	if(city.length <= 0 || city == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter City" + "\n";
		frm.city.focus();
	}

	var panno=trim(frm.panno.value);
	if(panno.length <= 0 || panno == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Pan No" + "\n";
		frm.panno.focus();
	}

	var telephone=trim(frm.telephone.value);
	if(telephone.length <= 0 || telephone == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Telephone" + "\n";
		frm.telephone.focus();
	}

	var email=trim(frm.email.value);
	if(email.length <= 0 || email == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Email" + "\n";
		frm.email.focus();
	}

	var url=trim(frm.url.value);
	if(url.length <= 0 || url == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Website" + "\n";
		frm.url.focus();
	}



	if(Number(error_count) == 0)
	{
		var div_name = "#div_merchant";
		var page_name = "save_merchant.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, AddEdit1:AddEdit1, session_userid:session_userid, session_ip:session_ip, companyname:companyname, address:address, area:area, pincode:pincode, city:city, panno:panno, telephone:telephone, email:email, url:url},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
}



function add_login()
{
	// alert("Hi...");
	var frm=document.login_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var AddEdit=trim(frm.AddEdit.value);

	var session_userid=trim(frm.session_userid.value);
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=trim(frm.session_ip.value);
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var username=trim(frm.username.value);
	if(username.length <= 0 || username == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User Name" + "\n";
		frm.username.focus();
	}

	var userid=trim(frm.userid.value);
	if(userid.length <= 0 || userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		frm.userid.focus();
	}


	userpassword=trim(frm.userpassword.value);
	if(userpassword.length <= 0 || userpassword == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User Password" + "\n";
		frm.userpassword.focus();
	}
	else
	{
		var pwd = hex_sha512(userpassword);
	}

	var designation=trim(frm.designation.value);
	if(designation.length <= 0 || designation == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Designation" + "\n";
		frm.designation.focus();
	}


	if(Number(error_count) == 0)
	{
		var div_name = "#div_login";
		var page_name = "save_addlogin.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {AddEdit:AddEdit, session_userid:session_userid, session_ip:session_ip, username:username, userid:userid, pwd:pwd, designation:designation},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
	else{
		alert(error_msg);
		return false;
	}
}

function displayAdditionalCharges(session_userid, session_ip)
{
	var frm=document.lrentry_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var session_userid=session_userid;
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=session_ip;
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter IP address" + "\n";
		// frm.username.focus();
	}

	var additionalcharges_tick=0;
	var additionalcharges_tick=frm.additionalcharges.checked;
	// alert("additionalcharges_tick :- " + additionalcharges_tick);
	if(additionalcharges_tick==true)
	{
		var div_name = "#div_additionalcharges";
		var page_name = "lrentry_5.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {session_userid:session_userid, session_ip:session_ip, additionalcharges_tick:additionalcharges_tick},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
	else{
		// alert("Else....");
		if(error_msg!="") {
			alert(error_msg);
		}
		frm.additionalcharges.checked=false;
		document.getElementById("additionalchargesentry").value="";
		document.getElementById("div_additionalcharges").innerHTML = "";
		return false;
	}
	
}

function get_quantityRate(Quantity, Creator, ip)
{
	var frm=document.lrentry_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var Quantity=Quantity;
	if(Quantity.length <= 0 || Quantity == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Error - Quantity" + "\n";
		// frm.username.focus();
	}

	var session_userid=Creator;
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Error - User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=ip;
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Error - IP Address " + "\n";
		// frm.username.focus();
	}

	var consignorid=trim(frm.consignorid.value);
	if(consignorid.length <= 0 || consignorid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Consignor" + "\n";
		frm.consignorid.focus();
	}

	// alert("consignorid :- " + consignorid);
	var consigneeid=trim(frm.consigneeid.value);
	if(consigneeid.length <= 0 || consigneeid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Consignee" + "\n";
		frm.consigneeid.focus();
	}

	var productid=trim(frm.productid.value);
	if(productid.length <= 0 || productid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Product" + "\n";
		frm.productid.focus();
	}

	var productrate=trim(frm.productrate.value);
	if(productrate.length <= 0 || productrate == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Enter Product Rate" + "\n";
		// frm.productid.focus();
	}


	if(Number(error_count) == 0)
	{
		document.getElementById("qauntity").disabled = true;
		var div_name = "#div_quantityrate";
		var page_name = "lrentry_4.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {Quantity:Quantity, session_userid:session_userid, session_ip:session_ip, consignorid:consignorid, consigneeid:consigneeid, productid:productid, productrate:productrate},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
	else
	{
		alert(error_msg);
		return false;
	}
}

function lradditionalcharge(cnt, Controlname)
{
	var frm=document.lrentry_form;
	var lramount=trim(frm.lramount.value);
	if(lramount.length <= 0 || lramount == "")
	{
		alert("Please check. LR Amount is Blank");
	}

	// alert("Controlname :- " + Controlname);

	var additionalchargevalueclub="";
	var additionalchargevalue=0;
	var Controlname=Controlname.split(",");
	for(i=0; i<cnt; i++)
	{
		Names=Controlname[i];
		// alert("Names :- " + Names);
		// alert("Control Value :- " + document.getElementById(Names).value);
		additionalchargevalue=Number(additionalchargevalue)+Number(document.getElementById(Names).value);

		if(i==0){
			additionalchargevalueclub=Names+"~"+Number(document.getElementById(Names).value);
		}
		else{
			additionalchargevalueclub=additionalchargevalueclub+"||"+Names+"~"+Number(document.getElementById(Names).value);
		}
	}

	document.getElementById("additionalchargesentry").value = additionalchargevalueclub;

	// alert("additionalchargevalue :- " + additionalchargevalue);



	// alert("lradditioncharge :- " + lradditioncharge);
	// alert("lramount :- " + lramount);
	additionamount=Number(lramount)+Number(additionalchargevalue);
	// alert("additionamount :- " + additionamount);
	frm.paidlramount.value=additionamount;
}

function get_productRate(packageType, Creator, ip)
{
	var frm=document.lrentry_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var packageType=packageType;
	if(packageType.length <= 0 || packageType == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Error - Package Type ID" + "\n";
		// frm.username.focus();
	}

	var session_userid=Creator;
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Error - User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=ip;
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Error - IP Address " + "\n";
		// frm.username.focus();
	}

	var consignorid=trim(frm.consignorid.value);
	if(consignorid.length <= 0 || consignorid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Consignor" + "\n";
		frm.consignorid.focus();
	}

	// alert("consignorid :- " + consignorid);
	var consigneeid=trim(frm.consigneeid.value);
	if(consigneeid.length <= 0 || consigneeid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Consignee" + "\n";
		frm.consigneeid.focus();
	}

	var productid=trim(frm.productid.value);
	if(productid.length <= 0 || productid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Please Select Product" + "\n";
		frm.productid.focus();
	}


	if(Number(error_count) == 0)
	{
		document.getElementById("packagetype").disabled = true;
		var div_name = "#div_productrate";
		var page_name = "lrentry_3.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {packageType:packageType, session_userid:session_userid, session_ip:session_ip, consignorid:consignorid, consigneeid:consigneeid, productid:productid},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
	else
	{
		alert(error_msg);
		return false;
	}
}


function get_productOnConsignee(ConsigneeID, ConsignorID, Creator, ip)
{
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var ConsigneeID=ConsigneeID;
	if(ConsigneeID.length <= 0 || ConsigneeID == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Error - Consignee ID" + "\n";
		// frm.username.focus();
	}

	var ConsignorID=ConsignorID;
	if(ConsignorID.length <= 0 || ConsignorID == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Error - Consignor ID" + "\n";
		// frm.username.focus();
	}

	var session_userid=Creator;
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Error - User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=ip;
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Error - IP Address " + "\n";
		// frm.username.focus();
	}


	if(Number(error_count) == 0)
	{
		document.getElementById("consigneeid").disabled = true;
		var div_name = "#div_product";
		var page_name = "lrentry_2.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {ConsigneeID:ConsigneeID, ConsignorID:ConsignorID, session_userid:session_userid, session_ip:session_ip},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
	else
	{
		alert("ID is Blank.");
		return false;
	}
}

function get_consignee(ConsignorID, Creator, ip)
{
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

	var ConsignorID=ConsignorID;
	if(ConsignorID.length <= 0 || ConsignorID == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Error - Consignor ID" + "\n";
		// frm.username.focus();
	}

	var session_userid=Creator;
	if(session_userid.length <= 0 || session_userid == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Error - User ID" + "\n";
		// frm.username.focus();
	}
	var session_ip=ip;
	if(session_ip.length <= 0 || session_ip == "")
	{
		error_count = error_count + 1;
		error_msg  =  error_msg + error_count + ") " + " Error - IP Address " + "\n";
		// frm.username.focus();
	}


	if(Number(error_count) == 0)
	{
		document.getElementById("consignorid").disabled = true;
		var div_name = "#div_consignee";
		var page_name = "lrentry_1.php";
		$(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
		$.post(page_name, {ConsignorID:ConsignorID, session_userid:session_userid, session_ip:session_ip},
			function(data)
			{
				$(div_name).html(data);
			}
		);
		return false;
	}
	else
	{
		alert("ID is Blank.");
		return false;
	}
}
