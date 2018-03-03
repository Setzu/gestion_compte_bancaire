<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 31/07/17
 * Time: 17:26
 */

namespace Ozyris\Controller;


use Ozyris\core\Router;
use Ozyris\Model\CompteModel;
use Ozyris\Model\MouvementModel;
use Ozyris\Service\Compte;
use Ozyris\Service\Users;

class CompteController extends AbstractController
{

    /**
     * @throws \Exception
     */
    public function indexAction()
    {
        $aSession = $this->getSession();

        if (!isset($aSession['oUser'])) {
            return $this->redirect();
        }

        /** @var Users $oUser */
        $oUser = $aSession['oUser'];

        if (!empty($_POST)) {
            $aInfosCompte = Router::getPostValues();
            $aInfosCompte['id_user'] = $oUser->getId();
            $oCompteModel = new CompteModel();
            $oCompteModel->createCompteWithInfos($aInfosCompte);

            return $this->redirect();
        }

        return $this->render('compte');
    }

    /**
     * @throws \Exception
     */
    public function updateCompteAction()
    {
        $iId = (int) Router::getGetValues();

        if (empty($iId)) {
            return $this->redirect();
        }

        $oCompteModel = new CompteModel();
        $aInfosCompte = $oCompteModel->selectCompteById($iId);

        if (!$aInfosCompte) {
            $this->setFlashMessage('Impossible de mettre à jour le compte. Si le problème persiste, veuillez contacter 
                l\'administrateur du site');

            return $this->redirect();
        }

        $oCompte = new Compte();
        $oCompte->createCompte($aInfosCompte);

        if (!empty($_POST)) {
            $aUpdateCompte = Router::getPostValues();
            $aModif = array_diff($aUpdateCompte, $aInfosCompte);

            if (!isset($aModif['nom']) && !isset($aModif['solde'])) {
                $this->setFlashMessage('Aucune modification n\'a été effectuée.');

                return $this->redirect();
            }

            if (!$oCompte->updateCompteById($aModif)) {
                $this->setFlashMessage('Impossible de mettre à jour le compte. Si le problème persiste, veuillez contacter 
                l\'administrateur du site');

                return $this->redirect();
            }

            $this->setFlashMessage('Le compte a bien été modifié.', false);
        } else {
            $this->setVariables(['oCompte' => $oCompte]);

            return $this->render('compte', 'updateCompte');
        }

        return $this->redirect();
    }

    /**
     * @throws \Exception
     */
    public function mouvementAction()
    {
        $iId = (int) Router::getGetValues();

        if (empty($iId)) {
            return $this->redirect();
        }

        $oCompteModel = new CompteModel();
        $aInfosCompte = $oCompteModel->selectCompteById($iId);

        if (!$aInfosCompte) {
            $this->setFlashMessage('Impossible d\'ajouter un mouvement. Si le problème persiste, veuillez contacter 
                l\'administrateur du site');

            return $this->redirect();
        }

        if (!empty($_POST)) {
            $aMouvement = Router::getPostValues();

            if ($this->getSessionValue('id_compte') != $iId ||
                !isset($aMouvement['type']) ||
                !isset($aMouvement['montant']) ||
                !array_key_exists('libelle', $aMouvement)
            ) {
                $this->setFlashMessage('Le mouvement n\'a pas pu être validé. Si le problème persiste, veuillez contacter 
                l\'administrateur du site');

                return $this->redirect('compte', 'mouvement');
            }

            $oCompte = new Compte();
            $oCompte->createCompte($aInfosCompte);

            if (isset($aMouvement['mensuel'])) {

                if (!is_numeric($aMouvement['jour']) || $aMouvement['jour'] > 28 || $aMouvement['jour'] <= 0) {
                    $this->setFlashMessage('Le jour saisi est incorrect');

                    return $this->redirect('compte', 'mouvement');
                }

                if (!is_numeric($aMouvement['montant']) || $aMouvement['montant'] <= 0) {
                    $this->setFlashMessage('Le montant doit être supérieur à 0');

                    return $this->redirect('compte', 'mouvement');
                }

                $oCompte->addAutomatiqueMouvement($aMouvement);
            }

            $oCompte->addMouvement($aMouvement['type'], $aMouvement['montant'], $aMouvement['libelle']);
            $oCompteModel->updateSoldeByCompte($oCompte);
            $this->setFlashMessage('Le mouvement a bien été renseigné.', false);

            return $this->redirect();
        }

        $this->setSessionValue('id_compte', $iId);
        $this->setVariables(['idCompte' => $iId]);

        return $this->render('compte', 'mouvement');
    }

    /**
     *
     */
    public function autoMouvementAction()
    {

    }

    /**
     * @throws \Exception
     */
    public function updateMouvementAction()
    {
        $iId = (int) Router::getGetValues();
        $oMouvementModel = new MouvementModel();
        $aMouvement = $oMouvementModel->selectMouvementById($iId);

        if (!$aMouvement) {
            $this->setFlashMessage('Le mouvement n\'a pas pu être modifié. Si le problème persiste, veuillez contacter
             l\'administrateur du site');

            return $this->redirect();
        }

        if (!empty($_POST)) {
            $aUpdateMouvement = Router::getPostValues();

            if ($this->getSessionValue('id_mouvement') != $iId ||
                !isset($aUpdateMouvement['type']) ||
                !isset($aUpdateMouvement['montant']) ||
                !array_key_exists('libelle', $aUpdateMouvement)
            ) {
                $this->setFlashMessage('Le mouvement n\'a pas pu être modifié. Si le problème persiste, veuillez contacter 
                l\'administrateur du site');

                return $this->redirect('compte', 'mouvement');
            }

            $oCompteModel = new CompteModel();
            $oMouvementModel->updateMouvementById($aMouvement['id'], $aUpdateMouvement);

            if ($aUpdateMouvement['type'] != $aMouvement['type_mouvement']) {
                if ($aUpdateMouvement['type'] == 'depot') {
                    $iMontant = $aMouvement['montant'] + $aUpdateMouvement['montant'];
                } else {
                    $iMontant = - $aMouvement['montant'] - $aUpdateMouvement['montant'];
                }
            } else {
                if ($aMouvement['type_mouvement'] == 'depot') {
                    $iMontant = - $aMouvement['montant'] + $aUpdateMouvement['montant'];
                } else {
                    $iMontant = + $aMouvement['montant'] - $aUpdateMouvement['montant'];
                }
            }

            $aInfosCompte = $oCompteModel->selectCompteById($aMouvement['id_compte']);
            $iNewSolde = $aInfosCompte['solde'] + $iMontant;

            $oCompteModel->updateCompteSolde($aMouvement['id_compte'], $iNewSolde);
            $this->setFlashMessage('Le mouvement a bien été modifié.', false);

            return $this->redirect();
        }

        $this->setSessionValue('id_mouvement', $iId);
        $this->setVariables(['mouvement' => $aMouvement]);

        return $this->render('compte', 'updateMouvement');
    }

    /**
     * @throws \Exception
     */
    public function deleteAction()
    {
        $iId = (int) Router::getGetValues();

        if (empty($iId)) {
            return $this->redirect();
        }

        $oCompteModel = new CompteModel();
        $oMouvementModel = new MouvementModel();
        $oCompteModel->deleteCompteById($iId);
        $oMouvementModel->deleteAllMouvementsByCompteId($iId);

        $this->setFlashMessage('Le compte a bien été supprimé.', false);

        return $this->redirect();
    }

    /**
     * @throws \Exception
     */
    public function deleteMouvementAction()
    {
        $iMouvementId = (int) Router::getGetValues();
        $oMouvementModel = new MouvementModel();
        $oCompteModel = new CompteModel();
        $aInfosMouvement = $oMouvementModel->selectMouvementById($iMouvementId);

        if (!is_array($aInfosMouvement) || !array_key_exists('id_compte', $aInfosMouvement) ||
            !array_key_exists('type_mouvement', $aInfosMouvement)) {
            $this->setFlashMessage('La suppression du mouvement n\'a pas abouti, veuillez réessayer ultérieurement.
            Si le problème persiste, merci de contacter l\'administrateur du site.');

            return $this->redirect();
        }

        $aInfosCompte = $oCompteModel->selectCompteById($aInfosMouvement['id_compte']);

        if (!is_array($aInfosCompte) && !array_key_exists('solde', $aInfosCompte)) {
            $this->setFlashMessage('La suppression du mouvement n\'a pas abouti, veuillez réessayer ultérieurement.
            Si le problème persiste, merci de contacter l\'administrateur du site.');

            return $this->redirect();
        }

        $oMouvementModel->deleteMouvementById($iMouvementId);
        $oMouvementModel->insertHistoriqueMouvement($aInfosMouvement);
        $iMontantMouvement = ($aInfosMouvement['type_mouvement'] == 'depot') ? - $aInfosMouvement['montant'] : + $aInfosMouvement['montant'];
        $iNewSolde = $aInfosCompte['solde'] + $iMontantMouvement;
        $oCompteModel->updateCompteSolde($aInfosMouvement['id_compte'], $iNewSolde);
        $this->setFlashMessage('Le mouvement a bien été supprimé.', false);

        return $this->redirect();
    }
}