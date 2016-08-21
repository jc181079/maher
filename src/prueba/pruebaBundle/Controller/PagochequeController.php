<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Pagocheque;
use prueba\pruebaBundle\Form\PagochequeType;

/**
 * Pagocheque controller.
 *
 * @Route("/pagocheque")
 */
class PagochequeController extends Controller
{
    /**
     * Lists all Pagocheque entities.
     *
     * @Route("/", name="pagocheque_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();

            $pagocheques = $em->getRepository('pruebaBundle:Pagocheque')->findAll();

            return $this->render('pagocheque/index.html.twig', array(
                        'pagocheques' => $pagocheques,
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Pagocheque entity.
     *
     * @Route("/new", name="pagocheque_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $pagocheque = new Pagocheque();
            $form = $this->createForm('prueba\pruebaBundle\Form\PagochequeType', $pagocheque);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($pagocheque);
                $em->flush();

                return $this->redirectToRoute('pagocheque_show', array('id' => $pagocheque->getId()));
            }

            return $this->render('pagocheque/new.html.twig', array(
                        'pagocheque' => $pagocheque,
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
     * Finds and displays a Pagocheque entity.
     *
     * @Route("/{id}", name="pagocheque_show")
     * @Method("GET")
     */
    public function showAction(Pagocheque $pagocheque)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($pagocheque);

            return $this->render('pagocheque/show.html.twig', array(
                        'pagocheque' => $pagocheque,
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
     * Displays a form to edit an existing Pagocheque entity.
     *
     * @Route("/{id}/edit", name="pagocheque_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pagocheque $pagocheque)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($pagocheque);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\PagochequeType', $pagocheque);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($pagocheque);
                $em->flush();

                return $this->redirectToRoute('pagocheque_edit', array('id' => $pagocheque->getId()));
            }

            return $this->render('pagocheque/edit.html.twig', array(
                        'pagocheque' => $pagocheque,
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
     * Deletes a Pagocheque entity.
     *
     * @Route("/{id}", name="pagocheque_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pagocheque $pagocheque)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $form = $this->createDeleteForm($pagocheque);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($pagocheque);
                $em->flush();
            }

            return $this->redirectToRoute('pagocheque_index');
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Pagocheque entity.
     *
     * @param Pagocheque $pagocheque The Pagocheque entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pagocheque $pagocheque)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('pagocheque_delete', array('id' => $pagocheque->getId())))
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
