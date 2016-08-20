<?php

namespace prueba\pruebaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use prueba\pruebaBundle\Entity\Und;
use prueba\pruebaBundle\Form\UndType;

/**
 * Und controller.
 *
 * @Route("/und")
 */
class UndController extends Controller
{
    /**
     * Lists all Und entities.
     *
     * @Route("/", name="und_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $unds = $em->getRepository('pruebaBundle:Und')->findAll();

        return $this->render('und/index_und.html.twig', array(
            'unds' => $unds,
        ));
    }

    /**
     * Creates a new Und entity.
     *
     * @Route("/new", name="und_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $und = new Und();
        $form = $this->createForm('prueba\pruebaBundle\Form\UndType', $und);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($und);
            $em->flush();

            return $this->redirectToRoute('und_show', array('id' => $und->getIdund()));
        }

        return $this->render('und/new_und.html.twig', array(
            'und' => $und,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Und entity.
     *
     * @Route("/{id}", name="und_show")
     * @Method("GET")
     */
    public function showAction(Und $und)
    {
        $deleteForm = $this->createDeleteForm($und);

        return $this->render('und/show_und.html.twig', array(
            'und' => $und,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Und entity.
     *
     * @Route("/{id}/edit", name="und_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Und $und)
    {
        $deleteForm = $this->createDeleteForm($und);
        $editForm = $this->createForm('prueba\pruebaBundle\Form\UndType', $und);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($und);
            $em->flush();
            //-------------------------- MENSAJE DE MODIFICACION SATISFACTORIA
            //--- se tiene que tener una session abierta para poder observar 
            //--- dicho mensaje en la hoja de actualizacion
            $this->get('session')->getFlashBag()->add(
              'Atencion!',
              "El registro se ha modificado correctamente"
            );
            //------------------------- FIN MENSAJE

            return $this->redirectToRoute('und_edit', array('id' => $und->getIdund()));
        }

        return $this->render('und/edit_und.html.twig', array(
            'und' => $und,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Und entity.
     *
     * @Route("/{id}", name="und_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Und $und)
    {
        $form = $this->createDeleteForm($und);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($und);
            $em->flush();
        }

        return $this->redirectToRoute('und_index');
    }

    /**
     * Creates a form to delete a Und entity.
     *
     * @param Und $und The Und entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Und $und)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('und_delete', array('id' => $und->getIdund())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
