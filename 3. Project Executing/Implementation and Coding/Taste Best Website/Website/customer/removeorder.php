<?php
session_start();
include('includes/db.php');
    if (isset($_SESSION['customer_id'])) {
        $u_id = $_SESSION['customer_id'];
    } else if (isset($_SESSION['admin_id'])) {
        $u_id = $_SESSION['admin_id'];
    }

    if (isset($_GET['cartid'])) {
        $cartid = $_GET['cartid'];
        
        $query_order="DELETE FROM ORDERR WHERE CART_ID=$cartid";
        $run_order = oci_parse($conn,$query_order);

        oci_execute($run_order);

        $query_payment="DELETE FROM PAYMENT WHERE USER_ID=$u_id";
        $run_pay = oci_parse($conn,$query_payment);

        oci_execute($run_pay);
        $query_coll="DELETE FROM COLLECTION_SLOT WHERE USER_ID=$u_id";
        $run_coll = oci_parse($conn,$query_coll);

        oci_execute($run_coll);

        $query_CP="DELETE FROM CART_PRODUCT WHERE CART_ID=$cartid AND STATUS=1";
        $run_CP = oci_parse($conn,$query_CP);

        oci_execute($run_CP);

        header("location: my_account.php?my_orders");
// 
    }
    else{
        header("location : ../cart.php");
    }
    ?>