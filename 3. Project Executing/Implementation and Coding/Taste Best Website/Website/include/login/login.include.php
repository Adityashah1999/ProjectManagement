

<!-- LOGIN -->
<?php 

include("../connection.php");


if(isset($_POST['login'])){
$user = $_POST['username'];
$pass = $_POST['pass'];

$sql_login = "SELECT * FROM USERA WHERE USERNAME='$user' OR USER_EMAIL ='$user'"; 

$login_stmt = oci_parse($conn, $sql_login);

if(!$login_stmt)
{
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
}

oci_execute($login_stmt);

if (($row= oci_fetch_array($login_stmt))==true)
{
	$username = $row['USERNAME'];
	$userid = $row['USER_ID'];
	$password = $row ['USER_PASSWORD'];
	$user_status =$row['USER_STATUS'];
	$type=$row['USER_TYPE'];
	$verified_password= password_verify($pass,$password);
	if($type=='trader'){
		if($pass==$password){
			$verified_password=true;
		}
	}
	if ($user_status=="verified")
	{
		
	if ($verified_password==true && $type=="customer")
	{
		session_start();
		$_SESSION['customer_name']=$username;
		$_SESSION['customer_id']=$userid;
		$_SESSION['customer_type']=$type;
		header("Location: ../../index.php?loginSucess='$userid'");

	}else if ($verified_password==true && $type=="trader"){
	
		session_start();
		$_SESSION['admin_name']=$username;
		$_SESSION['admin_id']=$userid;
		$_SESSION['admin_type']=$type;
		header("Location: ../../trader_area/index.php?dashboard==1&&user_profile=$userid");
	}else if($type=='management'){
		echo "<script>alert('To view management dashboard </br> <a href='http://127.0.0.1:8080/apex/f?p=104:LOGIN_DESKTOP:6225547306363:::::'>Click here</a></script>"; 
        
      
	   header('Location: http://127.0.0.1:8080/apex/f?p=104:LOGIN_DESKTOP:6225547306363:::::');
	}

	else if($verified_password==false){
		header("Location: ../../login.php?onlypasswordwrong=1");

	}	  
	else {

		header("Location: ../../login.php?emailpasswordwrong=1");
	}

	}
	else{
		
		?>
		<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP VERification</title>
    <link rel="stylesheet" href="otp.css">
</head>
<body>
    <div class="prompt">
	<?php

	if($user_status=="ACTIVATE_AGAIN")
	{
		echo 'Your account wast deactivated type ACTIVATE_AGAIN to activate';
	}
	else{
	echo 'Enter the code generated on your mobile device below to log in!';
}
      ?>  
    </div>
    
    <form method="post" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off" action="verify_customer.php">
        <input type="text" id="digit-1" name="digit" />
		<button type="submit" name="otpsubmit"> <?php

if($user_status=="ACTIVATE_AGAIN")
{
	echo 'ACTIVATE';
}
else{
echo 'Submit OTP';
}
  ?> </button>
    </form>

    <script src="otp.js"></script>
</body>
</html>


	<?php 
}
}
else{
	header("location: ../../login.php?invalidemail=1");
}
}

?> 


		

