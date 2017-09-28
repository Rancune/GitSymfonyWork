<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cinema
 *
 * @ORM\Table(name="cinema")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CinemaRepository")
 */
class Cinema
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="titre", type="string", length=255)
   */
  private $titre;

  /**
   * @var string
   *
   * @ORM\Column(name="contenu", type="text")
   */
  private $contenu;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="moviereleasedate", type="datetime")
   */
  private $moviereleasedate;

  /**
   * @ORM\Column(type="boolean")
   */
  private $actif;

  public function __construct()
  {
    $this->actif = true;
  }


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Cinema
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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Cinema
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set moviereleasedate
     *
     * @param \DateTime $moviereleasedate
     *
     * @return Cinema
     */
    public function setMoviereleasedate($moviereleasedate)
    {
        $this->moviereleasedate = $moviereleasedate;

        return $this;
    }

    /**
     * Get moviereleasedate
     *
     * @return \DateTime
     */
    public function getMoviereleasedate()
    {
        return $this->moviereleasedate;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Cinema
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean
     */
    public function getActif()
    {
        return $this->actif;
    }
}
