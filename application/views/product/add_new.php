<!--DONE-->
<h3>Add new advertisement</h3>
<hr/>
<?php
//var_dump($categories);
?>

<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-ok"></span>
        <strong><?php echo $this->session->flashdata('message'); ?></strong>
    </div>
<?php } ?>


<form class="form-horizontal" data-parsley-validate role="form" action="<?php echo URL_X . 'Product/add_new'; ?>" method="POST">
    <div class="form-group">
        <label for="product_name" class="col-sm-2 control-label">Product Name</label>
        <div class="col-sm-4">
            <input type="text" 
                   autofocus="autofocus"
                   accesskey="v"
                   class="form-control" 
                   required name="product_name"
                   placeholder=""/> 
        </div>
    </div>

     <div class="form-group" >
        <label for="product_category" class="col-sm-2 control-label">Domain</label>
        <div class="col-sm-4">

            <select name="product_domain" 
                    class="form-control"
                    accesskey="b"
                    required>
                <option value="" selected></option>
                <?php foreach ($domains as $d) { ?>
                    <option value="<?php echo $d->id ?>"><?php echo $d->product_category_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    
    <div class="form-group" ng-controller="ProductController">
        <label for="product_category" class="col-sm-2 control-label">Type</label>
        <div class="col-sm-4">

            <select name="product_category" 
                    class="form-control"
                    accesskey="b"
                    required>
                <option value="" selected></option>
                <?php foreach ($categories as $c) { ?>
                    <option value="<?php echo $c->id ?>"><?php echo $c->product_category_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="product_brand" class="col-sm-2 control-label">Company/Brand</label>
        <div class="col-sm-4">
            <input type="text" 
                   class="form-control"
                   accesskey="n"
                   required 
                   name="product_brand" 
                   placeholder=""/> 
        </div>
    </div>
    
<!--    <div class="form-group">
        <label for="product_brand" class="col-sm-2 control-label">Price</label>
        <div class="col-sm-4">
            <input type="text" 
                   class="form-control"
                   accesskey="n"
                   required 
                   name="product_price" 
                   placeholder=""/> 
        </div>
    </div>-->

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

    <div class="form-group" ng-controller="ProductController">
        <label for="product_category" class="col-sm-2 control-label">Seller</label>
        <div class="col-sm-4">

            <select name="product_seller" 
                    class="form-control"
                    accesskey="b"
                    required>
                <option value="" selected></option>
                <?php foreach ($sellers as $s) { ?>
                    <option value="<?php echo $s->id ?>"><?php echo $s->seller_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="product_description" class="col-sm-2 control-label"> Description </label>
        <div class="col-sm-4">
            <textarea 
                class="form-control" 
                rows="6"
                accesskey="m"
                name="product_description" 
                placeholder=""></textarea>
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">

            <input type="submit" 
                   accesskey="s"
                   class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a 
                accesskey="c"
                href="<?php echo URL_X . 'Product/'; ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</form>

<script>
    var app = angular.module('myapp', []);
    app.controller('ProductController', ['$scope', '$http', function ($scope, $http) {

            $scope.category = <?php echo $category_id; ?>;

        }]);

    app.controller('SlugController', ['$scope', '$http', function ($scope, $http) {
            $scope.flag = "";
            

            $scope.checkSlugAvailable = function (slug) {
                //console.log(slug.trim().length);
                if(slug==undefined){
                    $scope.flag = "";
                }
                else if (slug.trim().length != 0) {
                    $http.get('<?php echo site_url('Product/slugAvailable'); ?>/' + slug).success(function (data) {
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