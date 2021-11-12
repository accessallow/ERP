<div class="row">
    <form action="<?php echo site_url('Web/inquiry/'.$product->id.'/'.$seller_id); ?>" method="post">
        <input type="hidden" name="product_id" value="<?php echo $product->id; ?>"/>
        <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>"/>
        <input type="hidden" name="seller_name" value="<?php echo $seller_name; ?>"/>
        <input type="hidden" name="quoted_price" value="<?php echo $quoted_price; ?>"/>
<!--        geolocation parameters-->
        <input type="hidden" name="state_name" value="<?php echo $geolocation['state_name']; ?>"/>
        <input type="hidden" name="district_name" value="<?php echo $geolocation['district_name']; ?>"/>
        <input type="hidden" name="block_name" value="<?php echo $geolocation['block_name']; ?>"/>
        
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <td colspan="2" class="bold-text" style="background: #2c5090; color: #ffffff; ">
                    Inquiry About : <?php echo $product->product_name; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="bold-text" style="background: #50535a; color: #ffffff; ">
                    Seller : <?php echo $seller_name; ?>
                </td>
            </tr>
             <tr>
                <td colspan="2" class="bold-text" style="background: #50535a; color: #ffffff; ">
                    Price : <?php echo $quoted_price; ?>
                </td>
            </tr>

            <tr>
                <td class="bold-text">Name</td>
                <td>
                    <input type="text" required name="customer_name" class="form-control"/>
                </td>
            </tr>

            <tr>
                <td class="bold-text">Contact</td>
                <td>
                    <input type="text" required name="customer_contact" class="form-control"/>
                </td>
            </tr>

            <tr>
                <td class="bold-text">Address</td>
                <td>
                    <textarea  required name="customer_address" class="form-control"></textarea>
                </td>
            </tr>



            <tr style="text-align: center;">
                <td colspan="2">
                    <input type="submit" value="Submit" class="btn btn-success"/>
<!--                    <a href="<?php echo site_url('Web/product/' . $product->id); ?>"  class="btn btn-primary">Back</a>
                -->
                    <a href="<?php echo site_url('Web/product/' . $product->id."?state_name=".$geolocation['state_name']."&district_name=".$geolocation['district_name']."&block_name=".$geolocation['block_name']); ?>"  class="btn btn-primary">Back</a>
                </td>
            </tr>

        </table>
    </form>
</div>
