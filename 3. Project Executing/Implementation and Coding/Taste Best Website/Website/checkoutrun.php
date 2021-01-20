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


if (isset($_POST['collectionsubmit'])) {
    $select_que = "SELECT * FROM COLLECTION_SLOT WHERE USER_ID = '$userid'";
    $parse_sele = oci_parse($conn, $select_que);
    if (!$parse_sele) {
        echo "selection query on collection not parsed";
    }
    oci_execute($parse_sele);
   
    if (($row = oci_fetch_assoc($parse_sele)) == true) {
        
    
        
        $time = $_POST['hour'];
        $day = $_POST['day'];
        $status = $_POST['address'];
        $insertoncollection = "INSERT INTO COLLECTION_SLOT(SLOT_ID,SLOT_TIME,SLOT_STATUS,SLOT_DATE,USER_ID) VALUES(null,'$time','$status','$day','$userid')";

        $parsing = oci_parse($conn, $insertoncollection);

        oci_execute($parsing);

        $setted=1;
        $select_CART = "SELECT * FROM CART WHERE USER_ID = '$userid'";
        $CART_sele = oci_parse($conn, $select_CART);
        if (!$CART_sele) {
        echo "selection query on collection not parsed";
        }
    oci_execute($CART_sele);
    $cartrow=oci_fetch_assoc($CART_sele);
    $cartdi=$cartrow['CART_ID'];
       

        header("location: checkout.php?cartid=$cartdi&setted=$setted&sameday=1");
    
    } else {
        $time = $_POST['hour'];
        $day = $_POST['day'];
        $status = $_POST['address'];
        $insertoncollection = "INSERT INTO COLLECTION_SLOT(SLOT_ID,SLOT_TIME,SLOT_STATUS,SLOT_DATE,USER_ID) VALUES(null,'$time','$status','$day','$userid')";

        $parsing = oci_parse($conn, $insertoncollection);

        oci_execute($parsing);

        $setted=1;
        $select_CART = "SELECT * FROM CART WHERE USER_ID = '$userid'";
        $CART_sele = oci_parse($conn, $select_CART);
        if (!$CART_sele) {
        echo "selection query on collection not parsed";
        }
    oci_execute($CART_sele);
    $cartrow=oci_fetch_assoc($CART_sele);
    $cartdi=$cartrow['CART_ID'];

        header("location: checkout.php?cartid=$cartdi&setted=$setted");

    }
}

