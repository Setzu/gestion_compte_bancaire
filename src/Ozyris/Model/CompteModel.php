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

    /**
     * @param Compte $oCompte
     * @return bool
     */
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

    /**
     * @param array $aInfosCompte
     * @return bool
     */
    public function createCompteWithInfos(array $aInfosCompte)
    {
        if (
            !array_key_exists('nom', $aInfosCompte) ||
            !array_key_exists('numero', $aInfosCompte) ||
            !array_key_exists('solde', $aInfosCompte)
        ) {
            return false;
        }

        $sql = "INSERT INTO compte (nom, numero, solde) VALUES (:nom, :numero, :solde)";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':nom', $aInfosCompte['nom']);
            $stmt->bindParam(':numero', $aInfosCompte['numero']);
            $stmt->bindParam(':solde', $aInfosCompte['solde']);

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
     * @param int $value
     * @return array
     */
    public function selectCompteById($value)
    {
        $sql = "SELECT * FROM compte WHERE id = :id";
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
     * @param int $value
     * @return array
     */
    public function selectCompteByNumero($value)
    {
        $sql = "SELECT * FROM compte WHERE numero = :numero";
        $stmt = $this->bdd->prepare($sql);
        $iNumero = (int) $value;

        try {
            $stmt->bindParam(':numero', $iNumero);

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
     * @param string $value
     * @return array mixed
     */
    public function selectCompteByName($value)
    {
        $sql = "SELECT * FROM compte WHERE nom = :nom";
        $stmt = $this->bdd->prepare($sql);
        $sName = (string) $value;

        try {
            $stmt->bindParam(':nom', $sName);

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
     * @return array
     */
    public function selectAllCompte()
    {
        $sql = "SELECT * FROM compte";
        $stmt = $this->bdd->prepare($sql);

        try {
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
     * @param Compte $oCompte
     * @return mixed
     */
    public function updateSoldeByCompte(Compte $oCompte)
    {
        $sql = "UPDATE compte SET solde = :solde WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = $oCompte->getId();
        $iSolde = $oCompte->getSolde();

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':solde', $iSolde);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }

    /**
     * @param int $id
     * @param string $name
     * @return bool
     */
    public function updateCompteNom($id, $name)
    {
        $sql = "UPDATE compte SET nom = :nom WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;
        $sName = (string) $name;

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':nom', $sName);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }

    /**
     * @param int $id
     * @param int $solde
     * @return bool
     */
    public function updateCompteSolde($id, $solde)
    {
        $sql = "UPDATE compte SET solde = :solde WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;
        $iSolde = (int) $solde;

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':solde', $iSolde);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(self::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }

    /**
     * @param int $id
     * @param int $numero
     * @return bool
     */
    public function updateCompteNumero($id, $numero)
    {
        $sql = "UPDATE compte SET numero = :numero WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;
        $iNumero = (int) $numero;

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':numero', $iNumero);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(self::SQL_ERROR);
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
    public function updateCompteById($id, $infos)
    {
        if (!is_array($infos)) {
            return false;
        }

        foreach ($infos as $k => $v) {
            $update = 'updateCompte' . ucfirst($k);
            $this->$update((int) $id, $v);
        }

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteCompteById($id)
    {
        $sql = "DELETE FROM compte WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;

        try {
            $stmt->bindParam(':id', $iId);

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