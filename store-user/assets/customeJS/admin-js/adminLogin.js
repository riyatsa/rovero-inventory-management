
/*  file name : adminLogin.js
*	created date: 29-06-2020
*/
 var email_regex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
	password_length = 8;

function storeLogin(){
	var email = $("#email").val();
	var password = $("#password").val();
	// alert(email+'Hello'+password);

	if (email != '' && password != '' && email_regex.test(email) == true && password.length >= 8) {

		$('#login-email-error').html('');
		$('#login-password-error').html('');

		$.ajax({
			type: "POST",
		  	url: base_url+"?/adminLogin/verifylogin",
		  	data: {email: email, password: password},
		  	 dataType: "json",
		  	success: function(data){
		  		// alert(data.status);
			  	if (data.status == '1') {
			  		window.location.href = base_url+"?/store-panel";
			  	} else {
			  		let html = "<span class='text-danger'>Incorrect Email Id or Password</span>";
					$('#login-error').html(html);
		  		}
		  	} 
		});
	} else {

		if (email == '' && password == '') {
			$('#email').focus();
			$('#login-email-error').html('Please enter your email');
			$('#login-password-error').html('Please enter your password');
		} else if (!email_regex.test(email) && password.length < 4) {
			$('#email').focus();
			$('#login-email-error').html('Please enter a valid email id');
			$('#login-password-error').html('Password length should minimum 4 characters');
		} else {
			if (email == '') {
				$('#email').focus();
				$('#login-email-error').html('Please enter your email');
			} else if (password == '') {
				$('#password').focus();
				$('#login-password-error').html('Please enter your password');
			} else if (!email_regex.test(email))  {
				$('#email').focus();
				$('#login-email-error').html('Please enter a valid email id');
			} else if (password < 4){
				$('#password').focus();
				$('#login-password-error').html('Password length should minimum 4 characters');
			} else {
				
			}
		}

		if (email != '' && email_regex.test(email) == true) {
			$('#login-email-error').html('');
		}

		if (password != '' && password >= 4) {
			$('#login-password-error').html('');
		}
	}
}