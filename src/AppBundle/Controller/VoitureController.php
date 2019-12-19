<?php

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Voiture;
use AppBundle\Form\VoitureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class VoitureController extends Controller
{
    /**
     * @Route("/listVoiture", name="listVoiture")
     */
    public function listVoitureAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $voiture = $em->getRepository('AppBundle:Voiture')->findALL();

        return $this->render("Voiture/ListVoiture.html.twig",
            array('voiture' => $voiture));
    }
    /**
     * @Route("/ajoutVoiture", name="ajoutVoiture")
     */
    public function ajoutVoitureAction(Request $request)
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class,$voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($voiture);
            $em->flush();
            return $this->redirect($this->generateUrl('listVoiture'));
        }
        return $this->render("Voiture/AjoutVoiturehtml.twig",
            array('form' => $form->createView()));
    }

    /**
     * @Route("/modifierV/{id}", name="modifierV")
     */
    public function modifierVoitureAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $voiture=$em->getRepository('AppBundle:Voiture')->find($id);

        $form = $this->createForm(VoitureType::class,$voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em->persist($voiture);
            $em->flush();
            return $this->redirect($this->generateUrl('listVoiture'));
        }
        return $this->render("Voiture/AjoutVoiturehtml.twig",
            array('form' => $form->createView()));
    }

    /**
     * @Route("/supprimerV/{id}", name="supprimerV")
     */
    public function supprimerVoitureAction(Request $request)
    {
        $id = $request->get('id');
        $em=$this->getDoctrine()->getManager();
        $voiture = $em->getRepository(Voiture::class)->find($id);

        if (!$voiture) {
            throw $this->createNotFoundException('No voiture found for id ');
        }

        $em->remove($voiture);
        $em->flush();

        return $this->redirect($this->generateUrl('listVoiture'));
    }
    /**
     * @Route("/rechercheVoiture", name="rechercheVoiture")
     */
    public function rechercheVoitureAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $voiture = $em->getRepository(Voiture::class)->findAll();
        if($request->isMethod('post'))
        {
            $marque =$request->get('Marque');
            $voiture =$em->getRepository("AppBundle:Voiture")->findBy(array('marque'=>$marque));
        }
        return $this->render("Voiture/RechercheVoiture.html.twig",
            array('voiture'=>$voiture));
    }
}
