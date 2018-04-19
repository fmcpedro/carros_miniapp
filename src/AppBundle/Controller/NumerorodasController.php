<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Numerorodas;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Numerorodas controller.
 *
 */
class NumerorodasController extends Controller
{
    /**
     * Lists all numerorodas entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $numerorodas = $em->getRepository('AppBundle:Numerorodas')->findAll();

        return $this->render('numerorodas/index.html.twig', array(
            'numerorodas' => $numerorodas,
        ));
    }

    /**
     * Creates a new numerorodas entity.
     *
     */
    public function newAction(Request $request)
    {
        $numerorodas = new Numerorodas();
        $form = $this->createForm('AppBundle\Form\NumerorodasType', $numerorodas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($numerorodas);
            $em->flush();

            return $this->redirectToRoute('numerorodas_show', array('id' => $numerorodas->getId()));
        }

        return $this->render('numerorodas/new.html.twig', array(
            'numerorodas' => $numerorodas,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a numerorodas entity.
     *
     */
    public function showAction(Numerorodas $numerorodas)
    {
        $deleteForm = $this->createDeleteForm($numerorodas);

        return $this->render('numerorodas/show.html.twig', array(
            'numerorodas' => $numerorodas,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing numerorodas entity.
     *
     */
    public function editAction(Request $request, Numerorodas $numerorodas)
    {
        $deleteForm = $this->createDeleteForm($numerorodas);
        $editForm = $this->createForm('AppBundle\Form\NumerorodasType', $numerorodas);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('numerorodas_edit', array('id' => $numerorodas->getId()));
        }

        return $this->render('numerorodas/edit.html.twig', array(
            'numerorodas' => $numerorodas,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a numerorodas entity.
     *
     */
    public function deleteAction(Request $request, Numerorodas $numerorodas)
    {
        $form = $this->createDeleteForm($numerorodas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($numerorodas);
            $em->flush();
        }

        return $this->redirectToRoute('numerorodas_index');
    }

    /**
     * Creates a form to delete a numerorodas entity.
     *
     * @param Numerorodas $numerorodas The numerorodas entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Numerorodas $numerorodas)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('numerorodas_delete', array('id' => $numerorodas->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
