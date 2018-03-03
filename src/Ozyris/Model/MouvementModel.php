<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 01/08/17
 * Time: 09:30
 */

namespace Ozyris\Model;


use Ozyris\Service\Logs;
use Ozyris\Service\Mouvement;

class MouvementModel extends AbstractModel
{

    /**
     * @param Mouvement $oMouvement
     * @return bool
     */
    public function insertMouvement(Mouvement $oMouvement)
    {
        $sql = "INSERT INTO mouvement (id_compte, type_mouvement, montant, libelle, automatique)
VALUES (:id_compte, :type_mouvement, :montant, :libelle, :automatique)";
        $stmt = $this->bdd->prepare($sql);

        $iIdCompte = $oMouvement->getIdCompte();
        $sTypeMouvement = $oMouvement->getType();
        $iMontant = $oMouvement->getMontant();
        $sLibelle = $oMouvement->getLibelle();
        $iAutomatique = $oMouvement->getAutomatic();

        try {
            $stmt->bindParam(':id_compte', $iIdCompte);
            $stmt->bindParam(':type_mouvement', $sTypeMouvement);
            $stmt->bindParam(':montant', $iMontant);
            $stmt->bindParam(':libelle', $sLibelle);
            $stmt->bindParam(':automatique', $iAutomatique);

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
     * @param array $aInfosMouvement
     * @return bool
     */
    public function insertMouvementByInfosMouvement(array $aInfosMouvement)
    {
        $sql = "INSERT INTO mouvement (id_compte, type_mouvement, montant, libelle, automatique)
VALUES (:id_compte, :type_mouvement, :montant, :libelle, :automatique)";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_compte', $aInfosMouvement['id_compte']);
            $stmt->bindParam(':type_mouvement', $aInfosMouvement['type_mouvement']);
            $stmt->bindParam(':montant', $aInfosMouvement['montant']);
            $stmt->bindParam(':libelle', $aInfosMouvement['libelle']);
            $stmt->bindParam(':automatique', $aInfosMouvement['automatique']);

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
     * @param $idCompte
     * @param array $aInfosMouvement
     * @return bool
     */
    public function insertAutomatiqueMouvement($idCompte, array $aInfosMouvement)
    {
        $sql = "INSERT INTO auto_mouvement (id_compte, type_mouvement, montant, libelle, jour)
VALUES (:id_compte, :type_mouvement, :montant, :libelle, :jour)";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_compte', $idCompte);
            $stmt->bindParam(':type_mouvement', $aInfosMouvement['type']);
            $stmt->bindParam(':montant', $aInfosMouvement['montant']);
            $stmt->bindParam(':libelle', $aInfosMouvement['libelle']);
            $stmt->bindParam(':jour', $aInfosMouvement['jour']);

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
     * @param array $aInfosMouvement
     * @return bool
     */
    public function insertHistoriqueMouvement(array $aInfosMouvement)
    {
        $sql = "INSERT INTO histo_mouvement (id_compte, type_mouvement, montant, libelle, automatique, date_creation)
VALUES (:id_compte, :type_mouvement, :montant, :libelle, :automatique, :date_creation)";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_compte', $aInfosMouvement['id_compte']);
            $stmt->bindParam(':type_mouvement', $aInfosMouvement['type_mouvement']);
            $stmt->bindParam(':montant', $aInfosMouvement['montant']);
            $stmt->bindParam(':libelle', $aInfosMouvement['libelle']);
            $stmt->bindParam(':automatique', $aInfosMouvement['automatique']);
            $stmt->bindParam(':date_creation', $aInfosMouvement['date_mouvement']);

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
     * @param int $idCompte
     * @return array
     */
    public function selectAllMouvementsByCompteId($idCompte)
    {
        $sql = "SELECT * FROM mouvement WHERE id_compte = :id_compte ORDER BY date_mouvement DESC";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_compte', $idCompte);

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
     * @param int $id
     * @param string $type
     * @return bool
     */
    public function updateType($id, $type)
    {
        $sql = "UPDATE mouvement SET type_mouvement = :type_mouvement WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;
        $sType = (string) $type;

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':type_mouvement', $sType);

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
     * @param int $montant
     * @return bool
     */
    public function updateMontant($id, $montant)
    {
        $sql = "UPDATE mouvement SET montant = :montant WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;
        $iMontant = (int) $montant;

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':montant', $iMontant);

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
     * @param string $libelle
     * @return bool
     */
    public function updateLibelle($id, $libelle)
    {
        $sql = "UPDATE mouvement SET libelle = :libelle WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;
        $sLibelle = (string) $libelle;

        try {
            $stmt->bindParam(':id', $iId);
            $stmt->bindParam(':libelle', $sLibelle);

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
     * @param array $values
     * @return bool
     */
    public function updateMouvementById($id, $values)
    {
        if (!is_array($values)) {
            return false;
        }

        foreach ($values as $k => $v) {
            $update = 'update' . ucfirst($k);
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