<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 01/08/17
 * Time: 16:42
 */
?>

<div class="row">
    <form action="/compte/update">
        <div class="form-group">
            <label for="type">Nom du compte :
                <input type="text" name="name" placeholder="Nom du compte" value="<?= $this->compte->getNom(); ?>" class="form-control">
            </label>
            <label for="number">Numéro de compte :
                <input type="number" name="number" placeholder="0" value="<?= $this->compte->getNumero();?>" class="form-control">
            </label>
            <label for="solde">Solde (€) :
                <input type="number" name="solde" required="required" placeholder="0" value="<?= $this->compte->getSolde();?>" class="form-control">
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
    <a href="/compte/delete/<?= urlencode('$' . $this->compte->getId()); ?>" class="btn btn-danger" onClick="ConfirmMessage()">
        Supprmier le compte
    </a>
</div>

<script type="text/javascript">
    function ConfirmMessage() {
        confirm("Etes-vous sur de vouloir supprimer ce compte ? Toutes les informations liés au compte seront perdus.");
    }
</script>
