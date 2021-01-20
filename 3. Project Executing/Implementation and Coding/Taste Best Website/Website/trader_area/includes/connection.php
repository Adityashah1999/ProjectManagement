<?php 

//$conn = oci_connect('EXAMPLE', 'unique1-2', '//localhost/xe');

  $conn = oci_connect('projectmanagement', 'projectmanagement', '//localhost/xe'); 
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit; } 
    

?>