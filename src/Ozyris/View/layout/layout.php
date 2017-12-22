<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/16
 * Time: 13:54
 */

use Ozyris\Controller\IndexController;

$oIndexController = new IndexController();
?>
<!DOCTYPE html>
<title>Gestion de compte bancaire</title>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
</head>

<body>

<header>
    <div class="container">
        <?php include_once(__DIR__ . '/header.php'); ?>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php $oIndexController->flashMessages(); ?>
        </div>
    </div>
    <div class="row">
        <?php \Ozyris\Service\Dispatch::dispatch(); ?>
    </div>
</div>

<footer>
    <div class="container">
        <?php include_once (__DIR__ . '/footer.php'); ?>
    </div>
</footer>

</body>

</html>
