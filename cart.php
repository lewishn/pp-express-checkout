<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Brick Shop</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/heroic-features.css" rel="stylesheet">
</head>

<body>
    <form action="paypal_ec_redirect.php" method="POST">
    <div class="container">
        <div class="row">
            <h1 class="col-md-12">Your Brick Cart <a href="./index.php" class="btn btn-primary" style="float:right;">Back to Catalog</a></h1>
             <?php
                session_start();
                include "./psql_connect.php";
                $price = 0;
                $count = 0;
                if(isset($_SESSION['items'])) {
                    $query = "SELECT * FROM products";
                    $result = pg_query($pg_conn, $query);
                    for ($i = 0; $i < count($_SESSION['items']); $i++) {

                       if(isset($_SESSION['items'][$i]) && $_SESSION['items'][$i] != 0) {
                            while ($row = pg_fetch_row($result)) {
                                if ($row[0] == $i) {
                                    break;
                                }
                            }
                            echo ' <div class="col-md-3 col-sm-6"><div class="thumbnail">';
                            $count += $_SESSION["items"][$i];
                            $price += $_SESSION["items"][$i] * $row[3];
                            echo '<img src="./images/'.$row[4].'" alt="">';
                            echo '<div class="caption"><h3>'.$row[1].'</h3><h4>In cart: '.$_SESSION["items"][$i].'</h4><h4>$'.$row[3].' × ';
                            echo $_SESSION["items"][$i].'</h4></div></div></div>';
                        }
                    }
                } else {
                    echo "<h3>Your shopping cart is currently empty.</h3>";
                }
            ?>
        </div>

        <table class="col-md-12 table">
            <tr><td>Price:</td> 
                <td>
                <?php 
                    echo  number_format((float)$price, 2, '.', '');
                    echo '<input type="hidden" name="PAYMENTREQUEST_0_ITEMAMT" value="'.$price.'"></input>';
                ?>
                <td>
            <tr> 
            <tr><td>Tax:</td>
                <td>
                    <?php
                        $tax = 0.1 * $price;
                        echo number_format($tax, 2, '.', '');
                        echo '<input type="hidden" name="PAYMENTREQUEST_0_TAXAMT" value="'.$tax.'"></input>';
                    ?>
                </td>
            </tr>  
            <tr><td>Shipping Amount:</td><td> 0.00 <input type="hidden" name="PAYMENTREQUEST_0_SHIPPINGAMT" value="0"></input></td></tr>
            <tr><td>Total Amount:</td>
                <td>
                    <?php
                        $total = $price + $tax;
                        echo number_format((float)$total, 2, '.', '');
                        echo '<input type="hidden" name="PAYMENTREQUEST_0_AMT" value="'.$total.'"></input>';
                    ?>
                </td>
            </tr>
            <tr><td>Currency Code:</td><td>USD  <input type="hidden" name="currencyCodeType" value="USD"></input></td></tr>
            <input type="hidden" name="paymentType" value="Sale"></input>
            <input type="hidden" name="LOGOIMG" value=<?php echo('http://'.$_SERVER['HTTP_HOST'].preg_replace('/index.php/','images/logo.jpg',$_SERVER['SCRIPT_NAME'])); ?>></input>
        </table>
    </div> <!-- /.container -->
    
    <table border="0" cellpadding="10" cellspacing="0" align="center">
        <tr>
            <td align="center">
                <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png" alt="Check out with PayPal"></input>
            </td>
        </tr>
    </table>

    </form>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
