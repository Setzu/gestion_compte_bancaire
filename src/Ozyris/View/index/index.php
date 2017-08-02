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
        <table class="table table-bordered" id="liste-compte">
            <thead>
            <tr>
                <th style="max-width: 1%"></th>
                <th style="width: 32%;">Nom du compte</th>
                <th style="width: 32%;">N° de compte</th>
                <th style="width: 32%;">Solde (€)</th>
                <th style="max-width: 1%;"></th>
                <th class="display-none"></th>
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
                    <td class="detail" data-content="name"><?php echo $oCompte->getNom(); ?></td>
                    <td class="detail"><?php echo $oCompte->getNumero(); ?></td>
                    <td class="detail"><?php echo $oCompte->getSolde(); ?></td>
                    <td>
                        <a href="compte/mouvement/<?= urlencode('$' . $oCompte->getId()); ?>">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </td>
                    <td class="display-none">
                        <p>Historique des mouvements</p>
                        <table>
                            <thead>
                            <tr>
                                <th>Type du mouvement</th>
                                <th>Montant</th>
                                <th>Ordre</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($this->aListeMouvements as $compte => $aMouvements) { ?>
                                <?php foreach ($aMouvements as $mouvement) { ?>
                                    <tr>
                                        <td><?= $mouvement['type_mouvement'] ;?></td>
                                        <td><?= $mouvement['montant'] . '€' ;?></td>
                                        <td><?= $mouvement['ordre'] ;?></td>
                                        <td><?= $mouvement['date_mouvement'] ;?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <p><span class="glyphicon glyphicon-pencil"></span> : Modifier un compte</p>
        <p><span class="glyphicon glyphicon-plus"></span> : Ajouter un mouvement</p>
    </div>
<?php } ?>