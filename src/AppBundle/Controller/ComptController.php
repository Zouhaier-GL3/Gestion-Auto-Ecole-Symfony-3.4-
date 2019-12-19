<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Entity\Candidat;
use AppBundle\Form\CandidatType;
use AppBundle\Entity\Moniteur;
use AppBundle\Form\MoniteurType;
use AppBundle\Entity\Voiture;
use AppBundle\Form\VoitureType;

class ComptController extends Controller
{

    /**
     * @Route("/listCandidat", name="listCandidat")
     */
    public function listCandidatAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $Candidat = $em->getRepository('AppBundle:Candidat')->findALL();

        return $this->render("Candidat/listCandidat.html.twig",
            array('Candidat' => $Candidat));
    }

}