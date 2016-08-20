<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Pagotransferencia;
use prueba\pruebaBundle\Form\PagotransferenciaType;

/**
 * Pagotransferencia controller.
 *
 * @Route("/pagotransferencia")
 */
class PagotransferenciaController extends Controller
{
    /**
     * Lists all Pagotransferencia entities.
     *
     * @Route("/", name="pagotransferencia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pagotransferencias = $em->getRepository('pruebaBundle:Pagotransferencia')->findAll();

        return $this->render('pagotransferencia/index.html.twig', array(
            'pagotransferencias' => $pagotransferencias,
        ));
    }

    /**
     * Creates a new Pagotransferencia entity.
     *
     * @Route("/new", name="pagotransferencia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pagotransferencium = new Pagotransferencia();
        $form = $this->createForm('prueba\pruebaBundle\Form\PagotransferenciaType', $pagotransferencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pagotransferencium);
            $em->flush();

            return $this->redirectToRoute('pagotransferencia_show', array('id' => $pagotransferencium->getId()));
        }

        return $this->render('pagotransferencia/new.html.twig', array(
            'pagotransferencium' => $pagotransferencium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pagotransferencia entity.
     *
     * @Route("/{id}", name="pagotransferencia_show")
     * @Method("GET")
     */
    public function showAction(Pagotransferencia $pagotransferencium)
    {
        $deleteForm = $this->createDeleteForm($pagotransferencium);

        return $this->render('pagotransferencia/show.html.twig', array(
            'pagotransferencium' => $pagotransferencium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pagotransferencia entity.
     *
     * @Route("/{id}/edit", name="pagotransferencia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pagotransferencia $pagotransferencium)
    {
        $deleteForm = $this->createDeleteForm($pagotransferencium);
        $editForm = $this->createForm('prueba\pruebaBundle\Form\PagotransferenciaType', $pagotransferencium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pagotransferencium);
            $em->flush();

            return $this->redirectToRoute('pagotransferencia_edit', array('id' => $pagotransferencium->getId()));
        }

        return $this->render('pagotransferencia/edit.html.twig', array(
            'pagotransferencium' => $pagotransferencium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Pagotransferencia entity.
     *
     * @Route("/{id}", name="pagotransferencia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pagotransferencia $pagotransferencium)
    {
        $form = $this->createDeleteForm($pagotransferencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pagotransferencium);
            $em->flush();
        }

        return $this->redirectToRoute('pagotransferencia_index');
    }

    /**
     * Creates a form to delete a Pagotransferencia entity.
     *
     * @param Pagotransferencia $pagotransferencium The Pagotransferencia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pagotransferencia $pagotransferencium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pagotransferencia_delete', array('id' => $pagotransferencium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
