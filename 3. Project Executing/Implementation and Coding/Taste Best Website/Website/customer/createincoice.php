<?php

include('../include/connection.php');
session_start();
if (isset($_SESSION['customer_id'])) {
    $userid = $_SESSION['customer_id'];
    $username = $_SESSION['customer_name'];
} else if (isset($_SESSION['admin_id'])) {
    $userid = $_SESSION['admin_id'];
    $username = $_SESSION['admin_name'];
}

$select_cart = "SELECT * FROM CART WHERE USER_ID = '$userid'";
                    $parse_sele_cart = oci_parse($conn, $select_cart);
                    if (!$parse_sele_cart) {
                        echo "selection query on collection not parsed";
                    }
                    oci_execute($parse_sele_cart);
                    $row_cart= oci_fetch_assoc($parse_sele_cart);

                    $cartID=$row_cart['CART_ID'];


                    $get_order= "SELECT * FROM ORDERR WHERE CART_ID = $cartID";


                    $run_order = oci_parse($conn,$get_order);
            
                    oci_execute($run_order);
            
                    if(!$run_order){
                        echo "Error in parsing";
                    }
            
                    if (($row_order = oci_fetch_array($run_order))==false)
                    {
                        header("location: ../cart.php?notordered=1");
                    }
                    else
                    {

$de=0;
$discounted_price=0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <style>

#invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
    </style>
    
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<!------ Include the above in your HEAD tag ---------->

<!--Author      : @arboshiki-->
<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="https://lobianijs.com">
                            <img src="../images/logo/logo.png" data-holder-rendered="true" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="https://lobianijs.com">
                            TASTE BEST PVT LTD
                            </a>
                        </h2>
                        <div>455 Foggy Heights, AZ 85004, US</div>
                        <div>9846779494</div>
                        <div>tastebest@tastebest.com</div>
                    </div>
                </div>
            </header>
            <main>
<?php
$select_que = "SELECT * FROM USERA WHERE USER_ID = '$userid'";
$parse_sele = oci_parse($conn, $select_que);
if (!$parse_sele) {
    echo "selection query on collection not parsed";
}
oci_execute($parse_sele);
$row = oci_fetch_assoc($parse_sele);
if (isset($row['DISCOUNT_ID']))
{

    $discount_applied_id=$row['DISCOUNT_ID'];
}

?>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to"><?php echo $username ?></h2>
                        <div class="address"><?php echo $row['USER_ADDRESS']; ?></div>
                        <div class="email"><a href="mailto:<?php echo $row['USER_EMAIL']; ?>"><?php echo $row['USER_EMAIL']; ?></a></div>
                    </div>
                    <div class="col invoice-details">
                    <?php
                    




?>
                        <h1 class="invoice-id">INVOICE :<?php echo $row_order['ORDER_ID'];?></h1>
                        <div class="date">Date of Invoice Generated: <?php $Date =date('m-d-y') ; echo $Date; ?></div>
                        <div class="date">Due Date: <?php echo date('m-d-y', strtotime($Date. ' + 10 days'));?></div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">DESCRIPTION</th>
                            <th class="text-right">HOUR PRICE</th>
                            <th class="text-right">HOURS</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        
        $get_customer = "SELECT * FROM CART WHERE USER_ID='$userid' AND CART_STATUS=1";


        $run_customer = oci_parse($conn,$get_customer);

        oci_execute($run_customer);

        if(!$run_customer){
            echo "Error in parsing";
        }

        $row_customer = oci_fetch_array($run_customer);

        $cart_id = $row_customer['CART_ID'];

        $get_orders = "SELECT * FROM CART_PRODUCT WHERE CART_ID='$cart_id' AND STATUS =1 ";

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
    
    
    $Dquery="SELECT * from discount where DISCOUNT_ID=$discountid";
    
$Dlogin_stmt = oci_parse($conn, $Dquery);

if(!$Dlogin_stmt)
{
echo "An error occurred in parsing the sql string. on discount \n"; 
exit; 
}

oci_execute($Dlogin_stmt);
if($rowd= oci_fetch_array($Dlogin_stmt))
{
$disper=$rowd['DISCOUNT_PERCENTAGE'];
$dispers=($disper*$productprice)/100;
$finalprice =$productprice-$dispers;


$de+=$finalprice*$productquantity;

    
           


?>
                        <tr>
                            <td class=""><?php echo $productquantity; ?></td>
                            <td class="text-left"><h3><?php echo $productname; ?></h3><?php echo $productdesc; ?></td>
                            <td class="unit">$ <?php echo $productprice; ?></td>
                            <td class="qty"><?php echo $deliverday ?></td>
                            <td class="total">$<?php echo ($finalprice*$productquantity) ?></td>
                        </tr>

        <?php }}} ?>
                    </tbody>
                    <tfoot>
                    <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>$<?php echo $de ?></td>
                        </tr>
                    <?php
                    
    
    if (isset($discount_applied_id))
    {
        $DISCOUNTQUERY= "SELECT * FROM DISCOUNT WHERE DISCOUNT_ID ='$discount_applied_id'";
        $DISCOUNTPARSE = oci_parse($conn,$DISCOUNTQUERY);

    oci_execute($DISCOUNTPARSE);

    if(!$DISCOUNTPARSE){
        echo "Error in parsing";
    }

    $dis_row=oci_fetch_assoc($DISCOUNTPARSE);

    $dis_per = $dis_row['DISCOUNT_PERCENTAGE'];
    $dis_ID = $dis_row['DISCOUNT_ID'];
    $dis_name = $dis_row['DISCOUNT_NAME'];

    $dis_pers = $dis_per * $de;
    $dis_price = $dis_pers / 100;


    $discounted_price= $de-$dis_price;

    echo "
    <tr>
                            <td colspan='2'></td>
                            <td colspan='2'> Discount Added:( $dis_name)</td>
                            <td>$dis_price</td>
                        </tr>
    
    ";

    
    }

                    ?>
                        

                        
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>$<?php 
                            if ($discounted_price==0)
                            {
                                
                                echo $de;
                            }
                            else{
                                
                                echo $discounted_price;
                            }
                            
                            
                            ?></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">You need to collect your products from the mini-shop and the items in your cart will be removed automatically</div>
                </div>
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
    <script>
 $('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data) 
            {
                window.print();
                return true;
            }
        });

    </script>
</body>
</html>
    <?php } ?>