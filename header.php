<?php
session_start();
require_once 'config/conf.php';

if (isset($_GET['lang']) && $_GET['lang'] == 1) {
    include_once 'language/mk.php';
} 
else {
    include_once 'language/en.php';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php
        echo constant("TITLE"); ?></title>
        <link rel="shortcut icon" href="images/icons/settings_small.png" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Rajdhani:600' rel='stylesheet' type='text/css'>
        <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/css/style.css" rel="stylesheet" media="screen">
        <link href="/css/bootstrap-tagsinput.css" rel="stylesheet" media="screen">
        <script src="js/jquery-1.11.3.min.js"></script> 
        <script src="js/bootstrap.min.js"></script>
        <script src="/ckeditor/ckeditor.js"></script>
    </head>
    <body>


        <div class="container-fluid">
            <header class="navbar navbar-default navbar-fixed-top navbar-default-color">
                <a class="navbar-brand" href="/">

                    <img src="/images/icons/settings_small.png" alt="CMS" /> <?php
                    echo constant("ADMIN_PANEL"); ?></a>

                </header>


                <div class="row">
                    <div class="col-md-12">
                        <div class="push"></div>
                        <?php
                        $scriptname = $_SERVER['SCRIPT_NAME'];

                        $pagetitle = str_replace(".php", "", $scriptname);
                        $pagetitlefinal = strtoupper(str_replace("/", "", $pagetitle));

                        if (isset($_SESSION['user_email']) && $_SESSION['user_email'] != NULL) {
                            echo '
                            <ol class="breadcrumb">
                                <li><a href="/">  <button class="btn btn-info btn-xs" type="button">' . ADMIN_PANEL . '</button></a></li>
                                <li><a href="' . $pagetitle . '">  <button class="btn btn-warning btn-xs" type="button">' . $pagetitlefinal . '</button></a></li>
                                <li class="active pull-right">' . LOGGED_IN_AS . ' : ' . $_SESSION['name'] . '<a href="logout"> [ Logout ]</a></li>
                            </ol>

                            ';
                            ?>
                            <div class="col-md-2">
                                <ul class="nav nav-pills nav-stacked">

                                    <li><a href="/users"><span class="glyphicon glyphicon-user"> </span> Администратори</a></li>
                                    <li><a href="/settings"><span class="glyphicon glyphicon-cog"> </span> Подесувања</a></li>

                                    <li><a href="/sliders"><span class="glyphicon glyphicon-picture"> </span> Слајдери</a></li>
                                    <li><a href="/banners"><span class="glyphicon glyphicon-paperclip"> </span> Банери</a></li>
                                    <!--
                                    <li><a href="/addpage"><span class="glyphicon glyphicon-unchecked"> </span> Add Page</a></li>
                                    <li><a href="/listpages"><span class="glyphicon glyphicon-list-alt"> </span> List Pages</a></li>
                                -->
                                <li><a href="/addartists"><span class="glyphicon glyphicon-edit"> </span> Додади артист</a></li>
                                <li><a href="/listartists"><span class="glyphicon glyphicon-th-list"> </span> Артисти/Групи</a></li>
                                <li><a href="/categories"><span class="glyphicon glyphicon-object-align-bottom"> </span> Категории</a></li>
                                <li><a href="/addproduct"><span class="glyphicon glyphicon-modal-window"> </span> Додади пост </a></li>
                                <li><a href="/listproducts"><span class="glyphicon glyphicon-th"> </span> Постови</a></li>
                                <li><a href="/adddownload"><span class="glyphicon glyphicon-download"> </span> Додади Превземања</a></li>
                                <li><a href="/listdownloads"><span class="glyphicon glyphicon-cloud-download"> </span> Превземања</a></li>
                            </ul>
                            
                        </div>
                        <div class="col-md-10">
                            <?php 
                        }
                        else {}
                            ?>