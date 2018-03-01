<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 03/08/17
 * Time: 10:28
 */
?>

<div class="row">
    <div class="col-md-2">
        <a href="/index" class="btn btn-default">Retour</a>
    </div>
    <div class="col-md-10">
        <form action="/compte/updateMouvement/<?= $this->mouvement['id']; ?>" method="post" role="form">
            <div class="form-group">
                <div class="form-group">
                    <label for="type">Type du mouvement :
                        <select name="type" class="form-control">
                            <option value="retrait">Dépense / Retrait</option>
                            <option value="depot">Dépôt</option>
                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <label for="montant">Montant :
                        <input type="number" name="montant" placeholder="0" value="<?= $this->mouvement['montant'];?>" class="form-control">
                    </label>
                    <label for="ordre">Ordre :
                        <input type="text" name="ordre" placeholder="0" value="<?= $this->mouvement['ordre'];?>" class="form-control">
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</div>