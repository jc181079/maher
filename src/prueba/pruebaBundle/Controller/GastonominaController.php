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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gastonominas = $em->getRepository('pruebaBundle:Gastonomina')->findAll();

        return $this->render('gastonomina/index.html.twig', array(
            'gastonominas' => $gastonominas,
        ));
    }

    /**
     * Creates a new Gastonomina entity.
     *
     * @Route("/new", name="gastonomina_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $gastonomina = new Gastonomina();
        $form = $this->createForm('prueba\pruebaBundle\Form\GastonominaType', $gastonomina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gastonomina);
            $em->flush();

            return $this->redirectToRoute('gastonomina_show', array('id' => $gastonomina->getId()));
        }

        return $this->render('gastonomina/new.html.twig', array(
            'gastonomina' => $gastonomina,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Gastonomina entity.
     *
     * @Route("/{id}", name="gastonomina_show")
     * @Method("GET")
     */
    public function showAction(Gastonomina $gastonomina)
    {
        $deleteForm = $this->createDeleteForm($gastonomina);

        return $this->render('gastonomina/show.html.twig', array(
            'gastonomina' => $gastonomina,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Gastonomina entity.
     *
     * @Route("/{id}/edit", name="gastonomina_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Gastonomina $gastonomina)
    {
        $deleteForm = $this->createDeleteForm($gastonomina);
        $editForm = $this->createForm('prueba\pruebaBundle\Form\GastonominaType', $gastonomina);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gastonomina);
            $em->flush();

            return $this->redirectToRoute('gastonomina_edit', array('id' => $gastonomina->getId()));
        }

        return $this->render('gastonomina/edit.html.twig', array(
            'gastonomina' => $gastonomina,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Gastonomina entity.
     *
     * @Route("/{id}", name="gastonomina_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Gastonomina $gastonomina)
    {
        $form = $this->createDeleteForm($gastonomina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gastonomina);
            $em->flush();
        }

        return $this->redirectToRoute('gastonomina_index');
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
            ->setAction($this->generateUrl('gastonomina_delete', array('id' => $gastonomina->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
