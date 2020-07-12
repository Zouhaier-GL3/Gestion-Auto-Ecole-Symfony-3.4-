<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Candidat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Payment;
use AppBundle\Form\PaymentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PaymentController extends Controller
{
    /**
     * @Route("/listPayment", name="listPayment")
     */
    public function listPaymentAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $strDate =$request->get('date');
        if($strDate){
            $date = \DateTime::createFromFormat('d-m-Y', $strDate);
            $Payment =$em->getRepository(Payment::class)->findBy(array('date'=>$date));
        } else{
            $Payment = $em->getRepository(Payment::class)->findAll();
        }
        //$Payment = $em->getRepository('AppBundle:Payment')->findALL();

        return $this->render("Payment/payment.html.twig",
            array('Payment' => $Payment));
    }
    /**
     * @Route("/ajoutPayment", name="ajoutPayment")
     */
    public function ajoutPlanningAction(Request $request)
    {
        $Planning = new Payment();
        $form = $this->createForm(PaymentType::class,$Planning);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Planning);
            $em->flush();
            return $this->redirect($this->generateUrl('listPayment'));
        }
        return $this->render("Payment/ajoutPayment.html.twig",
            array('form' => $form->createView()));
    }

    /**
     * @Route("/modifierPay/{id}", name="modifierPay")
     */
    public function modifierPaymentAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $Payment=$em->getRepository('AppBundle:Payment')->find($id);

        $form = $this->createForm(PaymentType::class,$Payment);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em->persist($Payment);
            $em->flush();
            return $this->redirect($this->generateUrl('listPayment'));
        }
        return $this->render("Payment/ajoutPayment.html.twig",
            array('form' => $form->createView()));
    }

    /**
     * @Route("/supprimerPay/{id}", name="supprimerPay")
     */
    public function supprimerPlanningAction(Request $request)
    {
        $id = $request->get('id');
        $em=$this->getDoctrine()->getManager();
        $Payment = $em->getRepository(Payment::class)->find($id);

        if (!$Payment) {
            throw $this->createNotFoundException('No Payment found for id ');
        }

        $em->remove($Payment);
        $em->flush();

        return $this->redirect($this->generateUrl('listPayment'));
    }
    /**
     * @Route("/recherchepayment", name="recherchepayment")
     */
    public function recherchecandidatAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $Nom =$request->get('Nom');
        if($Nom){
            $payment =$em->getRepository(payment::class)->findBy(array('Nom'=>$Nom));
        } else{
            $payment = $em->getRepository(payment::class)->findAll();
        }

        return $this->render(":Payment:payment.html.twig",
            array('Payment'=>$payment));
    }
    /**
     * @Route("/listPay", name="listPay")
     */
    public function listAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $strDate =$request->get('date');
        if($strDate){
            $date = \DateTime::createFromFormat('d-m-Y', $strDate);
            $Payment =$em->getRepository(payment::class)->findBy(array('date'=>$date));
        } else{
            $Payment = $em->getRepository(payment::class)->findAll();
        }
        //$planning = $em->getRepository('AppBundle:Planning')->findALL();

        return $this->render("Payment/payment2.html.twig",
            array('Payment' => $Payment));
    }
}
