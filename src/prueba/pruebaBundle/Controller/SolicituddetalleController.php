<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Solicituddetalle;
use prueba\pruebaBundle\Form\SolicituddetalleType;

/**
 * Solicituddetalle controller.
 *
 * @Route("/solicituddetalle")
 */
class SolicituddetalleController extends Controller
{
    /**
     * Lists all Solicituddetalle entities.
     *
     * @Route("/", name="solicituddetalle_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();

            $solicituddetalles = $em->getRepository('pruebaBundle:Solicituddetalle')->findAll();

            return $this->render('solicituddetalle/index.html.twig', array(
                        'solicituddetalles' => $solicituddetalles,
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Solicituddetalle entity.
     *
     * @Route("/new", name="solicituddetalle_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $solicituddetalle = new Solicituddetalle();
            $form = $this->createForm('prueba\pruebaBundle\Form\SolicituddetalleType', $solicituddetalle);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($solicituddetalle);
                $em->flush();

                return $this->redirectToRoute('solicituddetalle_show', array('id' => $solicituddetalle->getId()));
            }

            return $this->render('solicituddetalle/new.html.twig', array(
                        'solicituddetalle' => $solicituddetalle,
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
     * Finds and displays a Solicituddetalle entity.
     *
     * @Route("/{id}", name="solicituddetalle_show")
     * @Method("GET")
     */
    public function showAction(Solicituddetalle $solicituddetalle)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($solicituddetalle);

            return $this->render('solicituddetalle/show.html.twig', array(
                        'solicituddetalle' => $solicituddetalle,
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
     * Displays a form to edit an existing Solicituddetalle entity.
     *
     * @Route("/{id}/edit", name="solicituddetalle_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Solicituddetalle $solicituddetalle)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($solicituddetalle);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\SolicituddetalleType', $solicituddetalle);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($solicituddetalle);
                $em->flush();

                return $this->redirectToRoute('solicituddetalle_edit', array('id' => $solicituddetalle->getId()));
            }

            return $this->render('solicituddetalle/edit.html.twig', array(
                        'solicituddetalle' => $solicituddetalle,
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
     * Deletes a Solicituddetalle entity.
     *
     * @Route("/{id}", name="solicituddetalle_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Solicituddetalle $solicituddetalle)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $form = $this->createDeleteForm($solicituddetalle);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($solicituddetalle);
                $em->flush();
            }

            return $this->redirectToRoute('solicituddetalle_index');
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Solicituddetalle entity.
     *
     * @param Solicituddetalle $solicituddetalle The Solicituddetalle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Solicituddetalle $solicituddetalle)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('solicituddetalle_delete', array('id' => $solicituddetalle->getId())))
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
