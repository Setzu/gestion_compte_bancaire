<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/05/16
 * Time: 11:56
 */

if (count($this->aListeComptes) == 0) {
    ?>
    <div class="row">
        <p>Bonjour, vous pouvez ajouter un compte en cliquant sur le bouton ci-dessous :</p>
        <a href="/compte" class="btn btn-primary">Ajouter un compte</a>
    </div>
<?php } else { ?>

    <div class="row">
        <a href="/compte" class="btn btn-primary">Ajouter un compte</a>
    </div>
    <br>
    <br>
    <br>

    <div class="row">
        <h3>Liste de vos comptes :</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="max-width: 1%"></th>
                <th style="width: 32%;">Nom du compte</th>
                <th style="width: 32%;">N° de compte</th>
                <th style="width: 32%;">Solde (€)</th>
                <th style="max-width: 1%;"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $compte = $this->aListeComptes;

            /** @var \Ozyris\Service\Compte $oCompte */
            foreach($this->aListeComptes as $oCompte) { ?>
                <tr>
                    <td>
                        <a href="compte/update/<?= urlencode('$' . $oCompte->getId()); ?>">
                            <span  class="glyphicon glyphicon-pencil"></span>
                        </a>
                    </td>
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
        <hr>
        <p><span class="glyphicon glyphicon-pencil"></span> : Modifier un compte</p>
        <p><span class="glyphicon glyphicon-plus"></span> : Ajouter un mouvement</p>
    </div>
<?php } ?>