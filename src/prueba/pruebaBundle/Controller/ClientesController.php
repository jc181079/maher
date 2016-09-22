<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Clientes;
use prueba\pruebaBundle\Form\ClientesType;

/**
 * Clientes controller.
 *
 * @Route("/clientes")
 */
class ClientesController extends Controller
{
    /**
     * Lists all Clientes entities.
     *
     * @Route("/", name="clientes_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
         $em = $this->getDoctrine()->getManager();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
           /*
            * aqui se mostraran todos los clientes siempre que el usuario sea de tipo Administrador o Empleado
            * la permisologia es una variable que le va indicar a la plantilla twig si muestra o no 
            * las oociones de eliminar o modificar
            */
            $clientes = $em->getRepository('pruebaBundle:Clientes')->findAll();

            return $this->render('clientes/index.html.twig', array(
                        'clientes' => $clientes,
                        'permisologia'=>'1',
            ));
        } elseif($session->get('tipousuario') == 'Cliente'){
            /*
             * aqui se mostra solo la informacion del cliente que se logueo no podra modificar su nombre
             * que asi es que se busca, en este caso la permisologia es 0 asi que no podra elimianar
             * ni modificar
             */
            $clientes = $em->getRepository('pruebaBundle:Clientes')->findBy(array('nombrecliente'=>$session->get('nombreusuario')));
            return $this->render('clientes/index.html.twig', array(
                        'clientes' => $clientes,
                        'permisologia'=>'0',
            ));
        }else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Clientes entity.
     *
     * @Route("/new", name="clientes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $cliente = new Clientes();
            $form = $this->createForm('prueba\pruebaBundle\Form\ClientesType', $cliente);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($cliente);
                $em->flush();

                return $this->redirectToRoute('clientes_show', array('id' => $cliente->getIdclientes()));
            }

            return $this->render('clientes/new.html.twig', array(
                        'cliente' => $cliente,
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
     * Finds and displays a Clientes entity.
     *
     * @Route("/{id}", name="clientes_show")
     * @Method("GET")
     */
    public function showAction(Clientes $cliente)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($cliente);

            return $this->render('clientes/show.html.twig', array(
                        'cliente' => $cliente,
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
     * Displays a form to edit an existing Clientes entity.
     *
     * @Route("/{id}/edit", name="clientes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Clientes $cliente)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($cliente);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\ClientesType', $cliente);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($cliente);
                $em->flush();

                return $this->redirectToRoute('clientes_edit', array('id' => $cliente->getIdclientes()));
            }

            return $this->render('clientes/edit.html.twig', array(
                        'cliente' => $cliente,
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
     * Deletes a Clientes entity.
     *
     * @Route("/{id}", name="clientes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Clientes $cliente)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $form = $this->createDeleteForm($cliente);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($cliente);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'Mensaje', "El registro fue eliminado satisfactoriamente."
                );
            }else{
                $this->get('session')->getFlashBag()->add(
                        'Alerta', "El registro no pudo ser eliminado, puede que el registro este relacionado."
                );
            }
            return $this->redirectToRoute('clientes_index');
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Clientes entity.
     *
     * @param Clientes $cliente The Clientes entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Clientes $cliente)
    {
        
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('clientes_delete', array('id' => $cliente->getIdclientes())))
                            ->setMethod('DELETE')
                            ->getForm()
            ;
        
    }
}
