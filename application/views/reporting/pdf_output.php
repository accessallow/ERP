<html>
    <head>


        <script src="<?php echo URL; ?>assets/jquery/jquery.min18.js"></script>

        <link rel="stylesheet" href="<?php echo URL; ?>assets/bootstrap3/css/bootstrap.min.css" />

        <link rel="stylesheet" href="<?php echo URL; ?>assets/mystyles/style.css" />

        <link rel="stylesheet" href="<?php echo URL; ?>assets/mystyles/print.css" media="print"/>



        <script src="<?php echo URL; ?>assets/bootstrap3/js/bootstrap.min.js"></script>

    </head>
    <body >
        <div class="container" style="padding: 5px;">
            <div style="background: #0066cc;color:white; margin-bottom: 10px; padding: 10px;">
                <h4><?php echo $title; ?></h4>
                <p><?php echo 'Records : ' . $recordCount; ?></p>
            </div>
            
            <table style="border-collapse: collapse;width: 100%;border:1px solid black;">
                <tr style="background: black;">
                    <td style="color: white;font-weight: bold;">ID</td>
                    <td style="color: white;font-weight: bold;">Name</td>
                    <td style="color: white;font-weight: bold;">Contact</td>
                    <td style="color: white;font-weight: bold;">Address</td>
                    <td style="color: white;font-weight: bold;">State</td>
                    <td style="color: white;font-weight: bold;">District</td>
                    <td style="color: white;font-weight: bold;">Block</td>
                    <td style="color: white;font-weight: bold;">Product-Id</td>
                    <td style="color: white;font-weight: bold;">Product</td>
                    <td style="color: white;font-weight: bold;">Inquiry</td>
                    <td style="color: white;font-weight: bold;">Seller</td>
                    <td style="color: white;font-weight: bold;">Price</td>
                </tr>
            <?php
            if ($recordCount > 0) {
                foreach ($slotArray as $slot) {
                    if (sizeof($slot->myOrders) > 0) {
                        ?>


                <tr style="background: #0066cc;color:white;"><td colspan="12" style="color:white;"><?php echo $slot->startDate->format('Y-m-d') . ' to ' . $slot->endDate->format('Y-m-d'); ?></td></tr>  
                       
                       
            
                         <?php foreach ($slot->myOrders as $order) { ?>
                            
                            <tr>
                                 <td style="border: 1px solid black;"><?php echo $order->id; ?></td>
                                 <td style="border: 1px solid black;"><?php echo $order->customer_name; ?> </td>
                                 <td style="border: 1px solid black;"><?php echo $order->customer_contact; ?></td>
                                 <td style="border: 1px solid black;"><?php echo $order->customer_address; ?></td>
                                 <td style="border: 1px solid black;"><?php echo $order->state_name; ?></td>
                                 <td style="border: 1px solid black;"><?php echo $order->district_name; ?></td>
                                 <td style="border: 1px solid black;"><?php echo $order->block_name; ?></td>
                                 <td style="border: 1px solid black;"><?php echo $order->product_id; ?></td>
                                 <td style="border: 1px solid black;"><?php echo $order->product_name; ?></td>
                                 <td style="border: 1px solid black;"><?php echo $order->inquiry_time; ?></td>
                                 <td style="border: 1px solid black;"><?php echo $order->seller_name; ?></td>
                                 <td style="border: 1px solid black;"><?php echo $order->quoted_price; ?></td>
                                
                            </tr>

                            <?php } ?>
                       
           

                        <?php
                    }
                }
            } else {
                echo '<p>No records to display</p>';
            }
            ?>
             </table>
        </div> <!--END CONTAINER-->
    </body>
</html>  



