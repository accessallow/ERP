<!DOCTYPE html>
<html ng-app="myapp">
    <head>
        <meta charset="UTF-8">
        <title><?php echo MegaTitle; ?></title>
        <script src="<?php echo URL; ?>assets/jquery/jquery.min18.js"></script>
        <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
        <script src="<?php echo base_url(); ?>assets/searchable/jquery.searchabledropdown-1.0.8.min.js"></script>
        <script src="<?php echo URL; ?>assets/angularjs/angular.min.js"></script>
        <link rel="stylesheet" href="<?php echo URL; ?>assets/bootstrap3/css/bootstrap.min.css" />
        
        <!--<link rel="stylesheet" href="<?php echo URL; ?>assets/bootstrap3/css/bootstrap-theme.min.css" />-->
        <link rel="stylesheet" href="<?php echo URL; ?>assets/mystyles/style.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>assets/bootstrap3/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>assets/mystyles/print.css" media="print"/>
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>assets/DataTables-1.10.5/media/css/jquery.dataTables.css">



        <script type="text/javascript">
            $(document).ready(function () {
                //$("select").searchable();
            });
        </script>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo site_url("Product"); ?>"><?php echo MegaTitle; ?></a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Ads 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a accesskey="q" href="<?php echo URL_X . 'Product/'; ?>">List all Ads - q</a></li>
                                <li><a accesskey="w" href="<?php echo URL_X . 'Product/add_new'; ?>">Add new - w</a></li>  
                                <li class="divider"></li>
                                <li><a accesskey="r" href="<?php echo URL_X . 'Product_category/'; ?>">Categories - r</a></li>
                                <li><a accesskey="t" href="<?php echo URL_X . 'Product_category/add_new'; ?>">Add new category - t</a></li>
                                <li class="divider"></li>
                                <li><a accesskey="r" href="<?php echo URL_X . 'Product_domain/'; ?>">Domain - r</a></li>
                                <li><a accesskey="t" href="<?php echo URL_X . 'Product_domain/add_new'; ?>">Add new domain - t</a></li>
                            </ul>
                        </li>
                        <!--                        <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Inventory
                                                        <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a accesskey="i" href="<?php echo URL_X . 'Inventory/'; ?>">Inventory List - i</a></li>
                                                        <li><a accesskey="o" href="<?php echo URL_X . 'Inventory/add_new'; ?>">Add new purchase - o</a></li>  
                        
                                                    </ul>
                                                </li>-->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Seller 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a accesskey="k"href="<?php echo URL_X . 'Seller/'; ?>">List all sellers - k</a></li>
                                <li><a accesskey="l" href="<?php echo URL_X . 'Seller/add_new'; ?>">Add new - l</a></li>


                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Crop 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a accesskey="c"href="<?php echo URL_X . 'Crop/'; ?>">List all crops - c</a></li>
                                <li><a accesskey="v" href="<?php echo URL_X . 'Crop/add_new'; ?>">Add new - v</a></li>
                                

                            </ul>
                        </li>
                        
<!--                         <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Diseases 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a accesskey="c"href="<?php echo URL_X . 'Disease/'; ?>">List all diseases - c</a></li>
                                <li><a accesskey="v" href="<?php echo URL_X . 'Disease/add_new'; ?>">Add new - v</a></li>


                            </ul>
                        </li>-->
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Geolocation 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a accesskey="" href="<?php echo URL_X . 'States/'; ?>">List all states</a></li>
                                <li><a accesskey="" href="<?php echo URL_X . 'States/add_new'; ?>">Add new state</a></li>
                                <li class="divider"></li>
                                 <li><a accesskey="" href="<?php echo URL_X . 'District/'; ?>">List all districts</a></li>
                                <li><a accesskey="" href="<?php echo URL_X . 'District/add_new'; ?>">Add new district</a></li>
                                <li class="divider"></li>
                                   
                                <li><a accesskey="" href="<?php echo URL_X . 'Block/'; ?>">List all blocks</a></li>
                                <li><a accesskey="" href="<?php echo URL_X . 'Block/add_new'; ?>">Add new block</a></li>
                                
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Inquiry 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a accesskey="c"href="<?php echo URL_X . 'Inquiry/dashboard'; ?>">Dashboard</a></li>


                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Reporting 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a accesskey="c"href="<?php echo URL_X . 'Reporting/showDates'; ?>">Dashboard</a></li>


                            </ul>
                        </li>
                        
                         <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Versions 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a accesskey="c"href="<?php echo URL_X . 'Versions'; ?>">Dashboard</a></li>
                                 <li><a accesskey="c"href="<?php echo URL_X . 'Versions/add_new'; ?>">Add new</a></li>


                            </ul>
                        </li>
                        
                        
                        <!--                        <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Shopping Lists 
                                                        <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a accesskey="[" href="<?php echo URL_X . 'ShoppingList/'; ?>">All shopping lists - [</a></li>
                                                        <li><a accesskey="]" href="<?php echo URL_X . 'ShoppingList/add_new_shopping_list'; ?>">Add new - ]</a></li>
                        
                        
                                                    </ul>
                                                </li>-->
                        <!--                        <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        StockZero
                                                        <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a accesskey="0" href="<?php echo URL_X . 'StockWarning/'; ?>">Dashboard - 0</a></li>
                        
                        
                        
                                                    </ul>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Form 49
                                                        <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a accesskey="g" href="<?php echo URL_X . 'Form49/'; ?>">Dashboard - g</a></li>
                        
                                                        <li><a accesskey="h" href="<?php echo URL_X . 'Form49/add_new'; ?>">Add new - h</a></li>
                        
                                                    </ul>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        Payment Bills
                                                        <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a accesskey="." href="<?php echo URL_X . 'Bill/dashboard'; ?>">Dashboard - .</a></li>
                        
                                                        <li><a accesskey="/" href="<?php echo URL_X . 'Bill/add_new'; ?>">Add new - /</a></li>
                        
                                                    </ul>
                                                </li>-->
                        
                        
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Settings
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <!--<li><a accesskey="\" href="<?php echo URL_X . 'Set/'; ?>">Presets - \</a></li>-->
                                <li><a href="<?php echo URL_X . 'Front/password'; ?>">Change password</a></li>
                                <li><a href="<?php echo URL_X . 'Front/logout'; ?>">Logout</a></li>


                            </ul>
                        </li>
                    </ul>
                    <?php if (isset($activation_status)) { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                            if ($counter < 50) {
                                $counter_class = 'btn-danger';
                            } else {
                                $counter_class = 'btn-success';
                            }

                            if ($activation_status == true) {
                                $activation_class = "btn-success";
                                $activation_label = "Activated";
                            } else {
                                $activation_class = "btn-danger";
                                $activation_label = "Not activated";
                            }

                            $counter_percentage = round((100 * $counter / 3000), 2);
                            ?>
                            <li>
                                <a href="<?php echo site_url('Activation'); ?>" >
                                    <span class="badge <?php echo $activation_class; ?>">
                                        <?php echo $activation_label; ?>
                                    </span>

                                    <span class="badge <?php echo $counter_class; ?>">
                                        Usage battery: <?php echo $counter_percentage; ?>%
                                    </span>

                                </a>
                            </li>

                        </ul>
                    <?php } ?>


                </div>
            </div><!-- End of its container-fluid-->
        </nav>

        <div class="container">