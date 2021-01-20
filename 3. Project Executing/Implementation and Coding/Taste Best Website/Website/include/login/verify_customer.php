<?php
include("../connection.php");

?>

<?php

if (isset($_POST['otpsubmit'])) {

	$enteredOTP=$_POST['digit'];
		$st = "SELECT * FROM USERA WHERE USER_STATUS='$enteredOTP'";

		$qry = oci_parse($conn, $st);

		if (!$qry)
		{
			header('location: ../../login.php?enterValidOTPSQL=1');
		}

		oci_execute($qry);

		if (($row= oci_fetch_array($qry))==true)
			{
				$username=$row['USERNAME'];
				$type=$row['USER_TYPE'];
				$userid=$row['USER_ID'];


				$stmt = "UPDATE USERA SET USER_STATUS ='verified' WHERE USER_STATUS='$enteredOTP'";

				$uquery = oci_parse($conn, $stmt);

				if(!$uquery)
				{
					header('location: ../../login.php?OTPnotupdated=1');
				}
				
				oci_execute($uquery);

				if ($row['USER_TYPE']=='trader')
				{
					session_start();
					$_SESSION['admin_name']=$username;
					$_SESSION['admin_id']=$userid;
					$_SESSION['admin_type']=$type;
					
				$S_query ="SELECT * FROM CART c , CART_PRODUCT cp WHERE c.CART_ID=cp.CART_ID AND USER_ID='$userid'";

				$cart_SELECT= oci_parse($conn,$S_query);

				if(!$cart_SELECT){
				    echo "sql error";
				}

				oci_execute($cart_SELECT);

				if(oci_num_rows($cart_SELECT)<1)
				{

			    $i_query ="INSERT INTO CART VALUES (null,0,'$userid')";

				$cart_created= oci_parse($conn,$i_query);

				if(!$cart_created){
 				   echo "cart not created for your ID";
					}

				oci_execute($cart_created);

				echo"<h3> Enjoy your shop </h3>";

				}
					header("Location: ../../trader_area/index.php?dashboard");
				}
				else{

					session_start();
					$_SESSION['customer_name']=$username;
					$_SESSION['customer_id']=$userid;
					$_SESSION['customer_type']=$type;
					
					$S_query ="SELECT * FROM CART c , CART_PRODUCT cp WHERE c.CART_ID=cp.CART_ID AND USER_ID='$userid'";

					$cart_SELECT= oci_parse($conn,$S_query);

					if(!$cart_SELECT){
					    echo "sql error";
					}

					oci_execute($cart_SELECT);

					if(oci_num_rows($cart_SELECT)<1)
					{

 					   $i_query ="INSERT INTO CART VALUES (null,0,'$userid')";

						$cart_created= oci_parse($conn,$i_query);

					if(!$cart_created){
					    echo "cart not created for your ID";
					}

					oci_execute($cart_created);

					echo"<h3> Enjoy your shop </h3>";

					}
					header("location: ../../index.php?loginSucess='$userid'");

				}
				
				
			}
			else{
				header('location: ../../login.php?entervalidOTP=1');
			}
		

    }else{
    	header('loacation: ../../login.php');
    }

?>