<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 31/07/17
 * Time: 17:26
 */

namespace Ozyris\Controller;


use Ozyris\Form\Form;
use Ozyris\Model\CompteModel;
use Ozyris\Model\MouvementModel;
use Ozyris\Service\Compte;
use Ozyris\Service\Mouvement;
use Ozyris\Service\Utils;

class CompteController extends AbstractController
{

    /**
     * @throws \Exception
     */
    public function indexAction()
    {
        if (!empty($_POST)) {
            $aInfosCompte = Form::getFormValues();

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
        $iId = str_replace('$', '', urldecode($_GET['param']));

        if (empty($iId)) {
            return $this->redirect();
        }

        $oCompteModel = new CompteModel();
        $aInfosCompte = $oCompteModel->selectCompteById($iId);
        $oCompte = new Compte();
        $oCompte->createCompte($aInfosCompte);

        if (!empty($_POST)) {
            $aUpdateCompte = Form::getFormValues();

            $aModif = array_diff($aUpdateCompte, $aInfosCompte);
            $oCompte->updateCompteById($aModif);
            $oCompteModel->updateCompteById($aInfosCompte['id'], $aModif);

            $this->setFlashMessage('Le mouvement a bien été modifié.', false);
        } else {
            $this->setVariables(['compte' => $oCompte]);

            return $this->render('compte', 'updateCompte');
        }

        return $this->redirect();
    }

    /**
     * @throws \Exception
     */
    public function mouvementAction()
    {
        $iId = (int) str_replace('$', '', urldecode($_GET['param']));

        if (empty($iId)) {
            return $this->redirect();
        }

        if (!empty($_POST)) {
            $oCompteModel = new CompteModel();
            $aInfosCompte = $oCompteModel->selectCompteById($iId);

            if (!$aInfosCompte) {
                $this->setFlashMessage('Le mouvement n\'a pas pu être validé.');

                return $this->redirect();
            }

            $aMouvement = Form::getFormValues();

            if (!isset($aMouvement['type']) || !isset($aMouvement['montant']) || !array_key_exists('libelle', $aMouvement)) {
                return $this->redirect();
            }

            $iAutomatique = isset($aMouvement['mensuel']) ? 1 : 0;
            $oCompte = new Compte();
            $oCompte->createCompte($aInfosCompte);
            $oCompte->addMouvement($aMouvement['type'], $aMouvement['montant'], $aMouvement['libelle'], $iAutomatique);
            $oCompteModel->updateSoldeByCompte($oCompte);
            $this->setFlashMessage('Le mouvement a bien été renseigné.', false);

            return $this->redirect();
        }

        $this->setVariables(['id' => $iId]);

        return $this->render('compte', 'mouvement');
    }

    /**
     * @throws \Exception
     */
    public function updateMouvementAction()
    {
        $iId = str_replace('$', '', urldecode($_GET['param']));

        if (empty($iId)) {
            return $this->redirect();
        }

        $oMouvementModel = new MouvementModel();
        $aMouvement = $oMouvementModel->selectMouvementById($iId);

        if (!empty($_POST)) {
            $aUpdateMouvement = Form::getFormValues();

            $aModif = array_diff($aUpdateMouvement, $aMouvement);
            $oMouvement = new Mouvement();
            $oMouvement->updateMouvement($aModif);
            $oMouvementModel->updateMouvementById($aMouvement['id'], $aModif);
            $this->setFlashMessage('Le mouvement a bien été modifié.', false);

            return $this->redirect();
        }

        $this->setVariables(['mouvement' => $aMouvement]);

        return $this->render('compte', 'updateMouvement');
    }

    /**
     * @throws \Exception
     */
    public function deleteAction()
    {
        $iId = str_replace('$', '', urldecode($_GET['param']));

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
        $iId = str_replace('$', '', urldecode($_GET['param']));

        $oMouvementModel = new MouvementModel();
        $oCompte = new CompteModel();
        $aInfosMouvement = $oMouvementModel->selectMouvementById($iId);

        if (!is_array($aInfosMouvement) && !array_key_exists('id_compte', $aInfosMouvement) || !array_key_exists('type_mouvement', $aInfosMouvement)) {
            $this->setFlashMessage('La suppression du mouvement n\'a pas abouti, veuillez réessayer ultérieurement. Si le problème persiste, merci de contacter l\'administrateur du site.');

            return $this->redirect();
        }

        $aInfosCompte = $oCompte->selectCompteById($aInfosMouvement['id_compte']);

        if (!is_array($aInfosCompte) && !array_key_exists('solde', $aInfosCompte)) {
            $this->setFlashMessage('La suppression du mouvement n\'a pas abouti, veuillez réessayer ultérieurement. Si le problème persiste, merci de contacter l\'administrateur du site.');

            return $this->redirect();
        }

        $oMouvementModel->deleteMouvementById($iId);
        $iMontantMouvement = ($aInfosMouvement['type_mouvement'] == 'depot') ? - $aInfosMouvement['montant'] : + $aInfosMouvement['montant'];
        $iNewSolde = $aInfosCompte['solde'] + $iMontantMouvement;
        $oCompte->updateCompteSolde($aInfosMouvement['id_compte'], $iNewSolde);

        $this->setFlashMessage('Le mouvement a bien été supprimé.', false);

        return $this->redirect();
    }

    /**
     *
     */
    public function addPrelevementAction()
    {

    }
}