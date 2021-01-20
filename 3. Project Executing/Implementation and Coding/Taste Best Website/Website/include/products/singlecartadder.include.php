<?php
if (isset($_GET['addsubmit'])&& isset($_GET['proid'])&& isset($_GET['qty'])){
    
                    $quantity=trim($_GET['qty']);
                    $productid=trim($_GET['proid']);
                
   					header("location: ../cart/cartadder.include.php?productid=$productid&quantity=$quantity");
}