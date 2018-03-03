<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 26/05/16
 * Time: 13:54
 */
?>

<!DOCTYPE html>
<title>Gestion de compte bancaire</title>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/form.css">
    <link rel="stylesheet" type="text/css" href="/css/global.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>

<header>
    <div class="container">
        <?php include_once(__DIR__ . '/header.php'); ?>
    </div>
</header>

<div class="container">
    <?php if (isset($this->flashMessages) && !empty($this->flashMessages)) { ?>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php echo $this->flashMessages; ?>
            </div>
        </div>
    <?php } ?>
    <?php include_once ($this->content); ?>
</div>

<footer>
    <div class="container">
        <?php include_once (__DIR__ . '/footer.php'); ?>
    </div>
</footer>

</body>

</html>