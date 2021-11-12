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


		<meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript">
            $(document).ready(function () {
                //$("select").searchable();
            });
        </script>
		
		</head>
    <body>
 
        <div class="container-fluid">