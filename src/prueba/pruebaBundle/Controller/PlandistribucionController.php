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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plandistribucions = $em->getRepository('pruebaBundle:Plandistribucion')->findAll();

        return $this->render('plandistribucion/index.html.twig', array(
            'plandistribucions' => $plandistribucions,
        ));
    }

    /**
     * Creates a new Plandistribucion entity.
     *
     * @Route("/new", name="plandistribucion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $plandistribucion = new Plandistribucion();
        $form = $this->createForm('prueba\pruebaBundle\Form\PlandistribucionType', $plandistribucion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plandistribucion);
            $em->flush();

            return $this->redirectToRoute('plandistribucion_show', array('id' => $plandistribucion->getId()));
        }

        return $this->render('plandistribucion/new.html.twig', array(
            'plandistribucion' => $plandistribucion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Plandistribucion entity.
     *
     * @Route("/{id}", name="plandistribucion_show")
     * @Method("GET")
     */
    public function showAction(Plandistribucion $plandistribucion)
    {
        $deleteForm = $this->createDeleteForm($plandistribucion);

        return $this->render('plandistribucion/show.html.twig', array(
            'plandistribucion' => $plandistribucion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Plandistribucion entity.
     *
     * @Route("/{id}/edit", name="plandistribucion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Plandistribucion $plandistribucion)
    {
        $deleteForm = $this->createDeleteForm($plandistribucion);
        $editForm = $this->createForm('prueba\pruebaBundle\Form\PlandistribucionType', $plandistribucion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plandistribucion);
            $em->flush();

            return $this->redirectToRoute('plandistribucion_edit', array('id' => $plandistribucion->getId()));
        }

        return $this->render('plandistribucion/edit.html.twig', array(
            'plandistribucion' => $plandistribucion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Plandistribucion entity.
     *
     * @Route("/{id}", name="plandistribucion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Plandistribucion $plandistribucion)
    {
        $form = $this->createDeleteForm($plandistribucion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plandistribucion);
            $em->flush();
        }

        return $this->redirectToRoute('plandistribucion_index');
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
            ->setAction($this->generateUrl('plandistribucion_delete', array('id' => $plandistribucion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
