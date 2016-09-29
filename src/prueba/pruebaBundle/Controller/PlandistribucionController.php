<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Plandistribucion;
use prueba\pruebaBundle\Form\PlandistribucionType;

/**
 * Plandistribucion controller.
 *
 * @Route("/plandistribucion")
 */
class PlandistribucionController extends Controller
{
    /**
     * Lists all Plandistribucion entities.
     *
     * @Route("/", name="plandistribucion_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();

            $plandistribucions = $em->getRepository('pruebaBundle:Plandistribucion')->findAll();

            return $this->render('plandistribucion/index.html.twig', array(
                        'plandistribucions' => $plandistribucions,
                        'nu'=>$session->get('nombreusuario'),
                        'l'=>$session->get('login'),
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Plandistribucion entity.
     *
     * @Route("/new", name="plandistribucion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $plandistribucion = new Plandistribucion();
            $form = $this->createForm('prueba\pruebaBundle\Form\PlandistribucionType', $plandistribucion);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($plandistribucion);
                $em->flush();

                return $this->redirectToRoute('plandistribucion_show', array('id' => $plandistribucion->getIdplandistribucion()));
            }

            return $this->render('plandistribucion/new.html.twig', array(
                        'plandistribucion' => $plandistribucion,
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
     * Finds and displays a Plandistribucion entity.
     *
     * @Route("/plan", name="plandistribucion_show")
     * @Method("GET")
     */
    public function showAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            //$deleteForm = $this->createDeleteForm($plandistribucion);
            /**
             * aqui se muestra el plan de distribucion del dia 
             */
            $em=$this->getDoctrine()->getManager();
//            $findDia=$em->createQuery(
//                      'SELECT d.iddia '
//                    . 'FROM pruebaBundle:Dia d '
//                    . "WHERE d.diafecha='". date('Y-m-d') ."' "
//                    );
            $fecha=date('Y-m-d');
            $findDia = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Dia')
                    ->findOneBy(array(
                        'diafecha' => new \DateTime($fecha),                        
                    ));
            //$resDia=$findDia->getResult();
            
            $queryPO= $em->createQuery(
                    'SELECT  s.nombreusuario, r.nombreruta,p.nombreproducto, SUM(sd.cantidad) cantidad ,sol.tipopago, sol.idsolicitud  '
                  . 'FROM pruebaBundle:Seguridad s, pruebaBundle:Ruta r, pruebaBundle:Producto p, pruebaBundle:Solicituddetalle sd, pruebaBundle:Solicitud sol '                  
                  . "WHERE sol.rif=s.rif AND s.rutaruta=r.idruta AND p.idproducto=sd.idproducto AND sol.estatus='Enviada' GROUP BY r.nombreruta, sd.idproducto"
            );
            $resPO=$queryPO->getResult();
            
            $findSolicitud = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Solicitud')
                    ->findOneBy(array(
                        'estatus' => 'Enviada',                        
                    ));
            
            //se se va a ingresar el registro a traves de foreach
            $plandistribucion = new Plandistribucion();
            foreach ($resPO as $newPO){
                $plandistribucion->setIddia($findDia);
                $plandistribucion->setIdsolicitud($findSolicitud);
                $plandistribucion->setPlandistribucionestatus('Activo');
                $plandistribucion->setPlandistribucionobservacion('Plan de distribucion realizado en fecha '.date('d-m-YYYY h:i:s A'));
                 $em->persist($plandistribucion);
                $em->flush();
            }
            
            return $this->render('plandistribucion/show_PO.html.twig', array(
                        "resPO"=>$resPO,
                        'nu'=>$session->get('nombreusuario'),
                        'l'=>$session->get('login'),
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Displays a form to edit an existing Plandistribucion entity.
     *
     * @Route("/{id}/edit", name="plandistribucion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Plandistribucion $plandistribucion)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($plandistribucion);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\PlandistribucionType', $plandistribucion);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($plandistribucion);
                $em->flush();

                return $this->redirectToRoute('plandistribucion_edit', array('id' => $plandistribucion->getIdplandistribucion()));
            }

            return $this->render('plandistribucion/edit.html.twig', array(
                        'plandistribucion' => $plandistribucion,
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
     * Deletes a Plandistribucion entity.
     *
     * @Route("/{id}", name="plandistribucion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Plandistribucion $plandistribucion)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $form = $this->createDeleteForm($plandistribucion);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($plandistribucion);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'Mensaje', "El registro fue eliminado satisfactoriamente."
                );
            } else {
                $this->get('session')->getFlashBag()->add(
                        'Alerta', "El registro no pudo ser eliminado, puede que el registro este relacionado."
                );
            }

            return $this->redirectToRoute('plandistribucion_index');
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Plandistribucion entity.
     *
     * @param Plandistribucion $plandistribucion The Plandistribucion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Plandistribucion $plandistribucion)
    {
        
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('plandistribucion_delete', array('id' => $plandistribucion->getIdplandistribucion())))
                            ->setMethod('DELETE')
                            ->getForm()
            ;
        
    }

}
