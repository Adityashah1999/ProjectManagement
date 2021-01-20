<?php
session_start();

include('../connection.php');

if (isset($_GET['productidremove'])){

    $p_id=$_GET['productid'];

    $query="DELETE FROM CART_PRODUCT WHERE PRODUCT_ID ='$p_id'";

    $parsing_query = oci_parse($conn,$query);

    if (!$parsing_query)
    {
        echo "Item not deleted because of sql error";
    }
    oci_execute($parsing_query);   

}