<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 03/08/17
 * Time: 10:28
 */
?>

<div class="col-md-1">
    <a href="/index" class="btn btn-default"><span class="glyphicon glyphicon-home">&nbsp;</span>Retour à l'accueil</a>
</div>
<div class="col-md-6 col-md-offset-2 cadre-form">
    <h3 class="title-form">Modifier un mouvement</h3>
    <form action="/compte/updateMouvement/<?= urlencode($this->mouvement['id']); ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
            <label for="type" class="col-sm-4 control-label">Type</label>
            <div class="col-sm-4">
                <select name="type" class="form-control">
                    <?php if ($this->mouvement['type_mouvement'] == 'depot') { ?>
                        <option value="retrait">Dépense / Retrait</option>
                        <option value="depot" selected="selected">Dépôt</option>
                    <?php } else { ?>
                        <option value="retrait" selected="selected">Dépense / Retrait</option>
                        <option value="depot">Dépôt</option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="montant" class="col-sm-4 control-label">Montant</label>
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="number" min="0" name="montant" value="<?= $this->mouvement['montant'];?>" required="required" placeholder="0" class="form-control">
                    <div class="input-group-addon">&euro;</div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="libelle" class="col-sm-4 control-label">Libellé</label>
            <div class="col-sm-4">
                <input type="text" name="libelle" value="<?= $this->mouvement['libelle'];?>" placeholder="Libellé" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-primary">Valider</button>
                <a href="/compte/deleteMouvement/<?= urlencode($this->mouvement['id']); ?>" class="btn btn-danger glyphicon glyphicon-remove"
                   onClick="return ConfirmMessage();" style="float: right;" data-toggle="tooltip" title="Supprimer le mouvement ?">
                </a>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    /**
     * @return {boolean}
     */
    function ConfirmMessage() {
        return confirm("Etes-vous sur de vouloir supprimer ce mouvement ? Le solde de votre compte sera mis à jour en conséquence.");
    }
</script>