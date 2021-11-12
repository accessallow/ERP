<div class="row">
    <h3 class="well"><?php echo $seller_name; ?>
        <small><?php echo $seller_phone_number; ?></small>
    </h3>
</div>

<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>" role="alert">
        <span class="glyphicon <?php echo $this->session->flashdata('glyphicon_class'); ?>"></span>
        <strong><?php echo $this->session->flashdata('message'); ?></strong>
    </div>
<?php } ?>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $seller_name; ?>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Phone</td>
                            <td><?php echo $seller_phone_number; ?></td>
                        </tr>
                        <tr>
                            <td>Mail Id</td>
                            <td><?php echo $mail_id; ?></td>
                        </tr>
<!--                        <tr>
                            <td>Tin number</td>
                            <td><?php echo $tin_number; ?></td>
                        </tr>-->
                        <tr>
                            <td>Address</td>
                            <td><?php echo $seller_address; ?></td>
                        </tr>
                        <tr>
                            <td>Action</td>
                            <td>
                                <a href="<?php echo $seller_edit_link; ?>" class="btn btn-primary btn-xs">Edit</a>
                                <a href="<?php echo $seller_delete_link; ?>" class="btn btn-danger btn-xs">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Stats
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Products</td>
                            <td>
                                <?php echo $products_count; ?>
                                <a 
                                    href="<?php echo $view_my_products_link; ?>" 
                                    class="badge pull-right"

                                    >View products</a>
                            </td>
                        </tr>
<!--                        <tr>
                            <td>Inventories</td>
                            <td>
                                <?php echo $inventory_count; ?>
                                <a 
                                    href="<?php echo $view_my_inventory_link; ?>" 
                                    class="badge pull-right"

                                    >View inventory</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Total transaction money</td>
                            <td>
                                <?php echo $total_money; ?>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Total cash money</td>
                            <td>
                                <?php echo $total_cash; ?>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Total cheque money</td>
                            <td>
                                <?php echo $total_cheque; ?>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Total pending money</td>
                            <td>
                                <?php echo $total_pending; ?>
                                
                            </td>
                        </tr>-->


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Files attached with <?php  echo $seller_name;   ?>
            <span class="pull-right">
                <a href="<?php  echo $upload_new_link;   ?>" class="btn btn-success btn-xs">Upload file</a>
            </span>
        </div>
        <div class="panel-body" ng-controller="UploadController">

            <div 
                ng-repeat="upload in uploads"
                class="col-md-2" style="text-align: center;margin-bottom: 15px;">
                <img ng-src="<?php echo $upload_base;  ?>/{{upload.file_name}}" 
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
                    Location Mapping
                    <a href="<?php echo site_url('Coverage/addMapping/' . $id); ?>" class="btn btn-xs btn-warning">Add mapping</a>
                </div>
                <div class="panel-body">

                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <td>State</td>
                        <td>District</td>
                        <td>Block</td>
                        <td>Action</td>
                        </thead>
                        <tbody>
                            <?php foreach ($mapping as $m) { ?>
                                <tr>
                                    <td><?php echo $m->state_name; ?></td>
                                    <td><?php echo $m->district_name; ?></td>
                                    <td><?php echo $m->block_name; ?></td>
                                    <td>
                                        <a href="<?php echo site_url('Coverage/editMapping/' . $m->id); ?>" class="btn btn-primary btn-xs">Edit</a>
                                        <a href="<?php echo site_url('Coverage/deleteMapping/' . $m->id); ?>" class="btn btn-danger btn-xs">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

<script>
    var app = angular.module('myapp', []);
    app.controller('UploadController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $uploads_json_fetch_link;   ?>').success(function (data) {
                $scope.uploads = data;
                console.log(data);
            });

        }]);
</script>
