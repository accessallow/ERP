<h3>Version-mapping of <strong><?php echo $product->product_name ?></strong></h3>

<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>" role="alert">
        <span class="glyphicon <?php echo $this->session->flashdata('glyphicon_class'); ?>"></span>
        <strong><?php echo $this->session->flashdata('message'); ?></strong>
    </div>
<?php } ?>

<hr/>
<div ng-controller="BlockController" class="row">
    <div class="col-md-4">
        <h3>Unmapped Versions</h3>
        <hr/>
        <table class="table table-hover table-bordered">
            <thead>
                <tr><td>Version</td></tr>
            </thead>
            <tbody>
                <?php foreach ($unmapped_versions as $um) { ?>
                <tr>
                    <td><?php echo $um->version_name; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <form class="form-horizontal" data-parsley-validate role="form" action="<?php echo site_url('Mapping/addVersionMapping/' . $product->id); ?>" method="POST">

            <input type="hidden" name="product_id" value="<?php echo $product->id; ?>"/>

            <div class="form-group" >
                <label for="" class="col-sm-4 control-label">State</label>
                <div class="col-sm-8">

                    <select name="version_name" 
                            class="form-control"
                            accesskey="b"
                            required
                            

                            >
                        <option value="" selected>Choose version</option>
                        <?php foreach ($unmapped_versions as $um) { ?>
                        <option value="<?php echo $um->version_name;?>"

                                ><?php echo $um->version_name;?></option>
                        <?php } ?>
                        

                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                    <input accesskey="s" type="submit" class="btn btn-success" value="Save"/>
                    <input type="reset" class="btn" value="Clear"/>
                    <a  accesskey="c" href="<?php echo site_url('Mapping/product_mapping/' . $product->id); ?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </form>


    </div>
    <div class="col-md-4">
        <h3>Mapped Versions</h3>
        <hr/>
       <table class="table table-hover table-bordered">
            <thead>
                <tr><td>Version</td> <td>Action</td></tr>
                
            </thead>
            <tbody>
                <?php foreach ($mapped_versions as $m) { ?>
                <tr>
                    <td><?php echo $m->version_name; ?></td>
                    <td>
                        <a href="<?php echo site_url('Mapping/detachVersionMapping/'.$m->id); ?>" class="btn btn-danger btn-xs">Detach</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>



</div>

<script>
    var app = angular.module('myapp', []);
    app.controller('BlockController', ['$scope', '$http', function ($scope, $http) {


        }]);
</script>