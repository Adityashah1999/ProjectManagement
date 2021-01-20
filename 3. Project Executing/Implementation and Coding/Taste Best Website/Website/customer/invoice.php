<?php
include("includes/db.php");
 ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>

    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }


    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>
<?php
if (isset($_GET['invoice_no'])) {
    $order_invoice =$_GET['invoice_no'];
  $get_c_in ="SELECT * FROM CUSTOMER_ORDER WHERE ORDER_INVOICE ='$order_invoice'";
  $run_c_in =oci_parse($con, $get_c_in);
  oci_execute($run_c_in);
  $row_c_in =oci_fetch_array($run_c_in);
  $customer_id =$row_c_in['CUSTOMER_ID'];
  $ordered_date=$row_c_in['ORDER_DATE'];

  $get_c_info ="SELECT * FROM CUSTOMER WHERE CUSTOMER_ID='$customer_id'";
  $run_c_info =oci_parse($con, $get_c_info);
  oci_execute($run_c_info);
  $row_c_info =oci_fetch_array($run_c_info);
  $c_name =$row_c_info['CUSTOMER_NAME'];
  $c_email=$row_c_info['CUSTOMER_EMAIL'];



}
?>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="images/logob.png" style = height:60px;,width:198px;>
                            </td>

                            <td>

                                Invoice :<?php  echo $order_invoice; ?><br>
                                <br>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <br>
                                <br>
                                Cleckhuddersfax, United Kingdom
                            </td>

                            <td>
                                <?php echo $c_name;?><br>
                                <?php echo $c_email;?><br>

                            </td>

                        </tr>

                        <tr>
                            <td>
                                Ordered Date: <?php echo $ordered_date;?><br>



                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Item
                </td>
                <td>
                    Quantity
                </td>
                <td>
                   Sub Total
                </td>
            </tr>

            <?php


$total=0;
  $get_info_invoice ="SELECT * FROM CUSTOMER_ORDER WHERE ORDER_INVOICE='$order_invoice'";
  $run_info_invoice=oci_parse($con, $get_info_invoice);
  oci_execute($run_info_invoice);
  while($row_info_invoice=oci_fetch_array($run_info_invoice)){
  $id_c_invoice =$row_info_invoice['PRODUCT_ID'];
 $product_qty=$row_info_invoice['QTY'];

  $get_info_product ="SELECT * FROM PRODUCT WHERE PRODUCT_ID='$id_c_invoice'";
  $run_info_product=oci_parse($con, $get_info_product);
  oci_execute($run_info_product);

  while($row_info_product=oci_fetch_array($run_info_product)){
  $product_name =$row_info_product['PRODUCT_TITLE'];
  $product_price=$row_info_product['PRODUCT_PRICE'];

      $subtotal=$product_price*$product_qty;

       echo "     <tr class='item'>
                <td>
                  {$product_name}

                </td>
                <td>
                 {$product_qty}
                </td>

                <td>
                 {$subtotal}
                </td>
            </tr>";

      }

$total+=$subtotal;

  }?>

            <tr class="total">
                <td></td>
                <td></td>

                <td>
                               <br>  
                   Total: $<?php echo $total;?>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>