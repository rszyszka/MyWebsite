<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request)
    {
        $data = $request->request->get("searchinput");
        $req = $data;
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            "SELECT a FROM AppBundle:Announcements a INNER JOIN a.requirements r WHERE r.name LIKE :req OR a.title LIKE :data OR a.text LIKE :data"
        )->setParameter('data', '%'.$data.'%')->setParameter('req', $req.'%');

        $result = $query->getResult();
        return $this->render('AppBundle:Default:searcher.html.twig', array('result' => $result));
    }

    /**
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/addQualifications/{id}", name="addQualifications")
     */
    public function addQualificationsAction(Request $request, User $user)
    {
        $form = $this->createForm('AppBundle\Form\AddQualificationsType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('account', array('id' => $user->getId()));
        }

        return $this->render('AppBundle:Default:addqualifications.html.twig', array(
            'user' => $user,
            'form' => $form->createView()
        ));
    }
}
