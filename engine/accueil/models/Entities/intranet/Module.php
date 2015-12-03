<?php

namespace Entities\intranet;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\intranet\Module
 */
class Module
{
    /**
     * @var integer $idmodule
     */
    private $idmodule;

    /**
     * @var string $designationmenu
     */
    private $designationmenu;

    /**
     * @var string $lienmenu
     */
    private $lienmenu;


    /**
     * Get idmodule
     *
     * @return integer 
     */
    public function getIdmodule()
    {
        return $this->idmodule;
    }

    /**
     * Set designationmenu
     *
     * @param string $designationmenu
     * @return Module
     */
    public function setDesignationmenu($designationmenu)
    {
        $this->designationmenu = $designationmenu;
        return $this;
    }

    /**
     * Get designationmenu
     *
     * @return string 
     */
    public function getDesignationmenu()
    {
        return $this->designationmenu;
    }

    /**
     * Set lienmenu
     *
     * @param string $lienmenu
     * @return Module
     */
    public function setLienmenu($lienmenu)
    {
        $this->lienmenu = $lienmenu;
        return $this;
    }

    /**
     * Get lienmenu
     *
     * @return string 
     */
    public function getLienmenu()
    {
        return $this->lienmenu;
    }
}