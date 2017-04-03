<?php

namespace BMG\gestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pret
 *
 * @ORM\Table(name="pret", indexes={@ORM\Index(name="fk_pret_client", columns={"no_client"}), @ORM\Index(name="fk_pret_ouvrage", columns={"no_ouvrage"})})
 * @ORM\Entity(repositoryClass="BMG\gestBundle\Repository\PretRepository")
 */
class Pret
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_emp", type="datetime", nullable=false)
     */
    private $dateEmp = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ret", type="datetime", nullable=true)
     */
    private $dateRet;

    /**
     * @var string
     *
     * @ORM\Column(name="penalite", type="decimal", precision=5, scale=2, nullable=true)
     */
    private $penalite;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_pret", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPret;

    /**
     * @var \BMG\gestBundle\Entity\Ouvrage
     *
     * @ORM\ManyToOne(targetEntity="BMG\gestBundle\Entity\Ouvrage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="no_ouvrage", referencedColumnName="no_ouvrage")
     * })
     */
    private $ouvrage;

    /**
     * @var \BMG\gestBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="BMG\gestBundle\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="no_client", referencedColumnName="no_client")
     * })
     */
    private $client;

    /**
     * Set dateEmp
     *
     * @param \DateTime $dateEmp
     *
     * @return Pret
     */
    public function setDateEmp($dateEmp)
    {
        $this->dateEmp = $dateEmp;

        return $this;
    }

    /**
     * Get dateEmp
     *
     * @return \DateTime
     */
    public function getDateEmp()
    {
        return $this->dateEmp;
    }

    /**
     * Set dateRet
     *
     * @param \DateTime $dateRet
     *
     * @return Pret
     */
    public function setDateRet($dateRet)
    {
        $this->dateRet = $dateRet;

        return $this;
    }

    /**
     * Get dateRet
     *
     * @return \DateTime
     */
    public function getDateRet()
    {
        return $this->dateRet;
    }

    /**
     * Set penalite
     *
     * @param string $penalite
     *
     * @return Pret
     */
    public function setPenalite($penalite)
    {
        $this->penalite = $penalite;

        return $this;
    }

    /**
     * Get penalite
     *
     * @return string
     */
    public function getPenalite()
    {
        return $this->penalite;
    }

    /**
     * Get idPret
     *
     * @return integer
     */
    public function getIdPret()
    {
        return $this->idPret;
    }

    /**
     * Set ouvrage
     *
     * @param \BMG\gestBundle\Entity\Ouvrage $ouvrage
     *
     * @return Pret
     */
    public function setOuvrage(\BMG\gestBundle\Entity\Ouvrage $ouvrage = null)
    {
        $this->ouvrage = $ouvrage;

        return $this;
    }

    /**
     * Get ouvrage
     *
     * @return \BMG\gestBundle\Entity\Ouvrage
     */
    public function getOuvrage()
    {
        return $this->ouvrage;
    }

    /**
     * Set client
     *
     * @param \BMG\gestBundle\Entity\Client $client
     *
     * @return Pret
     */
    public function setNoClient(\BMG\gestBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \BMG\gestBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set client
     *
     * @param \BMG\gestBundle\Entity\Client $client
     *
     * @return Pret
     */
    public function setClient(\BMG\gestBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }
}
