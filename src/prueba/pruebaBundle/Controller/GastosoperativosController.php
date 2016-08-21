<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Gastosoperativos;
use prueba\pruebaBundle\Form\GastosoperativosType;

/**
 * Gastosoperativos controller.
 *
 * @Route("/gastosoperativos")
 */
class GastosoperativosController extends Controller
{
    /**
     * Lists all Gastosoperativos entities.
     *
     * @Route("/", name="gastosoperativos_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();

            $gastosoperativos = $em->getRepository('pruebaBundle:Gastosoperativos')->findAll();

            return $this->render('gastosoperativos/index.html.twig', array(
                        'gastosoperativos' => $gastosoperativos,
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Gastosoperativos entity.
     *
     * @Route("/new", name="gastosoperativos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $gastosoperativo = new Gastosoperativos();
            $form = $this->createForm('prueba\pruebaBundle\Form\GastosoperativosType', $gastosoperativo);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($gastosoperativo);
                $em->flush();

                return $this->redirectToRoute('gastosoperativos_show', array('id' => $gastosoperativo->getId()));
            }

            return $this->render('gastosoperativos/new.html.twig', array(
                        'gastosoperativo' => $gastosoperativo,
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
     * Finds and displays a Gastosoperativos entity.
     *
     * @Route("/{id}", name="gastosoperativos_show")
     * @Method("GET")
     */
    public function showAction(Gastosoperativos $gastosoperativo)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($gastosoperativo);

            return $this->render('gastosoperativos/show.html.twig', array(
                        'gastosoperativo' => $gastosoperativo,
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
     * Displays a form to edit an existing Gastosoperativos entity.
     *
     * @Route("/{id}/edit", name="gastosoperativos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Gastosoperativos $gastosoperativo)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($gastosoperativo);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\GastosoperativosType', $gastosoperativo);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($gastosoperativo);
                $em->flush();

                return $this->redirectToRoute('gastosoperativos_edit', array('id' => $gastosoperativo->getId()));
            }

            return $this->render('gastosoperativos/edit.html.twig', array(
                        'gastosoperativo' => $gastosoperativo,
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
     * Deletes a Gastosoperativos entity.
     *
     * @Route("/{id}", name="gastosoperativos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Gastosoperativos $gastosoperativo)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $form = $this->createDeleteForm($gastosoperativo);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($gastosoperativo);
                $em->flush();
            }

            return $this->redirectToRoute('gastosoperativos_index');
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Gastosoperativos entity.
     *
     * @param Gastosoperativos $gastosoperativo The Gastosoperativos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Gastosoperativos $gastosoperativo)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('gastosoperativos_delete', array('id' => $gastosoperativo->getId())))
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
