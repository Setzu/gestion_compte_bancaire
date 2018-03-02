<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 29/05/16
 * Time: 03:19
 */
?>

<div class="col-md-1">
    <a href="/index" class="btn btn-default"><span class="glyphicon glyphicon-home">&nbsp;</span>Retour à l'accueil</a>
</div>
<div class="col-md-6 col-md-offset-2 cadre-form">
    <h3 class="title-form">Inscription :</h3>
    <form action="/authentication/signup" method="post" role="form" id="register-form" class="form-horizontal">
        <div class="form-group">
            <label for="email" class="col-sm-4 control-label">Adresse email :</label>
            <div class="col-sm-4">
                <input type="text" name="email" required="required" placeholder="Adresse email" class="form-control"
                       value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : null; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="username" class="col-sm-4 control-label">Nom d'utilisateur :</label>
            <div class="col-sm-4">
                <input type="text" name="username" required="required" placeholder="Nom d'utilisateur"
                       class="form-control" value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : null; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-4 control-label">Mot de passe :</label>
            <div class="col-sm-4">
                <input type="password" required="required" name="password" placeholder="********" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="confirm-password" class="col-sm-4 control-label">Confirmation :</label>
            <div class="col-sm-4">
                <input type="password" required="required" name="confirm-password" placeholder="********" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="g-recaptcha" data-sitekey="6LfoIEIUAAAAALVla5mj332H3JjaPQSn-kfAqA5P"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                <button type="submit" class="btn btn-primary">S'enregistrer</button>
            </div>
        </div>
    </form>
</div>

<script src='https://www.google.com/recaptcha/api.js'></script>