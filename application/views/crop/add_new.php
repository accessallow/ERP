<h3>Add new crop</h3>
<hr/>
<form class="form-horizontal"   data-parsley-validate role="form" action="<?php echo URL_X . 'Crop/add_new'; ?>" method="POST">
    <div class="form-group">
        <label for="crop_name" class="col-sm-2 control-label">Crop Name</label>
        <div class="col-sm-4">
            <input type="text"
                   autofocus="autofocus"
                   class="form-control" required name="crop_name" placeholder=""/> 
        </div>
    </div>
    <div class="form-group" ng-controller="SlugController">
        <label for="product_brand" class="col-sm-2 control-label">Unique Slug</label>
        <div class="col-sm-3">
            <input type="text" 
                   class="form-control"
                   accesskey="n"
                   required 
                   
                   name="slug" 
                   ng-model="slug"
                   placeholder=""/> 
        </div>
        <a href="#" class="btn btn-primary btn-sm" ng-click="checkSlugAvailable(slug);">Check</a>
        <span>{{flag}}</span>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input accesskey="s" type="submit" class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a  accesskey="c" href="<?php echo URL_X . 'Crop/'; ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</form>

<script>
    var app = angular.module('myapp', []);


    app.controller('SlugController', ['$scope', '$http', function ($scope, $http) {
            $scope.flag = "";
            

            $scope.checkSlugAvailable = function (slug) {
                //console.log(slug.trim().length);
                if (slug == undefined) {
                    $scope.flag = "";
                } else if (slug.trim().length != 0) {
                    $http.get('<?php echo site_url('Crop/slugAvailable'); ?>/' + slug).success(function (data) {
                        console.log(data);
                        if (data.response == true) {
                            $scope.flag = "Available";
                        } else {
                            $scope.flag = "Not Available";
                        }
                    });
                }
            }
        }]);
</script>