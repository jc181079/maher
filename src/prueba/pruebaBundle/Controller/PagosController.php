<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Pagos;
use prueba\pruebaBundle\Form\PagosType;

/**
 * Pagos controller.
 *
 * @Route("/pagos")
 */
class PagosController extends Controller
{
    /**
     * Lists all Pagos entities.
     *
     * @Route("/", name="pagos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pagos = $em->getRepository('pruebaBundle:Pagos')->findAll();

        return $this->render('pagos/index.html.twig', array(
            'pagos' => $pagos,
        ));
    }

    /**
     * Creates a new Pagos entity.
     *
     * @Route("/new", name="pagos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pago = new Pagos();
        $form = $this->createForm('prueba\pruebaBundle\Form\PagosType', $pago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pago);
            $em->flush();

            return $this->redirectToRoute('pagos_show', array('id' => $pago->getId()));
        }

        return $this->render('pagos/new.html.twig', array(
            'pago' => $pago,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pagos entity.
     *
     * @Route("/{id}", name="pagos_show")
     * @Method("GET")
     */
    public function showAction(Pagos $pago)
    {
        $deleteForm = $this->createDeleteForm($pago);

        return $this->render('pagos/show.html.twig', array(
            'pago' => $pago,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pagos entity.
     *
     * @Route("/{id}/edit", name="pagos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pagos $pago)
    {
        $deleteForm = $this->createDeleteForm($pago);
        $editForm = $this->createForm('prueba\pruebaBundle\Form\PagosType', $pago);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pago);
            $em->flush();

            return $this->redirectToRoute('pagos_edit', array('id' => $pago->getId()));
        }

        return $this->render('pagos/edit.html.twig', array(
            'pago' => $pago,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Pagos entity.
     *
     * @Route("/{id}", name="pagos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pagos $pago)
    {
        $form = $this->createDeleteForm($pago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pago);
            $em->flush();
        }

        return $this->redirectToRoute('pagos_index');
    }

    /**
     * Creates a form to delete a Pagos entity.
     *
     * @param Pagos $pago The Pagos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pagos $pago)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pagos_delete', array('id' => $pago->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
