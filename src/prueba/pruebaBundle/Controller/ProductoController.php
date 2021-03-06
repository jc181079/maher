<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Producto;
use prueba\pruebaBundle\Entity\Und;
use prueba\pruebaBundle\Form\ProductoType;

/**
 * Producto controller.
 *
 * @Route("/producto")
 */
class ProductoController extends Controller
{
    /**
     * Lists all Producto entities.
     *
     * @Route("/", name="producto_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();
            $permisologia=1;

            $productos = $em->getRepository('pruebaBundle:Producto')->findAll();

            return $this->render('producto/index_prod.html.twig', array(
                        'productos' => $productos,                       
                        'permisologia' => $permisologia,
                        'nu'=>$session->get('nombreusuario'),
                        'l'=>$session->get('login'),
                         'diaactivo' => $session->get('diaactivo'),
                        
           
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Producto entity.
     *
     * @Route("/new", name="producto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $producto = new Producto();
            $form = $this->createForm('prueba\pruebaBundle\Form\ProductoType', $producto);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($producto);
                $em->flush();

                return $this->redirectToRoute('producto_show', array('id' => $producto->getIdproducto()));
            }

            return $this->render('producto/new_prod.html.twig', array(
                        'producto' => $producto,
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
     * Finds and displays a Producto entity.
     *
     * @Route("/{id}", name="producto_show")
     * @Method("GET")
     */
    public function showAction(Producto $producto,$id,Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($producto); // codigo original
            //------------------- CODIGO DE CONSULTA PERSONALIZADO
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                       'select p.nombreproducto,p.marca,
                               p.referencia,p.familia,
                               p.stockminimo,p.stockmaximo,
                               p.preciocosto,p.precioventa,
                               u.nombreund

                        from pruebaBundle:producto p inner join pruebaBundle:und u with
                        p.idund=u.idund

                        where p.idproducto=' . $id . ''
            );
            $xproducto = $query->getResult();

            //-------------------- FIN CODIGO PERSONALIZADO


            return $this->render('producto/show_prod.html.twig', array(
                        'xproducto' => $xproducto,
                        'producto' => $producto,
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
     * Displays a form to edit an existing Producto entity.
     *
     * @Route("/{id}/edit", name="producto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Producto $producto)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($producto);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\ProductoType', $producto);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($producto);
                $em->flush();

                return $this->redirectToRoute('producto_edit', array('id' => $producto->getIdproducto()));
            }

            return $this->render('producto/edit_prod.html.twig', array(
                        'producto' => $producto,
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
     * Deletes a Producto entity.
     *
     * @Route("/{id}", name="producto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Producto $producto)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $form = $this->createDeleteForm($producto);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($producto);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'Mensaje', "El registro fue eliminado satisfactoriamente."
                );
            } else {
                $this->get('session')->getFlashBag()->add(
                        'Alerta', "El registro no pudo ser eliminado, puede que el registro este relacionado."
                );
            }

            return $this->redirectToRoute('producto_index');
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Producto entity.
     *
     * @param Producto $producto The Producto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Producto $producto)
    {
       
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('producto_delete', array('id' => $producto->getIdproducto())))
                            ->setMethod('DELETE')
                            ->getForm()
            ;
     
    }
}
