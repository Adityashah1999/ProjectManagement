

<center><!--  center Begin  -->

<h1> My Orders </h1>

<p class="lead"> Your orders on one place</p>

<p class="text-muted">

    If you have any questions, do not hesitate to Contact Us.</br>
    Contact : 01-5132076</br>
    Taste Best, Checkhuderfax, London

</p>

</center><!--  center Finish  -->


<hr>


<div class="table-responsive"><!--  table-responsive Begin  -->

<table class="table table-bordered table-hover"><!--  table table-bordered table-hover Begin  -->

    <thead><!--  thead Begin  -->
<?php
  $get_cus = "SELECT * FROM CART WHERE USER_ID='$userid' AND CART_STATUS=1";


  $run_cusr = oci_parse($conn,$get_cus);

  oci_execute($run_cusr);

  if(!$run_cusr){
      echo "Error in parsing";
  }

  $row_cu = oci_fetch_array($run_cusr);
  
  $cart_id = $row_cu['CART_ID'];

?>
        <tr><!--  tr Begin  -->

            <th> PRODUCT NAME</th>
            <th> PRODUCT PRICE</th>
            <th> CART ID</th>
            <th> Quantity </th>
            <th> PICK UP ON</th>
            <th> TIME </th>
            <th> Your Message </th>
            <th> View Invoice </th>
            <th><a href='removeorder.php?cartid=<?php echo $cart_id ?>'> Remove Invoice</a> </th>


        </tr><!--  tr Finish  -->

    </thead><!--  thead Finish  -->

    <tbody><!--  tbody Begin  -->



       <?php

       if (isset($_SESSION['customer_id']))
       {
           $userid= $_SESSION['customer_id'];
           $username= $_SESSION['customer_name'];
       }
       else if (isset($_SESSION['admin_id']))
       {
           $userid=$_SESSION['admin_id'];
           $username= $_SESSION['admin_name'];
       
       }


        $get_customer = "SELECT * FROM CART WHERE USER_ID='$userid' AND CART_STATUS=1";


        $run_customer = oci_parse($conn,$get_customer);

        oci_execute($run_customer);

        if(!$run_customer){
            echo "Error in parsing";
        }

        $row_customer = oci_fetch_array($run_customer);

        $cart_id = $row_customer['CART_ID'];
        if (isset($row_customer['DISCOUNT_ID']))
        {
            $discount_id = $row_customer['DISCOUNT_ID'];

        }

        $get_orders = "SELECT * FROM CART_PRODUCT WHERE CART_ID='$cart_id' AND STATUS =1";

        $run_orders = oci_parse($conn,$get_orders);

        oci_execute($run_orders);

        if(!$run_orders){
            echo "Error in parsing";
        }

        $i = 1;
        $COLQUERY= "SELECT * FROM COLLECTION_SLOT WHERE USER_ID ='$userid'";
        $COLLPARSE = oci_parse($conn,$COLQUERY);

    oci_execute($COLLPARSE);

    if(!$COLLPARSE){
        echo "Error in parsing";
    }
    $rowCOLL = oci_fetch_array($COLLPARSE);

    $deliverday=$rowCOLL['SLOT_DATE'];
    $pickuptime=$rowCOLL['SLOT_TIME'];
    $STATUS=$rowCOLL['SLOT_STATUS'];
         while ($row_all =oci_fetch_array($run_orders)){
             
            
          
            $P_ID = $row_all['PRODUCT_ID'];
            $productquantity=$row_all['PRODUCT_QUANTITY'];

            $QUERY= "SELECT * FROM PRODUCT WHERE PRODUCT_ID ='$P_ID'";
            $PRODUCT_DISPLAY = oci_parse($conn,$QUERY);

        oci_execute($PRODUCT_DISPLAY);

        if(!$PRODUCT_DISPLAY){
            echo "Error in parsing";
        }

        if($row = oci_fetch_array($PRODUCT_DISPLAY))
        {

            $productname = $row['PRODUCT_NAME'];
            $productid = $row['PRODUCT_ID'];
            $productdesc = $row ['PRODUCT_DESCRIPTION'];
            $productstatus =$row['PRODUCT_STATUS'];
    $productimage= $row['PRODUCT_IMAGE'];
        $productprice=$row['PRODUCT_PRICE'];
    $productkeywords= $row['PRODUCT_KEYWORDS'];
    $minimumorder= $row['MIN_ORDER'];
    $maximumorder = $row['MAX_ORDER'];
    $allergy =$row['ALLERGY_INFORMATION'];
    $category = $row['CATEGORY_ID'];
    $orderid=$row['ORDER_ID'];
    $shopid=$row['SHOP_ID'];
    $userid=$row['USER_ID'];
    $discountid= $row['DISCOUNT_ID'];
    

           

            
            ?>

        <tr><!--  tr Begin  -->

            <td> <?php echo $productname; ?> </td>
            <td> <?php echo $productprice; ?> </td>
            <td> <?php echo $cart_id; ?> </td>
            <td> <?php echo $productquantity; ?> </td>
            <td> <?php echo $deliverday; ?> </td>
            <td> <?php echo $pickuptime; ?> </td>
             <td> <?php echo $STATUS; ?> </td>
             <td><a href="createincoice.php" class="btn btn-info btn-md" target="_blank">View Invoice</a>
             </td>

             <td><a href="#" class="btn btn-info btn-md">Mail Invoice</a>
             </td>





            </tr><!--  tr Finish  -->

<?php
                   
         }}

        ?>




    </tbody><!--  tbody Finish  -->

</table><!--  table table-bordered table-hover Finish  -->


</div><!--  table-responsive Finish  -->