<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 08/06/16
 * Time: 13:01
 */

namespace Ozyris\Controller;

use Ozyris\Model\CompteModel;
use Ozyris\Service\Compte;
use Ozyris\Service\Users;

class IndexController extends AuthentificationController
{

    public function indexAction()
    {
        if ($this->getUser() instanceof Users) {
            $this->isAuthentified = true;
        }

        $this->setVariables([
            'user' => $this->getUser(),
            'isAuth' => $this->isAuthentified
        ]);

        $aCompte = [];
        $oCompteModel = new CompteModel();
        $aInfosCompte = $oCompteModel->selectAllCompte();

        foreach ($aInfosCompte as $compte) {
            $oCompte = new Compte();
            $oCompte->createCompte($compte);
            $aCompte[] = $oCompte;
        }

        $this->setVariables(['aListeComptes' => $aCompte]);

        return $this->render();
    }
}
