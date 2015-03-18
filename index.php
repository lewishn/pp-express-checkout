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
    <div class="container">
        <header>
             <img src="./images/brick.jpg" alt="" class="headimage">
        </header>

        <hr>

        <!-- Items -->
        <div class="row text-center">
            <?php
                include "psql_connect.php";
                $query = "SELECT * FROM products";
                $result = pq_query($pg_conn, $query);
                while ($row = pg_fetch_row($result)) {
                    echo '<div class="col-md-3 col-sm-6"><div class="thumbnail"><img src="./images/'.$row[4].'" alt="">';
                    echo '<div class="caption"><h3>'.$row[1].'</h3>';
                    echo '<h4>$'.$row[3].'</h4>';
                    echo '<p>'.$row[2].'</p>';
                    echo '<p><form action="add_to_cart.php" method="get"><button type="submit" name="brick" value="'.$row[0];
                    echo '" class="btn btn-primary">Add to cart</button></form></p></div></div></div>';
                }
            ?>
        </div> <!-- /.items -->
    </div> <!-- /.container -->

    <table border="0" cellpadding="10" cellspacing="0" align="center">
        <tr>
            <td align="center">
                <?php
                    session_start();
                    $count = 0;
                    if(isset($_SESSION['items'])) {
                        for ($i = 0; $i < count($_SESSION['items']); $i++) {
                            if(isset($_SESSION['items'][$i])) {
                                $count += $_SESSION['items'][$i];
                            }
                        }
                    }
                    echo "<p> You have $count items in your cart.";
                ?>
            </td>
        </tr>
        <tr>
            <td align="center" class="cart">
                <?php
                    if(isset($_SESSION['items'])) {
                        echo '<a href="./cart.php" class="btn btn-primary">Go to cart</a>';
                    }
                 ?>
            </td>
        </tr>
        <tr><td><br></td><tr>
       
       <tr><!-- PayPal Logo -->
            <td align="center">
            <a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;">
                <img src="https://www.paypalobjects.com/webstatic/mktg/logo/bdg_now_accepting_pp_2line_w.png" border="0" alt="Now Accepting PayPal">
            </a>
            <div style="text-align:center">
                <a href="https://www.paypal.com/webapps/mpp/how-paypal-works"><font size="2" face="Arial" color="#0079CD">How PayPal Works</font></a>
            </div></td>
        </tr><!-- PayPal Logo -->
    </table>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
