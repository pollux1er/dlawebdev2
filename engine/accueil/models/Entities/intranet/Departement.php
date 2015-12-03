<?php

namespace Entities\intranet;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\intranet\Departement
 */
class Departement
{
    /**
     * @var integer $codeDepartement
     */
    private $codeDepartement;

    /**
     * @var string $nomDepartement
     */
    private $nomDepartement;

    /**
     * @var Entities\intranet\Direction
     */
    private $codeDirection;


    /**
     * Get codeDepartement
     *
     * @return integer 
     */
    public function getCodeDepartement()
    {
        return $this->codeDepartement;
    }

    /**
     * Set nomDepartement
     *
     * @param string $nomDepartement
     * @return Departement
     */
    public function setNomDepartement($nomDepartement)
    {
        $this->nomDepartement = $nomDepartement;
        return $this;
    }

    /**
     * Get nomDepartement
     *
     * @return string 
     */
    public function getNomDepartement()
    {
        return $this->nomDepartement;
    }

    /**
     * Set codeDirection
     *
     * @param Entities\intranet\Direction $codeDirection
     * @return Departement
     */
    public function setCodeDirection(\Entities\intranet\Direction $codeDirection = null)
    {
        $this->codeDirection = $codeDirection;
        return $this;
    }

    /**
     * Get codeDirection
     *
     * @return Entities\intranet\Direction 
     */
    public function getCodeDirection()
    {
        return $this->codeDirection;
    }
}