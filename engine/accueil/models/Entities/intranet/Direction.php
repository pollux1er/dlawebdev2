<?php

namespace Entities\intranet;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\intranet\Direction
 */
class Direction
{
    /**
     * @var integer $codeDirection
     */
    private $codeDirection;

    /**
     * @var string $nomDirection
     */
    private $nomDirection;


    /**
     * Get codeDirection
     *
     * @return integer 
     */
    public function getCodeDirection()
    {
        return $this->codeDirection;
    }

    /**
     * Set nomDirection
     *
     * @param string $nomDirection
     * @return Direction
     */
    public function setNomDirection($nomDirection)
    {
        $this->nomDirection = $nomDirection;
        return $this;
    }

    /**
     * Get nomDirection
     *
     * @return string 
     */
    public function getNomDirection()
    {
        return $this->nomDirection;
    }
}