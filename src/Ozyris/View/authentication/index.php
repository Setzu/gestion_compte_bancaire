<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 29/05/16
 * Time: 03:18
 */
?>

<div class="col-md-1">
    <a href="/index" class="btn btn-default"><span class="glyphicon glyphicon-home">&nbsp;</span>Retour à l'accueil</a>
</div>
<div class="col-md-6 col-md-offset-2 cadre-form">
    <h3 class="title-form">Connexion :</h3>
    <form action="/authentication" method="post" role="form" id="register-form" class="form-horizontal">
        <div class="form-group">
            <label for="username" class="col-sm-4 control-label">Nom d'utilisateur :</label>
            <div class="col-sm-4">
                <input type="text" name="username" required="required" placeholder="John Doe" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-4 control-label">Mot de passe :</label>
            <div class="col-sm-4">
                <input type="password" name="password" required="required" placeholder="********" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </div>
        <div style="margin: 10px 0 0 0;">
            <a href="/password">Mot de passe perdu ?</a>
        </div>
    </form>
</div>
