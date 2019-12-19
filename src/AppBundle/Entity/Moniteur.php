<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Moniteur
 *
 * @ORM\Table(name="moniteur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MoniteurRepository")
 */
class Moniteur
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
     * @ORM\Column(name="NOM", type="string", length=255)
     */
    private $nom;



    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Téléphone", type="string", length=255)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=255)
     */
    private $Email;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Planning", mappedBy="moniteur")
     * @ORM\JoinColumn(name="Moniteur_nom", referencedColumnName="id")
     */
    private  $plannings;

    public function _constructor(){
        $this->plannings=new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getPlannings()
    {
        return $this->plannings;
    }

    /**
     * @param mixed $plannings
     */
    public function setPlannings($plannings)
    {
        $this->plannings = $plannings;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Moniteur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }


    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Moniteur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param string $Email
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }




    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Moniteur
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

}

