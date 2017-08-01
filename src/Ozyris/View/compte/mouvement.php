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
    <form action="/compte/valideMouvement/<?= urlencode(isset($this->id) ? '$' . $this->id : null); ?>" method="post" role="form">
        <div class="form-group">
            <label for="type">Type du mouvement :
                <select name="type" class="form-control">
                    <option value="retrait">Dépense / Retrait</option>
                    <option value="depot">Dépôt</option>
                </select>
            </label>
        </div>
        <div class="form-group">
            <label for="montant">Montant (€) :
                <input type="number" name="montant" required="required" placeholder="0" class="form-control">
            </label>
            <label for="ordre">Ordre (facultatif) :
                <input type="text" name="ordre" placeholder="Ordre" class="form-control">
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</div>