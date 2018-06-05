<?php

namespace FrancoinBundle\Controller;

use FrancoinBundle\Entity\Category;
use FrancoinBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FrancoinBundle\Controller\RestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class CategoryController extends RestController
{
    /**
     * @Rest\Get("/category", name="_category")
     *
     * @return View
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('FrancoinBundle:Category')->findAll();
        if ($entities === null) {
            return new View("there are no Categorys exist", Response::HTTP_NOT_FOUND);
        }
        return new View($entities, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/category/{id}", name="_category")
     *
     * @return View
     */
    public function getAction(Category $entity = null)
    {
        return ($entity) ? new View($entity, Response::HTTP_OK) : new View("Error : Category doesn't exist", Response::HTTP_NOT_FOUND);
    }

    /**
     * @Rest\Post("/category/new", name="_category")
     *
     * @return View
     */
    public function postAction(Request $request)
    {
        try {
            $entity = new Category();
            $form = $this->createForm(get_class(new CategoryType()), $entity, array("method" => $request->getMethod()));
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
        return new View("Error : Failed to add a new category", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @Rest\Put("/category/{id}", name="_category")
     *
     * @return View
     */
    public function putAction(Request $request, Category $entity)
    {
       try {
            $em = $this->getDoctrine()->getManager();
            $id = $entity->getId();
            $request->setMethod('PATCH');
            $form = $this->createForm(get_class(new CategoryType()), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
                return new View($entity, Response::HTTP_OK);
            }
            return new View("Error : Failed to edit the category " . $id , Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return new View("Error : Category doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Patch("/category/{id}", name="_category")
     *
     * @return View
     */
    public function patchAction(Request $request, Category $entity)
    {
       return $this->putAction($request, $entity);
    }

    /**
     * @Rest\Delete("/category/{id}", name="_category")
     *
     * @return View
     */
    public function deleteAction(Category $entity = null)
    {
        if ($entity) {
            $id = $entity->getId();
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            return new View("Category " . $id . " has been deleted", Response::HTTP_OK);
        } else {
            return new View("Error : Category doesn't exist", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
