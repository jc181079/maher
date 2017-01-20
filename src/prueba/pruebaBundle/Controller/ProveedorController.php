<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Proveedor;
use prueba\pruebaBundle\Form\ProveedorType;

/**
 * Proveedor controller.
 *
 * @Route("/proveedor")
 */
class ProveedorController extends Controller
{
    /**
     * Lists all Proveedor entities.
     *
     * @Route("/", name="proveedor_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('tipousuario')=='Administrador' or $session->get('tipousuario')=='Empleado') {
            $permisologia=1;
            $em = $this->getDoctrine()->getManager();

            $proveedors = $em->getRepository('pruebaBundle:Proveedor')->findAll();

            return $this->render('proveedor/index_prov.html.twig', array(
                'proveedors' => $proveedors,
                'permisologia'=>  $permisologia,
                'nu'=>$session->get('nombreusuario'),
                'l'=>$session->get('login'),
                'diaactivo'=>$session->get('diaactivo'),
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
     * Creates a new Proveedor entity.
     *
     * @Route("/new", name="proveedor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $proveedor = new Proveedor();
        $form = $this->createForm('prueba\pruebaBundle\Form\ProveedorType', $proveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proveedor);
            $em->flush();

            return $this->redirectToRoute('proveedor_show', array('id' => $proveedor->getIdproveedor()));
        }

        return $this->render('proveedor/new_prov.html.twig', array(
            'proveedor' => $proveedor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Proveedor entity.
     *
     * @Route("/{id}", name="proveedor_show")
     * @Method("GET")
     */
    public function showAction(Proveedor $proveedor)
    {
        $deleteForm = $this->createDeleteForm($proveedor);

        return $this->render('proveedor/show_prov.html.twig', array(
            'proveedor' => $proveedor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Proveedor entity.
     *
     * @Route("/{id}/edit", name="proveedor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Proveedor $proveedor)
    {
        $deleteForm = $this->createDeleteForm($proveedor);
        $editForm = $this->createForm('prueba\pruebaBundle\Form\ProveedorType', $proveedor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proveedor);
            $em->flush();

            return $this->redirectToRoute('proveedor_edit', array('id' => $proveedor->getIdproveedor()));
        }

        return $this->render('proveedor/edit_prov.html.twig', array(
            'proveedor' => $proveedor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Proveedor entity.
     *
     * @Route("/{id}", name="proveedor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Proveedor $proveedor)
    {
        $form = $this->createDeleteForm($proveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($proveedor);
            $em->flush();
        }

        return $this->redirectToRoute('proveedor_index');
    }

    /**
     * Creates a form to delete a Proveedor entity.
     *
     * @param Proveedor $proveedor The Proveedor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Proveedor $proveedor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proveedor_delete', array('id' => $proveedor->getIdproveedor())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
