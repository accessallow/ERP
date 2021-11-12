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
                    State Association
                </div>
                <div class="panel-body">

                    <form action="<?php echo site_url('Product/attach_state'); ?>" method="post">

                        <input type="hidden" name="product_id" value="<?php echo $product->id; ?>"/>

                        <?php foreach ($states as $c) { ?>


                            <input type="checkbox" name="state_check_list[]" value="<?php echo $c->state_name; ?>"
                            <?php
                            if (strpos($stateString, '' . $c->state_name) !== false) {
                                echo ' checked ';
                            }
                            ?>

                                   ><label> <?php echo $c->state_name; ?></label>
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
                    District Association
                </div>
                <div class="panel-body">

                    <form action="<?php echo site_url('Product/attach_district'); ?>" method="post">

                        <input type="hidden" name="product_id" value="<?php echo $product->id; ?>"/>


                        <?php foreach ($statesDistricts as $cs) { ?>
                            <p 
                                style="background: #2d4458;color:white;padding: 2px;font-weight: bold;"
                                ><?php echo $cs->state_name; ?></p>                       
                                <?php foreach ($cs->districts as $scr) { ?>                 

                                <input type="checkbox" name="district_check_list[]" value="<?php echo $scr->district_name; ?>"

                                       <?php
                                       if (strpos($districtString, '' . $scr->district_name) !== false) {
                                           echo ' checked ';
                                       }
                                       ?>

                                       ><label><?php echo $scr->district_name; ?></label>
                                   <?php } ?>    
                               <?php } ?>

                        <br/>
                        <input type="submit" name="submit" class="btn btn-success" Value="Update"/>
                    </form>

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
