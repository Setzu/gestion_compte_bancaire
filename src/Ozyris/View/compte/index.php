<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 01/08/17
 * Time: 10:40
 */
?>

<h2>Ajouter un compte : </h2>
<form action="/compte" method="post" role="form">
    <div class="form-group">
        <label for="nom">Nom du compte :
            <input type="text" name="nom" required="required" placeholder="Nom du compte" class="form-control">
        </label>
        <label for="numero">Numéro de compte :
            <input type="number" name="numero" required="required" placeholder="0" class="form-control">
        </label>
        <label for="solde">Solde (€) :
            <input type="number" name="solde" required="required" placeholder="0" value="0" class="form-control">
        </label>
    </div>

    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
