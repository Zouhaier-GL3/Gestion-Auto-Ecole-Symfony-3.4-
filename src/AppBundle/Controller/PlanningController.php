<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Candidat;
use AppBundle\Entity\Moniteur;
use AppBundle\Entity\Voiture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Planning;
use AppBundle\Form\PlanningType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PlanningController extends Controller
{
    /**
     * @Route("/listPlanning", name="listPlanning")
     */
    public function listPlanningAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $strDate =$request->get('date');
        if($strDate){
            $date = \DateTime::createFromFormat('d-m-Y', $strDate);
            $plannings =$em->getRepository(Planning::class)->findBy(array('date'=>$date));
        } else{
            $plannings = $em->getRepository(Planning::class)->findAll();
        }
        //$planning = $em->getRepository('AppBundle:Planning')->findALL();

        return $this->render("Planning/plan.html.twig",
            array('planning' => $plannings));
    }
    /**
     * @Route("/ajoutPlanning", name="ajoutPlanning")
     */
    public function ajoutPlanningAction(Request $request)
    {
        $Planning = new Planning();
        $form = $this->createForm(PlanningType::class,$Planning);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Planning);
            $em->flush();
            return $this->redirect($this->generateUrl('listPlanning'));
        }
        return $this->render("Planning/ajoutPlan.html.twig",
            array('form' => $form->createView()));
    }

    /**
     * @Route("/modifierP/{id}", name="modifierP")
     */
    public function modifierPlanningAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $planning=$em->getRepository('AppBundle:Planning')->find($id);

        $form = $this->createForm(PlanningType::class,$planning);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em->persist($planning);
            $em->flush();
            return $this->redirect($this->generateUrl('listPlanning'));
        }
        return $this->render("Planning/ajoutPlan.html.twig",
            array('form' => $form->createView()));
    }

    /**
     * @Route("/supprimerP/{id}", name="supprimerP")
     */
    public function supprimerPlanningAction(Request $request)
    {
        $id = $request->get('id');
        $em=$this->getDoctrine()->getManager();
        $planning = $em->getRepository(Planning::class)->find($id);

        if (!$planning) {
            throw $this->createNotFoundException('No Planning found for id ');
        }

        $em->remove($planning);
        $em->flush();

        return $this->redirect($this->generateUrl('listPlanning'));
    }
    /**
     * @Route("/recherchePlanning", name="recherchePlanning")
     */
    public function recherchePlanningAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $date =$request->get('date');
        if($date){
            $plannings =$em->getRepository(Planning::class)->findBy(array('date'=>$date));
        } else{
            $plannings = $em->getRepository(Planning::class)->findAll();
        }

        return $this->render("Planning/plan.html.twig",
            array('planning'=>$plannings));
    }
    /**
     * @Route("/list", name="list")
     */
    public function listAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $strDate =$request->get('date');
        if($strDate){
            $date = \DateTime::createFromFormat('d-m-Y', $strDate);
            $plannings =$em->getRepository(Planning::class)->findBy(array('date'=>$date));
        } else{
            $plannings = $em->getRepository(Planning::class)->findAll();
        }
        //$planning = $em->getRepository('AppBundle:Planning')->findALL();

        return $this->render("Planning/plan2.html.twig",
            array('planning' => $plannings));
    }
}
