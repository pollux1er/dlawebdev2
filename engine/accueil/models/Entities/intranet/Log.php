<?php

namespace Entities\intranet;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\intranet\Log
 */
class Log
{
    /**
     * @var integer $idlog
     */
    private $idlog;

    /**
     * @var string $idTarg
     */
    private $idTarg;

    /**
     * @var string $acteur
     */
    private $acteur;

    /**
     * @var datetime $datelog
     */
    private $datelog;

    /**
     * @var string $type
     */
    private $type;

    /**
     * @var string $libelle
     */
    private $libelle;


    /**
     * Get idlog
     *
     * @return integer 
     */
    public function getIdlog()
    {
        return $this->idlog;
    }

    /**
     * Set idTarg
     *
     * @param string $idTarg
     * @return Log
     */
    public function setIdTarg($idTarg)
    {
        $this->idTarg = $idTarg;
        return $this;
    }

    /**
     * Get idTarg
     *
     * @return string 
     */
    public function getIdTarg()
    {
        return $this->idTarg;
    }

    /**
     * Set acteur
     *
     * @param string $acteur
     * @return Log
     */
    public function setActeur($acteur)
    {
        $this->acteur = $acteur;
        return $this;
    }

    /**
     * Get acteur
     *
     * @return string 
     */
    public function getActeur()
    {
        return $this->acteur;
    }

    /**
     * Set datelog
     *
     * @param datetime $datelog
     * @return Log
     */
    public function setDatelog($datelog)
    {
        $this->datelog = $datelog;
        return $this;
    }

    /**
     * Get datelog
     *
     * @return datetime 
     */
    public function getDatelog()
    {
        return $this->datelog;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Log
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Log
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
}