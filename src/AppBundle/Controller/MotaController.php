<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mota;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swift_Message;
/**
 * Mota controller.
 *
 */
class MotaController extends Controller
{
    /**
     * Lists all mota entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $motas = $em->getRepository('AppBundle:Mota')->findAll();

        return $this->render('mota/index.html.twig', array(
            'motas' => $motas,
        ));
    }

    /**
     * Creates a new mota entity.
     *
     */
    public function newAction(Request $request)
    {
        $mota = new Mota();
        $form = $this->createForm('AppBundle\Form\MotaType', $mota);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mota);
            $em->flush();

            return $this->redirectToRoute('mota_show', array('id' => $mota->getId()));
        }

        return $this->render('mota/new.html.twig', array(
            'mota' => $mota,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a mota entity.
     *
     */
    public function showAction(Mota $mota)
    {
        $deleteForm = $this->createDeleteForm($mota);

        return $this->render('mota/show.html.twig', array(
            'mota' => $mota,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing mota entity.
     *
     */
    public function editAction(Request $request, Mota $mota)
    {
        $deleteForm = $this->createDeleteForm($mota);
        $editForm = $this->createForm('AppBundle\Form\MotaType', $mota);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mota_edit', array('id' => $mota->getId()));
        }

         //Mail da mota
         $message = Swift_Message::newInstance()
        ->setSubject('Nova Mota Criada')
        ->setFrom('veichlemanager@gmail.com')
        ->setTo('fpedro@parcelaja.pt')
       //  ->setTo('lmiguens@parcelaja.pt')
        ->setBody(
            'Foi Criada a mota: '.''.$mota->getId()." \n \n ".
            'Detalhes:'." \n \n ".
            'Peso:'.''.$mota->getPeso()." \n \n ".
            'Modelo: '.''.$mota->getModelo()." \n \n ".
            'Cor: '.''.$mota->getCor()." \n \n ".
            'Combustivel: '.''.$mota->getCombustivel()." \n \n ".
            'Número de rodas: '.''.$mota->getNumerorodas()." \n \n "
                
                
        );
          //  $message->toString();
            $this->get('mailer')->send($message);
        
        
        
        
        
        
        
        return $this->render('mota/edit.html.twig', array(
            'mota' => $mota,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
        
      


        
        
        
    }

    /**
     * Deletes a mota entity.
     *
     */
    public function deleteAction(Request $request, Mota $mota)
    {
        $form = $this->createDeleteForm($mota);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mota);
            $em->flush();
        }

        return $this->redirectToRoute('mota_index');
    }

    /**
     * Creates a form to delete a mota entity.
     *
     * @param Mota $mota The mota entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Mota $mota)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mota_delete', array('id' => $mota->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
