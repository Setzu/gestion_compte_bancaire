<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 01/08/17
 * Time: 09:27
 */

namespace Ozyris\Service;


class Mouvement extends AbstractService
{

    protected $id;
    protected $idCompte;
    protected $type;
    protected $montant;
    protected $ordre;
    protected $date;


    /**
     * @param string $type
     * @param int $montant
     * @param string $ordre
     */
    public function addMouvement($type, $montant, $idCompte, $ordre = '')
    {
        $this->setIdCompte((int) $idCompte);
        $this->setType($type);
        $this->setMontant((int) $montant);
        $this->setDate(new \DateTime());
        $this->setOrdre($ordre);
    }

    /**
     * @param array $aModif
     * @return bool
     * @throws \Exception
     */
    public function updateMouvement(array $aModif)
    {
        return $this->updateProperties($this, $aModif);
    }

    public function removeMouvementById($iId) {

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdCompte()
    {
        return $this->idCompte;
    }

    /**
     * @param mixed $idCompte
     */
    public function setIdCompte($idCompte)
    {
        $this->idCompte = $idCompte;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * @param mixed $ordre
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;
    }
}