<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/07/17
 * Time: 17:38
 */

namespace Ozyris\Model;

use Ozyris\Service\Compte;

class CompteModel extends AbstractModel
{

    public function createCompte(Compte $oCompte)
    {
        $sql = "INSERT INTO compte (nom, numero, solde) VALUES (:nom, :numero, :solde)";
        $stmt = $this->bdd->prepare($sql);

        $sNom = $oCompte->getNom();
        $iNumero = $oCompte->getNuméro();
        $iSolde = $oCompte->getSolde();

        try {
            $stmt->bindParam(':nom', $sNom);
            $stmt->bindParam(':numero', $iNumero);
            $stmt->bindParam(':solde', $iSolde);

            if (!$stmt->execute()) {
//                $aSqlError = $stmt->errorInfo();
                throw new \Exception(parent::SQL_ERROR);
            }
        } catch(\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }

}