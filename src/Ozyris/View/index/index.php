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
                <th style="width: 32%;">Solde (€)</th>
                <th style="width: 32%;">Dernières modifications</th>
                <th style="max-width: 1%;"></th>
                <th class="display-none"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $compte = $this->aListeComptes;
            /** @var \Ozyris\Service\Compte $oCompte */
            foreach($this->aListeComptes as $oCompte) { ?>
                <tr class="pointer">
                    <td>
                        <a href="compte/updateCompte/<?php echo urlencode('$' . $oCompte->getId()); ?>">
                            <span  class="glyphicon glyphicon-pencil"></span>
                        </a>
                    </td>
                    <td class="detail" data-content="name"><?php echo $oCompte->getNom(); ?></td>
                    <td class="detail"><?php echo $oCompte->getSolde(); ?></td>
                    <td class="detail"><?php echo $oCompte->getLastUpdate(); ?></td>
                    <td>
                        <a href="compte/mouvement/<?= urlencode('$' . $oCompte->getId()); ?>">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </td>
                    <td class="display-none">
                        <h4>Historique des mouvements</h4>
                        <?php if (count($this->aListeMouvements[$oCompte->getId()]) == 0) { ?>
                            <p>Vous n'avez pas de mouvement associé à ce compte.</p>
                            <p>Pour en ajouter, cliquer sur
                                <a href="compte/mouvement/<?= urlencode('$' . $oCompte->getId()); ?>">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </a>
                            </p>
                        <?php } else { ?>
                            <table class="table" id="mouvement">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Type du mouvement</th>
                                    <th>Montant</th>
                                    <th>Libellé</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($this->aListeMouvements[$oCompte->getId()] as $mouvement) { ?>
                                    <tr class="<?= $mouvement['type_mouvement'];?>">
                                        <td>
                                            <a href="compte/updateMouvement/<?= urlencode('$' . $mouvement['id']); ?>">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                        </td>
                                        <td><?= ucfirst(strtolower($mouvement['type_mouvement'])) ;?></td>
                                        <td><?= $mouvement['montant'] . '€' ;?></td>
                                        <td><?= $mouvement['libelle'] ;?></td>
                                        <td><?= $mouvement['date_mouvement'] ;?></td>
                                        <td>
                                            <a href="/compte/deleteMouvement/<?= urlencode('$' . $mouvement['id']); ?>"
                                               onClick="return ConfirmMessage();">
                                                <span class="glyphicon glyphicon-remove" style="color:#ff0000"></span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <p><span class="glyphicon glyphicon-pencil"></span> : Modifier un compte</p>
        <p><span class="glyphicon glyphicon-plus"></span> : Ajouter un mouvement</p>
    </div>
<?php } ?>

<script type="text/javascript">
    /**
     * @return {boolean}
     */
    function ConfirmMessage() {
        return !!confirm('Voulez-vous supprimer le mouvement associer au compte ?');
    }
</script>
