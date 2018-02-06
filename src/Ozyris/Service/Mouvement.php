<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 01/08/17
 * Time: 09:27
 */

namespace Ozyris\Service;


use Ozyris\Model\MouvementModel;

class Mouvement extends AbstractService
{

    protected $id;
    protected $idCompte;
    protected $type;
    protected $montant;
    protected $libelle;
    protected $automatic;
    protected $date;

    private $mouvementModel;

    public function __construct()
    {
        $this->setMouvementModel(new MouvementModel());
    }

    /**
     * @param string $type
     * @param int $montant
     * @param int $idCompte
     * @param string $libelle
     * @param int $iAutomatique
     */
    public function addMouvement($type, $montant, $idCompte, $libelle = '', $iAutomatique = 0)
    {
        $this->setIdCompte((int) $idCompte);
        $this->setType($type);
        $this->setMontant((int) $montant);
        $this->setDate(new \DateTime());
        $this->setLibelle($libelle);
        $this->setAutomatic($iAutomatique);

        /** @var MouvementModel $oMouvementModel */
        $oMouvementModel = $this->getMouvementModel();
        $oMouvementModel->insertMouvement($this);
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
    public function getMouvementModel()
    {
        return $this->mouvementModel;
    }

    /**
     * @param mixed $mouvementModel
     */
    public function setMouvementModel($mouvementModel)
    {
        $this->mouvementModel = $mouvementModel;
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
    public function getAutomatic()
    {
        return $this->automatic;
    }

    /**
     * @param mixed $automatic
     */
    public function setAutomatic($automatic)
    {
        $this->automatic = $automatic;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }
}