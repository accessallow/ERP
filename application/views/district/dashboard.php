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
        <a class="btn btn-success btn-xs" href="<?php echo site_url('District/add_new'); ?>">Add new district</a>
    </div>
</div>
<br/>

<div class="row well well-sm noprint">
    <h4>Districts</h4>
    <p class="badge">Total states: <?php echo $total_categories; ?></p>
</div>

<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-ok"></span>
        <strong><?php echo $this->session->flashdata('message'); ?></strong>
    </div>
<?php } ?>

<div class="row" ng-controller="CategoryController">
    <div class="col-md-12">

        <div class="panel panel-primary" ng-repeat="state in states">
            <div class="panel-heading">
                {{state.state_name}}
            </div>
            <div class="panel-body">

                <table class="table table-hover table-striped">

                    <tr ng-repeat="district in state.districts |filter:m">
                        
                        <td>
                            <a href="<?php echo URL_X; ?>Product?state_id={{district.id}}">
                                {{district.district_name}}
                            </a>
                        </td>

                        <td style="text-align: right;">
                             <!--<a href="<?php echo URL_X . 'Set?category_id='; ?>{{category.id}}" class="btn  btn-info btn-xs">Preset</a>-->
                            <a href="<?php echo URL_X . 'District/edit/'; ?>{{district.id}}" class="btn  btn-primary btn-xs">Edit</a>
                            <a href="<?php echo URL_X . 'District/delete/'; ?>{{district.id}}" class="btn  btn-danger btn-xs">Delete</a>
                        </td>
                    </tr>

                </table>

            </div>
        </div>





    </div>
</div>

<script>
    var app = angular.module('myapp', []);
    app.controller('CategoryController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $json_fetch_link; ?>').success(function (data) {
                $scope.states = data;
                console.log("States = \n" + data);
            });


        }]);
</script>