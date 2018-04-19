<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Carro;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
//liip
use Liip\ImagineBundle\Binary\Loader\LoaderInterface;
use Liip\ImagineBundle\Binary\Loader\FileSystemLoader;
use Imagine\Image\ImageInterface;
use Liip\ImagineBundle\Imagine\Cache\Resolver\ResolverInterface;
use Liip\ImagineBundle;

/**
 * Carro controller.
 *
 */
class CarroController extends Controller {

    /**
     * Lists all carro entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        //Check Login
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

            $carros = $em->getRepository('AppBundle:Carro')->findBy(array('user' => $user));
        return $this->render('carro/index.html.twig', array(
                        'carros' => $carros,
            ));
    }

    /**
     * Creates a new carro entity.
     *
     */
    public function newAction(Request $request) {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $carro = new Carro();
        $form = $this->createForm('AppBundle\Form\CarroType', $carro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $carro->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($carro);
            $em->flush();




            return $this->redirectToRoute('carro_show', array('id' => $carro->getId()));
        }

        return $this->render('carro/new.html.twig', array(
                    'carro' => $carro,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a carro entity.
     *
     */
    public function showAction(Carro $carro) {
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        $deleteForm = $this->createDeleteForm($carro);

        return $this->render('carro/show.html.twig', array(
                    'carro' => $carro,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing carro entity.
     *
     */
    public function editAction(Request $request, Carro $carro) {
        //Check Login
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $user = $this->getUser();
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $deleteForm = $this->createDeleteForm($carro);
            $editForm = $this->createForm('AppBundle\Form\CarroType', $carro);
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $user = $this->getUser();
                $carro->setUser($user);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('carro_edit', array('id' => $carro->getId()));
            }
            return $this->render('carro/edit.html.twig', array(
                        'carro' => $carro,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
            ));
        }
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER') && ($this->isGranted('edit',$carro))) {
            $deleteForm = $this->createDeleteForm($carro);
            $editForm = $this->createForm('AppBundle\Form\CarroType', $carro);
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $user = $this->getUser();
                $carro->setUser($user);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('carro_edit', array('id' => $carro->getId()));
            }
            return $this->render('carro/edit.html.twig', array(
                        'carro' => $carro,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
            ));
        }else{
            throw $this->createAccessDeniedException();
    }
    }
    /**
     * Deletes a carro entity.
     *
     */
    public function deleteAction(Request $request, Carro $carro) {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        $form = $this->createDeleteForm($carro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carro);
            $em->flush();
        }

        return $this->redirectToRoute('carro_index');
    }

    /**
     * Creates a form to delete a carro entity.
     *
     * @param Carro $carro The carro entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Carro $carro) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('carro_delete', array('id' => $carro->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    public function listaCarrosOrderedCilindradaAction($_locale) {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        $em = $this->getDoctrine()->getManager();
        $carros = $em->getRepository('AppBundle:Carro')->listaCarrosOrderedCilindrada();
//           
//           $translation = array();
//           $translation = $this->get('translator')->trans('Listagem de Carros (ordenados por cilindrada)');
//           $translation = $this->get('translator')->trans('Cilindrada');
//           $translation = $this->get('translator')->trans('Data de venda');
//           $translation = $this->get('translator')->trans('Observações');
//           $translation = $this->get('translator')->trans('Modelo');
//           $translation = $this->get('translator')->trans('Combustível');
//           $translation = $this->get('translator')->trans('Marca');
//           $translation = $this->get('translator')->trans('Opções');
//           $translation = $this->get('translator')->trans('editar carro');




        return $this->render('carro/orderedCilindrada.html.twig', array('carros' => $carros));
    }

}
