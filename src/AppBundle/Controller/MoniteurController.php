<?php

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\Moniteur;
use AppBundle\Form\MoniteurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class MoniteurController extends Controller
{
    /**
     * @Route("/listMoniteur", name="listMoniteur")
     */
    public function listMoniteurAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $moniteur = $em->getRepository('AppBundle:Moniteur')->findALL();

        return $this->render("Moniteur/listMoniteur.html.twig",
            array('moniteur' => $moniteur));
    }
    /**
     * @Route("/ajoutMoniteur", name="ajoutMoniteur")
     */
    public function ajoutMoniteurAction(Request $request)
    {
        $moniteur = new Moniteur();
        $form = $this->createForm(MoniteurType::class,$moniteur);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($moniteur);
            $em->flush();
            return $this->redirect($this->generateUrl('listMoniteur'));
        }
        return $this->render("Moniteur/AjoutMoniteur.html.twig",
            array('form' => $form->createView()));
    }
    /**
     * @Route("/modifierMoniteur/{id}", name="modifierMoniteur")
     */
    public function modifierMoniteurAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $moniteur=$em->getRepository('AppBundle:Moniteur')->find($id);

        $form = $this->createForm(MoniteurType::class,$moniteur);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em->persist($moniteur);
            $em->flush();
            return $this->redirect($this->generateUrl('listMoniteur'));
        }
        return $this->render("Moniteur/AjoutMoniteur.html.twig",
            array('form' => $form->createView()));
    }

    /**
     * @Route("/supprimerMoniteur/{id}", name="supprimerMoniteur")
     */
    public function supprimerMoniteurAction(Request $request)
    {
        $id = $request->get('id');
        $em=$this->getDoctrine()->getManager();
        $moniteur = $em->getRepository(Moniteur::class)->find($id);

        if (!$moniteur) {
            throw $this->createNotFoundException('No moniteur found for id ');
        }

        $em->remove($moniteur);
        $em->flush();

        return $this->redirect($this->generateUrl('listMoniteur'));
    }
    /**
     * @Route("/rechercheMoniteur", name="rechercheMoniteur")
     */
    public function rechercheMoniteurAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $nom =$request->get('nom');
        if($nom){
            $Moniteur =$em->getRepository(Moniteur::class)->findBy(array('nom'=>$nom));
        } else{
            $Moniteur = $em->getRepository(Moniteur::class)->findAll();
        }

        return $this->render("Moniteur/RechercheMoniteur.html.twig",
            array('Moniteur'=>$Moniteur));
    }
}
