<!--<div class="row">
    <form action="#" method="post">
        Start Date: <input type="date" name="start_date" />
        End Date: <input type="date" name="end_date"/>
        <input type="submit" value="Lookup"/>
    </form>
</div>
<br/>-->
<div class="row">
    <div class="col-md-3">
        <div ng-controller="BlockController">
            <form class="form-horizontal" data-parsley-validate role="form" action="<?php echo site_url('Reporting/showDates/'); ?>" method="POST">



                <div class="form-group">
                    <label for="product_name" class="col-sm-4 control-label">Start Date</label>
                    <div class="col-sm-8">
                        <input type="date" 
                               autofocus="autofocus"
                               accesskey="v"
                               class="form-control" 
                               required name="start_date"
                               placeholder=""/> 
                    </div>
                </div>

                <div class="form-group">
                    <label for="product_name" class="col-sm-4 control-label">End Date</label>
                    <div class="col-sm-8">
                        <input type="date" 
                               autofocus="autofocus"
                               accesskey="v"
                               class="form-control" 
                               required name="end_date"
                               placeholder=""/> 
                    </div>
                </div>


                <div class="form-group" >
                    <label for="" class="col-sm-4 control-label">State</label>
                    <div class="col-sm-8">

                        <select name="state_id" 
                                class="form-control"
                                accesskey="b"
                                required
                                ng-model="state"
                                ng-change="refreshDistricts();"
                                >
                            <option value="ALL" selected>ALL</option>

                            <option value="{{state.state_name}}" ng-repeat="state in data"

                                    >{{state.state_name}}</option>

                        </select>
                    </div>
                </div>

                <div class="form-group" >
                    <label for="" class="col-sm-4 control-label">District</label>
                    <div class="col-sm-8">

                        <select name="district_id" 
                                class="form-control"
                                accesskey="b"
                                ng-model="district_id"
                                ng-change="refreshBlocks();"
                                required>
                            <option value="ALL" selected>ALL</option>

                            <option value="{{district.district_name}}" ng-repeat="district in districts"
                                    ng-click=""
                                    >{{district.district_name}}</option>

                        </select>
                    </div>
                </div>

                <!--        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Block Name</label>
                            <div class="col-sm-4">
                                <input type="text"
                                       autofocus="autofocus"
                                       class="form-control" required name="block_name" placeholder=""/> 
                            </div>
                        </div>-->

                <div class="form-group" >
                    <label for="" class="col-sm-4 control-label">Block</label>
                    <div class="col-sm-8">

                        <select name="block_id" 
                                class="form-control"
                                name="block_id"
                                accesskey="b"
                                required>
                            <option value="ALL" selected>ALL</option>

                            <option value="{{block.block_name}}" ng-repeat="block in blocks"
                                    ng-click=""
                                    >{{block.block_name}}</option>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <input accesskey="s" type="submit" class="btn btn-success pull-right" value="Search"/>
<!--                        <input type="reset" class="btn" value="Clear"/>-->

                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="col-md-9">
        <div class="row well well-sm">
            <?php
            $link = null;
            if (isset($start_date) && isset($end_date)) {
                echo '<h4>' . $start_date . ' to ' . $end_date . '</h4>';
                echo '<h5> State: ' . $state . ' District: ' . $district . ' Block: ' . $block . '</h5>';
                echo '<p>Record count : '.$recordCount.'</p>';
                $link = site_url("Reporting/exportPDF?option=select&start_date=$start_date&end_date=$end_date&state=$state&district=$district&block=$block");
            } else {
                echo '<h4>All Records</h4>';
                echo '<p>Record count : '.$recordCount.'</p>';
                $link = site_url("Reporting/exportPDF?option=all");
            }
            
            echo '<a class="btn btn-primary btn-sm" href="'.$link.'">Export to PDF</a>';
            ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Data</a></li>
                    <li><a data-toggle="tab" href="#menu1">Graph</a></li>
                    <!--                    <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                                        <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>-->
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <br/>
                        <?php
                        if ($recordCount > 0) {
                            foreach ($slotArray as $slot) {
                                if (sizeof($slot->myOrders) > 0) {
                                    ?>
                                    <div class="row">
                                        <!--<p><b>Date :</b> <?php echo $slot->startDate->format('Y-m-d H:i:s') . '--' . $slot->endDate->format('Y-m-d H:i:s'); ?></p>-->
                                        <table  class="table table-condensed table-striped table-bordered table-hover" style="background: white; font-size: 0.8em;">

                                            <thead>
                                                <tr>
                                                    <td>ID</td>
                                                    <td>Customer Name</td>

                                                    <td>State</td>
                                                    <td>District</td>
                                                    <td>Block</td>


                                                    <td>Phone</td>
                                                    <td>Address</td>
                                                    <td>Product</td>
                                                    <td>Order Date</td>
                                                    <td>Quote Price</td>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <tr>
                                                    <td colspan="10"> <!--'Y-m-d H:i:s' -->
                                                        <b>Date :</b> <?php echo $slot->startDate->format('Y-m-d') . '--' . $slot->endDate->format('Y-m-d'); ?>
                                                    </td>
                                                </tr>
                                                <?php foreach ($slot->myOrders as $order) { ?>
                                                    <tr>
                                                        <td><?php echo $order->id; ?> </td>
                                                        <td><?php echo $order->customer_name; ?>
                                                            <!--<a href="#" data-toggle="tooltip" title="<?php echo "State: $order->state_name, District: $order->district_name, Block: $order->block_name"; ?>" data-placement="right" class="btn btn-xs btn-primary pull-right">G</a>-->
                                                        </td>
                                                        <td><?php echo $order->state_name; ?></td>
                                                        <td><?php echo $order->district_name; ?></td>
                                                        <td><?php echo $order->block_name; ?></td>

                                                        <td><?php echo $order->customer_contact; ?></td>
                                                        <td><?php echo $order->customer_address; ?></td>
                                                        <td><?php echo $order->product_name; ?>

                                                                                                <!--                            <a class="btn btn-xs btn-primary pull-right" href="<?php echo site_url('Product/single_product/' . $order->product_id); ?>">
                                                                                                                                <span class="glyphicon glyphicon-cog"></span>
                                                                                                                            </a>-->

                                                        </td>

                                                        <td><?php echo $order->inquiry_time; ?></td>

                                                        <td><?php echo $order->seller_name; ?> <strong>(<?php echo $order->quoted_price; ?>)</strong>

                                                                                                <!--                            <a class="btn btn-xs btn-primary pull-right" href="<?php echo site_url('Seller/single_seller/' . $order->seller_id); ?>">
                                                                                                                                <span class="glyphicon glyphicon-user"></span>
                                                                                                                            </a>-->

                                                        </td>

                                                                                                <!--                        <td class="noprint">
                                                                                                                            <a href="<?php echo site_url('Inquiry/update/' . $order->id); ?>" class="btn btn-primary btn-xs">Edit</a>
                                                                                                                            <a href="<?php echo site_url('Inquiry/delete/' . $order->id); ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                                                                                                                            <a href="<?php echo site_url('Inquiry/mark/' . $order->id . '/2'); ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                                                                                                            <a href="<?php echo site_url('Inquiry/mark/' . $order->id . '/1'); ?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-eye-close"></span></a>
                                                                                                                        </td>-->

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                }
                            }
                        } else {
                            echo '<p>No records to display</p>';
                        }
                        ?>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3>Date wise distribution</h3>
                        <div id="chart_div" style="height:100%"></div>
                    </div>
                    <!--                    <div id="menu2" class="tab-pane fade">
                                            <h3>Menu 2</h3>
                                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                        </div>
                                        <div id="menu3" class="tab-pane fade">
                                            <h3>Menu 3</h3>
                                            <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                        </div>-->
                </div>



            </div>
        </div>
    </div>
</div>








<script>
    var app = angular.module('myapp', []);
    app.controller('BlockController', ['$scope', '$http', function ($scope, $http) {
            $scope.data = null;
            $scope.districts = [];

            $http.get('<?php echo $json_fetch_link; ?>').success(function (data) {
                $scope.data = data;
                console.log("States = \n" + data);
            });

            $scope.getStates = function () {

            }
            $scope.refreshDistricts = function () {
                var state_id = $scope.state;

                console.log("refreshDistricts(" + state_id + ");");
                $scope.districts = [];
                var ourState = {};
                for (var i = 0; i < $scope.data.length; i++) {
                    var item = $scope.data[i];
                    if (item.state_name == state_id) {
                        ourState = item;
                    }
                }
                $scope.districts = ourState.districts;
            }
            $scope.refreshBlocks = function () {
                var state_id = $scope.state;
                var district_id = $scope.district_id;

                console.log("refreshBlocks(" + district_id + ");");
                //$scope.districts = [];
                var ourState = {};

                $scope.blocks = [];
                var ourDistrict = {};

                for (var i = 0; i < $scope.data.length; i++) {
                    var item = $scope.data[i];
                    if (item.state_name == state_id) {
                        ourState = item;
                    }
                }
                //now we have a state we can loop in districts
                for (var i = 0; i < ourState.districts.length; i++) {
                    var item = ourState.districts[i];
                    if (item.district_name == district_id) {
                        ourDistrict = item;
                    }
                }

                $scope.blocks = ourDistrict.blocks;
            }


            $scope.state = "ALL";
            $scope.district_id = "ALL";
        }]);
</script>


 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            
          ['Date', 'Inquiries'],
          <?php foreach ($slotArray as $slot) {?>
                                  
                             
          ['<?php echo $slot->startDate->format('Y-m-d');?>',  <?php echo count($slot->myOrders)  ?>],
         
              
              <?php } ?>
        ]);

        var options = {
         // title: 'Company Performance',
          hAxis: {title: '',  titleTextStyle: {color: '#333'},direction:-1, slantedText:true, slantedTextAngle:90},
          vAxis: {minValue: 0},
         
            width: 900,
            height: 480
        
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
