<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Modelo;
use AppBundle\Entity\Carro;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Modelo controller.
 *
 */
class ModeloController extends Controller
{
   
    
    /**
     * Lists all modelo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $modelos = $em->getRepository('AppBundle:Modelo')->findAll();
        return $this->render('modelo/index.html.twig', array(
            'modelos' => $modelos
        ));
    }

    /**
     * Creates a new modelo entity.
     *
     */
    public function newAction(Request $request)
    {
        $modelo = new Modelo();
        $form = $this->createForm('AppBundle\Form\ModeloType', $modelo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modelo);
            $em->flush();

            return $this->redirectToRoute('modelo_show', array('id' => $modelo->getId()));
        }

        return $this->render('modelo/new.html.twig', array(
            'modelo' => $modelo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a modelo entity.
     *
     */
    public function showAction(Modelo $modelo)
    {
        $deleteForm = $this->createDeleteForm($modelo);

        return $this->render('modelo/show.html.twig', array(
            'modelo' => $modelo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing modelo entity.
     *
     */
    public function editAction(Request $request, Modelo $modelo)
    {
        $deleteForm = $this->createDeleteForm($modelo);
        $editForm = $this->createForm('AppBundle\Form\ModeloType', $modelo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('modelo_edit', array('id' => $modelo->getId()));
        }

        return $this->render('modelo/edit.html.twig', array(
            'modelo' => $modelo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a modelo entity.
     *
     */
    public function deleteAction(Request $request, Modelo $modelo)
    {
        $form = $this->createDeleteForm($modelo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($modelo);
            $em->flush();
        }

        return $this->redirectToRoute('modelo_index');
    }

    /**
     * Creates a form to delete a modelo entity.
     *
     * @param Modelo $modelo The modelo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Modelo $modelo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modelo_delete', array('id' => $modelo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
