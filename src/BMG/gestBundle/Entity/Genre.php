<?php

namespace BMG\gestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity(repositoryClass="BMG\gestBundle\Repository\GenreRepository")
 */
class Genre
{
    /**
     * @var string
     *
     * @ORM\Column(name="lib_genre", type="string", length=50, nullable=false)
     */
    private $libGenre;

    /**
     * @var string
     *
     * @ORM\Column(name="code_genre", type="string", length=3)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $codeGenre;



    /**
     * Set libGenre
     *
     * @param string $libGenre
     *
     * @return Genre
     */
    public function setLibGenre($libGenre)
    {
        $this->libGenre = $libGenre;

        return $this;
    }

    /**
     * Get libGenre
     *
     * @return string
     */
    public function getLibGenre()
    {
        return $this->libGenre;
    }

    /**
     * Get codeGenre
     *
     * @return string
     */
    public function getCodeGenre()
    {
        return $this->codeGenre;
    }

    /**
     * Set codeGenre
     *
     * @param string $codeGenre
     *
     * @return Genre
     */
    public function setCodeGenre($codeGenre)
    {
        $this->codeGenre = $codeGenre;

        return $this;
    }
}
