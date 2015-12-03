<?php

namespace Entities\intranet;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\intranet\Actualite
 */
class Actualite
{
    /**
     * @var integer $idactualite
     */
    private $idactualite;

    /**
     * @var string $titre
     */
    private $titre;

    /**
     * @var string $contenu
     */
    private $contenu;

    /**
     * @var string $lienPhoto
     */
    private $lienPhoto;

    /**
     * @var boolean $select
     */
    private $select;


    /**
     * Get idactualite
     *
     * @return integer 
     */
    public function getIdactualite()
    {
        return $this->idactualite;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Actualite
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Actualite
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set lienPhoto
     *
     * @param string $lienPhoto
     * @return Actualite
     */
    public function setLienPhoto($lienPhoto)
    {
        $this->lienPhoto = $lienPhoto;
        return $this;
    }

    /**
     * Get lienPhoto
     *
     * @return string 
     */
    public function getLienPhoto()
    {
        return $this->lienPhoto;
    }

    /**
     * Set select
     *
     * @param boolean $select
     * @return Actualite
     */
    public function setSelect($select)
    {
        $this->select = $select;
        return $this;
    }

    /**
     * Get select
     *
     * @return boolean 
     */
    public function getSelect()
    {
        return $this->select;
    }
}