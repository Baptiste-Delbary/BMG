<?php

namespace BMG\gestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auteur
 *
 * @ORM\Table(name="auteur")
 * @ORM\Entity(repositoryClass="BMG\gestBundle\Repository\AuteurRepository")
 */
class Auteur
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_auteur", type="string", length=128, nullable=false)
     */
    private $nomAuteur;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_auteur", type="string", length=128, nullable=true)
     */
    private $prenomAuteur;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=128, nullable=true)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="string", length=255, nullable=true)
     */
    private $notes;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_auteur", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAuteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="BMG\gestBundle\Entity\Ouvrage", mappedBy="auteurs")
     */
    private $ouvrages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ouvrages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nomAuteur
     *
     * @param string $nomAuteur
     *
     * @return Auteur
     */
    public function setNomAuteur($nomAuteur)
    {
        $this->nomAuteur = $nomAuteur;

        return $this;
    }

    /**
     * Get nomAuteur
     *
     * @return string
     */
    public function getNomAuteur()
    {
        return $this->nomAuteur;
    }

    /**
     * Set prenomAuteur
     *
     * @param string $prenomAuteur
     *
     * @return Auteur
     */
    public function setPrenomAuteur($prenomAuteur)
    {
        $this->prenomAuteur = $prenomAuteur;

        return $this;
    }

    /**
     * Get prenomAuteur
     *
     * @return string
     */
    public function getPrenomAuteur()
    {
        return $this->prenomAuteur;
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Auteur
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Auteur
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Get idAuteur
     *
     * @return integer
     */
    public function getIdAuteur()
    {
        return $this->idAuteur;
    }

    /**
     * Add ouvrage
     *
     * @param \BMG\gestBundle\Entity\Ouvrage $ouvrage
     *
     * @return Auteur
     */
    public function addOuvrage(\BMG\gestBundle\Entity\Ouvrage $ouvrage)
    {
        $this->ouvrages[] = $ouvrage;

        return $this;
    }

    /**
     * Remove ouvrage
     *
     * @param \BMG\gestBundle\Entity\Ouvrage $ouvrage
     */
    public function removeOuvrage(\BMG\gestBundle\Entity\Ouvrage $ouvrage)
    {
        $this->ouvrages->removeElement($ouvrage);
    }

    /**
     * Get ouvrages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOuvrages()
    {
        return $this->ouvrages;
    }
}
