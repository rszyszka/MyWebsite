<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Announcements;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Announcement controller.
 *
 * @Route("announcements")
 */
class AnnouncementsController extends Controller
{
    /**
     * Lists all announcement entities.
     *
     * @Route("/", name="announcements_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $announcements = $em->getRepository('AppBundle:Announcements')->findAll();

        return $this->render('announcements/index.html.twig', array(
            'announcements' => $announcements,
        ));
    }

    /**
     * Creates a new announcement entity.
     *
     * @Route("/new", name="announcements_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $announcement = new Announcements();
        $form = $this->createForm('AppBundle\Form\AnnouncementsType', $announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($announcement);
            $em->flush();

            return $this->redirectToRoute('announcements_show', array('id' => $announcement->getId()));
        }

        return $this->render('announcements/new.html.twig', array(
            'announcement' => $announcement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a announcement entity.
     *
     * @Route("/{id}", name="announcements_show")
     * @Method("GET")
     */
    public function showAction(Announcements $announcement)
    {
        $deleteForm = $this->createDeleteForm($announcement);

        return $this->render('announcements/show.html.twig', array(
            'announcement' => $announcement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing announcement entity.
     *
     * @Route("/{id}/edit", name="announcements_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Announcements $announcement)
    {
        $deleteForm = $this->createDeleteForm($announcement);
        $editForm = $this->createForm('AppBundle\Form\AnnouncementsType', $announcement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('announcements_edit', array('id' => $announcement->getId()));
        }

        return $this->render('announcements/edit.html.twig', array(
            'announcement' => $announcement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a announcement entity.
     *
     * @Route("/{id}", name="announcements_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Announcements $announcement)
    {
        $form = $this->createDeleteForm($announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($announcement);
            $em->flush();
        }

        return $this->redirectToRoute('announcements_index');
    }

    /**
     * Creates a form to delete a announcement entity.
     *
     * @param Announcements $announcement The announcement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Announcements $announcement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('announcements_delete', array('id' => $announcement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
