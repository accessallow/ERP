<h3>Edit block</h3>

<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>" role="alert">
        <span class="glyphicon <?php echo $this->session->flashdata('glyphicon_class'); ?>"></span>
        <strong><?php echo $this->session->flashdata('message'); ?></strong>
    </div>
<?php } ?>

<hr/>
<div ng-controller="BlockController">
    <form class="form-horizontal" data-parsley-validate role="form" action="<?php echo site_url('Block/edit'); ?>" method="POST">

        <input type="hidden" name="id" value="<?php echo $block->id;?>"/>
        <div class="form-group" >
            <label for="" class="col-sm-2 control-label">State</label>
            <div class="col-sm-4">

                <select name="state_id" 
                        class="form-control"
                        accesskey="b"
                        required
                        ng-model="state_id"
                        ng-change="refreshDistricts();"
                        >
                    <option value="">Choose state</option>
                    
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
                        ng-model="d"
                        accesskey="b"
                        required>
                    <option value="">Choose district</option>
                    
                    <option value="{{district.id}}" ng-repeat="district in districts"
                            ng-click=""
                            ng-selected="getSelection(district.id);"
                            >{{district.district_name}}</option>
                    
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Block Name</label>
            <div class="col-sm-4">
                <input type="text"
                       autofocus="autofocus"
                       ng-model="block_name"
                       class="form-control" required name="block_name" placeholder=""/> 
            </div>
        </div>
        <!--<a href="#" ng-click="show()">Show</a>-->
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input accesskey="s" type="submit" class="btn btn-success" value="Save"/>
                <input type="reset" class="btn" value="Clear"/>
                <a  accesskey="c" href="<?php echo site_url('Block'); ?>" class="btn btn-primary">Back</a>
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

          
            $scope.refreshDistricts = function () {
                var state_id = $scope.state_id;
                
                $http.get('<?php echo $json_fetch_link; ?>').success(function (data) {
                
                console.log("States = \n" + data);
                
                console.log("refreshDistricts("+state_id+");");
                $scope.districts = [];
                var ourState = {};
                for(var i=0;i<data.length;i++){
                    var item = data[i];
                    if(item.id==state_id){
                        ourState = item;
                    }
                }
                $scope.districts = ourState.districts;
                
                });
                
                
            }
            
            $scope.getState = function(id){
                var state = {};
                for(var i=0;i<$scope.data.length;i++){
                    var item = $scope.data[i];
                    if(item.id == id){
                        state = item;
                    }
                }
            }
            
            
            
           $scope.block_name = '<?php echo $block->block_name; ?>';
//           $scope.state_id= $scope.getState(<?php echo $block->state_id; ?>);

            $scope.show = function(){
                console.log($scope.state_id);
                $scope.state_id = <?php echo $block->state_id; ?>;
                $scope.refreshDistricts();
//                $scope.d = <?php echo $block->district_id; ?>;
//                console.log($scope.d);
            }
            
            $scope.show();
            
            $scope.getSelection = function(district_id){
                if(district_id == <?php echo $block->district_id; ?>){
                    return true;
                }else{
                    return false;
                }
                
            }
            
            $scope.getStateSelection = function(state_id){
                if(state_id == <?php echo $block->state_id; ?>){
                    return true;
                }else{
                    return false;
                }
                
            }
            
        }]);
</script>