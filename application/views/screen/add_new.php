<h3><?php echo $screenTitle; ?></h3>
<hr/>

<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>" role="alert">
        <span class="glyphicon <?php echo $this->session->flashdata('glyphicon_class'); ?>"></span>
        <strong><?php echo $this->session->flashdata('message'); ?></strong>
    </div>
<?php } ?>

<form class="form-horizontal"   data-parsley-validate role="form" action="<?php echo $formSubmitUrl; ?>" method="POST">

    <input type="hidden" name="crop_id" value="<?php echo $cropId; ?>"/>
    <input type="hidden" name="crop_slug" value="<?php echo $crop_slug; ?>"/>
    <div class="form-group" ng-controller="SlugController">
        <label for="product_brand" class="col-sm-2 control-label">Screen Name</label>
        <div class="col-sm-3">

            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><?php echo $crop_slug.'_'; ?></span>
                
                 <input type="text" 
                   class="form-control"
                   accesskey="n"
                   required 
                   aria-describedby="basic-addon1"
                   name="screen_name" 
                   ng-model="slug"
                   placeholder=""/> 
            </div>

           
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

<hr/>
<h4>All screens attached with  crop: <?php echo $cropName; ?></h4>
<table 
    class="table table-hover table-striped table-bordered"
    id="mytable">

    <thead>
        <tr>
            <td>Id</td>
            <td>Crop Name</td>
            <td>Screen Name</td>
            
            <td class="noprint">Action</td>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($screens as $s) { ?>
            <tr>
                <td style="width: 150px;"><?php echo $s->id; ?>   
                </td>
              
                <td><?php echo $s->crop_id; ?></td>
                <td><?php echo $s->screen_name; ?></td>
                
                <td class="noprint">
                <a href="<?php echo site_url('Screen/delete/'.$s->crop_id.'/'. $s->id); ?>" class="btn btn-danger btn-xs">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<script>
    var app = angular.module('myapp', []);


    app.controller('SlugController', ['$scope', '$http', function ($scope, $http) {
            $scope.flag = "";


            $scope.checkSlugAvailable = function (slug) {
                //console.log(slug.trim().length);
                if (slug == undefined) {
                    $scope.flag = "";
                } else if (slug.trim().length != 0) {
                    $http.get('<?php echo site_url('Screen/slugAvailable/'.$crop_slug); ?>/' + slug).success(function (data) {
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