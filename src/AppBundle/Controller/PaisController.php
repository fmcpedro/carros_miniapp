<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pais;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Pais controller.
 *
 */
class PaisController extends Controller
{
    /**
     * Lists all pais entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pais = $em->getRepository('AppBundle:Pais')->findAll();

        return $this->render('pais/index.html.twig', array(
            'pais' => $pais,
        ));
    }

    /**
     * Creates a new pais entity.
     *
     */
    public function newAction(Request $request)
    {
        $pais = new Pais();
        $form = $this->createForm('AppBundle\Form\PaisType', $pais);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pais);
            $em->flush();

            return $this->redirectToRoute('pais_show', array('id' => $pais->getId()));
        }

        return $this->render('pais/new.html.twig', array(
            'pais' => $pais,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pais entity.
     *
     */
    public function showAction(Pais $pais)
    {
        $deleteForm = $this->createDeleteForm($pais);

        return $this->render('pais/show.html.twig', array(
            'pais' => $pais,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pais entity.
     *
     */
    public function editAction(Request $request, Pais $pais)
    {
        $deleteForm = $this->createDeleteForm($pais);
        $editForm = $this->createForm('AppBundle\Form\PaisType', $pais);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pais_edit', array('id' => $pais->getId()));
        }

        return $this->render('pais/edit.html.twig', array(
            'pais' => $pais,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pais entity.
     *
     */
    public function deleteAction(Request $request, Pais $pais)
    {
        $form = $this->createDeleteForm($pais);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pais);
            $em->flush();
        }

        return $this->redirectToRoute('pais_index');
    }

    /**
     * Creates a form to delete a pais entity.
     *
     * @param Pais $pais The pais entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pais $pais)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pais_delete', array('id' => $pais->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
