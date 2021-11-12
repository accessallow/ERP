<h3>Add new mapping to <strong><?php echo $product->product_name?></strong></h3>

<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>" role="alert">
        <span class="glyphicon <?php echo $this->session->flashdata('glyphicon_class'); ?>"></span>
        <strong><?php echo $this->session->flashdata('message'); ?></strong>
    </div>
<?php } ?>

<hr/>
<div ng-controller="BlockController">
    <form class="form-horizontal" data-parsley-validate role="form" action="<?php echo site_url('Mapping/addMapping/'.$product->id); ?>" method="POST">
        
        <input type="hidden" name="product_id" value="<?php echo $product->id;?>"/>
        
        <div class="form-group" >
            <label for="" class="col-sm-2 control-label">State</label>
            <div class="col-sm-4">

                <select name="state_id" 
                        class="form-control"
                        accesskey="b"
                        required
                        ng-model="state"
                        ng-change="refreshDistricts();"
                        >
                    <option value="" selected>Choose state</option>
                    
                    <option value="{{state.id}}" ng-repeat="state in data"
                            
                            >{{state.state_name}}</option>
                    
                </select>
            </div>
        </div>
        
         <div class="form-group" >
            <label for="" class="col-sm-2 control-label">District</label>
            <div class="col-sm-4">

                <select name="district_id" 
                        class="form-control"
                        accesskey="b"
                        ng-model="district_id"
                        ng-change="refreshBlocks();"
                        required>
                    <option value="" selected>Choose district</option>
                    
                    <option value="{{district.id}}" ng-repeat="district in districts"
                            ng-click=""
                            >{{district.district_name}}</option>
                    <option value="-1" selected>ALL</option>       
                    
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
            <label for="" class="col-sm-2 control-label">Block</label>
            <div class="col-sm-4">

                <select name="block_id" 
                        class="form-control"
                        name="block_id"
                        accesskey="b"
                        required>
                    <option value="" selected>Choose block</option>
                    
                    <option value="{{block.id}}" ng-repeat="block in blocks"
                            ng-click=""
                            >{{block.block_name}}</option>
                    <option value="-1" selected>ALL</option> 
                    
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input accesskey="s" type="submit" class="btn btn-success" value="Save"/>
                <input type="reset" class="btn" value="Clear"/>
                <a  accesskey="c" href="<?php echo site_url('Mapping/product_mapping/'.$product->id); ?>" class="btn btn-primary">Back</a>
            </div>
        </div>
    </form>

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

            $scope.getStates = function(){
                
            }
            $scope.refreshDistricts = function () {
                var state_id = $scope.state;
                
                console.log("refreshDistricts("+state_id+");");
                $scope.districts = [];
                var ourState = {};
                for(var i=0;i<$scope.data.length;i++){
                    var item = $scope.data[i];
                    if(item.id==state_id){
                        ourState = item;
                    }
                }
                $scope.districts = ourState.districts;
            }
            $scope.refreshBlocks = function () {
                var state_id = $scope.state;
                var district_id = $scope.district_id;
                
                console.log("refreshBlocks("+district_id+");");
                //$scope.districts = [];
                var ourState = {};
                
                $scope.blocks = [];
                var ourDistrict = {};
                
                for(var i=0;i<$scope.data.length;i++){
                    var item = $scope.data[i];
                    if(item.id==state_id){
                        ourState = item;
                    }
                }
                //now we have a state we can loop in districts
                for(var i=0;i<ourState.districts.length;i++){
                    var item = ourState.districts[i];
                    if(item.id==district_id){
                        ourDistrict = item;
                    }
                }
                
                $scope.blocks = ourDistrict.blocks;
            }

        }]);
</script>