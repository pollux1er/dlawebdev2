<?php

namespace Proxies\__CG__\Entities\intranet;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Departement extends \Entities\intranet\Departement implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getCodeDepartement()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["codeDepartement"];
        }
        $this->__load();
        return parent::getCodeDepartement();
    }

    public function setNomDepartement($nomDepartement)
    {
        $this->__load();
        return parent::setNomDepartement($nomDepartement);
    }

    public function getNomDepartement()
    {
        $this->__load();
        return parent::getNomDepartement();
    }

    public function setCodeDirection(\Entities\intranet\Direction $codeDirection = NULL)
    {
        $this->__load();
        return parent::setCodeDirection($codeDirection);
    }

    public function getCodeDirection()
    {
        $this->__load();
        return parent::getCodeDirection();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'codeDepartement', 'nomDepartement', 'codeDirection');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}