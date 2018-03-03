<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 26/05/16
 * Time: 14:36
 */
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <a class="navbar-brand" href="/index"><span class="glyphicon glyphicon-home">&nbsp;</span></a>
        <!-- @TODO : à determiner-->
        <?php if (isset($_SESSION['oUser'])) { ?>
            <p class="navbar-text navbar-right" style="margin-right: 0;">
                <?=$_SESSION['oUser']->getUsername(); ?>
                &nbsp;
                <a href="/authentication/signout" class="navbar-link">
                    <span class="glyphicon glyphicon-off"></span>
                </a>
            </p>
        <?php } else { ?>
            <div class="navbar-right" style="margin-right: 0;">
                <a href="/authentication" class="btn btn-success navbar-btn">Se connecter</a>
                <a href="/authentication/signup" class="btn btn-primary navbar-btn">S'enregistrer</a>
            </div>
        <?php } ?>
    </div>
</nav>