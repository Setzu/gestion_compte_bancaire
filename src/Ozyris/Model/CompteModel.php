<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/07/17
 * Time: 17:38
 */

namespace Ozyris\Model;

use Ozyris\Service\Compte;
use Ozyris\Service\Logs;

class CompteModel extends AbstractModel
{

    /**
     * @param Compte $oCompte
     * @return bool
     */
    public function createCompte(Compte $oCompte)
    {
        $sql = "INSERT INTO compte (nom, solde) VALUES (:nom, :solde)";
        $stmt = $this->bdd->prepare($sql);
        $sNom = $oCompte->getNom();
        $iSolde = $oCompte->getSolde();

        try {
            $stmt->bindParam(':nom', $sNom);
            $stmt->bindParam(':solde', $iSolde);

            if (!$stmt->execute()) {
                $aSqlError = $stmt->errorInfo();
                $aSqlError['file'] = __FILE__ . ' at line : ' . __LINE__;
                Logs::add($aSqlError);

                throw new \Exception($aSqlError[2]);
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
            !array_key_exists('solde', $aInfosCompte)
        ) {
            return false;
        }

        $sql = "INSERT INTO compte (id_user, nom, solde) VALUES (:id_user, :nom, :solde)";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':nom', $aInfosCompte['nom']);
            $stmt->bindParam(':solde', $aInfosCompte['solde']);
            $stmt->bindParam(':id_user', $aInfosCompte['id_user']);

            if (!$stmt->execute()) {
                $aSqlError = $stmt->errorInfo();
                $aSqlError['file'] = __FILE__ . ' at line : ' . __LINE__;
                Logs::add($aSqlError);

                throw new \Exception($aSqlError[2]);
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
                $aSqlError = $stmt->errorInfo();
                $aSqlError['file'] = __FILE__ . ' at line : ' . __LINE__;
                Logs::add($aSqlError);

                throw new \Exception($aSqlError[2]);
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
                $aSqlError = $stmt->errorInfo();
                $aSqlError['file'] = __FILE__ . ' at line : ' . __LINE__;
                Logs::add($aSqlError);

                throw new \Exception($aSqlError[2]);
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
                $aSqlError = $stmt->errorInfo();
                $aSqlError['file'] = __FILE__ . ' at line : ' . __LINE__;
                Logs::add($aSqlError);

                throw new \Exception($aSqlError[2]);
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
        $sql = "UPDATE compte SET solde = :solde, last_update = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = $oCompte->getId();
        $iSolde = $oCompte->getSolde();

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':solde', $iSolde);

            if (!$stmt->execute()) {
                $aSqlError = $stmt->errorInfo();
                $aSqlError['file'] = __FILE__ . ' at line : ' . __LINE__;
                Logs::add($aSqlError);

                throw new \Exception($aSqlError[2]);
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
        $sql = "UPDATE compte SET nom = :nom, last_update = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;
        $sName = (string) $name;

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':nom', $sName);

            if (!$stmt->execute()) {
                $aSqlError = $stmt->errorInfo();
                $aSqlError['file'] = __FILE__ . ' at line : ' . __LINE__;
                Logs::add($aSqlError);

                throw new \Exception($aSqlError[2]);
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
        $sql = "UPDATE compte SET solde = :solde, last_update = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;
        $iSolde = (int) $solde;

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':solde', $iSolde);

            if (!$stmt->execute()) {
                $aSqlError = $stmt->errorInfo();
                $aSqlError['file'] = __FILE__ . ' at line : ' . __LINE__;
                Logs::add($aSqlError);

                throw new \Exception($aSqlError[2]);
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
        $return = false;

        if (!is_array($infos)) {
            return $return;
        }

        foreach ($infos as $k => $v) {
            $update = 'updateCompte' . ucfirst($k);

            if (method_exists($this, $update)) {
                $this->$update((int)$id, $v);

                $return = true;
            }
        }

        return $return;
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
                $aSqlError = $stmt->errorInfo();
                $aSqlError['file'] = __FILE__ . ' at line : ' . __LINE__;
                Logs::add($aSqlError);

                throw new \Exception($aSqlError[2]);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }
}