<?php

namespace Entities\intranet;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\intranet\Utilisateur
 */
class Utilisateur
{
    /**
     * @var integer $idutilisateur
     */
    private $idutilisateur;

    /**
     * @var integer $idUserStaff
     */
    private $idUserStaff;

    /**
     * @var string $loginutilisateur
     */
    private $loginutilisateur;

    /**
     * @var string $passwordutilisateur
     */
    private $passwordutilisateur;

    /**
     * @var string $nomutilisateur
     */
    private $nomutilisateur;

    /**
     * @var string $prenom
     */
    private $prenom;

    /**
     * @var string $fonction
     */
    private $fonction;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var boolean $valideur
     */
    private $valideur;

    /**
     * @var integer $lineIdentifier
     */
    private $lineIdentifier;

    /**
     * @var string $line
     */
    private $line;

    /**
     * @var boolean $gestion
     */
    private $gestion;

    /**
     * @var integer $profil
     */
    private $profil;

    /**
     * @var Entities\intranet\Departement
     */
    private $codeDepartement;


    /**
     * Get idutilisateur
     *
     * @return integer 
     */
    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }

    /**
     * Set idUserStaff
     *
     * @param integer $idUserStaff
     * @return Utilisateur
     */
    public function setIdUserStaff($idUserStaff)
    {
        $this->idUserStaff = $idUserStaff;
        return $this;
    }

    /**
     * Get idUserStaff
     *
     * @return integer 
     */
    public function getIdUserStaff()
    {
        return $this->idUserStaff;
    }

    /**
     * Set loginutilisateur
     *
     * @param string $loginutilisateur
     * @return Utilisateur
     */
    public function setLoginutilisateur($loginutilisateur)
    {
        $this->loginutilisateur = $loginutilisateur;
        return $this;
    }

    /**
     * Get loginutilisateur
     *
     * @return string 
     */
    public function getLoginutilisateur()
    {
        return $this->loginutilisateur;
    }

    /**
     * Set passwordutilisateur
     *
     * @param string $passwordutilisateur
     * @return Utilisateur
     */
    public function setPasswordutilisateur($passwordutilisateur)
    {
        $this->passwordutilisateur = $passwordutilisateur;
        return $this;
    }

    /**
     * Get passwordutilisateur
     *
     * @return string 
     */
    public function getPasswordutilisateur()
    {
        return $this->passwordutilisateur;
    }

    /**
     * Set nomutilisateur
     *
     * @param string $nomutilisateur
     * @return Utilisateur
     */
    public function setNomutilisateur($nomutilisateur)
    {
        $this->nomutilisateur = $nomutilisateur;
        return $this;
    }

    /**
     * Get nomutilisateur
     *
     * @return string 
     */
    public function getNomutilisateur()
    {
        return $this->nomutilisateur;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     * @return Utilisateur
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;
        return $this;
    }

    /**
     * Get fonction
     *
     * @return string 
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set valideur
     *
     * @param boolean $valideur
     * @return Utilisateur
     */
    public function setValideur($valideur)
    {
        $this->valideur = $valideur;
        return $this;
    }

    /**
     * Get valideur
     *
     * @return boolean 
     */
    public function getValideur()
    {
        return $this->valideur;
    }

    /**
     * Set lineIdentifier
     *
     * @param integer $lineIdentifier
     * @return Utilisateur
     */
    public function setLineIdentifier($lineIdentifier)
    {
        $this->lineIdentifier = $lineIdentifier;
        return $this;
    }

    /**
     * Get lineIdentifier
     *
     * @return integer 
     */
    public function getLineIdentifier()
    {
        return $this->lineIdentifier;
    }

    /**
     * Set line
     *
     * @param string $line
     * @return Utilisateur
     */
    public function setLine($line)
    {
        $this->line = $line;
        return $this;
    }

    /**
     * Get line
     *
     * @return string 
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * Set gestion
     *
     * @param boolean $gestion
     * @return Utilisateur
     */
    public function setGestion($gestion)
    {
        $this->gestion = $gestion;
        return $this;
    }

    /**
     * Get gestion
     *
     * @return boolean 
     */
    public function getGestion()
    {
        return $this->gestion;
    }

    /**
     * Set profil
     *
     * @param integer $profil
     * @return Utilisateur
     */
    public function setProfil($profil)
    {
        $this->profil = $profil;
        return $this;
    }

    /**
     * Get profil
     *
     * @return integer 
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * Set codeDepartement
     *
     * @param Entities\intranet\Departement $codeDepartement
     * @return Utilisateur
     */
    public function setCodeDepartement(\Entities\intranet\Departement $codeDepartement = null)
    {
        $this->codeDepartement = $codeDepartement;
        return $this;
    }

    /**
     * Get codeDepartement
     *
     * @return Entities\intranet\Departement 
     */
    public function getCodeDepartement()
    {
        return $this->codeDepartement;
    }
}