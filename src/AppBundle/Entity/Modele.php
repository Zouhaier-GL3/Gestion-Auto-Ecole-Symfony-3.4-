<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 */
class Modele
{
/**
 * @var int
 *
 * @ORM\GeneratedValue(strategy="AUTO")
 * @ORM\Id
 * @ORM\Column(name="id", type="integer")
 */
private $id;
/**
 * @var string
 *
 * @ORM\Column(type="string",length=255)
 */
private $libelle;
/**
 * @var string
 *
 * @ORM\Column(type="string",length=255)
 */
private $pays;
    /**
     * @var string
     *
     * @ORM\Column(type="string",length=255)
     */
private $couleur;

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $pays
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * @param string $couleur
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    }


}