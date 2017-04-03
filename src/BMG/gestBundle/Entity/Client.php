<?php

namespace BMG\gestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="BMG\gestBundle\Repository\ClientRepository")
 */
class Client
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_client", type="string", length=50, nullable=false)
     */
    private $nomClient;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="rue_client", type="string", length=50, nullable=true)
     */
    private $rueClient;

    /**
     * @var string
     *
     * @ORM\Column(name="code_post", type="string", length=5, nullable=false)
     */
    private $codePost;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50, nullable=false)
     */
    private $ville;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_inscr", type="datetime", nullable=false)
     */
    private $dateInscr;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=50, nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=10, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="mel", type="string", length=128, nullable=true)
     */
    private $mel;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_client", type="string", length=1, nullable=false)
     */
    private $etatClient = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="caution", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $caution = '50.00';

    /**
     * @var string
     *
     * @ORM\Column(name="caution_encaissee", type="string", length=1, nullable=false)
     */
    private $cautionEncaissee = 'b\'0\'';

    /**
     * @var string
     *
     * @ORM\Column(name="montant_compte", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $montantCompte = '0.00';

    /**
     * @var integer
     *
     * @ORM\Column(name="no_client", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $noClient;



    /**
     * Set nomClient
     *
     * @param string $nomClient
     *
     * @return Client
     */
    public function setNomClient($nomClient)
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    /**
     * Get nomClient
     *
     * @return string
     */
    public function getNomClient()
    {
        return $this->nomClient;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Client
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
     * Set rueClient
     *
     * @param string $rueClient
     *
     * @return Client
     */
    public function setRueClient($rueClient)
    {
        $this->rueClient = $rueClient;

        return $this;
    }

    /**
     * Get rueClient
     *
     * @return string
     */
    public function getRueClient()
    {
        return $this->rueClient;
    }

    /**
     * Set codePost
     *
     * @param string $codePost
     *
     * @return Client
     */
    public function setCodePost($codePost)
    {
        $this->codePost = $codePost;

        return $this;
    }

    /**
     * Get codePost
     *
     * @return string
     */
    public function getCodePost()
    {
        return $this->codePost;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Client
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set dateInscr
     *
     * @param \DateTime $dateInscr
     *
     * @return Client
     */
    public function setDateInscr($dateInscr)
    {
        $this->dateInscr = $dateInscr;

        return $this;
    }

    /**
     * Get dateInscr
     *
     * @return \DateTime
     */
    public function getDateInscr()
    {
        return $this->dateInscr;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Client
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Client
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set mel
     *
     * @param string $mel
     *
     * @return Client
     */
    public function setMel($mel)
    {
        $this->mel = $mel;

        return $this;
    }

    /**
     * Get mel
     *
     * @return string
     */
    public function getMel()
    {
        return $this->mel;
    }

    /**
     * Set etatClient
     *
     * @param string $etatClient
     *
     * @return Client
     */
    public function setEtatClient($etatClient)
    {
        $this->etatClient = $etatClient;

        return $this;
    }

    /**
     * Get etatClient
     *
     * @return string
     */
    public function getEtatClient()
    {
        return $this->etatClient;
    }

    /**
     * Set caution
     *
     * @param string $caution
     *
     * @return Client
     */
    public function setCaution($caution)
    {
        $this->caution = $caution;

        return $this;
    }

    /**
     * Get caution
     *
     * @return string
     */
    public function getCaution()
    {
        return $this->caution;
    }

    /**
     * Set cautionEncaissee
     *
     * @param string $cautionEncaissee
     *
     * @return Client
     */
    public function setCautionEncaissee($cautionEncaissee)
    {
        $this->cautionEncaissee = $cautionEncaissee;

        return $this;
    }

    /**
     * Get cautionEncaissee
     *
     * @return string
     */
    public function getCautionEncaissee()
    {
        return $this->cautionEncaissee;
    }

    /**
     * Set montantCompte
     *
     * @param string $montantCompte
     *
     * @return Client
     */
    public function setMontantCompte($montantCompte)
    {
        $this->montantCompte = $montantCompte;

        return $this;
    }

    /**
     * Get montantCompte
     *
     * @return string
     */
    public function getMontantCompte()
    {
        return $this->montantCompte;
    }

    /**
     * Get noClient
     *
     * @return integer
     */
    public function getNoClient()
    {
        return $this->noClient;
    }
}
