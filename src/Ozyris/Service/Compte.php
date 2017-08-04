<?php
/**
 * Created by PhpStorm.
 * User: david
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
    protected $numero;
    protected $solde;
    protected $lastModification;
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
     */
    public function createCompte(array $aInfos)
    {
        $this->hydrate($this, $aInfos);
    }

    /**
     * @param array $infos
     * @return bool
     */
    public function updateCompteById(array $infos)
    {
        return $this->updateProperties($this, $infos);
    }

    /**
     * @param string $type
     * @param int $montant
     * @param string $ordre
     */
    public function addMouvement($type, $montant, $ordre = '')
    {
        if ($type == self::DEPOT) {
            $this->setSolde($this->getSolde() + $montant);
        } else {
            $this->setSolde($this->getSolde() - $montant);
        }

        $this->oMouvement->addMouvement($type, (int) $montant, $this->getId(), $ordre);
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
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
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
    public function getLastModification()
    {
        return $this->lastModification;
    }

    /**
     * @param mixed $lastModification
     */
    public function setLastModification($lastModification)
    {
        $this->lastModification = $lastModification;
    }

}