<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Qualifications;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Qualification controller.
 *
 * @Route("qualifications")
 */
class QualificationsController extends Controller
{
    /**
     * Lists all qualification entities.
     *
     * @Route("/", name="qualifications_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $qualifications = $em->getRepository('AppBundle:Qualifications')->findAll();

        return $this->render('qualifications/index.html.twig', array(
            'qualifications' => $qualifications,
        ));
    }

    /**
     * Creates a new qualification entity.
     *
     * @Route("/new", name="qualifications_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $qualification = new Qualifications();
        $form = $this->createForm('AppBundle\Form\QualificationsType', $qualification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($qualification);
            $em->flush();

            return $this->redirectToRoute('qualifications_index');
        }

        return $this->render('qualifications/new.html.twig', array(
            'qualification' => $qualification,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a qualification entity.
     *
     * @Route("/{id}", name="qualifications_show")
     * @Method("GET")
     */
    public function showAction(Qualifications $qualification)
    {
        $deleteForm = $this->createDeleteForm($qualification);

        return $this->render('qualifications/show.html.twig', array(
            'qualification' => $qualification,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing qualification entity.
     *
     * @Route("/{id}/edit", name="qualifications_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Qualifications $qualification)
    {
        $deleteForm = $this->createDeleteForm($qualification);
        $editForm = $this->createForm('AppBundle\Form\QualificationsType', $qualification);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('qualifications_edit', array('id' => $qualification->getId()));
        }

        return $this->render('qualifications/edit.html.twig', array(
            'qualification' => $qualification,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a qualification entity.
     *
     * @Route("/{id}", name="qualifications_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Qualifications $qualification)
    {
        $form = $this->createDeleteForm($qualification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($qualification);
            $em->flush();
        }

        return $this->redirectToRoute('qualifications_index');
    }

    /**
     * Creates a form to delete a qualification entity.
     *
     * @param Qualifications $qualification The qualification entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Qualifications $qualification)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('qualifications_delete', array('id' => $qualification->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
