<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Pagosefectivos;
use prueba\pruebaBundle\Form\PagosefectivosType;

/**
 * Pagosefectivos controller.
 *
 * @Route("/pagosefectivos")
 */
class PagosefectivosController extends Controller
{
    /**
     * Lists all Pagosefectivos entities.
     *
     * @Route("/", name="pagosefectivos_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();

            $pagosefectivos = $em->getRepository('pruebaBundle:Pagosefectivos')->findAll();

            return $this->render('pagosefectivos/index.html.twig', array(
                        'pagosefectivos' => $pagosefectivos,
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Pagosefectivos entity.
     *
     * @Route("/new", name="pagosefectivos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $pagosefectivo = new Pagosefectivos();
            $form = $this->createForm('prueba\pruebaBundle\Form\PagosefectivosType', $pagosefectivo);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($pagosefectivo);
                $em->flush();

                return $this->redirectToRoute('pagosefectivos_show', array('id' => $pagosefectivo->getIdpagosefectivos()));
            }

            return $this->render('pagosefectivos/new.html.twig', array(
                        'pagosefectivo' => $pagosefectivo,
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
     * Finds and displays a Pagosefectivos entity.
     *
     * @Route("/{id}", name="pagosefectivos_show")
     * @Method("GET")
     */
    public function showAction(Pagosefectivos $pagosefectivo)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($pagosefectivo);

            return $this->render('pagosefectivos/show.html.twig', array(
                        'pagosefectivo' => $pagosefectivo,
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
     * Displays a form to edit an existing Pagosefectivos entity.
     *
     * @Route("/{id}/edit", name="pagosefectivos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pagosefectivos $pagosefectivo)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($pagosefectivo);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\PagosefectivosType', $pagosefectivo);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($pagosefectivo);
                $em->flush();

                return $this->redirectToRoute('pagosefectivos_edit', array('id' => $pagosefectivo->getIdpagosefectivos()));
            }

            return $this->render('pagosefectivos/edit.html.twig', array(
                        'pagosefectivo' => $pagosefectivo,
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
     * Deletes a Pagosefectivos entity.
     *
     * @Route("/{id}", name="pagosefectivos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pagosefectivos $pagosefectivo)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $form = $this->createDeleteForm($pagosefectivo);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($pagosefectivo);
                $em->flush();
            }

            return $this->redirectToRoute('pagosefectivos_index');
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Pagosefectivos entity.
     *
     * @param Pagosefectivos $pagosefectivo The Pagosefectivos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pagosefectivos $pagosefectivo)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('pagosefectivos_delete', array('id' => $pagosefectivo->getIdpagosefectivos())))
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
