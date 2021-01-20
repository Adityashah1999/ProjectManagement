<?php

include("../connection.php");
session_start();


    if (isset($_GET['productid']))
    {
        $productid=$_GET['productid'];

        $checkeruery="SELECT * FROM PRODUCT WHERE PRODUCT_ID='$productid'";

        $cheparse=oci_parse($conn,$checkeruery);
    
       
    
        if (!$cheparse)
        {
            echo "add selection not done";
        }
        oci_execute($cheparse);
    
        $rowP=oci_fetch_assoc($cheparse);

        if (isset($_GET['quantity']))
        {
            $productquantity=$_GET['quantity'];
        }
        else if ($rowP==true){
            
        $minimumorder= $rowP['MIN_ORDER'];
          $productquantity=$minimumorder;
        }

    if (isset($_SESSION['customer_id']))
    {
        $userid= $_SESSION['customer_id'];
    }
    else if (isset($_SESSION['admin_id']))
    {
        $userid=$_SESSION['admin_id'];
    }
    
    $checkerquery="SELECT * FROM CART_PRODUCT CP , CART C WHERE cp.CART_ID = C.CART_ID AND CP.PRODUCT_ID = '$productid' and c.USER_ID='$userid' and CP.STATUS=0";

    $cheparse=oci_parse($conn,$checkerquery);   

    if (!$cheparse)
    {
        echo "add selection not done";
    }
    oci_execute($cheparse);

    $row=oci_fetch_assoc($cheparse);
    if ($row==true)
    {
        $proq=$row['PRODUCT_QUANTITY'];
        $cart = $row['CART_ID'];
        if($proq==$productquantity){
        header("location: ../../cart.php?itemalreadyoncart=1");
    }
        else{
            $Uquery="UPDATE CART_PRODUCT SET PRODUCT_QUANTITY='$productquantity' WHERE PRODUCT_ID='$productid' AND CART_ID = '$cart'";
            $Uparse=oci_parse($conn,$Uquery);

    if (!$Uparse)
    {
        echo "add selection not done";

    }
    oci_execute($Uparse);
    

    header("location: ../../cart.php?itemalreadyoncartbutquantityupdated=1");
    
        }
    }
    else{
       
        
    $query="SELECT * FROM  CART WHERE USER_ID='$userid'";

    $parse=oci_parse($conn,$query);

    if (!$parse)
    {
        echo "add selection not done";
    }
    oci_execute($parse);

        if ($row=oci_fetch_assoc($parse))
        {
            $cart_id=$row['CART_ID'];
    
            $inserting_query= "INSERT INTO CART_PRODUCT(CART_ID,PRODUCT_ID,PRODUCT_QUANTITY,STATUS) VALUES('$cart_id','$productid','$productquantity',0)";
    
            $insert_parse=oci_parse($conn,$inserting_query);
    
        if (!$insert_parse)
        {
            echo "add insertion not done";
        }
        $exec=oci_execute($insert_parse);

        if ($exec)
        {
        header("location: ../../cart.php?itemadded=1");

        }
    
        }

    }

    



    }
	
    

?>