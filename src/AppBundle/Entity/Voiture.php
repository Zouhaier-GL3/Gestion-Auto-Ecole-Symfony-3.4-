<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Voiture
 *
 * @ORM\Table(name="voiture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VoitureRepository")
 */
class Voiture
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
     * @ORM\Column(name="Serie", type="string", length=255)
     */
    private $serie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateMiseCirculation", type="string")
     */
    private $dateMiseCirculation;

    /**
     * @var string
     *
     * @ORM\Column(name="Marque", type="string", length=255)
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Modele")
     * @ORM\JoinColumn(name="marque",referencedColumnName="id")
     */
    private $marque;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Planning", mappedBy="voiture")
     * @ORM\JoinColumn(name="Voiture_nom",referencedColumnName="nom")
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
     * Set serie
     *
     * @param string $serie
     *
     * @return Voiture
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return string
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set dateMiseCirculation
     *
     * @param \DateTime $dateMiseCirculation
     *
     * @return Voiture
     */
    public function setDateMiseCirculation($dateMiseCirculation)
    {
        $this->dateMiseCirculation = $dateMiseCirculation;

        return $this;
    }

    /**
     * Get dateMiseCirculation
     *
     * @return \DateTime
     */
    public function getDateMiseCirculation()
    {
        return $this->dateMiseCirculation;
    }

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Voiture
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }
}

