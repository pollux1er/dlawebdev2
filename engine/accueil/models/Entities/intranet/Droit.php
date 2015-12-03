<?php

namespace Entities\intranet;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\intranet\Droit
 */
class Droit
{
    /**
     * @var integer $iddroit
     */
    private $iddroit;

    /**
     * @var boolean $modification
     */
    private $modification;

    /**
     * @var boolean $lecture
     */
    private $lecture;

    /**
     * @var Entities\intranet\Module
     */
    private $idmodule;

    /**
     * @var Entities\intranet\Utilisateur
     */
    private $idutilisateur;


    /**
     * Get iddroit
     *
     * @return integer 
     */
    public function getIddroit()
    {
        return $this->iddroit;
    }

    /**
     * Set modification
     *
     * @param boolean $modification
     * @return Droit
     */
    public function setModification($modification)
    {
        $this->modification = $modification;
        return $this;
    }

    /**
     * Get modification
     *
     * @return boolean 
     */
    public function getModification()
    {
        return $this->modification;
    }

    /**
     * Set lecture
     *
     * @param boolean $lecture
     * @return Droit
     */
    public function setLecture($lecture)
    {
        $this->lecture = $lecture;
        return $this;
    }

    /**
     * Get lecture
     *
     * @return boolean 
     */
    public function getLecture()
    {
        return $this->lecture;
    }

    /**
     * Set idmodule
     *
     * @param Entities\intranet\Module $idmodule
     * @return Droit
     */
    public function setIdmodule(\Entities\intranet\Module $idmodule = null)
    {
        $this->idmodule = $idmodule;
        return $this;
    }

    /**
     * Get idmodule
     *
     * @return Entities\intranet\Module 
     */
    public function getIdmodule()
    {
        return $this->idmodule;
    }

    /**
     * Set idutilisateur
     *
     * @param Entities\intranet\Utilisateur $idutilisateur
     * @return Droit
     */
    public function setIdutilisateur(\Entities\intranet\Utilisateur $idutilisateur = null)
    {
        $this->idutilisateur = $idutilisateur;
        return $this;
    }

    /**
     * Get idutilisateur
     *
     * @return Entities\intranet\Utilisateur 
     */
    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }
}