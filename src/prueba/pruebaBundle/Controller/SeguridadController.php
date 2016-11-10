<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Seguridad;
use prueba\pruebaBundle\Form\SeguridadType;

/**
 * Seguridad controller.
 *
 * @Route("/seguridad")
 */
class SeguridadController extends Controller
{
    /**
     * Lists all Seguridad entities.
     *
     * @Route("/seguridad/", name="seguridad_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();

            $seguridads = $em->getRepository('pruebaBundle:Seguridad')->findAll();

            return $this->render('seguridad/index.html.twig', array(
                        'seguridads' => $seguridads,
            ));
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a new Seguridad entity.
     *
     * @Route("/seguridad/new", name="seguridad_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $seguridad = new Seguridad();
            $form = $this->createForm('prueba\pruebaBundle\Form\SeguridadType', $seguridad);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($seguridad);
                $em->flush();

                return $this->redirectToRoute('seguridad_show', array('id' => $seguridad->getIdseguridad()));
            }

            return $this->render('seguridad/new.html.twig', array(
                        'seguridad' => $seguridad,
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
     * Finds and displays a Seguridad entity.
     *
     * @Route("/seguridad/show/{id}", name="seguridad_show")
     * @Method("GET")
     */
    public function showAction(Seguridad $seguridad)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($seguridad);

            return $this->render('seguridad/show.html.twig', array(
                        'seguridad' => $seguridad,
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
     * Displays a form to edit an existing Seguridad entity.
     *
     * @Route("/seguridad/edit/{id}", name="seguridad_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Seguridad $seguridad)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($seguridad);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\SeguridadType', $seguridad);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($seguridad);
                $em->flush();

                return $this->redirectToRoute('seguridad_edit', array('id' => $seguridad->getIdseguridad()));
            }

            return $this->render('seguridad/edit.html.twig', array(
                        'seguridad' => $seguridad,
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
     * Deletes a Seguridad entity.
     *
     * @Route("/seguridad/delete/{id}", name="seguridad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Seguridad $seguridad)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $form = $this->createDeleteForm($seguridad);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($seguridad);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'Mensaje', "El registro fue eliminado satisfactoriamente."
                );
            } else {
                $this->get('session')->getFlashBag()->add(
                        'Alerta', "El registro no pudo ser eliminado, puede que el registro este relacionado."
                );
            }

            return $this->redirectToRoute('seguridad_index');
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Seguridad entity.
     *
     * @param Seguridad $seguridad The Seguridad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Seguridad $seguridad)
    {
        
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('seguridad_delete', array('id' => $seguridad->getIdseguridad())))
                            ->setMethod('DELETE')
                            ->getForm()
            ;
       
    }
    
    /**
     * Bloque de login - verificacion de usuario y clave
     * creacion de session de usuario y guardado de la misma en variables
     * 
     * @Route("/seguridad/check/", name="seguridad_check")
     * @Method({"GET", "POST"})
     */
    public function checkAction(Request $request){
        if ($request->getMethod() == 'POST') {            
            $em = $this->getDoctrine()->getManager();
            $consulta = $em->getRepository('pruebaBundle:Seguridad')->findBy(array('login' => $request->get('login'),'pass'=> md5($request->get('pass'))));
            if ($consulta){
                /**
                 * con este query se busca saber si existe un dia activo o no
                 */
                $dia=date('Y-m-d');
                $queryDia= $em->createQuery(
                    'SELECT d.diafecha '
                  . 'FROM pruebaBundle:Dia d '                  
                  . "WHERE d.diafecha='".$dia."'");
                 $resDia=$queryDia->getResult();
                //************************************************************
                if ($resDia) $diaactivo=1; else $diaactivo=0;
                $session = $request->getSession();
                $session->set('idseguridad',$consulta[0]->getIdseguridad()); // se guarda la id del usuario que se logio
                $session->set('nombreusuario',$consulta[0]->getNombreusuario()); // se guarda el nombre del usuario
                $session->set('login',$consulta[0]->getLogin()); // se guarda el tipo del usuario
                $session->set('tipousuario',$consulta[0]->getTipousuario()); // se guarda el tipo del usuario
                $session->set('rif',$consulta[0]->getRif()); // se guarda el rif del usuario
                $session->set('diaactivo',$diaactivo);
                
                /*
                 * el sistema se loguea con la tabla seguridad, pero los clientes pueden loguiarse siempre y cuando 
                 * tengan un registro en la tabla seguridad y tengan un registro en su tabla cliente,
                 * la busqueda a continuacion se realizara por el rif, el cual sera el nombre del usuario
                 * 
                 */
                
                if ($consulta[0]->getTipousuario() == 'Cliente')
                    return $this->redirect($this->generateUrl('solicitud_index'));
                else
                    return $this->redirect($this->generateUrl('panel'));
            }else {
                $this->get('session')->getFlashBag()->add(
                            'Mensaje',
                            "Error usuario o clave incorrectos..."
                            );
            }
            return $this->render('pruebaBundle:Default:index.html.twig');
        }
    }
    /**
     * Bloque de logout - termina la session del usuario
     * y carga la ventana de login
     * 
     * @Route("/seguridad/logout/", name="seguridad_logout")
     * @Method({"GET", "POST"})
     */
    public function logoutAction(Request $request) {
        $session = $request->getSession();
        $session->clear();      
        return $this->render('pruebaBundle:Default:index.html.twig'); 
    }
    
    /**
     * se guarda el nuevo cliente que se quiera registrar en el sistema de maher
     * 
     * @Route("/seguridad/cliente", name="seguridad_cliente")
     * @Method({"GET", "POST"})
     */        
    public function newclienteAction(Request $request)
    {
        $seguridad = new Seguridad();
        if ($request->get('clave1') == $request->get('clave2')) {
            
            /*
             * para verificar que no se duplique el rif
             */
            $findrif = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Seguridad')
                    ->findOneBy(array('rif' => $request->get('rif')));
            if (!$findrif) {
                /*
                 * para evitar problemas que de error de que no puede capturar el dato
                 * debes hacer lo siguiente:
                 * 1-crea una consulta buscando el dato en la entidad
                 * 2-si se consiguio el resultado deseado, entonces, colocas la variable
                 *   resultado en set correspondiente y listo, problema solucionado
                 */
                $findruta = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Ruta')
                    ->findOneBy(array('idruta' => $request->get('idruta')));
                $seguridad->setNombreusuario($request->get('nombreusuario'));
                $seguridad->setLogin($request->get('login'));
                $seguridad->setPass(md5($request->get('clave1')));
                $seguridad->setRif($request->get('rif'));
                $seguridad->setDireccion($request->get('direccion'));
                $seguridad->setContacto($request->get('contacto'));
                $seguridad->setRutaruta($findruta);
                $seguridad->setTipocliente('Legal');
                $seguridad->setTipousuario('Cliente');

                $em = $this->getDoctrine()->getManager();
                $em->persist($seguridad);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'Mensaje2', "Se le informa que se ha registrado correctamente la base de datos de cliente de Distribuidora Maher, c.a."
                );
            }else{
                $this->get('session')->getFlashBag()->add(
                            'Mensaje',
                           "El rif que acaba de escribir esta ya registrado por otro cliente, por favor revise si escribio bien su Rif, en caso de persistir el problema pongase en contacto con la empresa Distribuidora Maher, c.a."
                            );
            }
        }else {
                $this->get('session')->getFlashBag()->add(
                            'Mensaje',
                           "Claves no coinsiden, vuelva a intentar "
                            );
            }
            return $this->redirect($this->generateUrl('inicio'));
    }
    
     /**
     * se guarda el nuevo cliente que se quiera registrar en el sistema de maher
     * 
     * @Route("/seguridad/cambio/clave", name="seguridad_cambioclave")
     * @Method({"GET", "POST"})
     */        
    public function cambiarclaveAction(Request $request)
    {
        $session = $request->getSession();
        $seguridad = $this->getDoctrine()
                    ->getRepository('pruebaBundle:Seguridad')
                    ->findOneBy(array('idseguridad' => $session->get('idseguridad')));
        if ($request->get('clave1') == $request->get('clave2')) {
            $seguridad->setPass(md5($request->get('clave1')));
            $em = $this->getDoctrine()->getManager();
            $em->persist($seguridad);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                        'Mensaje2', "Se le informa que se ha cambiado correctamente su claves"
            );
        }
        return $this->redirect($this->generateUrl('panel'));
    }
}
