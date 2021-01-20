<?php

include('../connection.php');

if (isset($_POST['emailsubmit']))
{


    $entered_email = $_POST['digitemail'];


    $q ="SELECT * FROM USERA WHERE USER_EMAIL =  '$entered_email'";

    $qp = oci_parse($conn,$q);
    oci_execute($qp);

    if (($row = oci_fetch_assoc($qp))==true)
    {
        $password=$row['USER_PASSWORD'];

    //Emailing the OTP
    $tos  = $entered_email;
    $subjects = "forgot Verification OTP";
    $random_numbers =rand(1, 10000);
    $messages = "Your OTP is '$random_numbers' and your password is '$password'";

      $head='From: uniq.funkii@gmail.com';
      $z=mail($tos,$subjects,$messages,$head);
      if ($z){
          $query = "UPDATE USERA SET USER_STATUS='$random_numbers' WHERE USER_EMAIL='$tos'";
          
          $qry = oci_parse($conn, $query);
          oci_execute($qry);

          header("location: forgetpass.include.php?mailsent=1");
      }
      else {
      
          header("location: forgetpass.include.php?mailnotfound=1");
      }

        
    }
    else{
        header("location: forgetpass.include.php?mailnotfound=1");

    }
      

}
