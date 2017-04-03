<?php

namespace BMG\gestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ouvrage
 *
 * @ORM\Table(name="ouvrage", indexes={@ORM\Index(name="idx_fk_ouvrage_genre", columns={"code_genre"})})
 * @ORM\Entity(repositoryClass="BMG\gestBundle\Repository\OuvrageRepository")
 */
class Ouvrage
{
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=128, nullable=false)
     */
    private $titre;

    /**
     * @var integer
     *
     * @ORM\Column(name="salle", type="integer", nullable=true)
     */
    private $salle;

    /**
     * @var string
     *
     * @ORM\Column(name="rayon", type="string", length=2, nullable=true)
     */
    private $rayon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_acquisition", type="date", nullable=true)
     */
    private $dateAcquisition;

    /**
     * @var integer
     *
     * @ORM\Column(name="no_ouvrage", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $noOuvrage;

    /**
     * @var \BMG\gestBundle\Entity\Genre
     *
     * @ORM\ManyToOne(targetEntity="BMG\gestBundle\Entity\Genre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_genre", referencedColumnName="code_genre")
     * })
     */
    private $genre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="BMG\gestBundle\Entity\Auteur", inversedBy="ouvrages")
     * @ORM\JoinTable(name="auteur_ouvrage",
     *   joinColumns={
     *     @ORM\JoinColumn(name="no_ouvrage", referencedColumnName="no_ouvrage")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_auteur", referencedColumnName="id_auteur")
     *   }
     * )
     */
    private $auteurs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->auteurs = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Ouvrage
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
     * Set salle
     *
     * @param integer $salle
     *
     * @return Ouvrage
     */
    public function setSalle($salle)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle
     *
     * @return integer
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * Set rayon
     *
     * @param string $rayon
     *
     * @return Ouvrage
     */
    public function setRayon($rayon)
    {
        $this->rayon = $rayon;

        return $this;
    }

    /**
     * Get rayon
     *
     * @return string
     */
    public function getRayon()
    {
        return $this->rayon;
    }

    /**
     * Set dateAcquisition
     *
     * @param \DateTime $dateAcquisition
     *
     * @return Ouvrage
     */
    public function setDateAcquisition($dateAcquisition)
    {
        $this->dateAcquisition = $dateAcquisition;

        return $this;
    }

    /**
     * Get dateAcquisition
     *
     * @return \DateTime
     */
    public function getDateAcquisition()
    {
        return $this->dateAcquisition;
    }

    /**
     * Get noOuvrage
     *
     * @return integer
     */
    public function getNoOuvrage()
    {
        return $this->noOuvrage;
    }

    /**
     * Set genre
     *
     * @param \BMG\gestBundle\Entity\Genre $genre
     *
     * @return Ouvrage
     */
    public function setGenre(\BMG\gestBundle\Entity\Genre $genre = null)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return \BMG\gestBundle\Entity\Genre
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Add auteur
     *
     * @param \BMG\gestBundle\Entity\Auteur $auteur
     *
     * @return Ouvrage
     */
    public function addAuteur(\BMG\gestBundle\Entity\Auteur $auteur)
    {
        $auteur->addOuvrage($this);
        $this->auteurs[] = $auteur;

        return $this;
    }

    /**
     * Remove auteur
     *
     * @param \BMG\gestBundle\Entity\Auteur $auteur
     */
    public function removeAuteur(\BMG\gestBundle\Entity\Auteur $auteur)
    {
        $this->auteurs->removeElement($auteur);
    }

    /**
     * Get auteurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuteurs()
    {
        return $this->auteurs;
    }
}
