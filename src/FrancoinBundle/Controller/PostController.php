<?php

namespace FrancoinBundle\Controller;

use FrancoinBundle\Entity\Post;
use FrancoinBundle\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FrancoinBundle\Controller\RestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class PostController extends RestController
{
    /**
     * @Rest\Get("/post", name="_post")
     *
     * @return View
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('FrancoinBundle:Post')->findAll();
        if ($entities === null) {
            return new View("there are no Posts exist", Response::HTTP_NOT_FOUND);
        }
        return new View($entities, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/post/{id}", name="_post")
     *
     * @return View
     */
    public function getAction(Post $entity = null)
    {
        return ($entity) ? new View($entity, Response::HTTP_OK) : new View("Error : Post doesn't exist", Response::HTTP_NOT_FOUND);
    }

    /**
     * @Rest\Post("/post/new", name="_post")
     *
     * @return View
     */
    public function postAction(Request $request)
    {
        try {
            $entity = new Post();
            $form = $this->createForm(get_class(new PostType()), $entity, array("method" => $request->getMethod()));
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
        return new View("Error : Failed to add a new post", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @Rest\Put("/post/{id}", name="_post")
     *
     * @return View
     */
    public function putAction(Request $request, Post $entity)
    {
       try {
            $em = $this->getDoctrine()->getManager();
            $id = $entity->getId();
            $request->setMethod('PATCH');
            $form = $this->createForm(get_class(new PostType()), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                return new View($entity, Response::HTTP_OK);
            }
            return new View("Error : Failed to edit the post " . $id , Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return new View("Error : Post doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Patch("/post/{id}", name="_post")
     *
     * @return View
     */
    public function patchAction(Request $request, Post $entity)
    {
       return $this->putAction($request, $entity);
    }

    /**
     * @Rest\Delete("/post/{id}", name="_post")
     *
     * @return View
     */
    public function deleteAction(Post $entity = null)
    {
        if ($entity) {
            $id = $entity->getId();
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            return new View("Post " . $id . " has been deleted", Response::HTTP_OK);
        } else {
            return new View("Error : Post doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
