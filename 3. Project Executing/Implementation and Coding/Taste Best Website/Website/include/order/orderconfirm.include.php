<?php

session_start();
include('../connection.php');

if(isset($_SESSION['customer_id']))
{
    $userid=$_SESSION['customer_id'];
    $username=$_SESSION['customer_name'];

}
else if(isset($_SESSION['admin_id']))
{
    $userid=$_SESSION['admin_id'];
    $username=$_SESSION['admin_name'];
    
}
if (isset($_GET['cart']))
{
    $cart_id=$_GET['cart'];

$select_collection="SELECT * FROM COLLECTION_SLOT WHERE USER_ID=$userid";

$parse_select=oci_parse($conn,$select_collection);

if(!$parse_select)
{
    echo"there is a sql error in slecting the collection slot";
}
oci_execute($parse_select);

if (($row=oci_fetch_array($parse_select))==true)
{
    $collectionslotid=$row['SLOT_ID'];
    $collectionslottime=$row['SLOT_TIME'];
    $collectionslotstatus=$row['SLOT_STATUS'];
    $collectionslotdate=$row['SLOT_DATE'];

    $select_PAYMENT="SELECT * FROM PAYMENT WHERE USER_ID=$userid";

$parse_select_payment=oci_parse($conn,$select_PAYMENT);

if(!$parse_select_payment)
{
    echo"there is a sql error in slecting the collection slot";
}
oci_execute($parse_select_payment);
$pay=oci_fetch_array($parse_select_payment);

$payid=$pay['PAYMENT_ID'];

    
$insert_order="INSERT INTO ORDERR(ORDER_ID,ORDER_STATUS,ORDER_TIME,ORDER_DATE,ORDER_DESCRIPTION,CART_ID,PAYMENT_ID,SLOT_ID) VALUES(null,'PAID','$collectionslottime','$collectionslotdate','$collectionslotstatus','$cart_id','$payid','$collectionslotid')";
$parse_iinsert=oci_parse($conn,$insert_order);

if(!$parse_iinsert)
{
    echo"there is a sql error in fetching cartt";
}
$executed=oci_execute($parse_iinsert);

if ($executed)
{
        
$update_cart="UPDATE CART SET CART_STATUS=1  WHERE USER_ID = '$userid'";
$parse_update=oci_parse($conn,$update_cart);

if(!$parse_update)
{
    echo"there is a sql error in fetching cartt";
}
oci_execute($parse_update);

header('location: ../../cart.php?orderplaced=1');
}

}
}
else{
    header('location: ../../cart.php');
}





?>