<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 01/08/17
 * Time: 16:42
 */
?>

<div class="row">
    <form action="/compte/updateCompte/<?= urlencode('$' . $this->compte->getId()); ?>" method="post" role="form">
        <div class="form-group">
            <label for="nom">Nom du compte :
                <input type="text" name="nom" placeholder="Nom du compte" value="<?= $this->compte->getNom(); ?>" class="form-control">
            </label>
            <label for="numero">Numéro de compte :
                <input type="number" name="numero" placeholder="0" value="<?= $this->compte->getNumero();?>" class="form-control">
            </label>
            <label for="solde">Solde (€) :
                <input type="number" name="solde" required="required" placeholder="0" value="<?= $this->compte->getSolde();?>" class="form-control">
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
    <a href="/compte/delete/<?= urlencode('$' . $this->compte->getId()); ?>" class="btn btn-danger" onClick="return ConfirmMessage();">
        Supprmier le compte
    </a>
</div>

<script type="text/javascript">
    /**
     * @return {boolean}
     */
    function ConfirmMessage() {
        return !!confirm("Etes-vous sur de vouloir supprimer ce compte ? Toutes les informations liés au compte seront perdus.");
    }
</script>
