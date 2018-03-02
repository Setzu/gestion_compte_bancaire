<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 01/08/17
 * Time: 16:42
 */
?>

<div class="col-md-1">
    <a href="/index" class="btn btn-default"><span class="glyphicon glyphicon-home">&nbsp;</span>Retour à l'accueil</a>
</div>
<div class="col-md-6 col-md-offset-2 cadre-form">
    <h3 class="title-form">Modifier un compte</h3>
    <form action="/compte/updateCompte/<?= urlencode($this->oCompte->getId()); ?>" method="post" role="form" class="form-horizontal">
        <div class="form-group">
            <label for="nom" class="col-sm-4 control-label">Nom du compte :</label>
            <div class="col-sm-4">
                <input type="text" name="nom" placeholder="Nom du compte" value="<?= $this->oCompte->getNom(); ?>" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="solde" class="col-sm-4 control-label">Solde (€) :</label>
            <div class="col-sm-4">
                <input type="number" name="solde" required="required" placeholder="0" value="<?= $this->oCompte->getSolde();?>" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-primary">Valider</button>
                <a href="/compte/delete/<?= urlencode($this->oCompte->getId()); ?>" class="btn btn-danger glyphicon glyphicon-remove"
                   onClick="return ConfirmDeleteCompte();" style="float: right;" data-toggle="tooltip" title="Supprimer le compte ?">
                </a>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    /**
     * @return {boolean}
     */
    function ConfirmDeleteCompte() {
        return confirm("Etes-vous sur de vouloir supprimer ce compte ? Toutes les informations liés au compte seront perdus.");
    }
</script>
