<?php

session_start();

 
?>


<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<head>
	<title>Sign in</title>
	<link rel="shortcut icon" type="image/png" href="Images/Logo.png">
	<?php include 'link/links.php'; ?>
	<style type="text/css">
		
		*{
			margin: 0;
			padding: 0;
			font-family: 'Poppins', sans-serif;
			box-sizing: border-box;
		}

		body{
			-webkit-touch-callout: none; /* iOS Safari */
 			-webkit-user-select: none; /* Safari */
 			-khtml-user-select: none; /* Konqueror HTML */
 			-moz-user-select: none; /* Firefox */
 			-ms-user-select: none; /* Internet Explorer/Edge */
  			user-select: none; /* Non-prefixed version, currently */
		}

		.form-element{
			position: relative;
		}

		.form-element input{
			width: 321px;
		}
			
		.form-element .toggle-password {
			position:absolute;
			width:40px;
			height:40px;
			top:2px;
			right:2px;
			border-radius:50%;
			text-align:center;
			line-height:35px;
			font-size:20px;
			cursor:pointer;
		}
		
		.form-element .toggle-password.active i.fa-eye {
			display:none;
		}
		
		.form-element .toggle-password.active i.fa-eye-slash {
			display:inline;
		}
			
		.form-element .toggle-password i.fa-eye-slash {
			display:none;
		}
		.form-elements .password-policies {
			position:relative;
			top:0px;
			left:50%;
			transform:translateX(-50%);
			width:90%;
			padding:0px;
			height:0px;
			background:#f5f5f5;
			border-radius:5px;
			margin-top:10px;
			box-sizing:border-box;
			opacity:0;
			overflow:hidden;
			transition: height 300ms ease-in-out, opacity 300ms ease-in-out;
		}

		.form-elements .password-policies.active {
			opacity:1;
			background: #E9ECEF;
			padding:10px;
			height:240px;
		}

		.form-elements .password-policies > div {
			margin:15px 10px;
			font-weight:600;
			color:#ea4335;
			transition:all 300ms ease-in-out;
		}

		.form-elements .password-policies > div.active {
			color:#ddd;
		}

		.form-elem{
			position: relative;
		}

		.form-elem input{
			width: 321px;
		}
			
		.form-elem .toggle-pass {
			position:absolute;
			width:40px;
			height:40px;
			top:2px;
			right:2px;
			border-radius:50%;
			text-align:center;
			line-height:35px;
			font-size:20px;
			cursor:pointer;
		}
		
		.form-elem .toggle-pass.active i.fa-eye {
			display:none;
		}
		
		.form-elem .toggle-pass.active i.fa-eye-slash {
			display:inline;
		}
			
		.form-elem .toggle-pass i.fa-eye-slash {
			display:none;
		}

		.divider-text{
			position: relative;
			text-align: center;
			margin-top: 15px;
			margin-bottom: 15px;
		}

		.divider-text span{
			padding: 7px;
			font-size: 12px;
			position: relative;
			z-index: 2;
		}

		.divider-text:after{
			content: "";
			position: absolute;
			width: 100%;
			border-bottom: 1px solid #ddd;
			top: 55%;
			left: 0;
			z-index: 1;
		}

		.btn-facebook{
			background-color: #405D9D!important;
			color: #fff!important;
		}

		.btn-gmail{
			background-color: #ea4335!important;
			color: #fff!important;
		}	 	

	</style>

	<script>
		window.oncontextmenu = function () {
			return false;
		}

		$(document).keydown(function (event) {
			if (event.keyCode == 123) {
				return false;
			}
			else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
				return false;
			}
		});
	</script>

</head>
<body>

<?php

include 'dbcon.php';

if (isset($_POST['submit'])) {
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

	$pass = password_hash($password, PASSWORD_BCRYPT);
	$cpass = password_hash($cpassword, PASSWORD_BCRYPT);	


	$emailquery = " select * from signindata where email = '$email' ";
	$query = mysqli_query($con,$emailquery);

	$emailcount = mysqli_num_rows($query);


	if ($emailcount>0) {
		?>

			<script type="text/javascript">
					swal({
					title: "Verification!",
					text: "Email is already exist!",
					icon: "error",
					button: "OK",
					});
			</script>

		<?php
		
	} else{
		if ($password === $cpassword) {

		$insertquery = "insert into signindata(username, email, mobile, password, cpassword) values('$username','$email','$mobile','$pass','$cpass')";

			$iquery = mysqli_query($con, $insertquery);	
			if($iquery){

			?>

				<script type="text/javascript">location.href = 'login.php';</script>

			<?php

		} else{
			?> 
				
				<script type="text/javascript">
					swal({
					title: "Verification!",
					text: "Inserted UnSuccesful!",
					icon: "error",
					button: "OK",
					});
			</script>

		<?php

		}
			} else{

			?> 

			<script type="text/javascript">
					swal({
					title: "Verification!",
					text: "Password is not matching!",
					icon: "error",
					button: "OK",
					});
			</script>

			<?php
		}
	}
}

?>


	<div class="card bg-light">
		<article class="card-body mx-auto" style="max-width: 400px;">
			<h4 class="card-title mt-3 text-center">Create Account</h4>
			<p class="text-center">Get started with your free account</p>

			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-user"></i></span>
					</div>
						<input type="text" name="username" pattern="[A-Za-z]{1,}" title="Mention your username properly" class="form-control" placeholder="Full Name" required>
				</div>

				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-envelope"></i></span>
					</div>
						<input type="email" name="email" pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Mention your email address properly" class="form-control" placeholder="Email address" required>
				</div>

				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-phone"></i></span>
					</div>
						<input type="text" name="mobile" class="form-control" pattern="[1-9]{1}[0-9]{9}" maxlength="10" title="Mention your mobile number properly" placeholder="Phone number" required>
				</div>

				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-lock mb-1"></i></span>
					</div>

					<div class="form-element">
						<input type="password" value="" id="password-field" name="password" class="form-control"  placeholder="Create password" required>
						
						<div class="toggle-password">
							<i class="fa fa-eye"></i>
							<i class="fa fa-eye-slash"></i>
						</div>
					</div>

					<div class="form-elements">

						<div class="password-policies">
							<div class="policy-length">
								Between 8 to 12 Characters
							</div>

							<div class="policy-number">
								Contains atleast one number
							</div>

							<div class="policy-uppercase">
								Contains atleast one Uppercase
							</div>

							<div class="policy-lowercase">
								Contains atleast one Lowercase
							</div>

							<div class="policy-special">
								Contains atleast one Special Characters from this set !@#$%
							</div>
						</div>
					</div>
				</div>

				<div class="form-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-lock"></i></span>
					</div>

					<div class="form-elem">
						<input type="password" id="pass-field" name="cpassword" class="form-control" placeholder="Confirm password" required>

						<div class="toggle-pass">
							<i class="fa fa-eye"></i>
							<i class="fa fa-eye-slash"></i>
						</div>
					</div>
				</div>

				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-block">Create Account</button>
				</div>

				<p class="text-center">Have an account? <a href="login.php">Log in 
				</a></p>
			</form>
		</article>
		
	</div>

	<script type="text/javascript">

		function _id(name){
		return document.getElementById(name);
		}
		function _class(name){
		return document.getElementsByClassName(name);
		}
		_class("toggle-password")[0].addEventListener("click",function(){
		_class("toggle-password")[0].classList.toggle("active");

		if(_id("password-field").getAttribute("type") == "password"){
			_id("password-field").setAttribute("type","text");
		} else {
			_id("password-field").setAttribute("type","password");
		}
		});

		_id("password-field").addEventListener("focus",function(){
		_class("password-policies")[0].classList.add("active");
		});
		_id("password-field").addEventListener("blur",function(){
		_class("password-policies")[0].classList.remove("active");
		});

		_id("password-field").addEventListener("keyup",function(){
		let password = _id("password-field").value;

		if(password.length >= 8 && password.length <= 12){
			_class("policy-length")[0].classList.add("active");
		} else {
			_class("policy-length")[0].classList.remove("active");
		}

		if(/[0-9]/.test(password)){
			_class("policy-number")[0].classList.add("active");
		} else {
			_class("policy-number")[0].classList.remove("active");
		}
		
		if(/[A-Z]/.test(password)){
			_class("policy-uppercase")[0].classList.add("active");
		} else {
			_class("policy-uppercase")[0].classList.remove("active");
		}

		if(/[a-z]/.test(password)){
			_class("policy-lowercase")[0].classList.add("active");
		} else {
			_class("policy-lowercase")[0].classList.remove("active");
		}
		
		
		if(/[!@#$%]/.test(password)){
			_class("policy-special")[0].classList.add("active");
		} else {
			_class("policy-special")[0].classList.remove("active");
		}
		});

		function _id2(name){
		return document.getElementById(name);
		}
		function _class2(name){
		return document.getElementsByClassName(name);
		}
		_class2("toggle-pass")[0].addEventListener("click",function(){
		_class2("toggle-pass")[0].classList.toggle("active");

		if(_id2("pass-field").getAttribute("type") == "password"){
			_id2("pass-field").setAttribute("type", "text");
		} else {
			_id2("pass-field").setAttribute("type", "password");
		}
		});

	</script>

</body>
</html>