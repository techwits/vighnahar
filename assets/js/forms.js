function formhash(email, password) {
    // Create a new element input, this will be our hashed password field. 
    var frm=document.logincheck_form;
	var error_count;
	var error_msg;
	error_msg="";
	error_count=0;

    var userid=frm.userid.value;
    if(userid.length <= 0 || userid == "")
		{
			error_count = error_count + 1;
			error_msg  =  error_msg + " Username is required" + "\n";
            frm.userid.focus();
		}

    var userpassword=frm.userpassword.value;
    if(userpassword.length <= 0 || userpassword == "")
		{
			error_count = error_count + 1;
			error_msg  =  error_msg + " Password is required" + "\n";
            frm.userpassword.focus();
		}
    else
        {
            var pwd = hex_sha512(frm.userpassword.value);
            // alert("p :- " + p);
            if(pwd.length <= 0 && userid.length <= 0)
            {
                error_msg  =  " Please enter details below" + "\n";
            }
        }

    // frm.userpassword.value = "";

    var autologin=0;
    if(document.getElementById("autologin").checked == true){
        autologin=1;
    }
    else{
        autologin=0;
    }

    //
    // alert("UserID :- "  + userid);
    // alert("userpassword :- "  + userpassword);
    // alert("pwd :- "  + pwd);
    // alert("autologin :- "  + autologin);

    if(Number(error_count) == 0)
    {
        var div_name = "#div_login";
        var page_name = "assets/inc/process_login.php";
        $(div_name).html("<div align='center' class='please_wait'><br /><br /><img src='images/wait.gif' /></div>");
        $.post(page_name, {userid:userid, pwd:pwd, autologin:autologin},
            function(data)
            {
                $(div_name).html(data);
            }
        );
        return false;
        // frm.submit();
    }
    else
    {
        document.getElementById("div_login").innerHTML = error_msg;
        return false;
    }

}
 
function regformhash(form, uid, email, password, conf) {
     // Check each field has a value
    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
 
    // Check the username
 
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        alert("Username must contain only letters, numbers and underscores. Please try again"); 
        form.username.focus();
        return false; 
    }
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }
 
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }
 
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";
 
    // Finally submit the form. 
    form.submit();
    return true;
}