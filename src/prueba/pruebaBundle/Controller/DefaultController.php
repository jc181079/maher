<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/inicio",name="inicio")
     */
    public function indexAction()
    {
        return $this->render('pruebaBundle:Default:index.html.twig');
    }
    /**
     * @Route("/panel", name="panel")
     */
    public function panelAction(Request $request)
    {
       $session = $request->getSession();
       
       if ($session->get('tipousuario')=='Administrador' or $session->get('tipousuario')=='Empleado') {
          return $this->render('pruebaBundle:Default:dashboard.html.twig'); 
       }else {
           $this->get('session')->getFlashBag()->add(
                            'Mensaje',
                            "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
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
}
