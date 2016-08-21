<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Movimiento;
use prueba\pruebaBundle\Entity\Inventario;
use prueba\pruebaBundle\Form\MovimientoType;

/**
 * Movimiento controller.
 *
 * @Route("/movimiento")
 */
class MovimientoController extends Controller
{
    /**
     * Lists all Movimiento entities.
     *
     * @Route("/", name="movimiento_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();

            $movimientos = $em->getRepository('pruebaBundle:Movimiento')->findAll();

            return $this->render('movimiento/index_movimiento.html.twig', array(
                        'movimientos' => $movimientos,
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Movimiento entity.
     *
     * @Route("/new", name="movimiento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            /*
             * esta accion se modifico con el proposito de que al momento de 
             * ingresar un nievo movimiento este actualice de manera transparente 
             * la tabla de inventario
             */
            $movimiento = new Movimiento();
            $form = $this->createForm('prueba\pruebaBundle\Form\MovimientoType', $movimiento);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($movimiento);
                $em->flush();
                /*
                 * aqui el sistema determina si es una entrada se suma en valor 
                 * de la cantidad del producto registrado con la cantidad nueva
                 * sino se resta del almacen la cantidad registrada con la nueva 
                 * cantidad
                 */
                $consulta = $em->getRepository('pruebaBundle:Inventario')->findBy(array('idproducto' => $movimiento->getIdproducto(), 'idalmacen' => $movimiento->getIdalmacen()));
                if ($consulta) {
                    /*
                     * si el producto se consiguio entonces se procede a actualizar
                     * la cantidad del mismo en el inventario quedando asi la 
                     * existencia actual
                     */
                    $tmpCantidad = $consulta[0]->getCantidad();
                    if ($movimiento->getTipomovimiento() == "Entrada" or $movimiento->getTipomovimiento() == "entrada" or $movimiento->getTipomovimiento() == "ENTRADA") {
                        $consulta[0]->setCantidad($tmpCantidad + $movimiento->getCantidad());
                    } elseif ($movimiento->getTipomovimiento() == "Salida" or $movimiento->getTipomovimiento() == "salida" or $movimiento->getTipomovimiento() == "SALIDA") {
                        $consulta[0]->setCantidad($tmpCantidad - $movimiento->getCantidad());
                    }
                    $em->persist($consulta[0]);
                    $em->flush();
                } else {
                    /*
                     * si el producto es nuevo en el almacen se guarda nuevo
                     */
                    $inventario = new Inventario();
                    $inventario->setIdalmacen($movimiento->getIdalmacen());
                    $inventario->setIdproducto($movimiento->getIdproducto());
                    $inventario->setCantidad($movimiento->getCantidad());
                    $em->persist($inventario);
                    $em->flush();
                }
                return $this->redirectToRoute('movimiento_show', array('id' => $movimiento->getIdmovimiento()));
            }
            return $this->render('movimiento/new_movimiento.html.twig', array(
                        'movimiento' => $movimiento,
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
     * Finds and displays a Movimiento entity.
     *
     * @Route("/{id}", name="movimiento_show")
     * @Method("GET")
     */
    public function showAction(Movimiento $movimiento)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($movimiento);

            return $this->render('movimiento/show_movimiento.html.twig', array(
                        'movimiento' => $movimiento,
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
     * Displays a form to edit an existing Movimiento entity.
     *
     * @Route("/{id}/edit", name="movimiento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Movimiento $movimiento)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($movimiento);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\MovimientoType', $movimiento);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($movimiento);
                $em->flush();

                return $this->redirectToRoute('movimiento_edit', array('id' => $movimiento->getIdmovimiento()));
            }

            return $this->render('movimiento/edit_movimiento.html.twig', array(
                        'movimiento' => $movimiento,
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
     * Deletes a Movimiento entity.
     *
     * @Route("/{id}", name="movimiento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Movimiento $movimiento)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $form = $this->createDeleteForm($movimiento);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($movimiento);
                $em->flush();
            }

            return $this->redirectToRoute('movimiento_index');
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Movimiento entity.
     *
     * @param Movimiento $movimiento The Movimiento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Movimiento $movimiento)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('movimiento_delete', array('id' => $movimiento->getIdmovimiento())))
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
