<?php
session_start();
include('include/connection.php');

if (isset($_SESSION['customer_id'])) {
    $userid = $_SESSION['customer_id'];
    $username = $_SESSION['customer_name'];
} else if (isset($_SESSION['admin_id'])) {
    $userid = $_SESSION['admin_id'];
    $username = $_SESSION['admin_name'];
}
// eta xai checkout successful vaesi order ma insert garney data haru.
// redirect: 

$date=date('m/d/Y');
$query="INSERT INTO PAYMENT (PAYMENT_ID, PAYMENT_STATUS,PAYMENT_TYPE,PAYMENT_DATE,USER_ID) VALUES (null,'PAID','PAYPAL','$date','$userid')";
    $insertPayment = oci_parse($conn, $query);
        if (!$insertPayment) {
            echo "selection query on collection not parsed";
        }
        oci_execute($insertPayment);

      
    
        $Select_query="SELECT* FROM CART WHERE USER_ID='$userid'";
        $select_parse= oci_parse($conn, $Select_query);
        if (!$select_parse) {
            echo "selection query on collection not parsed";
        }
        oci_execute($select_parse);
    
        if (($row=oci_fetch_assoc($select_parse))==true)
        {
            $cart_id=$row['CART_ID'];
            $updatecart_product="UPDATE CART_PRODUCT SET STATUS=1 WHERE CART_ID='$cart_id' ";
            $update_parse = oci_parse($conn, $updatecart_product);
            if (!$update_parse) {
                echo "selection query on collection not parsed";
            }
            oci_execute($update_parse);
            header("location: include/order/orderconfirm.include.php?cart=$cart_id");
    
        }
    

