
<table style="font-size: 0.9em;"
    class="table table-hover table-striped table-bordered table-responsive"
    id="mytable">

    <thead>
        <tr>
            <td>ID</td>
            <td>Customer Name</td>
            <td>Phone</td>
            <td>Address</td>
            <td>Product</td>

            <td>Inquiry Time</td>
            <td>Seller(Price)</td>
            <td class="noprint">Action</td>


        </tr>
    </thead>
    <tfoot>
        <tr class="noprint">
            <td>ID</td>
            <td>Customer Name</td>
            <td>Phone</td>
            <td>Address</td>
            <td>Product</td>

            <td>Inquiry Time</td>
            <td>Seller(Price)</td>
            <td class="noprint">Action</td>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($inquiries as $b) { ?>
            <tr 
            <?php
            if ($b->tag == '2')
                echo "class=\"success\" ";
            ?> >
                <td>
    <?php echo $b->id; ?>
                </td>

                <td><?php echo $b->customer_name; ?>
               <a href="#" data-toggle="tooltip" title="<?php echo "State: $b->state_name, District: $b->district_name, Block: $b->block_name"; ?>" data-placement="right" class="btn btn-xs btn-primary pull-right">G</a>
                </td>
                <td><?php echo $b->customer_contact ?></td>
                <td><?php echo $b->customer_address; ?></td>
                <td><?php echo $b->product_name; ?>

                    <a class="btn btn-xs btn-primary pull-right" href="<?php echo site_url('Product/single_product/' . $b->product_id); ?>">
                        <span class="glyphicon glyphicon-cog"></span>
                    </a>

                </td>

                <td><?php echo $b->inquiry_time; ?></td>

                <td><?php echo $b->seller_name; ?> <strong>(<?php echo $b->quoted_price; ?>)</strong>

                    <a class="btn btn-xs btn-primary pull-right" href="<?php echo site_url('Seller/single_seller/' . $b->seller_id); ?>">
                        <span class="glyphicon glyphicon-user"></span>
                    </a>

                </td>

                <td class="noprint">
                    <!--<a href="<?php echo site_url('Inquiry/update/' . $b->id); ?>" class="btn btn-primary btn-xs">Edit</a>-->
                    <a href="<?php echo site_url('Inquiry/delete/' . $b->id); ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                    <a href="<?php echo site_url('Inquiry/mark/' . $b->id . '/2'); ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                    <a href="<?php echo site_url('Inquiry/mark/' . $b->id . '/1'); ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-eye-close"></span></a>
                </td>
            </tr>
<?php } ?>
    </tbody>
</table>
    
    

<script>
    var app = angular.module('myapp', []);
    app.controller('ProductController', ['$scope', '$http', function ($scope, $http) {



        }]);
</script>


