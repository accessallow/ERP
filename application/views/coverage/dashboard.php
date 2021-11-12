<div class="row" ng-controller="dashboardController">
    <div class="col-md-2">
        <ul class="list-group">
            <?php foreach ($products as $p) { ?>
                <li class="list-group-item">
                    <a href="<?php echo site_url('Mapping/product_mapping/' . $p->id); ?>">
                        <?php echo $p->product_name; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="col-md-10">
        <h3>Mapping for <?php echo $product->product_name; ?></h3>

        <?php if ($this->session->flashdata('message')) { ?>
            <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>" role="alert">
                <span class="glyphicon <?php echo $this->session->flashdata('glyphicon_class'); ?>"></span>
                <strong><?php echo $this->session->flashdata('message'); ?></strong>
            </div>
        <?php } ?>

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Crop Association
                </div>
                <div class="panel-body">

                    <form action="<?php echo site_url('Product/attach_crop'); ?>" method="post">

                        <input type="hidden" name="product_id" value="<?php echo $product->id; ?>"/>

                        <?php foreach ($crops as $c) { ?>


                            <input type="checkbox" name="check_list[]" value="<?php echo $c->slug; ?>"
                            <?php
                            if (strpos($cropString, '' . $c->slug) !== false) {
                                echo ' checked ';
                            }
                            ?>

                                   ><label> <?php echo $c->crop_name; ?> <span class="badge"><?php echo $c->slug; ?></span></label>
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
                    Screen Association
                </div>
                <div class="panel-body">

                    <form action="<?php echo site_url('Product/attach_screen'); ?>" method="post">

                        <input type="hidden" name="product_id" value="<?php echo $product->id; ?>"/>


                        <?php foreach ($cropScreens as $cs) { ?>
                            <p 
                                style="background: #2d4458;color:white;padding: 2px;font-weight: bold;"
                                ><?php echo $cs->crop_name; ?></p>                       
                                <?php foreach ($cs->screens as $scr) { ?>                 

                                <input type="checkbox" name="screen_check_list[]" value="<?php echo $scr->screen_name; ?>"

                                       <?php
                                       if (strpos($screenString, '' . $scr->screen_name) !== false) {
                                           echo ' checked ';
                                       }
                                       ?>
                                       ><label><?php echo $scr->screen_name; ?></label>
                                   <?php } ?>    
                               <?php } ?>

                        <br/>
                        <input type="submit" name="submit" class="btn btn-success" Value="Update"/>
                    </form>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Location Mapping
                    <a href="<?php echo site_url('Mapping/addMapping/' . $product->id); ?>" class="btn btn-xs btn-warning">Add mapping</a>
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
                                        <a href="<?php echo site_url('Mapping/editMapping/' . $m->id); ?>" class="btn btn-primary btn-xs">Edit</a>
                                        <a href="<?php echo site_url('Mapping/deleteMapping/' . $m->id); ?>" class="btn btn-danger btn-xs">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>
</div>

<script>
    var app = angular.module('myapp', []);
    app.controller('dashboardController', ['$scope', '$http', function ($scope, $http) {
            $scope.screens = [];



            $scope.updateScreens = function (crop_id) {
                $http.get('<?php echo site_url('Screen/getScreensOfACrop') ?>/' + crop_id).success(function (data) {
                    $scope.crops = data;
                    $scope.screens = $scope.screens.concat(data);
                    console.log($scope.screens);
                });
            }

        }]);
</script>
