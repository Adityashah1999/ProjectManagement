<?php
if (isset($_GET['wishdelete'])){
$wishlistserviceno= $_GET['wishdelete'];
setcookie("mywish[$wishlistserviceno]", $wishlistserviceno, time()-(60*60*24*30), "/");
header('location: ../../wishlist.php?itemdeleted=1');
}