<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ListController extends Controller
{
    /**
     * @Route("/welcome", name="welcome")
     */
    public function showAction(Request $request)
    {
        return $this->render('auth/show.html.twig');
    }
    /**
     * @Route("/welcome2", name="welcome2")
     */
    public function show2Action(Request $request)
    {
        return $this->render('auth/show2.html.twig');
    }

    /**
     * @Route("/plan2", name="plan2")
     */
    public function plan2Action()
    {
        return $this->render('Planning/plan2.html.twig');
    }

    /**
     * @Route("/payment", name="payment")
     */
    public function paymentAction()
    {
        return $this->render('auth/payment.html.twig');
    }
    /**
     * @Route("/payment2", name="payment2")
     */
    public function payment2Action()
    {
        return $this->render(':Planning:plan2.html.twig');
    }
    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueilAction()
    {
        return $this->render('auth/accueil.html.twig');
    }
    /**
     * @Route("/CandidatCompt", name="CandidatCompt")
     */
    public function accueil2Action()
    {
        return $this->render('auth/accueil2.html.twig');
    }

    /**
     * @Route("/listLogin", name="accueil2")
     */
    public function litlogAction()
    {
        return $this->render('auth/listLogin.html.twig');
    }
}