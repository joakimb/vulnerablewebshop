<div class="header">
	<div>
		<h2 id="sf_header">phones-R-us</h2>
	</div>
	<div>

		<form class="login">
			<input type="button" id="signin" onClick="signUpForm()" value="Sign up">
		</form>

		<form class="login" >
			<input id="cancel" type="hidden" onClick="cancelSignup()" value="Cancel">
		</form>

		<form class="login" id="signupin" method="post" action="SignIn.php">
			<input type="text" name="username" value="username">
			<input type="text" name="password" value="password">
			<input type="hidden" id="address" name="address" value="address">
			<input type="submit" id="submit" value="Sign in">
		</form>

	</div>
</div>

<script>

function signUpForm(){
	var address = document.getElementById("address");
	address.setAttribute("type", "text");
	var signin = document.getElementById("signin");
	signin.setAttribute("type", "hidden");
	var cancel = document.getElementById("cancel");
	cancel.setAttribute("type", "button");
	var submit = document.getElementById("submit");
	submit.setAttribute("value", "Submit");
	var form = document.getElementById("signupin");
	form.setAttribute("action", "SignUp.php");
}

function cancelSignup(){
	var address = document.getElementById("address");
	address.setAttribute("type", "hidden");
	var signin = document.getElementById("signin");
	signin.setAttribute("type", "button");
	var cancel = document.getElementById("cancel");
	cancel.setAttribute("type", "hidden");
	var submit = document.getElementById("submit");
	submit.setAttribute("value", "Sign in");
	var form = document.getElementById("form");
	form.setAttribute("action", "SignIn.php");
}

</script>


<?php



	function showHeader(){
	
}
?>