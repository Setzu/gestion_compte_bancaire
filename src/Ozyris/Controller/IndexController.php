<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 08/06/16
 * Time: 13:01
 */

namespace Ozyris\Controller;

use Ozyris\core\SessionManager;
use Ozyris\Model\CompteModel;
use Ozyris\Model\MouvementModel;
use Ozyris\Service\Compte;

class IndexController extends AuthenticationController
{

    /**
     * @throws \Exception
     */
    public function indexAction()
    {
        $aSession = $this->getSession();
        $aComptes = $aMouvements = [];

        if (array_key_exists('isAuthentified', $aSession) && $aSession['isAuthentified']) {
            $aComptes = $aMouvements = [];
            $oCompteModel = new CompteModel();
            $aListeComptes = $oCompteModel->selectAllCompte();
            $oMouvementModel = new MouvementModel();

            foreach ($aListeComptes as $aInfoCompte) {
                $oCompte = new Compte();
                $oCompte->createCompte($aInfoCompte);
                $aComptes[$oCompte->getId()] = $oCompte;
                $aMouvements[$oCompte->getId()] = $oMouvementModel->selectAllMouvementsByCompteId($oCompte->getId());
            }

            $this->setVariables(['oUser' => $aSession['oUser']]);
            $this->setSessionValue('aListeComptes', $aListeComptes);
        }

        $this->setVariables([
            'aComptes' => $aComptes,
            'aListeMouvements' => $aMouvements
        ]);

        return $this->render();
    }
}