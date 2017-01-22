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
     * Aqui se realiza de manera automatica el plan de distribucion y luego se muestra.
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

            $fecha=date('Y-m-d');
            $findDia = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Dia')
                    ->findOneBy(array(
                        'diafecha' => new \DateTime($fecha),                        
                    ));
//            $findDia=$em->createQuery(
//                      ' SELECT d.iddia '
//                    . ' FROM pruebaBundle:Dia d '
//                    . " WHERE d.diafecha='". $fecha ."' "
//                    );
//            $resDia=$findDia->getResult();
            
            $queryPO= $em->createQuery(
                    'SELECT  s.nombreusuario, r.nombreruta,p.nombreproducto, SUM(p.precioventa*sd.cantidad) monto ,SUM(sd.cantidad) cantidad ,sol.tipopago, sol.idsolicitud,sol.estatus   '
                  . 'FROM pruebaBundle:Seguridad s, pruebaBundle:Ruta r, pruebaBundle:Producto p, pruebaBundle:Solicituddetalle sd, pruebaBundle:Solicitud sol '                  
                  . "WHERE sol.rif=s.rif AND s.rutaruta=r.idruta AND p.idproducto=sd.idproducto GROUP BY r.nombreruta, sd.idproducto"
            );
            $resPO=$queryPO->getResult();
            
            $findSolicitud = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Solicitud')
                    ->findOneBy(array(
                        'estatus' => 'Enviada',                        
                    ));
            $findPlan = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Plandistribucion')
                    ->findOneBy(array(
                        'iddia' => $findDia,
            ));
            if (!$findPlan) {
                $plandistribucion = new Plandistribucion();
                foreach ($resPO as $newPO) {
                    $plandistribucion->setIddia($findDia);
                    $plandistribucion->setIdsolicitud($findSolicitud);
                    $plandistribucion->setPlandistribucionestatus('Activo');
                    $plandistribucion->setPlandistribucionobservacion('Plan de distribucion realizado en fecha ' . date('d-m-Y h:i:s A'));
                    $em->persist($plandistribucion);
                    $em->flush();
                }
            }
            //se se va a ingresar el registro a traves de foreach            
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

}
