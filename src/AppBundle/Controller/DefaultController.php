<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/info", name="info")
     */
    public function infoAction()
    {
        return $this->render('AppBundle:Default:info.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/account", name="account")
     */
    public function myAccountAction()
    {
        return $this->render('AppBundle:Default:myaccount.html.twig');
    }
}
