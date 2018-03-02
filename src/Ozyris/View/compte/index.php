<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 01/08/17
 * Time: 10:40
 */
?>

<div class="col-md-1">
    <a href="/index" class="btn btn-default"><span class="glyphicon glyphicon-home">&nbsp;</span>Retour à l'accueil</a>
</div>
<div class="col-md-6 col-md-offset-2 cadre-form">
    <h3 class="title-form">Ajouter un compte : </h3>
    <form action="/compte" method="post" role="form" class="form-horizontal">
        <div class="form-group">
            <label for="nom" class="col-sm-4 control-label">Nom du compte :</label>
            <div class="col-sm-4">
                <input type="text" name="nom" required="required" placeholder="Nom du compte" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="solde" class="col-sm-4 control-label">Solde (€) :</label>
            <div class="col-sm-4">
                <input type="number" name="solde" required="required" placeholder="0" value="0" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </div>
    </form>
</div>
