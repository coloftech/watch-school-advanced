<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$result = $this->user_model->getAllSettings();
$theme = $result->theme;
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $title; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=base_url();?>public/images/w-icon-1.png"  sizes="35x35"/>
        
        <!--CSS-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- link rel="stylesheet" href="<?php echo $theme; ?>" -->
        <link rel="stylesheet" href="<?php echo base_url().'public/css/theme/yeti.css' ?>">
        <link rel="stylesheet" href="<?php echo base_url().'public/css/main.css' ?>">
        
        
    <script type="text/javascript"  src="<?=base_url()?>public/js/jquery-3.3.1.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script type="text/javascript">base_url = '<?=base_url()?>';letter_1 = 0;letter_2 = 0;</script>
    </head>
    <body>
