<form class="form-horizontal" role="form"   data-parsley-validate action="<?php echo URL_X . 'Crop/edit'; ?>" method="POST">
    <?php
    if (!isset($crop)) {

        $crop->id = "";
        $crop->crop_name = "";
    } else {
        $crop = $crop[0];
    }
    ?>
    <input type="hidden" name="id" value="<?php echo $crop->id; ?>" placeholder=""/> 
    <div class="form-group">
        <label for="seller_name" class="col-sm-2 control-label">Crop Name</label>
        <div class="col-sm-4">
            <input type="text" 
                   autofocus="autofocus"
                   class="form-control" required name="crop_name" value="<?php echo $crop->crop_name; ?>" placeholder=""/> 
        </div>
    </div>

    <div class="form-group" ng-controller="SlugController">
        <label for="product_brand" class="col-sm-2 control-label">Unique Slug</label>
        <div class="col-sm-3">
            <input type="text" 
                   class="form-control"
                   accesskey="n"
                   required 
                   value="<?php echo $crop->slug; ?>"
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
            <a accesskey="c" href="<?php echo URL_X . 'Crop/'; ?>" class="btn btn-primary">Back</a>
        </div>

    </div>


</form>

<script>
    var app = angular.module('myapp', []);


    app.controller('SlugController', ['$scope', '$http', function ($scope, $http) {
            $scope.flag = "";
            $scope.slug = '<?php echo $crop->slug; ?>';

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