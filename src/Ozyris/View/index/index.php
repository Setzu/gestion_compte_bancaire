<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/05/16
 * Time: 11:56
 */

if ($this->isAuth) {
    ?>
    <p>Bonjour <?php echo ucfirst($this->user->getUsername()); ?>,</p>

<?php } else { ?>

    <div class="row">
        <a href="compte" class="btn btn-primary">Ajouter un compte</a>
    </div>
    <br>
    <br>
    <br>

    <div class="row">
        <h3>Liste de vos comptes :</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 33%;">Nom du compte</th>
                <th style="width: 33%;">N° de compte</th>
                <th style="width: 33%;">Solde (€)</th>
                <th style="max-width: 1%;"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $compte = $this->aListeComptes;

            /** @var \Ozyris\Service\Compte $oCompte */
            foreach($this->aListeComptes as $oCompte) { ?>
                <tr>
                    <td><?php echo $oCompte->getNom(); ?></td>
                    <td><?php echo $oCompte->getNumero(); ?></td>
                    <td><?php echo $oCompte->getSolde(); ?></td>
                    <td>
                        <a href="compte/mouvement/<?= urlencode('$' . $oCompte->getId()); ?>">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>