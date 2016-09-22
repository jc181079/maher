<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Almacen;
use prueba\pruebaBundle\Form\AlmacenType;

/**
 * Almacen controller.
 *
 * @Route("/almacen")
 */
class AlmacenController extends Controller
{
    /**
     * Lists all Almacen entities.
     *
     * @Route("/", name="almacen_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();
            $permisologia=1;

            $almacens = $em->getRepository('pruebaBundle:Almacen')->findAll();

            return $this->render('almacen/index_alm.html.twig', array(
                        'almacens' => $almacens,
                         'diaactivo' => $session->get('diaactivo'),
                         'nu'=>$session->get('nombreusuario'),
                         'l'=>$session->get('login'),
                        'permisologia' => $permisologia,
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Almacen entity.
     *
     * @Route("/new", name="almacen_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $almacen = new Almacen();
            $form = $this->createForm('prueba\pruebaBundle\Form\AlmacenType', $almacen);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($almacen);
                $em->flush();

                return $this->redirectToRoute('almacen_show', array('id' => $almacen->getIdalmacen()));
            }

            return $this->render('almacen/new_alm.html.twig', array(
                        'almacen' => $almacen,
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
     * Finds and displays a Almacen entity.
     *
     * @Route("/show/{id}", name="almacen_show")
     * @Method("GET")
     */
    public function showAction(Almacen $almacen,Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($almacen);

            return $this->render('almacen/show_alm.html.twig', array(
                        'almacen' => $almacen,
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
     * Displays a form to edit an existing Almacen entity.
     *
     * @Route("/edit/{id}", name="almacen_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Almacen $almacen)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($almacen);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\AlmacenType', $almacen);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($almacen);
                $em->flush();

                return $this->redirectToRoute('almacen_edit', array('id' => $almacen->getIdalmacen()));
            }

            return $this->render('almacen/edit_alm.html.twig', array(
                        'almacen' => $almacen,
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
     * Deletes a Almacen entity.
     *
     * @Route("/delete/{id}", name="almacen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Almacen $almacen)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $form = $this->createDeleteForm($almacen);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($almacen);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'Mensaje', "El registro fue eliminado satisfactoriamente."
                );
            }else{
                $this->get('session')->getFlashBag()->add(
                        'Alerta', "El registro no pudo ser eliminado, puede que el registro este relacionado."
                );
            }

            return $this->redirectToRoute('almacen_index');
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Almacen entity.
     *
     * @param Almacen $almacen The Almacen entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Almacen $almacen)
    {
       
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('almacen_delete', array('id' => $almacen->getIdalmacen())))
                            ->setMethod('DELETE')
                            ->getForm()
            ;
        
    }
}
