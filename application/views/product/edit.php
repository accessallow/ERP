<form class="form-horizontal" role="form"  data-parsley-validate action="<?php echo $form_submit_url; ?>" method="POST">
    <?php
    if (!isset($product)) {

        $product->id = "";
        $product->product_name = "";
        $product->product_brand = "";
        $product->product_category = "";
        $product->product_description = "";
        $product->product_price = "";
        
    } else {
        $product = $product[0];
    }
    ?>
    <input type="hidden" name="id" value="<?php echo $product->id; ?>" placeholder="" required /> 
    <div class="form-group">
        <label for="product_name" class="col-sm-2 control-label">Product Name</label>
        <div class="col-sm-4">
            <input type="text" 
                   accesskey="v"
                   class="form-control" 
                   name="product_name" required value="<?php echo $product->product_name; ?>" placeholder=""/> 
        </div>
    </div>

   <div class="form-group">
        <label for="product_category" class="col-sm-2 control-label">Domain</label>
        <div class="col-sm-4">

            <select name="product_domain"
                    accesskey="n"
                    class="form-control" required>
                <option value="">Choose a domain</option>
                <?php foreach ($domains as $d) { ?>
                    <option value="<?php echo $d->id ?>"
                    <?php if ($d->id == $product->product_domain) echo "selected"; ?>    
                            >
                        <?php echo $d->product_category_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label for="product_category" class="col-sm-2 control-label">Type</label>
        <div class="col-sm-4">

            <select name="product_category"
                    accesskey="n"
                    class="form-control" required>
                <option value="">Choose a category</option>
                <?php foreach ($categories as $c) { ?>
                    <option value="<?php echo $c->id ?>"
                    <?php if ($c->id == $product->product_category) echo "selected"; ?>    
                            >
                        <?php echo $c->product_category_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="product_brand" class="col-sm-2 control-label">Company/Brand</label>
        <div class="col-sm-4">
            <input type="text" 
                   accesskey="b"
                   class="form-control" required name="product_brand" value="<?php echo $product->product_brand; ?>" placeholder=""/> 
        </div>
    </div>
    
<!--     <div class="form-group">
        <label for="product_brand" class="col-sm-2 control-label">Price</label>
        <div class="col-sm-4">
            <input type="text" 
                   accesskey="b"
                   class="form-control" required name="product_price" value="<?php echo $product->product_price; ?>" placeholder=""/> 
        </div>
    </div>-->
    

<!--    <div class="form-group">
        <label for="product_brand" class="col-sm-2 control-label">Unique Slug</label>
        <div class="col-sm-4">
            <input type="text" 
                   accesskey="b"
                   class="form-control" required name="slug" value="<?php echo $product->slug; ?>" placeholder=""/> 
        </div>
    </div>-->

    <div class="form-group" ng-controller="SlugController">
        <label for="product_brand" class="col-sm-2 control-label">Unique Slug</label>
        <div class="col-sm-3">
            <input type="text" 
                   class="form-control"
                   accesskey="n"
                   required 
                   value="<?php echo $product->slug; ?>"
                   name="slug" 
                   ng-model="slug"
                   placeholder=""/> 
        </div>
        <a href="#" class="btn btn-primary btn-sm" ng-click="checkSlugAvailable(slug);">Check</a>
        <span>{{flag}}</span>
    </div>

    <div class="form-group">
        <label for="product_category" class="col-sm-2 control-label">Seller</label>
        <div class="col-sm-4">

            <select name="product_seller"
                    accesskey="n"
                    class="form-control" required>
                <option value="">Choose a category</option>
                <?php foreach ($sellers as $s) { ?>
                    <option value="<?php echo $s->id ?>"
                    <?php if ($s->id == $product->seller_id) echo "selected"; ?>    
                            >
                        <?php echo $s->seller_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>


    <div class="form-group">
        <label for="product_description" class="col-sm-2 control-label"> Description </label>
        <div class="col-sm-4">
            <textarea class="form-control"
                      accesskey="m"
                      rows="8"
                      name="product_description" placeholder=""><?php echo $product->product_description; ?></textarea>
        </div>
    </div>


    <!--    <div class="form-group">
            <label for="stock" class="col-sm-2 control-label">Stock</label>
            <div class="col-sm-4">
                <input type="text" 
                       accesskey=","
                       class="form-control" required name="stock" placeholder="stock"
                       value="<?php echo $product->stock; ?>"/> 
            </div>
        </div>-->

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


</form>

<script>
    var app = angular.module('myapp', []);


    app.controller('SlugController', ['$scope', '$http', function ($scope, $http) {
            $scope.flag = "";
            $scope.slug = '<?php echo $product->slug; ?>';

            $scope.checkSlugAvailable = function (slug) {
                //console.log(slug.trim().length);
                if (slug == undefined) {
                    $scope.flag = "";
                } else if (slug.trim().length != 0) {
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