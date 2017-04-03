<?php

namespace BMG\gestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement", indexes={@ORM\Index(name="idx_fk_evenement_client", columns={"no_client"}), @ORM\Index(name="idx_fk_evenement_date_evenement", columns={"date_evenement"}), @ORM\Index(name="idx_fk_evenement_type_evenement", columns={"type_evenement"}), @ORM\Index(name="idx_fk_evenement_pret", columns={"id_pret"})})
 * @ORM\Entity(repositoryClass="BMG\gestBundle\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_evenement", type="datetime", nullable=false)
     */
    private $dateEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="type_evenement", type="string", length=2, nullable=false)
     */
    private $typeEvenement;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_pret", type="integer", nullable=true)
     */
    private $idPret;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_evenement", type="text", length=65535, nullable=true)
     */
    private $descEvenement;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_evenement", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvenement;

    /**
     * @var \BMG\gestBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="BMG\gestBundle\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="no_client", referencedColumnName="no_client")
     * })
     */
    private $noClient;



    /**
     * Set dateEvenement
     *
     * @param \DateTime $dateEvenement
     *
     * @return Evenement
     */
    public function setDateEvenement($dateEvenement)
    {
        $this->dateEvenement = $dateEvenement;

        return $this;
    }

    /**
     * Get dateEvenement
     *
     * @return \DateTime
     */
    public function getDateEvenement()
    {
        return $this->dateEvenement;
    }

    /**
     * Set typeEvenement
     *
     * @param string $typeEvenement
     *
     * @return Evenement
     */
    public function setTypeEvenement($typeEvenement)
    {
        $this->typeEvenement = $typeEvenement;

        return $this;
    }

    /**
     * Get typeEvenement
     *
     * @return string
     */
    public function getTypeEvenement()
    {
        return $this->typeEvenement;
    }

    /**
     * Set idPret
     *
     * @param integer $idPret
     *
     * @return Evenement
     */
    public function setIdPret($idPret)
    {
        $this->idPret = $idPret;

        return $this;
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
     * Set descEvenement
     *
     * @param string $descEvenement
     *
     * @return Evenement
     */
    public function setDescEvenement($descEvenement)
    {
        $this->descEvenement = $descEvenement;

        return $this;
    }

    /**
     * Get descEvenement
     *
     * @return string
     */
    public function getDescEvenement()
    {
        return $this->descEvenement;
    }

    /**
     * Get idEvenement
     *
     * @return integer
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * Set noClient
     *
     * @param \BMG\gestBundle\Entity\Client $noClient
     *
     * @return Evenement
     */
    public function setNoClient(\BMG\gestBundle\Entity\Client $noClient = null)
    {
        $this->noClient = $noClient;

        return $this;
    }

    /**
     * Get noClient
     *
     * @return \BMG\gestBundle\Entity\Client
     */
    public function getNoClient()
    {
        return $this->noClient;
    }
}
