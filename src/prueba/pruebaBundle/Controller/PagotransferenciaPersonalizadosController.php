<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Pagotransferencia;
use prueba\pruebaBundle\Form\PagotransferenciaType;

/**
 * Pagotransferencia controller.
 *
 * @Route("/pagotransferencia")
 */
class PagotransferenciaController extends Controller
{
    /**
     * Lists all Pagotransferencia entities.
     *
     * @Route("/", name="pagotransferencia_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();

            $pagotransferencias = $em->getRepository('pruebaBundle:Pagotransferencia')->findAll();

            return $this->render('pagotransferencia/index.html.twig', array(
                        'pagotransferencias' => $pagotransferencias,
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Pagotransferencia entity.
     *
     * @Route("/new", name="pagotransferencia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $pagotransferencium = new Pagotransferencia();
            $form = $this->createForm('prueba\pruebaBundle\Form\PagotransferenciaType', $pagotransferencium);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($pagotransferencium);
                $em->flush();

                return $this->redirectToRoute('pagotransferencia_show', array('id' => $pagotransferencium->getIdpagotransferencia()));
            }

            return $this->render('pagotransferencia/new.html.twig', array(
                        'pagotransferencium' => $pagotransferencium,
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
     * Finds and displays a Pagotransferencia entity.
     *
     * @Route("/{id}", name="pagotransferencia_show")
     * @Method("GET")
     */
    public function showAction(Pagotransferencia $pagotransferencium)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($pagotransferencium);

            return $this->render('pagotransferencia/show.html.twig', array(
                        'pagotransferencium' => $pagotransferencium,
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
     * Displays a form to edit an existing Pagotransferencia entity.
     *
     * @Route("/{id}/edit", name="pagotransferencia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pagotransferencia $pagotransferencium)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($pagotransferencium);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\PagotransferenciaType', $pagotransferencium);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($pagotransferencium);
                $em->flush();

                return $this->redirectToRoute('pagotransferencia_edit', array('id' => $pagotransferencium->getIdpagotransferencia()));
            }

            return $this->render('pagotransferencia/edit.html.twig', array(
                        'pagotransferencium' => $pagotransferencium,
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
     * Deletes a Pagotransferencia entity.
     *
     * @Route("/{id}", name="pagotransferencia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pagotransferencia $pagotransferencium)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
 $form = $this->createDeleteForm($pagotransferencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($pagotransferencium);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'Mensaje', "El registro fue eliminado satisfactoriamente."
                );
            } else {
                $this->get('session')->getFlashBag()->add(
                        'Alerta', "El registro no pudo ser eliminado, puede que el registro este relacionado."
                );
            }

            return $this->redirectToRoute('pagotransferencia_index');
} else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
       
    }

    /**
     * Creates a form to delete a Pagotransferencia entity.
     *
     * @param Pagotransferencia $pagotransferencium The Pagotransferencia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pagotransferencia $pagotransferencium)
    {
        
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('pagotransferencia_delete', array('id' => $pagotransferencium->getIdpagotransferencia())))
                            ->setMethod('DELETE')
                            ->getForm()
            ;
        
    }

     /**
     * Se va a llenar el formulario de ingreso de datos de pagos pero dicho formulario sera personalizado
     * con el fin de hacer que llene tanto los datos que van a ir a la tabla de pagos como tambien de 
     * pagosefectivos.
     * @Route("/new/{idsolicitud}", name="pagos_personalizado_transferencia_new")
     * @Method({"GET", "POST"})
     */
    public function newPagosTransferenciaPersonalizadosAction(Request $request,$idsolicitud)
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
            $pagotransferencia= new Pagostransferencia();
            $form = $this->createForm('prueba\pruebaBundle\Form\PagosType', $pago); //aqui debo de hacer un nuevo formulario de pago para ingresar los datos de la transferencia, no se puede reutilizar el formulario de pagos
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
