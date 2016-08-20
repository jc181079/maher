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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seguridads = $em->getRepository('pruebaBundle:Seguridad')->findAll();

        return $this->render('seguridad/index.html.twig', array(
            'seguridads' => $seguridads,
        ));
    }

    /**
     * Creates a new Seguridad entity.
     *
     * @Route("/seguridad/new", name="seguridad_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $seguridad = new Seguridad();
        $form = $this->createForm('prueba\pruebaBundle\Form\SeguridadType', $seguridad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seguridad);
            $em->flush();

            return $this->redirectToRoute('seguridad_show', array('id' => $seguridad->getId()));
        }

        return $this->render('seguridad/new.html.twig', array(
            'seguridad' => $seguridad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Seguridad entity.
     *
     * @Route("/seguridad/show/{id}", name="seguridad_show")
     * @Method("GET")
     */
    public function showAction(Seguridad $seguridad)
    {
        $deleteForm = $this->createDeleteForm($seguridad);

        return $this->render('seguridad/show.html.twig', array(
            'seguridad' => $seguridad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Seguridad entity.
     *
     * @Route("/seguridad/edit/{id}", name="seguridad_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Seguridad $seguridad)
    {
        $deleteForm = $this->createDeleteForm($seguridad);
        $editForm = $this->createForm('prueba\pruebaBundle\Form\SeguridadType', $seguridad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seguridad);
            $em->flush();

            return $this->redirectToRoute('seguridad_edit', array('id' => $seguridad->getId()));
        }

        return $this->render('seguridad/edit.html.twig', array(
            'seguridad' => $seguridad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Seguridad entity.
     *
     * @Route("/seguridad/delete/{id}", name="seguridad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Seguridad $seguridad)
    {
        $form = $this->createDeleteForm($seguridad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seguridad);
            $em->flush();
        }

        return $this->redirectToRoute('seguridad_index');
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
            ->setAction($this->generateUrl('seguridad_delete', array('id' => $seguridad->getId())))
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
                $session = $request->getSession();
                $session->set('idseguridad',$consulta->get('idseguridad')); // se guarda la id del usuario que se logio
                $session->set('nombreusuario',$consulta->get('nombreusuario')); // se guarda el nombre del usuario
                $session->set('login',$consulta->get('login')); // se guarda el tipo del usuario
                $session->set('tipousuario',$consulta->get('tipousuario')); // se guarda el tipo del usuario
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
            
    
}
