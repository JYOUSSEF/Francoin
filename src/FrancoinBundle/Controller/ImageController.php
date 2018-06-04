<?php

namespace FrancoinBundle\Controller;

use FrancoinBundle\Entity\Image;
use FrancoinBundle\Form\ImageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FrancoinBundle\Controller\RestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class ImageController extends RestController
{
    /**
     * @Rest\Get("/image", name="_image")
     *
     * @return View
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('FrancoinBundle:Image')->findAll();
        if ($entities === null) {
            return new View("there are no Images exist", Response::HTTP_NOT_FOUND);
        }
        return new View($entities, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/image/{id}", name="_image")
     *
     * @return View
     */
    public function getAction(Image $entity = null)
    {
        return ($entity) ? new View($entity, Response::HTTP_OK) : new View("Error : Image doesn't exist", Response::HTTP_NOT_FOUND);
    }

    /**
     * @Rest\Post("/image/new", name="_image")
     *
     * @return View
     */
    public function postAction(Request $request)
    {
        try {
            $entity = new Image();
            $form = $this->createForm(get_class(new ImageType()), $entity, array("method" => $request->getMethod()));
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
        return new View("Error : Failed to add a new image", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @Rest\Put("/image/{id}", name="_image")
     *
     * @return View
     */
    public function putAction(Request $request, Image $entity)
    {
       try {
            $em = $this->getDoctrine()->getManager();
            $id = $entity->getId();
            $request->setMethod('PATCH');
            $form = $this->createForm(get_class(new ImageType()), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                return new View($entity, Response::HTTP_OK);
            }
            return new View("Error : Failed to edit the image " . $id , Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return new View("Error : Image doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Patch("/image/{id}", name="_image")
     *
     * @return View
     */
    public function patchAction(Request $request, Image $entity)
    {
       return $this->putAction($request, $entity);
    }

    /**
     * @Rest\Delete("/image/{id}", name="_image")
     *
     * @return View
     */
    public function deleteAction(Image $entity = null)
    {
        if ($entity) {
            $id = $entity->getId();
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            return new View("Image " . $id . " has been deleted", Response::HTTP_OK);
        } else {
            return new View("Error : Image doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
