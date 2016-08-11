<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Vote
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="iduser", type="integer")
     */
    private $iduser;

    /**
     * @var integer
     *
     * @ORM\Column(name="idepreuve", type="integer")
     */
    private $idepreuve;

    /**
     * @var integer
     *
     * @ORM\Column(name="idathlete", type="integer")
     */
    private $idathlete;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set iduser
     *
     * @param integer $iduser
     * @return Vote
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return integer 
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set idepreuve
     *
     * @param integer $idepreuve
     * @return Vote
     */
    public function setIdepreuve($idepreuve)
    {
        $this->idepreuve = $idepreuve;

        return $this;
    }

    /**
     * Get idepreuve
     *
     * @return integer 
     */
    public function getIdepreuve()
    {
        return $this->idepreuve;
    }

    /**
     * Set idathlete
     *
     * @param integer $idathlete
     * @return Vote
     */
    public function setIdathlete($idathlete)
    {
        $this->idathlete = $idathlete;

        return $this;
    }

    /**
     * Get idathlete
     *
     * @return integer 
     */
    public function getIdathlete()
    {
        return $this->idathlete;
    }
}
