<?php

namespace FrancoinBundle\Controller;

use FrancoinBundle\Entity\Favourite;
use FrancoinBundle\Form\FavouriteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FrancoinBundle\Controller\RestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class FavouriteController extends RestController
{
    /**
     * @Rest\Get("/favourite", name="_favourite")
     *
     * @return View
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('FrancoinBundle:Favourite')->findAll();
        if ($entities === null) {
            return new View("there are no Favourites exist", Response::HTTP_NOT_FOUND);
        }
        return new View($entities, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/favourite/{id}", name="_favourite")
     *
     * @return View
     */
    public function getAction(Favourite $entity = null)
    {
        return ($entity) ? new View($entity, Response::HTTP_OK) : new View("Error : Favourite doesn't exist", Response::HTTP_NOT_FOUND);
    }

    /**
     * @Rest\Post("/favourite/new", name="_favourite")
     *
     * @return View
     */
    public function postAction(Request $request)
    {
        try {
            $entity = new Favourite();
            $form = $this->createForm(get_class(new FavouriteType()), $entity, array("method" => $request->getMethod()));
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
        return new View("Error : Failed to add a new favourite", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @Rest\Put("/favourite/{id}", name="_favourite")
     *
     * @return View
     */
    public function putAction(Request $request, Favourite $entity)
    {
       try {
            $em = $this->getDoctrine()->getManager();
            $id = $entity->getId();
            $request->setMethod('PATCH');
            $form = $this->createForm(get_class(new FavouriteType()), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                return new View($entity, Response::HTTP_OK);
            }
            return new View("Error : Failed to edit the favourite " . $id , Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return new View("Error : Favourite doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Patch("/favourite/{id}", name="_favourite")
     *
     * @return View
     */
    public function patchAction(Request $request, Favourite $entity)
    {
       return $this->putAction($request, $entity);
    }

    /**
     * @Rest\Delete("/favourite/{id}", name="_favourite")
     *
     * @return View
     */
    public function deleteAction(Favourite $entity = null)
    {
        if ($entity) {
            $id = $entity->getId();
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            return new View("Favourite " . $id . " has been deleted", Response::HTTP_OK);
        } else {
            return new View("Error : Favourite doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
