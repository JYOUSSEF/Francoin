<?php

namespace FrancoinBundle\Controller;

use FrancoinBundle\Entity\User;
use FrancoinBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FrancoinBundle\Controller\RestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class UserController extends RestController
{
    /**
     * @Rest\Get("/user", name="_user")
     *
     * @return View
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('FrancoinBundle:User')->findAll();
        if ($entities === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
        return new View($entities, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/user/{id}", name="_user")
     *
     * @return View
     */
    public function getAction(User $entity = null)
    {
        return ($entity) ? new View($entity, Response::HTTP_OK) : new View("Error : User doesn't exist", Response::HTTP_NOT_FOUND);
    }

    /**
     * @Rest\Post("/user/new", name="_user")
     *
     * @return View
     */
    public function postAction(Request $request)
    {
        try {
            $entity = new User();
            $form = $this->createForm(get_class(new UserType()), $entity, array("method" => $request->getMethod()));
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
        return new View("Error : Failed to add a new user", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @Rest\Put("/user/{id}", name="_user")
     *
     * @return View
     */
    public function putAction(Request $request, User $entity)
    {
       try {
            $em = $this->getDoctrine()->getManager();
            $id = $entity->getId();
            $request->setMethod('PATCH');
            $form = $this->createForm(get_class(new UserType()), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                return new View($entity, Response::HTTP_OK);
            }
            return new View("Error : Failed to edit the user " . $id , Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return new View("Error : User doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Patch("/user/{id}", name="_user")
     *
     * @return View
     */
    public function patchAction(Request $request, User $entity)
    {
       return $this->putAction($request, $entity);
    }

    /**
     * @Rest\Delete("/user/{id}", name="_user")
     *
     * @return View
     */
    public function deleteAction(User $entity = null)
    {
        if ($entity) {
            $id = $entity->getId();
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            return new View("User " . $id . " has been deleted", Response::HTTP_OK);
        } else {
            return new View("Error : User doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
