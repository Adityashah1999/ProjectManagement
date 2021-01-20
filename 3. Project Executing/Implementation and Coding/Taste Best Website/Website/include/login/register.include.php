<!-- Start My Account Area -->
<?php
include("../connection.php");

if(isset($_POST['register'])){
	$username=$_POST['name'];
	$email=$_POST['email'];
	$address=$_POST['address'];
	$contact=$_POST['contact'];
	$password=$_POST['password'];
	$confirm_password=$_POST['password1'];
	$constumer_type = $_POST['customertype'];
	

	// $password=password_hash($password, PASSWORD_BCRYPT);
	// $confirm_password=password_hash($confirm_password, PASSWORD_BCRYPT);


	// password for the backend = sabdeeka123

	$emailquery="Select * from usera where USER_EMAIL='$email' ";
	$equery=oci_parse($conn,$emailquery);
	
	oci_execute($equery);
	$row=oci_fetch_assoc($equery);

	if($row==true){
		header("location: ../../login.php?erroremailalreadyexists=1");

	}else{
		if($password == $confirm_password){

			$confirm_password=password_hash($confirm_password, PASSWORD_DEFAULT);
			$insertquery="INSERT INTO USERA (USERNAME, USER_PASSWORD, USER_PHONE, USER_ADDRESS, USER_EMAIL,USER_TYPE ) VALUES('$username','$confirm_password','$contact','$address','$email','$constumer_type')";
			$query=oci_parse($conn,$insertquery);
			$g=oci_execute($query); 
			
			

			if($g)
    		{
				echo "<script>alert('You are registered successfully.')</script>";
      $to  = $email;
	  $subject = "Email Verification OTP";
	  $random_number =rand(1, 10000);
	  $message = $random_number;

        $head='From: uniq.funkii@gmail.com';
		$z=mail($to,$subject,$message,$head);
		if ($z){
			$query = "UPDATE USERA SET USER_STATUS='$random_number' WHERE USER_EMAIL='$email'";
			
			$qry = oci_parse($conn, $query);
			oci_execute($qry);
			

			header("location: ../../login.php?registeredandemailsent=1");
		}
		else {
			header("location: ../../login.php?registeredandemailnotsent=1");
		}
		

    		}
		}else{
			header("location: ../../login.php?passworddidnotmatch=1");

		}

		}
}

?>