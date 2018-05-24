<?php

namespace FrancoinBundle\Controller;

use FrancoinBundle\Entity\Favourite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Favourite controller.
 *
 * @Route("favourite")
 */
class FavouriteController extends Controller
{
    /**
     * Lists all favourite entities.
     *
     * @Route("/", name="favourite_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $favourites = $em->getRepository('FrancoinBundle:Favourite')->findAll();

        return $this->render('favourite/index.html.twig', array(
            'favourites' => $favourites,
        ));
    }

    /**
     * Creates a new favourite entity.
     *
     * @Route("/new", name="favourite_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $favourite = new Favourite();
        $form = $this->createForm('FrancoinBundle\Form\FavouriteType', $favourite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($favourite);
            $em->flush();

            return $this->redirectToRoute('favourite_show', array('id' => $favourite->getId()));
        }

        return $this->render('favourite/new.html.twig', array(
            'favourite' => $favourite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a favourite entity.
     *
     * @Route("/{id}", name="favourite_show")
     * @Method("GET")
     */
    public function showAction(Favourite $favourite)
    {
        $deleteForm = $this->createDeleteForm($favourite);

        return $this->render('favourite/show.html.twig', array(
            'favourite' => $favourite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing favourite entity.
     *
     * @Route("/{id}/edit", name="favourite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Favourite $favourite)
    {
        $deleteForm = $this->createDeleteForm($favourite);
        $editForm = $this->createForm('FrancoinBundle\Form\FavouriteType', $favourite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('favourite_edit', array('id' => $favourite->getId()));
        }

        return $this->render('favourite/edit.html.twig', array(
            'favourite' => $favourite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a favourite entity.
     *
     * @Route("/{id}", name="favourite_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Favourite $favourite)
    {
        $form = $this->createDeleteForm($favourite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($favourite);
            $em->flush();
        }

        return $this->redirectToRoute('favourite_index');
    }

    /**
     * Creates a form to delete a favourite entity.
     *
     * @param Favourite $favourite The favourite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Favourite $favourite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('favourite_delete', array('id' => $favourite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
