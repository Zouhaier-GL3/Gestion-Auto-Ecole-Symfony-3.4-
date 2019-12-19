<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Candidat
 *
 * @ORM\Table(name="candidat")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CandidatRepository")
 */
class Candidat
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
     * @Assert\File(maxSize="6000000")
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    public $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=255)
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Payment")
     * @ORM\JoinColumn(name="CandidatPayment",referencedColumnName="Candidat_nom")
     */
    private $Nom;

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=255)
     */
    private $Adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Téléphone", type="string", length=255)
     */
    private $telephone;


    /**
     * @var string
     *
     * @ORM\Column(name="Inscrioption", type="date")
     */
    private $Inscrioption;

    /**
     * @var string
     *
     * @ORM\Column(type="string",length=255)
     */
    private $Email;


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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Planning", mappedBy="candidat")
     * @ORM\JoinColumn(name="Candidat_nom",referencedColumnName="nom")
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
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }



    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../web/images/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/documents';
    }
    public function upload()
    {
        // la propriété « file » peut être vide si le champ n'est pas requis
        if (null === $this->file) {
            return;
        }

        // utilisez le nom de fichier original ici mais
        // vous devriez « l'assainir » pour au moins éviter
        // quelconques problèmes de sécurité

        // la méthode « move » prend comme arguments le répertoire cible et
        // le nom de fichier cible où le fichier doit être déplacé
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

        // définit la propriété « path » comme étant le nom de fichier où vous
        // avez stocké le fichier
        $this->path = $this->file->getClientOriginalName();

        // « nettoie » la propriété « file » comme vous n'en aurez plus besoin
        $this->file = null;
    }



    /**
     * @return string
     */
    public function getNom()
    {
        return $this->Nom;
    }

    /**
     * @param string $Nom
     */
    public function setNom($Nom)
    {
        $this->Nom = $Nom;
    }


    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->Adresse;
    }

    /**
     * @param string $Adresse
     */
    public function setAdresse($Adresse)
    {
        $this->Adresse = $Adresse;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }



    /**
     * @return string
     */
    public function getInscrioption()
    {
        return $this->Inscrioption;
    }

    /**
     * @param string $Inscrioption
     */
    public function setInscrioption($Inscrioption)
    {
        $this->Inscrioption = $Inscrioption;
    }

    /**
     * @return mixed
     */
    public function getNomImage()
    {
        return $this->nomImage;
    }

    /**
     * @param mixed $nomImage
     *
     * @return Candidat
     */
    public function setNomImage($nomImage)
    {
        $this->nomImage = $nomImage;
    }


}

