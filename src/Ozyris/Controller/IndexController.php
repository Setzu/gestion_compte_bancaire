<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 08/06/16
 * Time: 13:01
 */

namespace Ozyris\Controller;

use Ozyris\Model\CompteModel;
use Ozyris\Model\MouvementModel;
use Ozyris\Service\Compte;

class IndexController extends AuthentificationController
{

    public function indexAction()
    {
        $aComptes = $aMouvements = [];
        $oCompteModel = new CompteModel();
        $aInfosCompte = $oCompteModel->selectAllCompte();
        $oMouvementModel = new MouvementModel();

        foreach ($aInfosCompte as $compte) {
            $oCompte = new Compte();
            $oCompte->createCompte($compte);
            $aComptes[] = $oCompte;
            $aMouvements[$oCompte->getId()] = $oMouvementModel->selectAllMouvementsByCompteId($oCompte->getId());
        }

        $this->setVariables([
            'aListeComptes' => $aComptes,
            'aListeMouvements' => $aMouvements
        ]);

        return $this->render();
    }
}
