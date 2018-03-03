<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 31/05/16
 * Time: 11:56
 */
?>

<?php if (!isset($this->oUser)) { ?>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 cadre-form">
            <p>Bienvenue sur la plateforme de simulation de gestion de compte bancaire en ligne. Pour pouvoir en
                profiter, commencez par créer un compte. Si vous êtes déjà inscit, connectez-vous en utilisant le
                formulaire ci-dessous :
            </p>
            <br>
            <h3 class="title-form">Connexion</h3>
            <form action="/authentication" method="post" role="form" id="register-form" class="form-horizontal">
                <div class="form-group">
                    <label for="username" class="col-sm-5 control-label">Nom d'utilisateur :</label>
                    <div class="col-sm-4">
                        <input type="text" name="username" required="required" placeholder="John Doe" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-5 control-label">Mot de passe :</label>
                    <div class="col-sm-4">
                        <input type="password" name="password" required="required" placeholder="********" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-4">
                        <button type="submit" class="btn btn-success">Se connecter</button>
                    </div>
                </div>
                <div style="margin: 10px 0 0 0;">
                    <a href="/authentication/signup">Pas encore inscrit ?</a>
                </div>
            </form>
        </div>
    </div>
<?php } elseif (count($this->aComptes) == 0) { ?>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 cadre-form">
            <p>Bonjour <?= $this->oUser->getUsername(); ?></p>
            <p>Vous n'avez pas encore ajouté de compte, vous pouvez en ajouter en cliquant sur le bouton ci-dessous :</p>
            <a href="/compte" class="btn btn-info">Ajouter un compte</a>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="col-md-4">
            <h3>Liste de vos comptes</h3>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-2">
            <p><a href="/compte" class="btn btn-default">Ajouter un compte</a></p>
            <!--            <br>-->
            <!--            <p><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;&nbsp;Ajouter un mouvement</p>-->
            <!--            <p><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;&nbsp;Modifier un compte / mouvement</p>-->
            <!--            <p><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;&nbsp;Supprimer un compte / mouvement</p>-->
        </div>
        <div class="col-md-10">
            <!-- ATTENTION : modifier également le fichier compte-datatables.js en cas d'ajout ou suppression de <th> dans le tableau-->
            <table class="table datatable" id="liste-compte">
                <thead>
                <tr>
                    <th style="max-width: 1%;"></th>
                    <th style="width: 32%;">Nom du compte</th>
                    <th style="width: 32%;">Solde</th>
                    <th style="width: 32%;">Dernières modifications</th>
                    <th style="max-width: 1%"></th>
                    <th style="max-width: 1%;"></th>
                    <th style="max-width: 1%;"></th>
                    <th class="display-none"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                /** @var \Ozyris\Service\Compte $oCompte */
                $i = 0; foreach($this->aComptes as $oCompte) { $i++; ?>
                    <tr class="pointer <?= ($i % 2 == 1) ? 'tr-impair' : ''; ?>">
                        <td class="detail" id="pencil-<?= $oCompte->getId();?>">
                            <span class='glyphicon glyphicon-eye-open'></span>
                        </td>
                        <td class="detail" data-content="name"><?= $oCompte->getNom(); ?></td>
                        <td class="detail" style="color :<?= ($oCompte->getSolde()) < 0 ? '#c9302c' : '' ;?>"><?= $oCompte->getSolde(); ?> &euro;</td>
                        <td class="detail"><?= \Ozyris\Service\Utils::convertFormatDateToEu($oCompte->getLastUpdate()); ?></td>
                        <td>
                            <!-- @TODO : ajouter un encodage supplémentaire lors de l'ajout de l'authentification -->
                            <a href="compte/updateCompte/<?= urlencode($oCompte->getId()); ?>">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        </td>
                        <td>
                            <!-- @TODO : ajouter un encodage supplémentaire lors de l'ajout de l'authentification -->
                            <a href="compte/delete/<?= urlencode($oCompte->getId()); ?>" onClick="return ConfirmDeleteCompte();">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                        <td>
                            <!-- @TODO : ajouter un encodage supplémentaire lors de l'ajout de l'authentification -->
                            <a href="compte/mouvement/<?= urlencode($oCompte->getId()); ?>">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </td>
                        <!-- @TODO : Les id sont doublés ce qui empêche le fonctionnement du jQuery tabs -->
                            <td class="display-none">
                                <div class="tabs">
                                    <ul>
                                        <li><a class="link-tabs" href="#tabs-<?= $oCompte->getId(); ?>1">Liste des mouvements</a></li>
                                        <li><a class="link-tabs" href="#tabs-<?= $oCompte->getId(); ?>2">Historique des mouvements</a></li>
                                    </ul>
                                        <div class="div-tabs" id="tabs-<?= $oCompte->getId(); ?>1">
                                        <?php if (count($this->aListeMouvements[$oCompte->getId()]) == 0) { ?>
                                            <p>Vous n'avez pas de mouvements associés à ce compte.</p>
                                            <p>Pour en ajouter, cliquer sur
                                                <a href="compte/mouvement/<?= urlencode($oCompte->getId()); ?>">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </a>
                                            </p>
                                        <?php } else { ?>
                                            <table class="table mouvement" id="mouvement">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Type</th>
                                                    <th>Montant</th>
                                                    <th>Libellé</th>
                                                    <th>Date</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($this->aListeMouvements[$oCompte->getId()] as $aMouvement) { ?>
                                                    <tr class="<?= $aMouvement['type_mouvement']; ?>">
                                                        <td>
                                                            <a href="compte/updateMouvement/<?= urlencode($aMouvement['id']); ?>">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                            </a>
                                                        </td>
                                                        <td><?= ucfirst(strtolower($aMouvement['type_mouvement'])); ?></td>
                                                        <td><?= $aMouvement['montant']; ?> &euro;</td>
                                                        <td><?= $aMouvement['libelle']; ?></td>
                                                        <td><?= \Ozyris\Service\Utils::convertFormatDateToEu($aMouvement['date_mouvement']); ?></td>
                                                        <td>
                                                            <a href="/compte/deleteMouvement/<?= urlencode($aMouvement['id']); ?>"
                                                               onClick="return ConfirmDeleteMouvement();">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        <?php } ?>
                                    </div>
                                        <div class="div-tabs" id="tabs-<?= $oCompte->getId(); ?>2">
                                        <p>test 2</p>
                                    </div>
                                </div>
                            </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>

<script type="text/javascript">
    /**
     * @return {boolean}
     */
    function ConfirmDeleteMouvement() {
        return confirm('Voulez-vous supprimer le mouvement associer au compte ? Le solde de votre compte sera mis à jour en conséquence.');
    }

    /**
     * @return {boolean}
     */
    function ConfirmDeleteCompte() {
        return confirm("Etes-vous sur de vouloir supprimer ce compte ? Toutes les informations liés au compte seront perdus.");
    }
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>