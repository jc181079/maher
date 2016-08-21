<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Pagotransferencia;
use prueba\pruebaBundle\Form\PagotransferenciaType;

/**
 * Pagotransferencia controller.
 *
 * @Route("/pagotransferencia")
 */
class PagotransferenciaController extends Controller
{
    /**
     * Lists all Pagotransferencia entities.
     *
     * @Route("/", name="pagotransferencia_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();

            $pagotransferencias = $em->getRepository('pruebaBundle:Pagotransferencia')->findAll();

            return $this->render('pagotransferencia/index.html.twig', array(
                        'pagotransferencias' => $pagotransferencias,
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Pagotransferencia entity.
     *
     * @Route("/new", name="pagotransferencia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $pagotransferencium = new Pagotransferencia();
            $form = $this->createForm('prueba\pruebaBundle\Form\PagotransferenciaType', $pagotransferencium);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($pagotransferencium);
                $em->flush();

                return $this->redirectToRoute('pagotransferencia_show', array('id' => $pagotransferencium->getId()));
            }

            return $this->render('pagotransferencia/new.html.twig', array(
                        'pagotransferencium' => $pagotransferencium,
                        'form' => $form->createView(),
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Finds and displays a Pagotransferencia entity.
     *
     * @Route("/{id}", name="pagotransferencia_show")
     * @Method("GET")
     */
    public function showAction(Pagotransferencia $pagotransferencium)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($pagotransferencium);

            return $this->render('pagotransferencia/show.html.twig', array(
                        'pagotransferencium' => $pagotransferencium,
                        'delete_form' => $deleteForm->createView(),
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Displays a form to edit an existing Pagotransferencia entity.
     *
     * @Route("/{id}/edit", name="pagotransferencia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pagotransferencia $pagotransferencium)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($pagotransferencium);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\PagotransferenciaType', $pagotransferencium);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($pagotransferencium);
                $em->flush();

                return $this->redirectToRoute('pagotransferencia_edit', array('id' => $pagotransferencium->getId()));
            }

            return $this->render('pagotransferencia/edit.html.twig', array(
                        'pagotransferencium' => $pagotransferencium,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Deletes a Pagotransferencia entity.
     *
     * @Route("/{id}", name="pagotransferencia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pagotransferencia $pagotransferencium)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
 $form = $this->createDeleteForm($pagotransferencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pagotransferencium);
            $em->flush();
        }

        return $this->redirectToRoute('pagotransferencia_index');
} else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
       
    }

    /**
     * Creates a form to delete a Pagotransferencia entity.
     *
     * @param Pagotransferencia $pagotransferencium The Pagotransferencia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pagotransferencia $pagotransferencium)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('pagotransferencia_delete', array('id' => $pagotransferencium->getId())))
                            ->setMethod('DELETE')
                            ->getForm()
            ;
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }
}
