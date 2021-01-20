<?php

include('include/connection.php');
session_start();

if (isset($_SESSION['customer_id'])) {
    $userid = $_SESSION['customer_id'];
    $username = $_SESSION['customer_name'];
} else if (isset($_SESSION['admin_id'])) {
    $userid = $_SESSION['admin_id'];
    $username = $_SESSION['admin_name'];
}
if (isset($_GET['cartid'])) {
    $cartid = $_GET['cartid'];
}
if (isset($_GET['setted']))
{
    $checkoutmessage = "
    <div class='alert alert-success' role='alert'>
    Your time has been set now you can pay for your cart products
</div>
    ";
}
if (isset($_GET['sameday']))
{
    $checkoutmessage = "
    <div class='alert alert-success' role='alert'>
    We acknowledge that you already have ordered the product. You can pick the items on the same day.
</div>
    ";
}



include('include/header.include.php');
include('include/banner.include.php');

$S_query = "SELECT * FROM  CART_PRODUCT WHERE CART_ID='$cartid' AND STATUS=0";

$cart_SELECT = oci_parse($conn, $S_query);

if (!$cart_SELECT) {
    echo "sql error";
}

oci_execute($cart_SELECT);
$total_price = 0;
if (isset($checkoutmessage)) {
    echo $checkoutmessage;
}

echo "
<div class='container'>
<div class='row justify-content-center'>
<div class='col-lg-6 px-4 pb-4' id='order'>
<h4 class='text-center text-info p-2'  >Complete Your Order!</h4>
<div class='jumbotron p-3 mb-2 text-center' style='background-color:RGB(201, 190, 185);'>
<h6 class='lead'<b>Product  :

";

while ($row = oci_fetch_array($cart_SELECT)) {

    $product_id = $row['PRODUCT_ID'];
    $product_quantity = $row['PRODUCT_QUANTITY'];

    $cart_id_show = $row['CART_ID'];

    $select_query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID='$product_id'";

    $parsing_cart_showing = oci_parse($conn, $select_query);

    if (!$parsing_cart_showing) {
        echo "sql error while showing cart product";
    }

    oci_execute($parsing_cart_showing);

    if (($row = oci_fetch_array($parsing_cart_showing)) == true) {
        $productname = $row['PRODUCT_NAME'];
        $productid = $row['PRODUCT_ID'];
        $productdesc = $row['PRODUCT_DESCRIPTION'];
        $productstatus = $row['PRODUCT_STATUS'];
        $productimage = $row['PRODUCT_IMAGE'];
        $productprice = $row['PRODUCT_PRICE'];
        $productkeywords = $row['PRODUCT_KEYWORDS'];
        $minimumorder = $row['MIN_ORDER'];
        $maximumorder = $row['MAX_ORDER'];
        $allergy = $row['ALLERGY_INFORMATION'];
        $category = $row['CATEGORY_ID'];
        $orderid = $row['ORDER_ID'];
        $shopid = $row['SHOP_ID'];
        $userid = $row['USER_ID'];
        $discountid = $row['DISCOUNT_ID'];

        $de = $productprice * $product_quantity;

        $Dquery = "SELECT * from discount where DISCOUNT_ID=$discountid";

                                        $Dlogin_stmt = oci_parse($conn, $Dquery);

                                        if (!$Dlogin_stmt) {
                                            echo "An error occurred in parsing the sql string. on discount \n";
                                            exit;
                                        }

                                        oci_execute($Dlogin_stmt);
                                        if ($rowd = oci_fetch_array($Dlogin_stmt)) {
                                            $disper = $rowd['DISCOUNT_PERCENTAGE'];
                                            $dispers = ($disper * $productprice) / 100;
                                            $finalprice = $productprice - $dispers;
                                        }


                                        if (isset($finalprice)) {

                                            $de = $finalprice * $product_quantity;
                                        } else {

                                            $de = $productprice * $product_quantity;
                                        }

        $total_price += $de;


        echo
            "
    
    </b>$productname ( X $product_quantity)
    ";
    }
}


?>
</h6>
<h5><b>Total Amount Payable: </b><?php echo number_format($total_price, 2) ?></h5>
</div>

<?php

if (!isset($_GET['setted']))
{
    ?>
<form action ="checkoutrun.php" method='POST'>
<h6>Your Name (Username):</h6>
<div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="Enter Name" required value="<?php echo $username ?>">
    </div>
    <h6>Your Message:</h6>
<div class="form-group">
        <textarea name="address" cols="19" rows="3" class="form-control" placeholder="Enter order description(if any)...."> </textarea>
    </div>
    <h6 class="text-center lead">Select the day for picking up:</h6>
    <div class="form-group">
        <select name="day" class="form-control">

            <?php

            // Prints the day
            $today = date("l");
            $time = date("H"); //the current time in 24 hr format

            if ($today == 'Friday') { //if purchase day is friday, then all days & slots for next week is open
                echo "<option value='NEXT WEDNESDAY' selected>Next Wednesday</option>";
                echo "<option value='NEXT THURSDAY'>Next Thursday</option>";
                echo "<option value='NEXT FRIDAY'>Next Friday</option>";
            } elseif ($today == 'Thursday' && $time >= 19) //if purchase day is thursday & time is 7pm or late then all days & slots for next week is open
            {
                echo "<option value='NEXT WEDNESDAY' selected>Next Wednesday</option>";
                echo "<option value='NEXT THURSDAY'>Next Thursday</option>";
                echo "<option value='NEXT FRIDAY'>Next Friday</option>";
            } elseif ($today == 'Thursday' && $time < 19) //if purchase day is thursday & time is earlier than 7pm then
            {
                echo "<option value='NEXT WEDNESDAY' selected>Next Wednesday</option>";
                echo "<option value='NEXT THURSDAY'>Next Thurday</option>";
                echo "<option value='FRIDAY'> Friday</option>";            //friday's one slot is open
            } elseif ($today == 'Wednesday' && ($time >= 19)) //if purchase day is wednesday and time is 7pm or late 
            {
                echo "<option value='NEXT WEDNESDAY' selected>Next Wednesday</option>";
                echo "<option value='NEXT THURSDAY'>Next Thursday</option>";
                echo "<option value='FRIDAY'>Friday</option>";    //only Friday's all slot are open
            } elseif ($today == 'Wednesday' && $time < 19) {    //if purchase day is wednesday and time is earlier than 7pm
                echo "<option value='NEXT WEDNESDAY' selected>Next Wednesday</option>";
                echo "<option value='THURSDAY'> Thursday</option>"; //selected thursday's slots are open
                echo "<option value='FRIDAY'>Friday</option>"; //Friday's all slots are open
            } elseif ($today == 'Tuesday' && $time >= 19) //if purchase day is tuesday and time is 7pm or late 
            {
                echo "<option value='NEXT WEDNESDAY' selected>Next Wednesday</option>";
                echo "<option value='THURSDAY'>Thursday</option>";    //All slots for thursday and friday along with next wednesday is open
                echo "<option value='FRIDAY'>Friday</option>";
            } elseif ($today == 'Tuesday' && $time < 19) //if purchase day is tuesday and time is earlier than 7pm
            {
                echo "<option value='WEDNESDAY' selected> Wednesday</option>"; //all slots for following 3 days are open
                echo "<option value='THURSDAY'>Thursday</option>";
                echo "<option value='FRIDAY'>Friday</option>";
            } else {
                echo "<option value='WEDNESDAY' selected> Wednesday</option>"; //else, if purachase day if on any other day, upcoming wed, thursday and fri are slots are open
                echo "<option value='THURSDAY'>Thursday</option>";
                echo "<option value='FRIDAY'>Friday</option>";
            }




            ?>

        </select>
    </div>
    <div class="form-group">
        <select name="hour" class="form-control">
            <?php
            $dayselected = $_POST['day'];

            $time = date("H");

            if ($today == 'Friday') { //if purchase day is friday, then all days & slots for next week is open
                echo "<option value='10AM to 1PM'> 10AM to 1PM </option>";
                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
            } //inside friday
            elseif ($today == 'Tuesday') {
                if ($time >= 19) {    //if purchase day is tuesday and time is 7pm or late 
                    echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //all slots for thurday, friday and next wednesday is open
                    echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                } elseif ($time < 10) //if purchase day is tuesday and time is 10am or earlier
                {
                    echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //all slots for upcoming next are open
                    echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                } elseif (($time >= 13 || $time <= 15) && $dayselected == 'wed') {
                    echo "<option disabled value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is tuesday and time is between 1pm to 3pm and 																				
                    echo "<option value='1PM to 4PM'>1PM to 4PM</option>";                ////Collection day is Wednesday, the first slot is unavailable
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                } elseif (($time >= 16 || $time <= 18) && $dayselected == 'wed') {
                    echo "<option disabled value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is tuesday and time is between 4pm to 6pm and 
                    echo "<option disabled value='1PM to 4PM'>1PM to 4PM</option>";    ////Collection day is Wednesday,only the last slot is available
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                } else {
                    echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //
                    echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                }
            } //inside tuesday
            elseif ($today == 'Wednesday') {
                if ($time >= 19) {
                    echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is wednesday and time is 7pm or late 
                    echo "<option value='1PM to 4PM'>1PM to 4PM</option>";    //all slots from friday and upcoming wed and thursday is free
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                } elseif ($time < 10) {
                    echo "<option value='10AM to 1PM'> 10AM to 1PM </option>";    //if purchase day is wednesday and time is 10am or earlier 
                    echo "<option value='1PM to 4PM'>1PM to 4PM</option>";        ////all slots are open
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                } elseif (($time >= 13 || $time <= 15) && $dayselected == 'thu') {
                    echo "<option disabled value='10AM to 1PM'> 10AM to 1PM </option>";    //if purchase day is wednesday and time is between 1pm to 3pm and Collection day
                    echo "<option value='1PM to 4PM'>1PM to 4PM</option>";                //thursday, only the first slot is unavailable
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                } elseif (($time >= 16 || $time <= 18) && $dayselected == 'thu') {
                    echo "<option disabled value='10AM to 1PM'> 10AM to 1PM </option>";    //if purchase day is wednesday and time is between 4pm to 6pm and Collection day
                    echo "<option disabled value='1PM to 4PM'>1PM to 4PM</option>";        //thursday the last slot is available
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                } else {
                    echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //else all slots for any days selected is free
                    echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                }
            } //inside wednesday
            elseif ($today == 'Thursday') {
                if ($time >= 19) {
                    echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is thursday and time is 7pm or late 
                    echo "<option value='1PM to 4PM'>1PM to 4PM</option>";        //all slots for next days are open
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                } elseif ($time < 10) {
                    echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is thursday and time is 10am or earlier 
                    echo "<option value='1PM to 4PM'>1PM to 4PM</option>";        //all slots are open
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                } elseif (($time >= 13 || $time <= 15) && $dayselected == 'fri') {
                    echo "<option disabled value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is thursday and time is between 1pm to 3pm and Collection day
                    echo "<option value='1PM to 4PM'>1PM to 4PM</option>";                //is friday then only the first slot is unavailable
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                } elseif (($time >= 16 || $time <= 18) && $dayselected == 'fri') {
                    echo "<option disabled value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is thursday and time is between 4pm to 6pm and Collection day
                    echo "<option disabled value='1PM to 4PM'>1PM to 4PM</option>";        //is friday, only the last slot is available
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                } else {
                    echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //else all slots for any days selected is free
                    echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                    echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                }
            } //thursday
            else {
                echo "<option value='10AM to 1PM'> 10AM to 1PM </option>";
                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
            }

            ?>

        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="collectionsubmit" value="Place Order" class="btn btn-danger btn-block">
    </div>

</form>
<?php
}else{ 
$count = 1;
$paypalHiddenData = '';
$query = "SELECT * FROM CART_PRODUCT CP, PRODUCT P WHERE CP.PRODUCT_ID = P.PRODUCT_ID AND CART_ID = $cartid AND CP.STATUS=0";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
while ($row = oci_fetch_assoc($stmt)) {
    $productprice=$row['PRODUCT_PRICE'];
    if(isset($row['DISCOUNT_ID']))
    {

        $discount=$row['DISCOUNT_ID'];
        $discount_query = "SELECT * FROM DISCOUNT WHERE DISCOUNT_ID=$discount";
    $discount_parse = oci_parse($conn, $discount_query);
    oci_execute($discount_parse);
    if ($discount_row=oci_fetch_assoc($discount_parse))
    {
        $disper = $discount_row['DISCOUNT_PERCENTAGE'];
        $dispers = ($disper * $productprice) / 100;
        $finalprice = $productprice - $dispers;
    }
    
    }else{
        $finalprice=$productprice;
    }

    

    // generate hidden inputs to submit to paypal
    $paypalHiddenData .= "<input type='hidden' name='item_name_$count'
               value='$row[PRODUCT_NAME]'/>
        <input type='hidden' name='quantity_$count'
               value='$row[PRODUCT_QUANTITY]'/>
        <input type='hidden' name='amount_$count'
               value='$finalprice'/>";
    ++$count;
}
?>
<div class="box" style="background-color:RGB(211, 215, 222);">
<center><!--  center Begin  -->


<h3> Paypal For Your Payment </h3>

<p class="text-muted">

    If you have any questions, do not hesitate to Contact Us.</br>
    Contact : 01-5132076</br>
    Taste Best, Checkhuderfax, London

</p>

</center><!--  center Finish  -->


<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST" id="placeOrder" style="background-color:RGB(211, 215, 222);">
    <!-- PayPal logic -->
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type='hidden' name='business' value='sb-rvpml2285907@business.example.com'>
    <input type='hidden' name='currency_code' value='USD'>
    <input type='hidden' name='notify_url' value='http://localhost/website-prroject/notify.php'>
    <input type='hidden' name='return' value='http://localhost/Website-prroject/checkoutSuccessful.php'>
    <?php echo $paypalHiddenData; ?>
    <!-- /.PayPal logic -->

    <input type="hidden" name="products" value="<?php $productname; ?>">
    <input type="hidden" name="grand_total" value="<?php $total_price; ?>">

   
    <div class="form-group" >
        <input type="image" type="submit" name="collectionsubmit"  width="200" height="130" src="images/paypal.png" style="border:5px,solid,red; margin-left:150px;" >
    </div>
    </form>
    </div>
    <?php

    }
    ?>


    </div>
    </div>
    </div>