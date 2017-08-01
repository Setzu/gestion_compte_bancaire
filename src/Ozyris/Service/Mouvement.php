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

    protected $type;
    protected $montant;
    protected $ordre;
    protected $date;

    /**
     * @param string $type
     * @param int $montant
     * @param string $ordre
     */
    public function addMouvement($type, $montant, $ordre = '')
    {
        $this->setType($type);
        $this->setMontant((int) $montant);
        $this->setDate(new \DateTime());
        $this->setOrdre($ordre);
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