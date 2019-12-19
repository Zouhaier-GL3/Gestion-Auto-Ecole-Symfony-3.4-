<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Planning
 *
 * @ORM\Table(name="planning")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlanningRepository")
 */
class Planning
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
     * @ORM\Column(name="date", type="date")
     */
    private $date;
    /**
* @ORM\ManyToOne(targetEntity="AppBundle\Entity\Candidat", inversedBy="plannings")
* @ORM\JoinColumn(name="Candidat_nom",referencedColumnName="id")
*/
   private $candidat;

    /**
* @ORM\ManyToOne(targetEntity="AppBundle\Entity\Moniteur")
* @ORM\JoinColumn(name="Moniteur_nom",referencedColumnName="id")
*/
    private $moniteur;
    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Voiture")
    * @ORM\JoinColumn(name="Voiture_marque",referencedColumnName="id")
     */

    private $voiture;

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
     * Set Date_Examen
     *
     * @param string $Date_Examen
     *
     * @return Planning
     */
    public function setdate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get Date_Examen
     *
     * @return string
     */
    public function getdate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getCandidat()
    {
        return $this->candidat;
    }

    /**
     * @param mixed $candidat
     */
    public function setCandidat($candidat)
    {
        $this->candidat = $candidat;
    }

    /**
     * @return mixed
     */
    public function getMoniteur()
    {
        return $this->moniteur;
    }

    /**
     * @param mixed $moniteur
     */
    public function setMoniteur($moniteur)
    {
        $this->moniteur = $moniteur;
    }

    /**
     * @return mixed
     */
    public function getVoiture()
    {
        return $this->voiture;
    }

    /**
     * @param mixed $voiture
     */
    public function setVoiture($voiture)
    {
        $this->voiture = $voiture;
    }

}

