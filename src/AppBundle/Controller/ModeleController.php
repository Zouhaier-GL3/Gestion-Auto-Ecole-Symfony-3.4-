<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\Modele;
use AppBundle\Form\ModeleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ModeleController extends Controller
{
    /**
     * @Route("/listModele", name="listModele")
     */
    public function listAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $modele = $em->getRepository('AppBundle:Modele')->findALL();

        return $this->render("Model/list.html.twig",
            array('modele' => $modele));
    }
    /**
     * @Route("/ajoutModele", name="ajoutModele")
     */
    public function ajoutAction(Request $request)
    {
        $modele = new Modele();
        $form = $this->createForm(ModeleType::class,$modele);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modele);
            $em->flush();
            return $this->redirect($this->generateUrl('listModele'));
        }
        return $this->render("Model/Ajout.html.twig",
            array('form' => $form->createView()));
    }
    /**
     * @Route("/modifierM/{id}", name="modifierM")
     */
    public function modifierMAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $modele=$em->getRepository('AppBundle:Modele')->find($id);

        $form = $this->createForm(ModeleType::class,$modele);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em->persist($modele);
            $em->flush();
            return $this->redirect($this->generateUrl('listModele'));
        }
        return $this->render("Model/Ajout.html.twig",
            array('form' => $form->createView()));
    }

    /**
     * @Route("/supprimerM/{id}", name="supprimerM")
     */
    public function supprimerMAction(Request $request)
    {
        $id = $request->get('id');
        $em=$this->getDoctrine()->getManager();
        $modele = $em->getRepository(Modele::class)->find($id);

        if (!$modele) {
            throw $this->createNotFoundException('No modele found for id ');
        }

        $em->remove($modele);
        $em->flush();

        return $this->redirect($this->generateUrl('listModele'));
    }
    /**
     * @Route("/rechercheModele", name="rechercheModele")
     */
    public function rechercheAction(Request $request)
    {
       $em=$this->getDoctrine()->getManager();
       $modele = $em->getRepository(Modele::class)->findAll();
       if($request->isMethod('post'))
       {
           $libelle =$request->get('libelle');
           $modele=$em->getRepository("AppBundle:Modele")->findBy(array('libelle'=>$libelle));
        }
      return $this->render("Model/Recherche.html.twig",
            array('modele'=>$modele));
    }


}
