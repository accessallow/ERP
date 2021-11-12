<h3>Update mapping of seller: <strong><?php echo $seller->seller_name?></strong></h3>

<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>" role="alert">
        <span class="glyphicon <?php echo $this->session->flashdata('glyphicon_class'); ?>"></span>
        <strong><?php echo $this->session->flashdata('message'); ?></strong>
    </div>
<?php } ?>

<hr/>
<div ng-controller="BlockController">
    <form class="form-horizontal" data-parsley-validate role="form" action="<?php echo site_url('Coverage/editMapping/'.$mapping->id); ?>" method="POST">
        
        <input type="hidden" name="mapping_id" value="<?php echo $mapping->id;?>"/>
        <input type="hidden" name="seller_id" value="<?php echo $seller->id;?>"/>
        
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
                            ng-selected="getStateSelection(state.id);"
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
                            ng-selected="getDistrictSelection(district.id);"
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
                            ng-selected="getBlockSelection(block.id);"
                            >{{block.block_name}}</option>
                    
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input accesskey="s" type="submit" class="btn btn-success" value="Save"/>
                <input type="reset" class="btn" value="Clear"/>
                <a  accesskey="c" href="<?php echo site_url('Seller/single_seller/'.$seller->id); ?>" class="btn btn-primary">Back</a>
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
                
                $scope.state = <?php echo $mapping->state_id;?>;
                
                $scope.refreshDistricts();
                $scope.district_id=<?php echo $mapping->district_id;?>;
                
                $scope.refreshBlocks();
            });

            
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
            
            $scope.getDistrictSelection = function(district_id){
                if(district_id == <?php echo $mapping->district_id; ?>){
                    return true;
                }else{
                    return false;
                }
                
            }
            
            $scope.getStateSelection = function(state_id){
                if(state_id == <?php echo $mapping->state_id; ?>){
                    return true;
                }else{
                    return false;
                }
                
            }
            
            $scope.getBlockSelection = function(block_id){
                if(block_id == <?php echo $mapping->block_id; ?>){
                    return true;
                }else{
                    return false;
                }
            }
            
            
        }]);
</script>