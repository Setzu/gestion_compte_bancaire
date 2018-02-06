<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 31/07/17
 * Time: 17:38
 */

namespace Ozyris\Service;


class Compte extends AbstractService
{
    const DEPOT = 'depot';
    const RETRAIT = 'retrait';

    protected $id;
    protected $nom;
    protected $solde;
    protected $dateCreation;
    protected $lastUpdate;
    private $oMouvement;

    /**
     * Injection de Mouvement
     *
     * Compte constructor.
     */
    public function __construct()
    {
        $this->setMouvement(new Mouvement());
    }

    /**
     * @param array $aInfos
     * @throws \Exception
     */
    public function createCompte(array $aInfos)
    {
        $this->hydrate($this, $aInfos);
    }

    /**
     * @param array $infos
     * @return bool
     * @throws \Exception
     */
    public function updateCompteById(array $infos)
    {
        return $this->updateProperties($this, $infos);
    }

    /**
     * @param string $type
     * @param int $montant
     * @param string $libelle
     * @param int $iAutomatique
     */
    public function addMouvement($type, $montant, $libelle = '', $iAutomatique = 0)
    {
        if ($type == self::DEPOT) {
            $this->setSolde($this->getSolde() + $montant);
        } else {
            $this->setSolde($this->getSolde() - $montant);
        }

        /** @var Mouvement $oMouvement */
        $oMouvement = $this->oMouvement;
        $oMouvement->addMouvement($type, (int) $montant, $this->getId(), $libelle, $iAutomatique);
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * @param mixed $solde
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;
    }

    /**
     * @return Mouvement
     */
    public function getMouvement()
    {
        return $this->oMouvement;
    }

    /**
     * @param Mouvement $oMouvement
     */
    public function setMouvement($oMouvement)
    {
        $this->oMouvement = $oMouvement;
    }


    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * @param mixed $lastUpdate
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    }

}