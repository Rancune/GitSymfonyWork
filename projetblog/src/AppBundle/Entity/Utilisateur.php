<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
* @ORM\Entity(repositoryClass="AppBundle\Repository\UtilisateurRepository")
* @ORM\Table(name="utilisateur")
* @UniqueEntity("pseudo")
* @UniqueEntity("email")
*/

class Utilisateur
{

  /**
  * @ORM\Column(type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  private $id;

  /**
  * @ORM\Column(type="string", length=30)
  * @Assert\Length(min=3, max=30, minMessage="le pseudo doit avoir {{ limit }} caracteres minimum",
  *  maxMessage="Le pseudo doit être de {{ limit }} caractères maximum.")
  *
  * @Assert\NotNull(message="Vous devez remplir le champ pseudo.")
  */
  private $pseudo;

  /**
  * @ORM\Column(type="string", length=4096)
  */
  private $mdp;

  /**
  * @ORM\Column(type="string", length=255)
  */
  private $email;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="datecreation", type="datetime")
   */
  private $datecreation;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="datemodification", type="datetime")
   */
  private $datemodification;

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
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return Utilisateur
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     *
     * @return Utilisateur
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Utilisateur
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     *
     * @return Utilisateur
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;

        return $this;
    }

    /**
     * Get datemodification
     *
     * @return \DateTime
     */
    public function getDatemodification()
    {
        return $this->datemodification;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Utilisateur
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
