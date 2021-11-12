<br/>
<div class="row" style="text-align: center; background: #2c5090; color: #ffffff;">
    <h3 style="margin-top: 10px;"><?php echo $product->product_name; ?></h3>
</div>
<br/>
<div class="row"> 

    <?php
    $productImagePath = $product->uploads[1]->file_name;
    ?>
    <img class="thumbnail" src="<?php echo $productImagePath; ?>" style="display: block;
         margin-left: auto;
         margin-right: auto;"
         width="243" height="230"
         />

</div>
<div class="row">
    <table class="table table-hover table-striped table-bordered">
        <tr>
            <td class="bold-text">Brand</td>
            <td><?php echo $product->product_brand; ?></td>
        </tr>

        <tr>
            <td class="bold-text">Type</td>
            <td><?php echo $product->product_category; ?></td>
        </tr>

        <tr>
            <td class="bold-text">Category</td>
            <td><?php echo $product->domain_name; ?></td>
        </tr>

        <tr>
            <td class="bold-text">Manufacturer</td>
            <td><?php echo $product->seller_name; ?></td>
        </tr>
        
        
        
        <tr>
            <td colspan="2" class="bold-text" style="background: #2c5090; color: #ffffff; ">
                About <?php echo $product->product_name; ?>
            </td>
        </tr>
        <tr>

            <td colspan="2"><?php echo $product->product_description; ?></td>
        </tr>
        
        <tr>
            <td colspan="2" class="bold-text" style="background: #2c5090; color: #ffffff; ">
                Compare Prices
            </td>
        </tr>
        <tr>

            <td colspan="2">
                <?php if(sizeof($sellers)>0) { ?>
                <table class="table table-bordered table-bordered table-striped table-condensed">
                    <?php foreach ($sellers as $s) { ?>    
                    <tr>
                        <td><?php echo $s->seller_name; ?></td>
                        <td><?php echo $s->product_price; ?></td>
                        <td>
                            <a href="<?php 
                            echo site_url("Web/inquiry/$product->id/$s->id?state_name=".$geolocation['state_name']."&district_name=".$geolocation['district_name']."&block_name=".$geolocation['block_name']); 
                            ?>" class="btn btn-success btn-xs">Order</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <?php } else {?>
                
                <p><strong>Currently there are no sellers providing this product in your area.</strong></p>
                <?php } ?>
                
            </td>
        </tr>

    </table>
</div>
<!--<div class="row" style="text-align: center;">
    <div class="col-sm-12" style="text-align: center;">
        <a 

            href="<?php echo site_url('Web/inquiry/' . $product->id); ?>" class="btn btn-primary">Send Inquiry</a>
    </div>
</div>-->
 <?php if(sizeof($side_products)>0) { ?>
<div class="row" style="text-align: center;">
    <p style="background: #2c5090; color: #ffffff; padding: 7px;font-weight: bold; ">Similar products</p>
    <br/>
    
        <?php
        foreach ($side_products as $s) {

            $pn = $s->product_name;
            $ipath = $s->uploads[1]->file_name;
            ?>
<!--            <div class="col-sm-3" 
                 onclick="window.location='<?php echo site_url('Web/product/'.$s->id); ?>';"
                 >-->
                
                 <div class="col-sm-3" 
                 onclick="window.location='<?php echo site_url('Web/product/'.$s->id."?state_name=".$geolocation['state_name']."&district_name=".$geolocation['district_name']."&block_name=".$geolocation['block_name']); ?>';"
                 >
                     
            <p style="background: #2c5090; 
                 color: #ffffff; padding: 7px;font-weight: bold; "><?php echo $pn ?></p>  

            <img class="thumbnail" src="<?php echo $ipath; ?>" style="display: block;
                 margin-left: auto;
                 margin-right: auto;"
                 width="243" height="230"
                 />
            
             </div>
<?php } ?>
   
</div>

<?php } ?>
