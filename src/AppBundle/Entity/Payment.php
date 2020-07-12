<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaymentRepository")
 */
class Payment
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Candidat", inversedBy="payment")
     * @ORM\JoinColumn(name="Candidat_nom",referencedColumnName="id")
     */
    private $candidat;
    /**
     * @var string
     *
     * @ORM\Column(type="string",length=255)
     */
    private $mantant;
    /**
     * @var string
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return string
     */
    public function getMantant()
    {
        return $this->mantant;
    }

    /**
     * @param string $mantant
     */
    public function setMantant($mantant)
    {
        $this->mantant = $mantant;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }



}


