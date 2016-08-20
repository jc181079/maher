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
       if ($session->has('tipousuario')) {
          return $this->render('pruebaBundle:Default:index.html.twig'); 
       }else {
           $this->get('session')->getFlashBag()->add(
                            'Mensaje',
                            "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
                            );            
        }
    return $this->redirect($this->generateUrl('inicio'));    
    }
}
