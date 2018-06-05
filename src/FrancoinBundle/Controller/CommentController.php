<?php

namespace FrancoinBundle\Controller;

use FrancoinBundle\Entity\Comment;
use FrancoinBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FrancoinBundle\Controller\RestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class CommentController extends RestController
{
    /**
     * @Rest\Get("/comment", name="_comment")
     *
     * @return View
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('FrancoinBundle:Comment')->findAll();
        if ($entities === null) {
            return new View("there are no Comments exist", Response::HTTP_NOT_FOUND);
        }
        return new View($entities, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/comment/{id}", name="_comment")
     *
     * @return View
     */
    public function getAction(Comment $entity = null)
    {
        return ($entity) ? new View($entity, Response::HTTP_OK) : new View("Error : Comment doesn't exist", Response::HTTP_NOT_FOUND);
    }

    /**
     * @Rest\Post("/comment/new", name="_comment")
     *
     * @return View
     */
    public function postAction(Request $request)
    {
        try {
            $entity = new Comment();
            $form = $this->createForm(get_class(new CommentType()), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                return new View($entity, Response::HTTP_OK);
            }
        } catch (Exception $e) {
            return new View($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return new View("Error : Failed to add a new comment", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @Rest\Put("/comment/{id}", name="_comment")
     *
     * @return View
     */
    public function putAction(Request $request, Comment $entity)
    {
       try {
            $em = $this->getDoctrine()->getManager();
            $id = $entity->getId();
            $request->setMethod('PATCH');
            $form = $this->createForm(get_class(new CommentType()), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                return new View($entity, Response::HTTP_OK);
            }
            return new View("Error : Failed to edit the comment " . $id , Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return new View("Error : Comment doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Patch("/comment/{id}", name="_comment")
     *
     * @return View
     */
    public function patchAction(Request $request, Comment $entity)
    {
       return $this->putAction($request, $entity);
    }

    /**
     * @Rest\Delete("/comment/{id}", name="_comment")
     *
     * @return View
     */
    public function deleteAction(Comment $entity = null)
    {
        if ($entity) {
            $id = $entity->getId();
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            return new View("Comment " . $id . " has been deleted", Response::HTTP_OK);
        } else {
            return new View("Error : Comment doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
