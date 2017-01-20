<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Fideicomiso;
use prueba\pruebaBundle\Form\FideicomisoType;

/**
 * Fideicomiso controller.
 *
 * @Route("/fideicomiso")
 */
class FideicomisoController extends Controller
{
    /**
     * Lists all Fideicomiso entities.
     *
     * @Route("/", name="fideicomiso_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fideicomisos = $em->getRepository('pruebaBundle:Fideicomiso')->findAll();

        return $this->render('fideicomiso/index.html.twig', array(
            'fideicomisos' => $fideicomisos,
        ));
    }

    /**
     * Creates a new Fideicomiso entity.
     *
     * @Route("/new", name="fideicomiso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fideicomiso = new Fideicomiso();
        $form = $this->createForm('prueba\pruebaBundle\Form\FideicomisoType', $fideicomiso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fideicomiso);
            $em->flush();

            return $this->redirectToRoute('fideicomiso_show', array('id' => $fideicomiso->getId()));
        }

        return $this->render('fideicomiso/new.html.twig', array(
            'fideicomiso' => $fideicomiso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Fideicomiso entity.
     *
     * @Route("/{id}", name="fideicomiso_show")
     * @Method("GET")
     */
    public function showAction(Fideicomiso $fideicomiso)
    {
        $deleteForm = $this->createDeleteForm($fideicomiso);

        return $this->render('fideicomiso/show.html.twig', array(
            'fideicomiso' => $fideicomiso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Fideicomiso entity.
     *
     * @Route("/{id}/edit", name="fideicomiso_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Fideicomiso $fideicomiso)
    {
        $deleteForm = $this->createDeleteForm($fideicomiso);
        $editForm = $this->createForm('prueba\pruebaBundle\Form\FideicomisoType', $fideicomiso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fideicomiso);
            $em->flush();

            return $this->redirectToRoute('fideicomiso_edit', array('id' => $fideicomiso->getId()));
        }

        return $this->render('fideicomiso/edit.html.twig', array(
            'fideicomiso' => $fideicomiso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Fideicomiso entity.
     *
     * @Route("/{id}", name="fideicomiso_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Fideicomiso $fideicomiso)
    {
        $form = $this->createDeleteForm($fideicomiso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fideicomiso);
            $em->flush();
        }

        return $this->redirectToRoute('fideicomiso_index');
    }

    /**
     * Creates a form to delete a Fideicomiso entity.
     *
     * @param Fideicomiso $fideicomiso The Fideicomiso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fideicomiso $fideicomiso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fideicomiso_delete', array('id' => $fideicomiso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
