<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Gastonomina;
use prueba\pruebaBundle\Form\GastonominaType;

/**
 * Gastonomina controller.
 *
 * @Route("/gastonomina")
 */
class GastonominaController extends Controller
{
    /**
     * Lists all Gastonomina entities.
     *
     * @Route("/", name="gastonomina_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $em = $this->getDoctrine()->getManager();

            $gastonominas = $em->getRepository('pruebaBundle:Gastonomina')->findAll();
             /*
             * con este condicional el cliente solo podra observar solo sus solicitudes nada mas
             * permisologia evita que el cliente tenga acceso a las opciones del navbar
             */
            if ($session->get('tipousuario') == 'Cliente') {                
                $permisologia = 0;
            } else {                
                $permisologia = 1;
            }

            return $this->render('gastonomina/index_gn.html.twig', array(
                        'gastonominas' => $gastonominas,
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
     * Creates a new Gastonomina entity.
     *
     * @Route("/new", name="gastonomina_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $gastonomina = new Gastonomina();
            $form = $this->createForm('prueba\pruebaBundle\Form\GastonominaType', $gastonomina);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($gastonomina);
                $em->flush();

                return $this->redirectToRoute('gastonomina_show', array('id' => $gastonomina->getIdgastonomina()));
            }

            return $this->render('gastonomina/new_gn.html.twig', array(
                        'gastonomina' => $gastonomina,
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
     * Finds and displays a Gastonomina entity.
     *
     * @Route("/{id}", name="gastonomina_show")
     * @Method("GET")
     */
    public function showAction(Gastonomina $gastonomina,Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($gastonomina);

            return $this->render('gastonomina/show_gn.html.twig', array(
                        'gastonomina' => $gastonomina,
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
     * Displays a form to edit an existing Gastonomina entity.
     *
     * @Route("/{id}/edit", name="gastonomina_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Gastonomina $gastonomina)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $deleteForm = $this->createDeleteForm($gastonomina);
            $editForm = $this->createForm('prueba\pruebaBundle\Form\GastonominaType', $gastonomina);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($gastonomina);
                $em->flush();

                return $this->redirectToRoute('gastonomina_edit', array('id' => $gastonomina->getIdgastonomina()));
            }

            return $this->render('gastonomina/edit_gn.html.twig', array(
                        'gastonomina' => $gastonomina,
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
     * Deletes a Gastonomina entity.
     *
     * @Route("/{id}", name="gastonomina_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Gastonomina $gastonomina)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario') == 'Administrador' or $session->get('tipousuario') == 'Empleado') {
            $form = $this->createDeleteForm($gastonomina);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($gastonomina);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'Mensaje', "El registro fue eliminado satisfactoriamente."
                );
            }else{
                $this->get('session')->getFlashBag()->add(
                        'Alerta', "El registro no pudo ser eliminado, puede que el registro este relacionado."
                );
            }


            return $this->redirectToRoute('gastonomina_index');
        } else {
            $this->get('session')->getFlashBag()->add(
                    'Mensaje', "Esta intentando entrar a una zona de seguridad a la cual no tiene acceso"
            );
        }
        return $this->redirect($this->generateUrl('inicio'));
    }

    /**
     * Creates a form to delete a Gastonomina entity.
     *
     * @param Gastonomina $gastonomina The Gastonomina entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Gastonomina $gastonomina)
    {
        
            return $this->createFormBuilder()
                            ->setAction($this->generateUrl('gastonomina_delete', array('id' => $gastonomina->getIdgastonomina())))
                            ->setMethod('DELETE')
                            ->getForm()
            ;
        
    }
}
