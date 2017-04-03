<?php

namespace BMG\gestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Operation
 *
 * @ORM\Table(name="operation", indexes={@ORM\Index(name="idx_fk_operation_client", columns={"no_client"}), @ORM\Index(name="idx_fk_operation_date_operation", columns={"date_operation"}), @ORM\Index(name="idx_fk_operation_type_operation", columns={"type_operation"})})
 * @ORM\Entity(repositoryClass="BMG\gestBundle\Repository\OperationRepository")
 */
class Operation
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_operation", type="datetime", nullable=false)
     */
    private $dateOperation;

    /**
     * @var string
     *
     * @ORM\Column(name="type_operation", type="string", length=1, nullable=false)
     */
    private $typeOperation;

    /**
     * @var string
     *
     * @ORM\Column(name="montant_operation", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $montantOperation;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_operation", type="string", length=50, nullable=false)
     */
    private $intituleOperation;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_operation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOperation;

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
     * Set dateOperation
     *
     * @param \DateTime $dateOperation
     *
     * @return Operation
     */
    public function setDateOperation($dateOperation)
    {
        $this->dateOperation = $dateOperation;

        return $this;
    }

    /**
     * Get dateOperation
     *
     * @return \DateTime
     */
    public function getDateOperation()
    {
        return $this->dateOperation;
    }

    /**
     * Set typeOperation
     *
     * @param string $typeOperation
     *
     * @return Operation
     */
    public function setTypeOperation($typeOperation)
    {
        $this->typeOperation = $typeOperation;

        return $this;
    }

    /**
     * Get typeOperation
     *
     * @return string
     */
    public function getTypeOperation()
    {
        return $this->typeOperation;
    }

    /**
     * Set montantOperation
     *
     * @param string $montantOperation
     *
     * @return Operation
     */
    public function setMontantOperation($montantOperation)
    {
        $this->montantOperation = $montantOperation;

        return $this;
    }

    /**
     * Get montantOperation
     *
     * @return string
     */
    public function getMontantOperation()
    {
        return $this->montantOperation;
    }

    /**
     * Set intituleOperation
     *
     * @param string $intituleOperation
     *
     * @return Operation
     */
    public function setIntituleOperation($intituleOperation)
    {
        $this->intituleOperation = $intituleOperation;

        return $this;
    }

    /**
     * Get intituleOperation
     *
     * @return string
     */
    public function getIntituleOperation()
    {
        return $this->intituleOperation;
    }

    /**
     * Get idOperation
     *
     * @return integer
     */
    public function getIdOperation()
    {
        return $this->idOperation;
    }

    /**
     * Set noClient
     *
     * @param \BMG\gestBundle\Entity\Client $noClient
     *
     * @return Operation
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
