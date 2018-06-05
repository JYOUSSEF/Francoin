<?php

namespace FrancoinBundle\Controller;

use FrancoinBundle\Entity\Attribute;
use FrancoinBundle\Form\AttributeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FrancoinBundle\Controller\RestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class AttributeController extends RestController
{
    /**
     * @Rest\Get("/attribute", name="_attribute")
     *
     * @return View
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('FrancoinBundle:Attribute')->findAll();
        if ($entities === null) {
            return new View("there are no Attributes exist", Response::HTTP_NOT_FOUND);
        }
        return new View($entities, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/attribute/{id}", name="_attribute")
     *
     * @return View
     */
    public function getAction(Attribute $entity = null)
    {
        return ($entity) ? new View($entity, Response::HTTP_OK) : new View("Error : Attribute doesn't exist", Response::HTTP_NOT_FOUND);
    }

    /**
     * @Rest\Post("/attribute/new", name="_attribute")
     *
     * @return View
     */
    public function postAction(Request $request)
    {
        try {
            $entity = new Attribute();
            $form = $this->createForm(get_class(new AttributeType()), $entity, array("method" => $request->getMethod()));
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
        return new View("Error : Failed to add a new attribute", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @Rest\Put("/attribute/{id}", name="_attribute")
     *
     * @return View
     */
    public function putAction(Request $request, Attribute $entity)
    {
       try {
            $em = $this->getDoctrine()->getManager();
            $id = $entity->getId();
            $request->setMethod('PATCH');
            $form = $this->createForm(get_class(new AttributeType()), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                return new View($entity, Response::HTTP_OK);
            }
            return new View("Error : Failed to edit the attribute " . $id , Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return new View("Error : Attribute doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Patch("/attribute/{id}", name="_attribute")
     *
     * @return View
     */
    public function patchAction(Request $request, Attribute $entity)
    {
       return $this->putAction($request, $entity);
    }

    /**
     * @Rest\Delete("/attribute/{id}", name="_attribute")
     *
     * @return View
     */
    public function deleteAction(Attribute $entity = null)
    {
        if ($entity) {
            $id = $entity->getId();
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            return new View("Attribute " . $id . " has been deleted", Response::HTTP_OK);
        } else {
            return new View("Error : Attribute doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
