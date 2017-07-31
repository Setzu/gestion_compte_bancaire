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
    protected $id;
    protected $nom;
    protected $numéro;
    protected $solde;

    public function createCompte(array $aInfos)
    {
        $this->hydrate($this, $aInfos);
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
    public function getNuméro()
    {
        return $this->numéro;
    }

    /**
     * @param mixed $numéro
     */
    public function setNuméro($numéro)
    {
        $this->numéro = $numéro;
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

}