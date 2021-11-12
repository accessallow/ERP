<div class="row">
    <div class="col-md-7">
        <form class="form-inline">
            <div class="form-group">
                <input  placeholder="Search..."  type="text" ng-model="m" 
                        autofocus
                        class="form-control noprint"/>
            </div>
        </form>
    </div>
    <div class="col-md-5" style="text-align: right;">
        <a class="btn btn-success btn-xs" href="<?php echo URL_X . 'Crop/add_new'; ?>">Add new crop</a>
    </div>
</div>
<br/>

<?php if($this->session->flashdata('message')){?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok"></span>
    <strong><?php echo $this->session->flashdata('message');?></strong>
</div>
<?php } ?>

<div class="row" ng-controller="CropController">
    <div class="col-md-5">
        <table class="table table-hover table-striped">
            <thead>
            <td>Crop Name</td><td>Slug</td><td style="text-align: right;">Action</td>
            </thead>
            <tr ng-repeat="crop in crops|filter:m">
                <td>
                    <a href="<?php echo URL_X; ?>Product?crop_id={{crop.id}}">
                        {{crop.crop_name}}
                    </a>
                    
                    
                    
                </td>
                
                 <td>
                    
                        {{crop.slug}}
                    
                </td>

                <td style="text-align: right;">
                     <!--<a href="<?php echo URL_X . 'Set?category_id='; ?>{{category.id}}" class="btn  btn-info btn-xs">Preset</a>-->
                    <a href="<?php echo URL_X . 'Screen/addScreenToCrop/'; ?>{{crop.id}}" class="btn  btn-info btn-xs">+S</a>
                   
                    <a href="<?php echo URL_X . 'Crop/edit/'; ?>{{crop.id}}" class="btn  btn-primary btn-xs">Edit</a>
                    <a href="<?php echo URL_X . 'Crop/delete/'; ?>{{crop.id}}" class="btn  btn-danger btn-xs">Delete</a>
                </td>
            </tr>

        </table>
    </div>
</div>

<script>
    var app = angular.module('myapp', []);
    app.controller('CropController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $json_fetch_link; ?>').success(function (data) {
                $scope.crops = data;
                console.log("Crops = \n" + data);
            });

        }]);
</script>