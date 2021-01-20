<?php 

session_unset();

session_destroy();

 echo "<script>window.open('../login.php','_self')</script>";

?>