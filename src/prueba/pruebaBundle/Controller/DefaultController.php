<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Form\SeguridadclienteType;
use prueba\pruebaBundle\Entity\Dia;

class DefaultController extends Controller
{
    /**
     * @Route("/inicio",name="inicio")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        return $this->render('pruebaBundle:Default:index.html.twig',array('diaactivo'=>$session->get('diaactivo')));
    }

    /**
     * @Route("/panel", name="panel")
     */
    public function panelAction(Request $request)
    {
       $session = $request->getSession();
       
       if ($session->get('tipousuario')=='Administrador' or $session->get('tipousuario')=='Empleado') {
          $permisologia=1;
          $em=$this->getDoctrine()->getManager();
          /**
           * aqui se va a consultar el total de los gastos operativos que se encuentren en el mes en curso
           */
          $primero=date('Y').'-'.date('m').'-01'; //se obtiene el primer dia del mes
          $ultimo=date('Y').'-'.date('m').'-'.cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); //se obtiene el ultimo dia del mes
          /*
           * se modifico la sentencia sql por haber modificado la estructura de la base de datos 
           */
          $queryGastoOperativo= $em->createQuery(
                    'SELECT SUM(go.montogasto) trgo '
                  . 'FROM pruebaBundle:Gastosoperativos go  '
                  . "WHERE go.fechagasto between '".$primero."' and '".$ultimo."'");
          $resGastosOperativosMes=$queryGastoOperativo->getResult();
          if (!$resGastosOperativosMes) $resGastosOperativosMes= array('trgo'=>0);
          //*****************************************************************************************
          /**
           * aqui se va a buscar la informacion de los movimientos del inventario o kardex
           * 
           */
          $queryMovimiento= $em->createQuery(
                    'SELECT m.fechamovimiento, m.tipomovimiento, m.conceptomovimiento,p.nombreproducto, u.nombreund,'
                  . '       p.preciocosto, p.precioventa, m.cantidad '
                  . 'FROM pruebaBundle:Movimiento m INNER JOIN '
                  . '     pruebaBundle:Producto p with m.idproducto=p.idproducto INNER JOIN '
                  . '     pruebaBundle:Und u WITH p.idund=u.idund '                  
                  . "WHERE m.fechamovimiento between '".$primero."' AND '".$ultimo."'");
          $resMovimiento=$queryMovimiento->getResult();
          //******************************************************************************************
          /**
           * aqui se va a llenar el cuadro de movimientos de almacen 
           */
          $queryMAxM=$em->createQuery(
                    'SELECT m.tipomovimiento,count(m.idmovimiento) cantidad '
                  . 'from pruebaBundle:Movimiento m '
                  . 'group by m.tipomovimiento'
                  
                  );
          $resMaxM=$queryMAxM->getResult();
          //******************************************************************************************
          /**
           * aqui se va a mostrar la informacion de los inventarios
           */
          $querySumInv=$em->createQuery(
                    'SELECT a.nombrealmacen,sum(p.precioventa*i.cantidad) sti '
                  . 'from pruebaBundle:Inventario i INNER JOIN pruebaBundle:Producto p with  i.idproducto=p.idproducto INNER JOIN pruebaBundle:Almacen a with i.idalmacen=a.idalmacen '
                  . 'Where i.idproducto=p.idproducto  and i.idalmacen=a.idalmacen '
                  . 'group by a.nombrealmacen '
                  
                  );
          $queryinventario=$em->createQuery(
                    'SELECT p.nombreproducto,i.cantidad, a.nombrealmacen '
                  . 'from pruebaBundle:Inventario i INNER JOIN pruebaBundle:Producto p with  i.idproducto=p.idproducto '
                  .'INNER JOIN pruebaBundle:Almacen a with a.idalmacen=i.idalmacen '
                  . 'Where i.idproducto=p.idproducto '
                  . 'group by p.nombreproducto '
                  
                  );
          $resinventario=$queryinventario->getResult();
          $resSumInv=$querySumInv->getResult();
          //*******************************************************************************************
          /**
           * aqui se va a mostrar la informacion de las cantidades de solicitudes realizadas
           */
          $querysolicitud=$em->createQuery(
                    'SELECT sol.tipopago,count(sol.idsolicitud) cantidad,sol.prioridad '
                  . 'from pruebaBundle:Solicitud sol  '
                  . "Where sol.estatus='Enviada' "
                  . 'group by sol.tipopago '
                  
                  );
          $ressolicitud=$querysolicitud->getResult();
          //*******************************************************************************************
           /**
           * aqui se va a mostrar la informacion de los gastos operativos
           */
          
          $querygo=$em->createQuery(
                    'SELECT go.conceptogasto,sum(go.montogasto) monto  '
                  . 'from pruebaBundle:Gastosoperativos go  '                  
                  . 'group by go.conceptogasto '
                  
                  );
          $resgo=$querygo->getResult();

         /*
          * se calcula el balance general
          */
         $querygn=$em->createQuery(
                    'SELECT go.conceptogasto,sum(go.montogasto) monto  '
                  . 'from pruebaBundle:Gastonomina go  '                  
                  . 'group by go.conceptogasto '
                  
                  );
          $resgo=$querygo->getResult();
           return $this->render('pruebaBundle:Default:dashboard.html.twig', array(
                        'permisologia' => $permisologia,
                        'nu'=>$session->get('nombreusuario'),
                        'l'=>$session->get('login'),
                        'rgo'=>$resGastosOperativosMes,
                        'movimientos'=>$resMovimiento,
                        'diaactivo'=>$session->get('diaactivo'),
                        'maxm'=>$resMaxM,
                        'inventario'=>$resinventario,
                        'solicitud'=>$ressolicitud,
                        'go'=>$resgo,
                        'rsi'=>$resSumInv,
                        
            )); 
       }else {
           $this->get('session')->getFlashBag()->add(
                            'Mensaje',
                            "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso".$session->get('tipousuario')
                            );            
        }
    return $this->redirect($this->generateUrl('inicio'));    
    }
    /**
     * @Route("/md5/{numero}", name="md5")
     */
    public function md5Action($numero){
        if ($numero>0){
           return $this->render('pruebaBundle:Default:md5.html.twig',array('md5'=>md5($numero))); 
        }
        
    }
    /**
     * @Route("/modal", name="modal")
     */
     public function modalAction(){
        
           return $this->render('pruebaBundle:Default:modalFormNewCliente.html.twig');
        
        
    }
    /**
     * @Route("/modal/kardex/producto", name="modalproducto")
     */
     public function modalkardexproductoAction(){
        
           return $this->render('pruebaBundle:Default:modalFormNewCliente.html.twig');
        
        
    }
    /**
     * @Route("/modal/kardex/fecha", name="modalfecha")
     */
     public function modalkardexfechaAction(){
        
           return $this->render('pruebaBundle:Default:modalFormNewCliente.html.twig');
        
        
    }
    /**
     * @Route("/modal/kardex/almacen", name="modalalmacen")
     */
     public function modalkardexalmacenAction(){
        
           return $this->render('pruebaBundle:Default:modalFormNewCliente.html.twig');
        
        
    }
    /**
     * @Route("/dia",name="dia_activo")
     */
    public function DiaAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado' or $session->get('tipousuario') == 'Cliente') {

            /**
             * con este query se busca saber si existe un dia activo o no
             */
            $em = $this->getDoctrine()->getManager();
            $fecha = date('Y-m-d');
            $queryDia = $em->createQuery(
                      'SELECT d.diafecha '
                    . 'FROM pruebaBundle:Dia d '
                    . "WHERE d.diafecha=' . $fecha . '");
            $resDia = $queryDia->getResult();
            //$resDia = $em->getRepository('pruebaBundle:Dia')->findBy(
            //        array('diafecha' => $fecha)
            //         );

            //************************************************************
            if ($resDia)
                $diaactivo = 1;
            else
                $diaactivo = 0;
            
            if ($resDia) {
                $this->get('session')->getFlashBag()->add(
                        'MensajeAlerta', "*** El dia se encuentra activo ***"
                );
            } else {
                $findseguridad = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Seguridad')
                    ->findOneBy(array('idseguridad' => $session->get('idseguridad')));
                $dia = new Dia(); 
                $fecha=date('Y/m/d');
                $dia->setDiafecha(new \DateTime($fecha));
                $dia->setActivo(1);
                $dia->setIdseguridad($findseguridad);
                $em->persist($dia);
                $em->flush();
                $session->set('diaactivo',1);
                $this->get('session')->getFlashBag()->add(
                        'MensajeCorrecto', "Se a activado el dia de manera correcta"
                );
                
            }


            return $this->redirect($this->generateUrl('panel'));  
        }
           
        
    }
    
    /**
     * @Route("/modal/cambioclave", name="cambioclave")
     */
     public function cambioclaveAction(){
        
           return $this->render('pruebaBundle:Default:cambioclave.html.twig');
        
        
    }
    /**
     * @Route("/modal/reportsol/{prioridad}", name="rep_sol")
     */
     public function repsolaltaAction($prioridad,Request $request){
        $em = $this->getDoctrine()->getManager();
        $querySol= $em->createQuery(
                    'SELECT s.idsolicitud, s.fechadolicitud, s.fechaentrega, s.estatus '                  
                  . 'FROM pruebaBundle:Solicitud s '                 
                  . "WHERE s.prioridad= '".$prioridad."'");
          $solicitud=$querySol->getResult();
        return $this->render('pruebaBundle:Default:rep_sol.html.twig',array('solicituds'=>$solicitud));        
    }
    
    /**
     * en esta funcion se realiza el cierre del dia de trabajo
     * @Route("/diacerrar",name="dia_cerrar")
     */
    public function CerrarDiaAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado' or $session->get('tipousuario') == 'Cliente') {

            /**
             * con este query se busca saber si existe un dia activo o no
             */
            $em = $this->getDoctrine()->getManager();
            $dia = date('Y-m-d');
            $queryDia = $em->createQuery(
                      'SELECT d.diafecha '
                    . 'FROM pruebaBundle:Dia d '
                    . "WHERE d.diafecha='".$dia."'");
            $resDia = $queryDia->getResult();
            //************************************************************
            
            $findseguridad = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Seguridad')
                    ->findOneBy(array('idseguridad' => $session->get('idseguridad')));
            
            if ($resDia)  {
                $xdia = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Dia')
                    ->findOneBy(array('activo' => 1)); 
                $xdia->setActivo(0);
                $session->set('diaactivo',0);                
                $em->persist($xdia);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'Mensaje', "Se ha cerrado el dia de manera correcta"
                );
                
            }


            return $this->redirect($this->generateUrl('panel'));  
        }       
    }

    /**
    * aqui se realiza el resultado de de las busquedas
    *
    * @Route("/buscar",name="buscar_s")
    */ 
    public function searchAction(Request $request){

      switch (strtoupper($request->get('search'))) {
        case 'UNIDAD':
          return $this->redirect($this->generateUrl('und_index'));
          break;
        case 'MOVIMIENTO':
          return $this->redirect($this->generateUrl('movimiento_index'));
          break;
        case 'SOLICITUD':
          return $this->redirect($this->generateUrl('solicitud_index'));
          break;
        case 'RUTA':
          return $this->redirect($this->generateUrl('ruta_index'));
          break;
        case 'PRODUCTO':
          return $this->redirect($this->generateUrl('producto_index'));
          break;
        case 'ALMACEN':
          return $this->redirect($this->generateUrl('almacen_index'));
          break; 
         default:
          return $this->redirect($this->generateUrl('panel'));
          break;  
      }
    }
    
}
