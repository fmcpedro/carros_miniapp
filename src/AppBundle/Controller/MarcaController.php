<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Marca;
use AppBundle\Entity\Modelo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Marca controller.
 *
 */
class MarcaController extends Controller
{
    /**
     * Lists all marca entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $marcas = $em->getRepository('AppBundle:Marca')->findAll();
        $modelos = $em->getRepository('AppBundle:Modelo')->findAll();

        return $this->render('marca/index.html.twig', array(
            'marcas' => $marcas
        ));
    }

    /**
     * Creates a new marca entity.
     *
     */
    public function newAction(Request $request)
    {
        $marca = new Marca();
        $form = $this->createForm('AppBundle\Form\MarcaType', $marca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($marca);
            $em->flush();

            return $this->redirectToRoute('marca_show', array('id' => $marca->getId()));
        }

        return $this->render('marca/new.html.twig', array(
            'marca' => $marca,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a marca entity.
     *
     */
    public function showAction(Marca $marca)
    {
        $deleteForm = $this->createDeleteForm($marca);

        return $this->render('marca/show.html.twig', array(
            'marca' => $marca,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing marca entity.
     *
     */
    public function editAction(Request $request, Marca $marca)
    {
        $deleteForm = $this->createDeleteForm($marca);
        $editForm = $this->createForm('AppBundle\Form\MarcaType', $marca);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('marca_edit', array('id' => $marca->getId()));
        }

        return $this->render('marca/edit.html.twig', array(
            'marca' => $marca,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a marca entity.
     *
     */
    public function deleteAction(Request $request, Marca $marca)
    {
        $form = $this->createDeleteForm($marca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($marca);
            $em->flush();
        }

        return $this->redirectToRoute('marca_index');
    }

    /**
     * Creates a form to delete a marca entity.
     *
     * @param Marca $marca The marca entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Marca $marca)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('marca_delete', array('id' => $marca->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
