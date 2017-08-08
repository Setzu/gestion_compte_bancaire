<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/07/17
 * Time: 17:26
 */

namespace Ozyris\Controller;


use Ozyris\Form\Form;
use Ozyris\Model\CompteModel;
use Ozyris\Model\MouvementModel;
use Ozyris\Service\Compte;
use Ozyris\Service\Mouvement;

class CompteController extends AbstractController
{

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

    public function mouvementAction()
    {
        $iId = str_replace('$', '', urldecode($_GET['param']));

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

            $oCompte = new Compte();
            $oCompte->createCompte($aInfosCompte);
            $oCompte->addMouvement($aMouvement['type'], $aMouvement['montant'], $aMouvement['ordre']);

            $oMouvementModel = new MouvementModel();
            $oMouvementModel->insertMouvement($oCompte->getMouvement());
            $oCompteModel->updateSoldeByCompte($oCompte);

            $this->setFlashMessage('Le mouvement a bien été renseigné.', false);

            return $this->redirect();
        }

        $this->setVariables(['id' => $iId]);

        return $this->render('compte', 'mouvement');
    }

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
            $oMouvement->updateMouvementById($aModif);
            $oMouvementModel->updateMouvementById($aMouvement['id'], $aModif);
            $this->setFlashMessage('Le mouvement a bien été modifié.', false);

            return $this->redirect();
        }

        $this->setVariables(['mouvement' => $aMouvement]);

        return $this->render('compte', 'updateMouvement');
    }

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

    public function deleteMouvementAction()
    {
        $iId = str_replace('$', '', urldecode($_GET['param']));

        $oMouvementModel = new MouvementModel();
        $oMouvementModel->deleteMouvementById($iId);

        $this->setFlashMessage('Le mouvement a bien été supprimé.', false);

        return $this->redirect();
    }
}