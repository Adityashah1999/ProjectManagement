<!-- cart-main-area start -->
<?php
// debugging
// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
if (isset($_GET['allitemsremoved'])) {
    $cart_message = "
    
    <div class='alert alert-success' role='alert'>
    All your items has been removed from the cart
</div>
    
    ";
    
}
$counter=0;

if(isset($_GET['orderplaced']))
{
    $cart_message = "
    
    <div class='alert alert-success' role='alert'>
    Your items have been placed for order. You can see your invoice in <a href='customer\createincoice.php'>INVOICE</a>
</div>
    
    ";
    
}

if (isset($_GET['notordered'])) {
    $cart_message = "
    
    <div class='alert alert-danger' role='alert'>
    You need to pay for the Products to see the invoice.
</div>
    
    ";
}
if (isset($_GET['itemadded'])) {
    $cart_message = "Your item has been added to cart";
}
if (isset($_GET['productidremove'])) {

    $p_id = $_GET['productidremove'];

    $c_id = $_GET['cart'];

    $query = "DELETE FROM CART_PRODUCT WHERE PRODUCT_ID ='$p_id' and CART_ID = $c_id";

    $parsing_query = oci_parse($conn, $query);

    if (!$parsing_query) {
        echo "Item not deleted because of sql error";
    }
    oci_execute($parsing_query);

    $cart_message = "
    <div class='alert alert-danger' role='alert'>
    Your item has been removed
</div>
    ";
}
if (isset($_SESSION['customer_id'])) {
    $u_id = $_SESSION['customer_id'];
} else if (isset($_SESSION['admin_id'])) {
    $u_id = $_SESSION['admin_id'];
}

if (isset($_GET['removeall'])) {
    if (isset($_SESSION['customer_id'])) {
        $u_id = $_SESSION['customer_id'];
    } else if (isset($_SESSION['admin_id'])) {
        $u_id = $_SESSION['admin_id'];
    }


    $squery = "SELECT *  FROM CART WHERE USER_ID ='$u_id'";

    $select_query = oci_parse($conn, $squery);

    if (!$select_query) {
        echo "Item not deleted because of sql error";
    }
    oci_execute($select_query);
    if ($select_row = oci_fetch_assoc($select_query)) {
        $card_id = $select_row['CART_ID'];

        $Dquery = "DELETE FROM CART_PRODUCT WHERE CART_ID ='$card_id'";

        $DELETE_parsing_query = oci_parse($conn, $Dquery);

        if (!$DELETE_parsing_query) {
            echo "Item not deleted because of sql error";
        }
        oci_execute($DELETE_parsing_query);
        $cart_message = "
        <div class='alert alert-danger' role='alert'>
        Your all item has been removed
    </div>
        ";
    }
}

if (isset($_GET['itemalreadyoncart'])) {
    $cart_message = "
    <div class='alert alert-info' role='alert'>
    Your Item is already on the cart.
</div>
    ";
}
if (isset($_GET['itemalreadyoncartbutquantityupdated'])) {
    

    $cart_message = "
    <div class='alert alert-warning' role='alert'>
    Your item was already on the cart but the quantity is updated
</div>
    ";
}

include("include/connection.php");

if (isset($_SESSION['customer_id'])) {
    $userid = $_SESSION['customer_id'];
} else if (isset($_SESSION['admin_id'])) {
    $userid = $_SESSION['admin_id'];
}

$dis_price = 0;
$coupon_code = 0;
?>

<div class='cart-main-area section-padding--lg bg--white' style='background-color:RGB(211, 215, 222);'>
    <div class='container'>
        <div class='row'>
            <div class='col-md-12 col-sm-12 ol-lg-12'>
                <div class='section__title text-center'>
                    <h2 class='title__be--2'>Your <span class='color--theme'> Cart</span></h2>
                </div>
                <form action='cart.php' method="POST">
                    <?php
                    if (isset($cart_message)) {
                        echo
                            $cart_message;
                    }
                    ?>


                    <div class='table-content wnro__table table-responsive'>
                        <table>
                            <thead>
                                <tr class='title-top'>
                                    <th class='product-thumbnail'>Image</th>
                                    <th class='product-name'>Product</th>
                                    <th class='product-price'>Price</th>
                                    <th class='product-quantity'>Quantity</th>
                                    <th class='product-subtotal'>Total</th>
                                    <th class='product-remove'>Remove</th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                $S_query = "SELECT * FROM CART c , CART_PRODUCT cp WHERE c.CART_ID=cp.CART_ID AND USER_ID='$userid' AND STATUS=0";

                                $cart_SELECT = oci_parse($conn, $S_query);

                                if (!$cart_SELECT) {
                                    echo "sql error";
                                }

                                oci_execute($cart_SELECT);
                                $total_price = 0;
                                

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

                                    if (($row = oci_fetch_assoc($parsing_cart_showing)) == true) {
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

                                        $_SESSION['cartProducts'] = $productid;
                                        $_SESSION['cartProducts'] = $productname;
                                        $_SESSION['cartProducts'] = $maximumorder;
                                        $_SESSION['cartProducts'] = $productprice;


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
                                        echo "
    <tr>
    <td class='product-thumbnail'><a href='#'><img src='trader_area/product_images/$productimage' alt='$productname'></a></td>
    <td class='product-name'><a href='singleproduct.php?productdi=$product_id'>'$productname'</a></td>

    ";

                                        if (isset($finalprice)) {
                                            echo "
        <td class='product-price'><span class='amount'>$ $finalprice</span></td>";
                                        } else {
                                            echo "
        <td class='product-price'><span class='amount'>$ $productprice</span></td>";
                                        }

                                        echo "
    <td class='product-quantity'><span class='amount'>$product_quantity</span></td></td>
    <td class='product-subtotal'>$$de</td>
    <td class='product-remove'><a href='cart.php?productidremove=$product_id&cart=$cart_id_show'> X</a></td>
    </tr>
    ";
    $counter++;
                                    }

                                }






                                ?>

                                <?php

                                if (isset($_POST['couponsubmit'])) {

                                    $coupon_code = $_POST['couponcode'];

                                    $query = "SELECT * FROM DISCOUNT WHERE DISCOUNT_NAME='$coupon_code'";

                                    $dis_parse = oci_parse($conn, $query);

                                    if (!$dis_parse) {
                                        echo "discount sql not run";
                                    }
                                    oci_execute($dis_parse);

                                    if (($dis_row = oci_fetch_assoc($dis_parse)) == true) {
                                        $dis_per = $dis_row['DISCOUNT_PERCENTAGE'];

                                        $dis_pers = $dis_per * $total_price;
                                        $dis_price = $dis_pers / 100;
                                    } else {
                                        $dis_price="Invalid Discount Name";
                                    }
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="cartbox__btn">
                    <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                        <form action="cart.php" method="post" class="d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                            <li><input type="text" placeholder="Coupon Code" name="couponcode" style="padding:15px;"></a></li>
                            <li><button type="submit" name="couponsubmit" style="padding:15px;">Apply Code</button></li>
                        </form>
                        <li><a href="cart.php?removeall=1">Clear All</a></li>
                        <?php
                        if ($counter>=20)
                        {
                            $check="You can order maximum 20 items at a time";
                            echo "$check";
                        }
                        else{
                            $COLQUERY= "SELECT * FROM COLLECTION_SLOT WHERE USER_ID ='$u_id'";
        $COLLPARSE = oci_parse($conn,$COLQUERY);

    oci_execute($COLLPARSE);
    $rocill=oci_fetch_assoc($COLLPARSE);
    if ($rocill==false)
    {
        if (isset($card_id)) {
            echo "
                <li><a href='checkout.php?cartid=$card_id'>Check Out</a></li>
                ";
        } else if (isset($cart_id_show)) {
            echo "
                    <li><a href='checkout.php?cartid=$cart_id_show'>Check Out</a></li>
                    ";
        }
    }
    else{
        if (isset($card_id)) {
            echo "
                <li><a href='checkout.php?cartid=$card_id&sameday=1'>Check Out</a></li>
                ";
        } else if (isset($cart_id_show)) {
            echo "
                    <li><a href='checkout.php?cartid=$cart_id_show&sameday=1'>Check Out</a></li>
                    ";
        }
                       
                    }
                    }

                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-6">
                <div class="cartbox__total__area">
                    <div class="cartbox-total d-flex justify-content-between">
                        <ul class="cart__total__list">
                            <li>Cart total</li>
                            <li>Discount Added <strong>(<?php echo $coupon_code; ?>)</strong></li>
                        </ul>
                        <ul class="cart__total__tk">
                            <li>$<?php echo $total_price; ?></li>
                            <li>$<?php echo $dis_price; ?></li>
                        </ul>
                    </div>
                    <div class="cart__total__amount">
                        <span>Grand Total</span>
                    
                        <span>$<?php
                        if(is_string($dis_price))
                        {
                            $discounted_price = $total_price;
                        echo $discounted_price; 
                         
                        }
                        else{
                            $discounted_price = $total_price - $dis_price;
                            echo $discounted_price;
                            
                    }
                        ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- cart-main-area end -->