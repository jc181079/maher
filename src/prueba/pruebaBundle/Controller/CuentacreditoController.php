<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Cuentacredito;
use prueba\pruebaBundle\Form\CuentacreditoType;

/**
 * Cuentacredito controller.
 *
 * @Route("/cuentacredito")
 */
class CuentacreditoController extends Controller
{
    /**
     * Lists all Cuentacredito entities.
     *
     * @Route("/", name="cuentacredito_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cuentacreditos = $em->getRepository('pruebaBundle:Cuentacredito')->findAll();

        return $this->render('cuentacredito/index.html.twig', array(
            'cuentacreditos' => $cuentacreditos,
        ));
    }

    /**
     * Creates a new Cuentacredito entity.
     *
     * @Route("/new", name="cuentacredito_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cuentacredito = new Cuentacredito();
        $form = $this->createForm('prueba\pruebaBundle\Form\CuentacreditoType', $cuentacredito);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cuentacredito);
            $em->flush();

            return $this->redirectToRoute('cuentacredito_show', array('id' => $cuentacredito->getId()));
        }

        return $this->render('cuentacredito/new.html.twig', array(
            'cuentacredito' => $cuentacredito,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cuentacredito entity.
     *
     * @Route("/{id}", name="cuentacredito_show")
     * @Method("GET")
     */
    public function showAction(Cuentacredito $cuentacredito)
    {
        $deleteForm = $this->createDeleteForm($cuentacredito);

        return $this->render('cuentacredito/show.html.twig', array(
            'cuentacredito' => $cuentacredito,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Cuentacredito entity.
     *
     * @Route("/{id}/edit", name="cuentacredito_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cuentacredito $cuentacredito)
    {
        $deleteForm = $this->createDeleteForm($cuentacredito);
        $editForm = $this->createForm('prueba\pruebaBundle\Form\CuentacreditoType', $cuentacredito);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cuentacredito);
            $em->flush();

            return $this->redirectToRoute('cuentacredito_edit', array('id' => $cuentacredito->getId()));
        }

        return $this->render('cuentacredito/edit.html.twig', array(
            'cuentacredito' => $cuentacredito,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Cuentacredito entity.
     *
     * @Route("/{id}", name="cuentacredito_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cuentacredito $cuentacredito)
    {
        $form = $this->createDeleteForm($cuentacredito);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cuentacredito);
            $em->flush();
        }

        return $this->redirectToRoute('cuentacredito_index');
    }

    /**
     * Creates a form to delete a Cuentacredito entity.
     *
     * @param Cuentacredito $cuentacredito The Cuentacredito entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cuentacredito $cuentacredito)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cuentacredito_delete', array('id' => $cuentacredito->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}