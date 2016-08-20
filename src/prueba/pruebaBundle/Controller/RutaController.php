<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Ruta;
use prueba\pruebaBundle\Form\RutaType;

/**
 * Ruta controller.
 *
 * @Route("/ruta")
 */
class RutaController extends Controller
{
    /**
     * Lists all Ruta entities.
     *
     * @Route("/", name="ruta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rutas = $em->getRepository('pruebaBundle:Ruta')->findAll();

        return $this->render('ruta/index.html.twig', array(
            'rutas' => $rutas,
        ));
    }

    /**
     * Creates a new Ruta entity.
     *
     * @Route("/new", name="ruta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rutum = new Ruta();
        $form = $this->createForm('prueba\pruebaBundle\Form\RutaType', $rutum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rutum);
            $em->flush();

            return $this->redirectToRoute('ruta_show', array('id' => $rutum->getId()));
        }

        return $this->render('ruta/new.html.twig', array(
            'rutum' => $rutum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Ruta entity.
     *
     * @Route("/{id}", name="ruta_show")
     * @Method("GET")
     */
    public function showAction(Ruta $rutum)
    {
        $deleteForm = $this->createDeleteForm($rutum);

        return $this->render('ruta/show.html.twig', array(
            'rutum' => $rutum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ruta entity.
     *
     * @Route("/{id}/edit", name="ruta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ruta $rutum)
    {
        $deleteForm = $this->createDeleteForm($rutum);
        $editForm = $this->createForm('prueba\pruebaBundle\Form\RutaType', $rutum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rutum);
            $em->flush();

            return $this->redirectToRoute('ruta_edit', array('id' => $rutum->getId()));
        }

        return $this->render('ruta/edit.html.twig', array(
            'rutum' => $rutum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Ruta entity.
     *
     * @Route("/{id}", name="ruta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Ruta $rutum)
    {
        $form = $this->createDeleteForm($rutum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rutum);
            $em->flush();
        }

        return $this->redirectToRoute('ruta_index');
    }

    /**
     * Creates a form to delete a Ruta entity.
     *
     * @param Ruta $rutum The Ruta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ruta $rutum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ruta_delete', array('id' => $rutum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
