<div class="row well">
    <h3 class=""><?php echo $product_name; ?>
        <small><?php echo $category; ?></small>
    </h3>
    <a href="<?php echo site_url('Product'); ?>" class="btn btn-xs btn-warning">
        <span class="glyphicon glyphicon-backward"></span> Back
    </a>
</div>
<div class="row">
<!--    <div class="col-md-12">-->
        <div class="panel panel-primary">
            <div class="panel-heading">

                Details
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Brand</td>
                            <td><?php echo $brand; ?></td>
                            <td>Unique Slug</td>
                            <td><?php echo $slug; ?></td>
                        </tr>

                        <tr>
                            <td>Category</td>
                            <td><?php echo $category; ?></td>
                            <td>Best Price</td>
                            <td><?php echo $best_rate; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="background:#337ab7;color:white;">Description</td>
                        </tr>
                        <tr>
                            <td colspan="4" ><?php echo $description; ?></td>
                        </tr>
                    
                        <tr>
                            <td>Action</td>
                            <td colspan="3">
                                <a href="<?php echo $product_edit_link; ?>" class="btn btn-primary btn-xs">Edit</a>
                                <a href="<?php echo $product_delete_link; ?>" class="btn btn-danger btn-xs">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
<!--    </div>-->
    <!--    <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Stats
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Sellers</td>
                                <td><?php echo $sellers_count; ?></td>
                            </tr>
    
                            <tr>
                                <td>Best rate</td>
                                <td><?php echo $best_rate; ?></td>
                            </tr>
                            <tr>
                                <td>Best seller</td>
                                <td><?php echo $best_seller; ?></td>
                            </tr>
                            <tr>
                                <td>Stock</td>
                                <td>
                                    <span class="pull-left"><?php echo $stock; ?></span>
                                    <span class="pull-right">
                                        <a href="<?php echo $do_stock_zero_link; ?>" class="btn btn-danger btn-xs">Do Stock Zero</a>
                                    </span>
                                </td>
                            </tr>
    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>-->
</div>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Files attached with <?php echo $product_name; ?>
            <span class="pull-right">
                <a href="<?php echo $upload_new_link; ?>" class="btn btn-success btn-xs">Upload file</a>
            </span>
        </div>
        <div class="panel-body" ng-controller="UploadController">

            <div 
                ng-repeat="upload in uploads"
                class="col-md-2" style="text-align: center;margin-bottom: 15px;">
                <img ng-src="<?php echo $upload_base; ?>/{{upload.file_name}}" 
                     class="img-thumbnail"
                     style="width: 150px;height:100px;margin-bottom: 5px;"
                     />
                <br/>
                <a 
                    href="<?php echo site_url('FileUpload/single'); ?>/{{upload.id}}/{{upload.attachment_type}}/{{upload.attachment_id}}" 
                    class="btn btn-info btn-xs"
                    style="margin-top:-190px;margin-left:110px;"
                    >V</a>

                <a href="<?php echo site_url('FileUpload/delete'); ?>/{{upload.id}}/{{upload.attachment_type}}/{{upload.attachment_id}}" class="btn btn-danger btn-xs"
                   style="margin-top:-138px;margin-left:-24px;"
                   >D</a>        

            </div>


        </div>
    </div>
</div>

<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Crop Association
        </div>
        <div class="panel-body">

            <form action="<?php echo site_url('Product/attach_crop'); ?>" method="post">

                <input type="hidden" name="product_id" value="<?php echo $id; ?>"/>

                <?php foreach ($crops as $c) { ?>


                    <input type="checkbox" name="check_list[]" value="<?php echo $c->slug; ?>"
                    <?php
                    if (strpos($cropString, '' . $c->slug) !== false) {
                        echo ' checked ';
                    }
                    ?>
                           ><label> <?php echo $c->crop_name; ?></label>
                    <br/>
                <?php } ?>


                <input type="submit" name="submit" class="btn btn-success" Value="Update"/>
            </form>

        </div>
    </div>
</div>


<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Disease Association
        </div>
        <div class="panel-body">

            <form action="<?php echo site_url('Product/attach_disease'); ?>" method="post">

                <input type="hidden" name="product_id" value="<?php echo $id; ?>"/>

                <?php foreach ($diseases as $d) { ?>


                    <input type="checkbox" name="check_list[]" value="<?php echo $d->slug; ?>"
                    <?php
                    if (strpos($diseaseString, '' . $d->slug) !== false) {
                        echo ' checked ';
                    }
                    ?>
                           ><label> <?php echo $d->disease_name; ?></label>
                    <br/>
                <?php } ?>


                <input type="submit" name="submit" class="btn btn-success" Value="Update"/>
            </form>

        </div>
    </div>
</div>

<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Cross Product Association
        </div>
        <div class="panel-body">

            <form action="<?php echo site_url('Product/attach_product'); ?>" method="post">

                <input type="hidden" name="product_id" value="<?php echo $id; ?>"/>

                <?php foreach ($products as $p) { ?>


                    <input type="checkbox" name="product_check_list[]" value="<?php echo $p->slug; ?>"
                    <?php
                    if (strpos($prodString, '' . $p->slug) !== false) {
                        echo ' checked ';
                    }
                    ?>
                           ><label> <?php echo $p->product_name; ?></label>
                    <br/>
                <?php } ?>


                <input type="submit" name="submit" class="btn btn-success" Value="Update"/>

            </form>
        </div>
    </div>
</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('UploadController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $uploads_json_fetch_link; ?>').success(function (data) {
                $scope.uploads = data;
                console.log(data);
            });

        }]);

   
</script>
