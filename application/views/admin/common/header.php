<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Question App | <?php if(isset($title)){ echo $title; }else{ ''; } ?></title>

    <link href="<?php echo base_url('admin_assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('admin_assets/'); ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="<?php echo base_url('admin_assets/'); ?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo base_url('admin_assets/'); ?>js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <!-- Data Tables -->
    <link href="<?php echo base_url('admin_assets/'); ?>css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url('admin_assets/'); ?>css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo base_url('admin_assets/'); ?>css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />

    <link href="<?php echo base_url('admin_assets/'); ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url('admin_assets/'); ?>css/style.css" rel="stylesheet">

    <style type="text/css">
        
        .alert-success {
            color: #ffffff;
            background-color: #1ab394;
            border-color: #1ab394;
        }

         .alert-danger {
            color: #ffffff;
            background-color: rgb(237,85,101);
            border-color: rgb(237,85,101);
        }

    </style>

    <script src="<?php echo base_url('admin_assets/'); ?>js/jquery-2.1.1.js"></script>
</head>

<body>
    <div id="wrapper">