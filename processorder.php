<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bob's Auto Parts - Order Results</title>
</head>
<body>
    <h1>Bob's Auto Parts</h1>
    <?php 
        date_default_timezone_set('Asia/Manila');
        echo "<p>Order processed at " . date('h:i A, jS F Y') . "</p>";

        define('tprice', 100);
        define('oprice', 10);
        define('sprice', 4);

        $tireQty = $_POST['tireqty'] ? $_POST['tireqty'] : 0;
        
        $oilQty = $_POST['oilqty'] ? $_POST['oilqty'] : 0;

        $sparkQty = $_POST['sparkqty'] ? $_POST['sparkqty'] : 0;

        $find = $_POST['find'];

        switch($find) {
            case "a" :
                echo "<p>Regular customer.</p>";
            break;
            case "b" :
                echo "<p>Customer reffered by TV advert.</p>";
            break;
            case "c" :
                echo "<p>Customer referred by phone directory.</p>";
            break;
            case "d" :
                echo "<p>Customer referred by word of mouth.</p>";
            break;
            default :
                echo "<p> We do not know this customer found us";
        break;
        }

        $totalQty = $tireQty + $oilQty + $sparkQty;

        /* Discount computation

            Fewer than 10 tires purchased - no discount
            10-49 tires purchased - 5% discount
            50-99 tires purchased - 10% discount
            100 or more tires purchased - 15% discount
        */

        $discount = 0.0;

        if (($tireQty >= 10) && ($tireQty <= 49)) {
            $discount = 0.5;
        } elseif (($tireQty >= 50) && ($tireQty <= 99)) {
            $discount = 0.10;
        } elseif ($tireQty >= 100) {
            $discount = 0.15;
        }

        if ($totalQty == 0) {
            echo "You did not order anything in the previous page.";
            $subTotal = 0.0;
            $totalAmountTax = 0.0;
            $totalAmount = 0.0;
        } else {
            $subTotal = ($tireQty * tprice) + ($oilQty * oprice) + ($sparkQty * sprice);
        
            $taxRate = 0.10;
            $totalAmountTax = $subTotal * (1 + $taxRate);

            $totalDiscount = 0.0;
           if ($discount) {
                $totalDiscount = $totalAmountTax * $discount;
           }

           if($totalDiscount) {
                $totalAmount = $totalAmountTax - $totalDiscount;
           } else {
               $totalAmount = $totalAmountTax;
           }

        }
        
    ?>

    <h2>Order Summary</h2>
    <table style="border: 0px">
            <tr style="background: #cccccc;">
                <td style="width: 150px; text-align: center;">Item</td>
                <td style="width: 15px; text-align: center;">Quantity</td>
            </tr>
            <tr>
                <td>Tires</td>
                <td>
                    <?php echo $tireQty; ?>
                </td>
            </tr>
            <tr>
                <td>Oil</td>
                <td>
                    <?php echo $oilQty; ?>
                </td>
            </tr>
            <tr>
                <td>Spark Plugs</td>
                <td>
                    <?php echo $sparkQty; ?>
                </td>
            </tr>
            <tr>
                <td>Total Quantity</td>
                <td>
                    <?php echo $totalQty ?>
                </td>
            </tr>
            <tr>
                <td>Subtotal</td>
                <td>
                    <?php echo "$" .number_format($subTotal, 2)  ?>
                </td>
            </tr>
            <tr>
                <td>Total included tax</td>
                <td>
                    <?php echo "$" . number_format($totalAmountTax, 2) ?>
                </td>
            </tr>
            <tr>
                <td>
                    Discount
                    <?php 
                        if ($discount == 0.5) {
                            echo " 5%";
                        } elseif ($discount == 0.10) {
                            echo " 10%";
                        } elseif ($discount == 0.15) {
                            echo " 15%";
                        } else {
                            echo " 0%";
                        }
                    ?>
                </td>
                <td>
                    <?php echo "$" . number_format($totalDiscount, 2); ?>
                </td>
            </tr>
            <tr>
                <td>Total Amount</td>
                <td>
                    <?php echo "$" . number_format($totalAmount, 2) ?>
                </td>
            </tr>
        </table>
</body>
</html>