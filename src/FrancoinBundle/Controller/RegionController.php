<?php

namespace FrancoinBundle\Controller;

use FrancoinBundle\Entity\Region;
use FrancoinBundle\Form\RegionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FrancoinBundle\Controller\RestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class RegionController extends RestController
{
    /**
     * @Rest\Get("/region", name="_region")
     *
     * @return View
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('FrancoinBundle:Region')->findAll();
        if ($entities === null) {
            return new View("there are no Regions exist", Response::HTTP_NOT_FOUND);
        }
        return new View($entities, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/region/{id}", name="_region")
     *
     * @return View
     */
    public function getAction(Region $entity = null)
    {
        return ($entity) ? new View($entity, Response::HTTP_OK) : new View("Error : Region doesn't exist", Response::HTTP_NOT_FOUND);
    }

    /**
     * @Rest\Post("/region/new", name="_region")
     *
     * @return View
     */
    public function postAction(Request $request)
    {
        try {
            $entity = new Region();
            $form = $this->createForm(get_class(new RegionType()), $entity, array("method" => $request->getMethod()));
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
        return new View("Error : Failed to add a new region", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @Rest\Put("/region/{id}", name="_region")
     *
     * @return View
     */
    public function putAction(Request $request, Region $entity)
    {
       try {
            $em = $this->getDoctrine()->getManager();
            $id = $entity->getId();
            $request->setMethod('PATCH');
            $form = $this->createForm(get_class(new RegionType()), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                return new View($entity, Response::HTTP_OK);
            }
            return new View("Error : Failed to edit the region " . $id , Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return new View("Error : Region doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Patch("/region/{id}", name="_region")
     *
     * @return View
     */
    public function patchAction(Request $request, Region $entity)
    {
       return $this->putAction($request, $entity);
    }

    /**
     * @Rest\Delete("/region/{id}", name="_region")
     *
     * @return View
     */
    public function deleteAction(Region $entity = null)
    {
        if ($entity) {
            $id = $entity->getId();
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            return new View("Region " . $id . " has been deleted", Response::HTTP_OK);
        } else {
            return new View("Error : Region doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
