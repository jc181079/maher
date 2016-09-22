<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Dia;
use prueba\pruebaBundle\Form\DiaType;

/**
 * Dia controller.
 *
 * @Route("/dia")
 */
class DiaController extends Controller
{
    /**
     * Lists all Dia entities.
     *
     * @Route("/", name="dia_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();

            $dias = $em->getRepository('pruebaBundle:Dia')->findAll();

            return $this->render('dia/index.html.twig', array(
                        'dias' => $dias,
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Dia entity.
     *
     * @Route("/new", name="dia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $dium = new Dia();
            $form = $this->createForm('prueba\pruebaBundle\Form\DiaType', $dium);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($dium);
                $em->flush();

                return $this->redirectToRoute('dia_show', array('id' => $dium->getIddia()));
            }

            return $this->render('dia/new.html.twig', array(
                        'dium' => $dium,
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
     * Finds and displays a Dia entity.
     *
     * @Route("/{id}", name="dia_show")
     * @Method("GET")
     */
    public function showAction(Dia $dium)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($dium);

            return $this->render('dia/show.html.twig', array(
                        'dium' => $dium,
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
     * Displays a form to edit an existing Dia entity.
     *
     * @Route("/{id}/edit", name="dia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Dia $dium)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($dium);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\DiaType', $dium);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($dium);
                $em->flush();

                return $this->redirectToRoute('dia_edit', array('id' => $dium->getIddia()));
            }

            return $this->render('dia/edit.html.twig', array(
                        'dium' => $dium,
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
     * Deletes a Dia entity.
     *
     * @Route("/{id}", name="dia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Dia $dium)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $form = $this->createDeleteForm($dium);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($dium);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'Mensaje', "El registro fue eliminado satisfactoriamente."
                );
            } else {
                $this->get('session')->getFlashBag()->add(
                        'Alerta', "El registro no pudo ser eliminado, puede que el registro este relacionado."
                );
            }

            return $this->redirectToRoute('dia_index');
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Dia entity.
     *
     * @param Dia $dium The Dia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Dia $dium)
    {
        
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('dia_delete', array('id' => $dium->getIddia())))
                            ->setMethod('DELETE')
                            ->getForm()
            ;
        
    }
}
