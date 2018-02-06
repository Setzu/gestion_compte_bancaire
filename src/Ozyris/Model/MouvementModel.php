<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 01/08/17
 * Time: 09:30
 */

namespace Ozyris\Model;


use Ozyris\Service\Mouvement;
use Ozyris\Service\Utils;

class MouvementModel extends AbstractModel
{

    /**
     * @param Mouvement $oMouvement
     * @return bool
     */
    public function insertMouvement(Mouvement $oMouvement)
    {
        $_SESSION['test']++;
        $sql = "INSERT INTO mouvement (id_compte, type_mouvement, montant, libelle, automatic) VALUES (:id_compte, :type_mouvement, :montant, :libelle, :automatic)";
        $stmt = $this->bdd->prepare($sql);

        $iIdCompte = $oMouvement->getIdCompte();
        $sTypeMouvement = $oMouvement->getType();
        $iMontant = $oMouvement->getMontant();
        $sLibelle = $oMouvement->getLibelle();
        $iAutomatic = $oMouvement->getAutomatic();

        try {
            $stmt->bindParam(':id_compte', $iIdCompte);
            $stmt->bindParam(':type_mouvement', $sTypeMouvement);
            $stmt->bindParam(':montant', $iMontant);
            $stmt->bindParam(':libelle', $sLibelle);
            $stmt->bindParam(':automatic', $iAutomatic);

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
     * @param array $aInfosMouvement
     * @return bool
     */
    public function insertMouvementByInfosMouvement(array $aInfosMouvement)
    {
        $sql = "INSERT INTO mouvement (id_compte, type_mouvement, montant, libelle, automatic) VALUES (:id_compte, :type_mouvement, :montant, :libelle, :automatic)";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_compte', $aInfosMouvement['id_compte']);
            $stmt->bindParam(':type_mouvement', $aInfosMouvement['type_mouvement']);
            $stmt->bindParam(':montant', $aInfosMouvement['montant']);
            $stmt->bindParam(':libelle', $aInfosMouvement['libelle']);
            $stmt->bindParam(':automatic', $aInfosMouvement['automatic']);

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
    public function selectAllMouvementsByLibelle($value)
    {
        $sql = "SELECT * FROM mouvement WHERE libelle = :libelle";
        $stmt = $this->bdd->prepare($sql);
        $sLibelle = (string) $value;

        try {
            $stmt->bindParam(':libelle', $sLibelle);

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
     * @param string $libelle
     * @return bool
     */
    public function updateMouvementLibelle($id, $libelle)
    {
        $sql = "UPDATE mouvement SET libelle = :libelle WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;
        $sLibelle = (string) $libelle;

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':libelle', $sLibelle);

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