<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/07/17
 * Time: 17:26
 */

namespace Ozyris\Controller;


use Ozyris\Model\CompteModel;
use Ozyris\Model\MouvementModel;
use Ozyris\Service\Compte;

class CompteController extends AbstractController
{

    public function indexAction()
    {
        if ($_POST) {
            $aInfosCompte = [];
            $aInfosCompte['nom'] = (string) htmlspecialchars(trim($_POST['name']));
            $aInfosCompte['number'] = (int) htmlspecialchars(trim($_POST['number']));
            $aInfosCompte['solde'] = (int) htmlspecialchars(trim($_POST['solde']));

            $oCompteModel = new CompteModel();
            $oCompteModel->createCompteWithInfos($aInfosCompte);

            return $this->redirect();
        }

        return $this->render('compte');
    }

    public function mouvementAction()
    {
        $iId = str_replace('$', '', urldecode($_GET['param']));

        if ($iId === "") {
            return $this->redirect();
        } else {
            $this->setVariables(['id' => $iId]);

            return $this->render('compte', 'mouvement');
        }
    }

    public function valideMouvementAction()
    {
        if ($_POST) {
            $iId = str_replace('$', '', urldecode($_GET['param']));

            if ($iId === "") {
                return $this->redirect();
            }

            $oCompteModel = new CompteModel();
            $aInfosCompte = $oCompteModel->selectCompteById($iId);

            if (!$aInfosCompte) {
                $this->setFlashMessage('Le mouvement n\'a pas pu être validé.');

                return $this->redirect();
            }

            $oCompte = new Compte();
            $oCompte->createCompte($aInfosCompte);

            if ($_POST['type'] == 'Depot') {
                $oCompte->depot($_POST['montant']);
            } else {
                $oCompte->retrait($_POST['montant'], $_POST['ordre']);
            }

            $oMouvementModel = new MouvementModel();
            $oMouvementModel->insertMouvement($oCompte->getMouvement());
            $oCompteModel->updateSoldeByCompte($oCompte);

            $this->setFlashMessage('Le mouvement a bien été renseigné.', false);
        }

        return $this->redirect();
    }
}