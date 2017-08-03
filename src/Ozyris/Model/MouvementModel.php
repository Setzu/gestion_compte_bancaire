<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 01/08/17
 * Time: 09:30
 */

namespace Ozyris\Model;


use Ozyris\Service\Mouvement;

class MouvementModel extends AbstractModel
{

    /**
     * @param Mouvement $oMouvement
     * @return bool
     */
    public function insertMouvement(Mouvement $oMouvement)
    {
        $sql = "INSERT INTO mouvement (id_compte, type_mouvement, montant, ordre) VALUES (:id_compte, :type_mouvement, :montant, :ordre)";
        $stmt = $this->bdd->prepare($sql);

        $iIdCompte = $oMouvement->getIdCompte();
        $sTypeMouvement = $oMouvement->getType();
        $iMontant = $oMouvement->getMontant();
        $sOrdre = $oMouvement->getOrdre();

        try {
            $stmt->bindParam(':id_compte', $iIdCompte);
            $stmt->bindParam(':type_mouvement', $sTypeMouvement);
            $stmt->bindParam(':montant', $iMontant);
            $stmt->bindParam(':ordre', $sOrdre);

            if (!$stmt->execute()) {
//                $aSqlError = $stmt->errorInfo();
                throw new \Exception(parent::SQL_ERROR);
            }
        } catch(\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }

    public function selectMouvementById($value)
    {
        $sql = "SELECT * FROM mouvement WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $value;

        try {
            $stmt->bindParam(':id', $iId);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $compteId
     * @return array
     */
    public function selectAllMouvementsByCompteId($compteId)
    {
        $sql = "SELECT * FROM mouvement WHERE id_compte = :id_compte";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_compte', $compteId);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param string $value
     * @return array
     */
    public function selectAllMouvementsByOrdre($value)
    {
        $sql = "SELECT * FROM mouvement WHERE ordre = :ordre";
        $stmt = $this->bdd->prepare($sql);
        $sOrdre = (string) $value;

        try {
            $stmt->bindParam(':ordre', $sOrdre);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $value
     * @return array
     */
    public function selectAllMouvementsByMontant($value)
    {
        $sql = "SELECT * FROM mouvement WHERE montant = :montant";
        $stmt = $this->bdd->prepare($sql);
        $iMontant = (int) $value;

        try {
            $stmt->bindParam(':montant', $iMontant);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteMouvementById($id)
    {
        $sql = 'DELETE FROM mouvement WHERE id = :id';
        $stmt = $this->bdd->prepare($sql);
        $id = (int) $id;

        try {
            $stmt->bindParam(':id', $id);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }
        return $stmt->closeCursor();
    }

    public function deleteAllMouvementsByCompteId($compteId)
    {
        $sql = 'DELETE FROM mouvement WHERE id_compte = :id_compte';
        $stmt = $this->bdd->prepare($sql);
        $iCompteId = (int) $compteId;

        try {
            $stmt->bindParam(':id_compte', $iCompteId);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }
}