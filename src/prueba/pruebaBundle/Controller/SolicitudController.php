<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Solicitud;
use prueba\pruebaBundle\Form\SolicitudType;

/**
 * Solicitud controller.
 *
 * @Route("/solicitud")
 */
class SolicitudController extends Controller
{
    /**
     * Lists all Solicitud entities.
     *
     * @Route("/", name="solicitud_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado' or $session->get('tipousuario') == 'Cliente') {
            $em = $this->getDoctrine()->getManager();
            /*
             * con este condicional el cliente solo podra observar solo sus solicitudes nada mas
             * permisologia evita que el cliente tenga acceso a las opciones del navbar
             */
            if ($session->get('tipousuario') == 'Cliente') {
                $solicituds = $em->getRepository('pruebaBundle:Solicitud')->findBy(array('rif' => $session->get('rif')));
                $permisologia = 0;
            } else {
                $solicituds = $em->getRepository('pruebaBundle:Solicitud')->findAll();
                $permisologia = 1;
            }
            return $this->render('solicitud/index_sol.html.twig', array(
                        'solicituds' => $solicituds,
                        'permisologia' => $permisologia,
                        'nu'=>$session->get('nombreusuario'),
                        'l'=>$session->get('login'),
                        'diaactivo'=>$session->get('diaactivo'),
                        
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Solicitud entity.
     *
     * @Route("/new", name="solicitud_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado' or $session->get('tipousuario') == 'Cliente') {
            
            $solicitud = new Solicitud();
            $form = $this->createForm('prueba\pruebaBundle\Form\SolicitudType', $solicitud);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                /*
                 * aqui se empieza a colocar los datos a traves del controlador para evitar que el usuario
                 * ingrese datos errados
                 */  
               $solicitud->setEstatus('Activa'); 
                switch ($solicitud->getTipopago()) {  //aqui asigna la prioridad de la solicitud por el tipo de pago
                    case 'Efectivo':$solicitud->setPrioridad('Alta');
                        break;
                    case 'Cheque':$solicitud->setPrioridad('Media');
                        break;
                    case 'transferencia':$solicitud->setPrioridad('Media');
                        break;
                    case 'Credito':$solicitud->setPrioridad('Baja');
                        break;
                }                
                $em->persist($solicitud);
                $em->flush();

                return $this->redirectToRoute('solicitud_show', array('id' => $solicitud->getIdsolicitud()));
            }

            return $this->render('solicitud/new_sol.html.twig', array(
                        'solicitud' => $solicitud,
                        'form' => $form->createView(),
                        'rif'=>$session->get('rif'),
                       
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Finds and displays a Solicitud entity.
     *
     * @Route("/{idsolicitud}", name="solicitud_show")
     * @Method("GET")
     */
    public function showAction(Solicitud $solicitud,Request $request,$idsolicitud)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado' or $session->get('tipousuario') == 'Cliente') {
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
            //***********************************************************************S
            return $this->render('solicitud/show.html.twig', array(
                        'idsolicitud' => $idsolicitud,
                        'solicituddetalles'=>$resultadosd,
                        'solicitud'=>$resultados,
                        
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Displays a form to edit an existing Solicitud entity.
     *
     * @Route("/{id}/edit", name="solicitud_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Solicitud $solicitud)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado' or $session->get('tipousuario') == 'Cliente') {
            $deleteForm = $this->createDeleteForm($solicitud);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\SolicitudType', $solicitud);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($solicitud);
                $em->flush();

                return $this->redirectToRoute('solicitud_edit', array('id' => $solicitud->getIdsolicitud()));
            }

            return $this->render('solicitud/edit_sol.html.twig', array(
                        'solicitud' => $solicitud,
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
     * Deletes a Solicitud entity.
     *
     * @Route("/{id}", name="solicitud_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Solicitud $solicitud)
 {
        /*
         * con el siguiente condicional se especifica que un cliente aunque el haya
         * hecho el registro de una solicitud el no puede eliminarla
         */
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Cliente') {
            $this->get('session')->getFlashBag()->add(
                    'Alerta', "Usted no tiene permiso para eliminar una solicitud, llame a Distribuidora Maher, C.A. para que eliminen dicha solicitud"
            );
            return $this->redirect($this->generateUrl('solicitud_index'));
        } else {
            if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
                $form = $this->createDeleteForm($solicitud);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($solicitud);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add(
                            'Mensaje', "El registro fue eliminado satisfactoriamente."
                    );
                } else {
                    $this->get('session')->getFlashBag()->add(
                            'Alerta', "El registro no pudo ser eliminado, puede que el registro este relacionado."
                    );
                }

                return $this->redirectToRoute('solicitud_index');
            } else {
                $this->get('session')->getFlashBag()->add(
                        'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
                );
            }
        }

        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Solicitud entity.
     *
     * @param Solicitud $solicitud The Solicitud entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Solicitud $solicitud)
    {
        
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('solicitud_delete', array('id' => $solicitud->getIdsolicitud())))
                            ->setMethod('DELETE')
                            ->getForm()
            ;
        
    }
    /**
     * en esta funcion de la clase se va a modificar el estatus de la solicitud para que el sistema lo tome en cuenta 
     * cuando este logueado el administrador
     * @Route("/{idsolicitud}/enviar", name="solicitud_enviar")
     * @Method({"GET", "POST"})
     */
    public function enviarAction($idsolicitud){
        $findsolicitud = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Solicitud')
                    ->findOneBy(array('idsolicitud' => $idsolicitud));
        $em = $this->getDoctrine()->getManager();
        $findsolicitud->setEstatus('Enviada'); //con este estatus se envia la solicitud y se evita que el usuario la modifique
        $em->persist($findsolicitud);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
                        'Mensaje', "Su solicitud fue confirmada y enviada a maher para su gestionamiento, gracias por preferirnos"
                );
        return $this->redirect($this->generateUrl('solicitud_index'));
    }
}
