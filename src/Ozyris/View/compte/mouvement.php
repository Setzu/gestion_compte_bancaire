<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 01/08/17
 * Time: 10:40
 */
?>

<div class="col-md-8 col-md-offset-2 cadre-form">
    <h3 class="title-form">Ajouter un mouvement</h3>
    <form action="/compte/mouvement/<?= urlencode(isset($this->id) ? '$' . $this->id : null); ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
            <label for="type" class="col-sm-4 control-label">Type </label>
            <div class="col-sm-4">
                <select name="type" class="form-control">
                    <option value="retrait">Dépense / Retrait</option>
                    <option value="depot">Dépôt</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="montant" class="col-sm-4 control-label">Montant (€)</label>
            <div class="col-sm-4">
                <input type="number" name="montant" required="required" placeholder="0" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="libelle" class="col-sm-4 control-label">Libellé</label>
            <div class="col-sm-4">
                <input type="text" name="libelle" placeholder="Libellé" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="mensuel"> Mouvement mensuel
                    </label>
                    <span data-toggle="tooltip" title="Ce mouvement sera répété le premier jour de chaque mois">
                        <span class="glyphicon glyphicon-question-sign"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </div>
    </form>
</div>