<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 01/08/17
 * Time: 10:40
 */
?>

<h2>Ajouter un compte : </h2>
<div class="col-md-4">
    <form action="/compte" method="post" role="form" class="form-horizontal">
        <div class="form-group">
            <label for="nom">Nom du compte :</label>
            <input type="text" name="nom" required="required" placeholder="Nom du compte" class="form-control">
            <label for="solde">Solde (€) :</label>
            <input type="number" name="solde" required="required" placeholder="0" value="0" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
