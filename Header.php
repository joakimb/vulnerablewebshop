<div class="header">
	<div>
		<h2 id="sf_header">phones-R-us</h2>
	</div>
	<div>

		<form class="login">
			<input type="button" onClick="signUpForm()" value="Sign up">
		</form>

		<form class="login" >
			<input id="cancel" type="hidden" onClick="cancelSignup()" value="Cancel">
		</form>

		<form class="login" method="link" action="Login.php">
			<input type="text" name="username" value="username">
			<input type="text" name="password" value="password">
			<input type="hidden" id="address" name="address" value="address">
			<input type="submit" value="Sign in">
		</form>

	</div>
</div>

<script>

function signUpForm(){
	var form = document.getElementById("address");
	form.setAttribute("type", "text");
	var cancel = document.getElementById("cancel");
	cancel.setAttribute("type", "button");
}

function cancelSignup(){
	var form = document.getElementById("address");
	form.setAttribute("type", "hidden");
	var cancel = document.getElementById("cancel");
	cancel.setAttribute("type", "hidden");
}

</script>


<?php



	function showHeader(){
	
}
?>