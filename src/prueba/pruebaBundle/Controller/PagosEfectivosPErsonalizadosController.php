<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Pagos;
use prueba\pruebaBundle\Entity\Pagosefectivos;
use prueba\pruebaBundle\Entity\Solicitud;
use prueba\pruebaBundle\Form\PagosType;

/**
 * Pagos controller.
 *
 * @Route("/pagosefectivospersonalizados")
 */
class PagosEfectivosPErsonalizadosController extends Controller
{
    /**
     * Lists all Pagos entities.
     *
     * @Route("/", name="solicitudesEntregadasEfectivo_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $permisologia=1;
            $em = $this->getDoctrine()->getManager();

             //$solicituds = $em->getRepository('pruebaBundle:Solicitud')->findBy(array(
             //   'estatus' => 'Entregada',
             //   'tipopago'=>'Efectivo'
             //   ));
             $estatus="Entregada";
             $findsol = $em->createQuery(
                       'select s.idsolicitud,s.fechadolicitud, s.fechaentrega, s.estatus, pa.montopagado, se.nombreusuario

                        from pruebaBundle:solicitud s inner join pruebaBundle:pagos pa with
                        pa.idsolicitud=s.idsolicitud inner join pruebaBundle:seguridad se with s.rif=se.rif '.

                        "where s.estatus='" . $estatus . "' and s.rif=se.rif"
            );
            $solicituds=$findsol->getResult();

            return $this->render('pagos/indexPagosEfectivosPErsonaliado.html.twig', array(
                        'solicituds' => $solicituds,
                        'nu'=>$session->get('nombreusuario'),
                        'l'=>$session->get('login'),
                        'permisologia' => $permisologia,
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
     * Creates a new Pagos entity.
     *
     * @Route("/new", name="pagos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $pago = new Pagos();
            $form = $this->createForm('prueba\pruebaBundle\Form\PagosType', $pago);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($pago);
                $em->flush();

                return $this->redirectToRoute('pagos_show', array('id' => $pago->getIdpagos()));
            }

            return $this->render('pagos/new.html.twig', array(
                        'pago' => $pago,
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
     * Finds and displays a Pagos entity.
     *
     * @Route("/{id}", name="solicitudesEntregadasEfectivo_show")
     * @Method("GET")
     */
    public function solicitudesEntregadasEfectivoshowAction(Pagos $pago,$idsolicitud)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($pago);

            return $this->render('pagos/show.html.twig', array(
                        'pago' => $pago,
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
     * Displays a form to edit an existing Pagos entity.
     *
     * @Route("/{id}/edit", name="pagos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pagos $pago)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($pago);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\PagosType', $pago);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($pago);
                $em->flush();

                return $this->redirectToRoute('pagos_edit', array('id' => $pago->getIdpagos()));
            }

            return $this->render('pagos/edit.html.twig', array(
                        'pago' => $pago,
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
     * Deletes a Pagos entity.
     *
     * @Route("/{id}", name="pagos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pagos $pago)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $form = $this->createDeleteForm($pago);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($pago);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'Mensaje', "El registro fue eliminado satisfactoriamente."
                );
            } else {
                $this->get('session')->getFlashBag()->add(
                        'Alerta', "El registro no pudo ser eliminado, puede que el registro este relacionado."
                );
            }

            return $this->redirectToRoute('pagos_index');
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Pagos entity.
     *
     * @param Pagos $pago The Pagos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pagos $pago)
    {
        
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('pagos_delete', array('id' => $pago->getIdpagos())))
                            ->setMethod('DELETE')
                            ->getForm()
            ;
        
    }

     /**
     * Se va a llenar el formulario de ingreso de datos de pagos pero dicho formulario sera personalizado
     * con el fin de hacer que llene tanto los datos que van a ir a la tabla de pagos como tambien de 
     * pagosefectivos.
     * @Route("/new/{idsolicitud}", name="pagos_personalizado_efectivo_new")
     * @Method({"GET", "POST"})
     */
    public function newPagosPersonalizadoEfectivoAction(Request $request,$idsolicitud)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();
            $findsd = $em->createQuery(
                       'select sum(sd.total) montoPagar

                        from pruebaBundle:producto p inner join pruebaBundle:solicituddetalle sd with
                        sd.idproducto=p.idproducto

                        where sd.idsolicitud=' . $idsolicitud . ''
            );
            $resultadosd=$findsd->getResult();
            $pago = new Pagos();
            $pagoefectivo= new Pagosefectivos();
            $form = $this->createForm('prueba\pruebaBundle\Form\PagosType', $pago);
            $form->handleRequest($request);
            $solicituds = $em->getRepository('pruebaBundle:Solicitud')->findBy(array(
                    'idsolicitud' => $idsolicitud));

            if ($form->isSubmitted() && $form->isValid()) {    
                $pago->setTipopago('Efectivo');
                $findsolicitud = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Solicitud')
                    ->findOneBy(array('idsolicitud' => $idsolicitud));
                $pago->setIdsolicitud($findsolicitud);
                $em->persist($pago);
                $em->flush();
                $findpago = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Pagos')
                    ->findOneBy(array('idsolicitud' => $idsolicitud));
                $pagoefectivo->setIdpagos($findpago);
                $pagoefectivo->setNumerosolicitud($pago->getNumerosolicitud());
                $pagoefectivo->setFechapagoefectivo($pago->getFechapago());
                $pagoefectivo->setPagosefectivomonto($pago->getMontopagado());
                $em->persist($pagoefectivo);
                $em->flush();           
                return $this->redirectToRoute('solicitudesEntregadasEfectivo_index');
            }

            return $this->render('pagos/new.html.twig', array(
                        'pago' => $pago,
                        'solicituds'=>$solicituds,
                        'resultadosd'=>$resultadosd,
                        'form' => $form->createView(),
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }
}
