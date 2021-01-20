<?php
session_start();

include("include/connection.php");
include("include/header.include.php");
include("include/banner.include.php");

if (isset($_GET['logout']))
{
	$lmessage="User has logged out.";
}

if (isset($_GET['erroremailalreadyexists']))
{
	$message="Email is taken already. Please use another Email Address";
}
if (isset($_GET['registeredandemailsent']))
{
	$message="Email is You have been Sucessfully Registered and Check your Email for OTP";
}
else if(isset($_GET['registeredandemailnotsent'])){
	$message="Email is You have been Sucessfully Registered and <br/>But you have not been sent your email <br>  Check your Internet  OR Please allow less secure app to send email. ";
}

if (isset($_GET['passworddidnotmatch']))
{
	$message="Password didnot match";
}

if (isset($_GET['enterValidOTPSQL']))
{
	$lmessage = "THere is a database error in validating OTP";
}
else if (isset($_GET['OTPnotupdated'])){
	$lmessage ="There has been some error so OTP is not Verified";

}
if (isset($_GET['entervalidOTP']))
{
	$lmessage = "Please enter a valid otp and login again";
}
if (isset($_GET['emailpasswordwrong']))
{
	$lmessage="login credentials wrong";
}

if (isset($_GET['onlypasswordwrong']))
{
	$lmessage="Invalid Password";
}

if (isset($_GET['invalidemail']))
{
	$lmessage="Invalid username";
}

if(isset($_GET['loginSucess']))
{
	session_start();
	$_SESSION['userid']=$_GET['loginSucess'];
}

?>

<section class="my_account_area pt--80 pb--55 bg--white">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="my__account__wrapper">
							<h3 class="account__title">Login</h3>
							<p><?php 
							if (isset($lmessage))
							{
								echo $lmessage;
							}
							
							?> </p>

							<?php
							if (isset($_SESSION['customer_id']) || isset($_SESSION['admin_id']))
							{
								echo "<p style='background-color:green ; text-align:center ; padding:10px; color :white'> You can continue to shop </p>";

								echo "
								<form action='include/logout.include.php' method='POST'>
								
								<button style='background-color:red ; text-align:center ; padding:10px; color :white' name='logout' > Logout</button>
								
								</form>

								";
								
							}
							else{
								


							?>
							<form action="include/login/login.include.php" method="POST" enctype="multipart/form-data">
								<div class="account__form">
									<div class="input__box">
										<label>Username or email address <span>*</span></label>
										<input type="text" name="username" required>
									</div>
									<div class="input__box">
										<label>Password<span>*</span></label>
										<input type="text" name="pass" required>
									</div>
									<div class="input__box">
										<label>Select the Type<span>*</span></label>
										<select name='tradertype'>  
                    					<option value='customer'>Customer</option>
                    					<option value='trader'>Trader</option>
										<option value='management'>Management</option>
                						</select>
									</div>
									<div class="form__btn">
										<button type="submit" name="login">Login</button>
										<label class="label-for-checkbox">
											<input id="rememberme" class="input-checkbox" name="rememberme" value="forever" type="checkbox">
											<span>Remember me</span>
										</label>
									</div>
									<a class="forget_pass" href="include/login/forgetpass.include.php">Lost your password?</a>
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="my__account__wrapper">
							<h3 class="account__title">Register</h3>
							<p><?php 
							if (isset($message)){							
							echo $message;
							}
							?></p>
							<form action="include/login/register.include.php" method="POST" enctype="multipart/form-data">
								<div class="account__form">
								<div class="input__box">
										<label>Your Name<span>*</span></label>
										<input type="text" name="name" required>
									</div>
									<div class="input__box">
										<label>Email address <span>*</span></label>
										<input type="email" name="email" required>
									</div>
									<div class="input__box">
										<label>Address <span>*</span></label>
										<input type="text" name="address" required>
									</div>
									<div class="input__box">
										<label>Phone Number<span>*</span></label>
										<input type="number" name="contact" required>
									</div>
									<div class="input__box">
										<label>Password<span>*</span></label>
										<input type="password" name="password" required>
									</div>
									<div class="input__box">
										<label>Confirm Password<span>*</span></label>
										<input type="password" name="password1" required>
									</div>
									<div class="input__box">
										<label>Select the Type<span>*</span></label>
										<select name='customertype'>  
                    					<option value='customer'>Customer</option>
                    					<option value='trader'>Trader</option>
										<option value='management'>Management</option>
                						</select>
									</div>
									
									<div class="form__btn">
										<button type="submit" name="register">Register</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<?php

						} ?>
				</div>
			</div>
		</section>
		<!-- End My Account Area -->


<?php
include("include/footer.include.php");