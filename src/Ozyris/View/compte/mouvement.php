<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 01/08/17
 * Time: 10:40
 */
?>

<div class="row">
    <h3>Ajouter un mouvement :</h3>
    <div class="col-md-2">
        <form action="/compte/mouvement/<?= urlencode(isset($this->id) ? '$' . $this->id : null); ?>" method="post" role="form" class="form-horizontal">
            <div class="form-group">
                <label for="type">Type du mouvement :</label>
                <select name="type" class="form-control">
                    <option value="retrait">Dépense / Retrait</option>
                    <option value="depot">Dépôt</option>
                </select>
                <label for="montant">Montant (€) :</label>
                <input type="number" name="montant" required="required" placeholder="0" class="form-control">
                <label for="ordre">Ordre (facultatif) :</label>
                <input type="text" name="ordre" placeholder="Ordre" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>
</div>