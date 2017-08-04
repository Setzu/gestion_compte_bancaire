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

    /**
     * @param int $id
     * @return mixed
     */
    public function selectMouvementById($id)
    {
        $sql = "SELECT * FROM mouvement WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;

        try {
            $stmt->bindParam(':id', $iId);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(parent::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $idCompte
     * @return array
     */
    public function selectAllMouvementsByCompteId($idCompte)
    {
        $sql = "SELECT * FROM mouvement WHERE id_compte = :id_compte";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_compte', $idCompte);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(parent::SQL_ERROR);
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
                throw new \Exception(parent::SQL_ERROR);
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
                throw new \Exception(parent::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @param string $type
     * @return bool
     */
    public function updateMouvementType($id, $type)
    {
        $sql = "UPDATE mouvement SET type_mouvement = :type_mouvement WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;
        $sType = (string) $type;

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':type_mouvement', $sType);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(parent::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }

    /**
     * @param int $id
     * @param int $montant
     * @return bool
     */
    public function updateMouvementMontant($id, $montant)
    {
        $sql = "UPDATE mouvement SET numero = :numero WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;
        $iMontant = (int) $montant;

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':montant', $iMontant);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(parent::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }

    /**
     * @param int $id
     * @param string $ordre
     * @return bool
     */
    public function updateMouvementOrdre($id, $ordre)
    {
        $sql = "UPDATE mouvement SET ordre = :ordre WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;
        $sOrdre = (string) $ordre;

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':ordre', $sOrdre);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(parent::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }

    /**
     * @param int $id
     * @param array $infos
     * @return bool
     */
    public function updateMouvementById($id, $infos)
    {
        if (!is_array($infos)) {
            return false;
        }

        foreach ($infos as $k => $v) {
            $update = 'updateMouvement' . ucfirst($k);
            $this->$update((int) $id, $v);
        }

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteMouvementById($id)
    {
        $sql = 'DELETE FROM mouvement WHERE id = :id';
        $stmt = $this->bdd->prepare($sql);
        $id = (int) $id;

        try {
            $stmt->bindParam(':id', $id);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(parent::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }
        return $stmt->closeCursor();
    }

    /**
     * @param int $compteId
     * @return bool
     */
    public function deleteAllMouvementsByCompteId($compteId)
    {
        $sql = 'DELETE FROM mouvement WHERE id_compte = :id_compte';
        $stmt = $this->bdd->prepare($sql);
        $iCompteId = (int) $compteId;

        try {
            $stmt->bindParam(':id_compte', $iCompteId);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(parent::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }
}