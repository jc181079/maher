<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Solicituddetalle;
use prueba\pruebaBundle\Entity\Solicitud;
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
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado' or $session->get('tipousuario') == 'Cliente') {
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
     * @Route("/new/{idsolicitud}", name="solicituddetalle_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,$idsolicitud)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado' or $session->get('tipousuario') == 'Cliente') {
            $solicituddetalle = new Solicituddetalle();
            $form = $this->createForm('prueba\pruebaBundle\Form\SolicituddetalleType', $solicituddetalle);
            $form->handleRequest($request);
            
            /**
             * con este find se busca los detalles ya ingresados en la solicitud actual
             * para ser mostrados en el formulario de ingreso
             */
            $em = $this->getDoctrine()->getManager();
            $findsd = $em->createQuery(
                       'select sd.idsolicituddetalle,p.nombreproducto,sd.cantidad,sd.precio,sd.total

                        from pruebaBundle:producto p inner join pruebaBundle:solicituddetalle sd with
                        sd.idproducto=p.idproducto

                        where sd.idsolicitud=' . $idsolicitud . ''
            );
            $resultadosd=$findsd->getResult();
            //***********************************************************************
            /**
             * con este find se busca la solicitud actual
             * para ser mostrados en el formulario de ingreso
             */
            
            $finds = $em->createQuery(
                       'select s.fechaentrega,s.estatus,s.tipopago,s.prioridad,sum(sd.total) t

                        from pruebaBundle:Solicitud s inner join pruebaBundle:Solicituddetalle sd with
                        sd.idsolicitud=s.idsolicitud                        

                        where s.idsolicitud=' . $idsolicitud . ''
            );
            $resultados=$finds->getResult();
            //***********************************************************************

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $findproducto = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Producto')
                    ->findOneBy(array('idproducto' => $solicituddetalle->getIdproducto()));
                if ($findproducto) {
                    $findsolicitud = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Solicitud')
                    ->findOneBy(array('idsolicitud' => $idsolicitud));
                    $solicituddetalle->setPrecio($findproducto->getPrecioventa());
                    $solicituddetalle->setTotal($solicituddetalle->getCantidad() * $findproducto->getPrecioventa());
                    $solicituddetalle->setIdsolicitud($findsolicitud);
                    $em->persist($solicituddetalle);
                    $em->flush();
                }


                return $this->redirectToRoute('solicituddetalle_new', array('idsolicitud' => $idsolicitud));
            }

            return $this->render('solicituddetalle/new.html.twig', array(
                        'idsolicitud' => $idsolicitud,
                        'solicituddetalles'=>$resultadosd,
                        'solicitud'=>$resultados,
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
    public function showAction(Solicituddetalle $solicituddetalle,  Request $request)
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

                return $this->redirectToRoute('solicituddetalle_edit', array('id' => $solicituddetalle->getIdsolicituddetalle()));
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
                $this->get('session')->getFlashBag()->add(
                        'Mensaje', "El registro fue eliminado satisfactoriamente."
                );
            } else {
                $this->get('session')->getFlashBag()->add(
                        'Alerta', "El registro no pudo ser eliminado, puede que el registro este relacionado."
                );
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
        
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('solicituddetalle_delete', array('id' => $solicituddetalle->getIdsolicituddetalle())))
                            ->setMethod('DELETE')
                            ->getForm()
            ;
        
    }
    
    

}
