<?php

namespace FrancoinBundle\Controller;

use FrancoinBundle\Entity\City;
use FrancoinBundle\Form\CityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FrancoinBundle\Controller\RestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class CityController extends RestController
{
    /**
     * @Rest\Get("/city", name="_city")
     *
     * @return View
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('FrancoinBundle:City')->findAll();
        if ($entities === null) {
            return new View("there are no Citys exist", Response::HTTP_NOT_FOUND);
        }
        return new View($entities, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/city/{id}", name="_city")
     *
     * @return View
     */
    public function getAction(City $entity = null)
    {
        return ($entity) ? new View($entity, Response::HTTP_OK) : new View("Error : City doesn't exist", Response::HTTP_NOT_FOUND);
    }

    /**
     * @Rest\Post("/city/new", name="_city")
     *
     * @return View
     */
    public function postAction(Request $request)
    {
        try {
            $entity = new City();
            $form = $this->createForm(get_class(new CityType()), $entity, array("method" => $request->getMethod()));
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
        return new View("Error : Failed to add a new city", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @Rest\Put("/city/{id}", name="_city")
     *
     * @return View
     */
    public function putAction(Request $request, City $entity)
    {
       try {
            $em = $this->getDoctrine()->getManager();
            $id = $entity->getId();
            $request->setMethod('PATCH');
            $form = $this->createForm(get_class(new CityType()), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                return new View($entity, Response::HTTP_OK);
            }
            return new View("Error : Failed to edit the city " . $id , Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return new View("Error : City doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Patch("/city/{id}", name="_city")
     *
     * @return View
     */
    public function patchAction(Request $request, City $entity)
    {
       return $this->putAction($request, $entity);
    }

    /**
     * @Rest\Delete("/city/{id}", name="_city")
     *
     * @return View
     */
    public function deleteAction(City $entity = null)
    {
        if ($entity) {
            $id = $entity->getId();
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            return new View("City " . $id . " has been deleted", Response::HTTP_OK);
        } else {
            return new View("Error : City doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
