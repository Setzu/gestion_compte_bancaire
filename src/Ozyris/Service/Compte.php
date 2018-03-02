<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 31/07/17
 * Time: 17:38
 */

namespace Ozyris\Service;


use Ozyris\Model\CompteModel;

class Compte extends AbstractService
{
    const DEPOT = 'depot';
    const RETRAIT = 'retrait';

    protected $id;
    protected $idUser;
    protected $nom;
    protected $solde;
    protected $dateCreation;
    protected $lastUpdate;
    private $oMouvement;
    private $oCompteModel;

    /**
     * Injection de Mouvement
     *
     * Compte constructor.
     */
    public function __construct()
    {
        $this->setMouvement(new Mouvement());
        $this->setCompteModel(new CompteModel());
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
        /** @var CompteModel $oCompteModel */
        $oCompteModel = $this->getCompteModel();
        $oCompteModel->updateCompteById($this->getId(), $infos);

        return $this->updateProperties($this, $infos);
    }

    /**
     * @param string $type
     * @param int $montant
     * @param string $libelle
     * @param int $iAutomatique
     * @return bool
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

        return $oMouvement->addMouvement($type, (int) $montant, $this->getId(), $libelle, $iAutomatique);
    }

    /**
     * @param array $aInfosMouvement
     * @return bool
     */
    public function addAutomatiqueMouvement(array $aInfosMouvement)
    {
        /** @var Mouvement $oMouvement */
        $oMouvement = $this->oMouvement;

        return $oMouvement->addAutomatiqueMouvement($this->getId(), $aInfosMouvement);
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

    /**
     * @return mixed
     */
    public function getCompteModel()
    {
        return $this->oCompteModel;
    }

    /**
     * @param mixed $oCompteModel
     */
    public function setCompteModel($oCompteModel)
    {
        $this->oCompteModel = $oCompteModel;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

}