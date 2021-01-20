<?php

if (isset($_GET['mailsent']))
{
    $message="the OTP mail has been sent to you. Check your mail and <a href='../../login.php'  style='color:orange ; text-decoration:none;'>Login Again </a>";
}
if (isset($_GET['mailnotfound']))
{
    $message="No Such Mail found. Enter a valid one. <a href='../../login.php' style='color:orange ; text-decoration:none;'>Login Again</a>";
}

?>


		<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password</title>
    <link rel="stylesheet" href="otp.css">
</head>
<body>
    <div class="prompt">
    <?php
    if(isset($message))
    {
        echo $message;
    }
    else
    {
        echo "Enter a Valid email that you registered";
    }
    ?>
        
    </div>
    
    <form method="post" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off" action="forget.php">
    <input type="email" id="digit-email" name="digitemail" />
		<button type="submit" name="emailsubmit">Submit</button>
    </form>
</body>
</html>
