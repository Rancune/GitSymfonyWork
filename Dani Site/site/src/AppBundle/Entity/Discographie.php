<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discographie
 *
 * @ORM\Table(name="discographie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiscographieRepository")
 */
class Discographie
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
   * @ORM\Column(name="discreleasedate", type="datetime")
   */
  private $discreleasedate;

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
     * @return Discographie
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
     * @return Discographie
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
     * Set discreleasedate
     *
     * @param \DateTime $discreleasedate
     *
     * @return Discographie
     */
    public function setDiscreleasedate($discreleasedate)
    {
        $this->discreleasedate = $discreleasedate;

        return $this;
    }

    /**
     * Get discreleasedate
     *
     * @return \DateTime
     */
    public function getDiscreleasedate()
    {
        return $this->discreleasedate;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Discographie
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
