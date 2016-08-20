<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Pagocheque;
use prueba\pruebaBundle\Form\PagochequeType;

/**
 * Pagocheque controller.
 *
 * @Route("/pagocheque")
 */
class PagochequeController extends Controller
{
    /**
     * Lists all Pagocheque entities.
     *
     * @Route("/", name="pagocheque_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pagocheques = $em->getRepository('pruebaBundle:Pagocheque')->findAll();

        return $this->render('pagocheque/index.html.twig', array(
            'pagocheques' => $pagocheques,
        ));
    }

    /**
     * Creates a new Pagocheque entity.
     *
     * @Route("/new", name="pagocheque_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pagocheque = new Pagocheque();
        $form = $this->createForm('prueba\pruebaBundle\Form\PagochequeType', $pagocheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pagocheque);
            $em->flush();

            return $this->redirectToRoute('pagocheque_show', array('id' => $pagocheque->getId()));
        }

        return $this->render('pagocheque/new.html.twig', array(
            'pagocheque' => $pagocheque,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pagocheque entity.
     *
     * @Route("/{id}", name="pagocheque_show")
     * @Method("GET")
     */
    public function showAction(Pagocheque $pagocheque)
    {
        $deleteForm = $this->createDeleteForm($pagocheque);

        return $this->render('pagocheque/show.html.twig', array(
            'pagocheque' => $pagocheque,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pagocheque entity.
     *
     * @Route("/{id}/edit", name="pagocheque_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pagocheque $pagocheque)
    {
        $deleteForm = $this->createDeleteForm($pagocheque);
        $editForm = $this->createForm('prueba\pruebaBundle\Form\PagochequeType', $pagocheque);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pagocheque);
            $em->flush();

            return $this->redirectToRoute('pagocheque_edit', array('id' => $pagocheque->getId()));
        }

        return $this->render('pagocheque/edit.html.twig', array(
            'pagocheque' => $pagocheque,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Pagocheque entity.
     *
     * @Route("/{id}", name="pagocheque_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pagocheque $pagocheque)
    {
        $form = $this->createDeleteForm($pagocheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pagocheque);
            $em->flush();
        }

        return $this->redirectToRoute('pagocheque_index');
    }

    /**
     * Creates a form to delete a Pagocheque entity.
     *
     * @param Pagocheque $pagocheque The Pagocheque entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pagocheque $pagocheque)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pagocheque_delete', array('id' => $pagocheque->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
