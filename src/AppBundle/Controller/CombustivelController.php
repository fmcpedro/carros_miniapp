<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Combustivel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Combustivel controller.
 *
 */
class CombustivelController extends Controller
{
    /**
     * Lists all combustivel entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $combustivels = $em->getRepository('AppBundle:Combustivel')->findAll();

        return $this->render('combustivel/index.html.twig', array(
            'combustivels' => $combustivels,
        ));
    }

    /**
     * Creates a new combustivel entity.
     *
     */
    public function newAction(Request $request)
    {
        $combustivel = new Combustivel();
        $form = $this->createForm('AppBundle\Form\CombustivelType', $combustivel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($combustivel);
            $em->flush();

            return $this->redirectToRoute('combustivel_show', array('id' => $combustivel->getId()));
        }

        return $this->render('combustivel/new.html.twig', array(
            'combustivel' => $combustivel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a combustivel entity.
     *
     */
    public function showAction(Combustivel $combustivel)
    {
        $deleteForm = $this->createDeleteForm($combustivel);

        return $this->render('combustivel/show.html.twig', array(
            'combustivel' => $combustivel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing combustivel entity.
     *
     */
    public function editAction(Request $request, Combustivel $combustivel)
    {
        $deleteForm = $this->createDeleteForm($combustivel);
        $editForm = $this->createForm('AppBundle\Form\CombustivelType', $combustivel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('combustivel_edit', array('id' => $combustivel->getId()));
        }

        return $this->render('combustivel/edit.html.twig', array(
            'combustivel' => $combustivel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a combustivel entity.
     *
     */
    public function deleteAction(Request $request, Combustivel $combustivel)
    {
        $form = $this->createDeleteForm($combustivel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($combustivel);
            $em->flush();
        }

        return $this->redirectToRoute('combustivel_index');
    }

    /**
     * Creates a form to delete a combustivel entity.
     *
     * @param Combustivel $combustivel The combustivel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Combustivel $combustivel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('combustivel_delete', array('id' => $combustivel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
