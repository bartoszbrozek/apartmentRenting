<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Apartment;
use AppBundle\Form\ApartmentType;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\RouteRedirectView;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use function ucfirst;

/**
 * Class ApartmentController
 * @package AppBundle\Controller
 * @RouteResource("api/apartment")
 */
class ApartmentController extends FOSRestController implements ClassResourceInterface
{

    /**
     * Gets an apartment
     *
     * @param int $id
     * @return object
     */
    public function getAction(int $id)
    {
        return $this->getDoctrine()->
        getRepository('AppBundle:Apartment')
            ->find($id);
    }

    /**
     * Gets all apartments
     *
     * @return array
     */
    public function cgetAction()
    {
        return $this->getDoctrine()->
        getRepository('AppBundle:Apartment')
            ->findAll();
    }

    /**
     * Creates a new apartment
     *
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     */
    public function postAction(Request $request)
    {
        $form = $this->createForm(ApartmentType::class, null, [
            'csrf_protection' => false,
        ]);

        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        try {
            /**
             * @var $apartment Apartment
             */
            $apartment = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($apartment);
            $em->flush();

            $routeOptions = [
                'id' => $apartment->getId(),
                '_format' => $request->get('_format'),
            ];

            return $this->routeRedirectView('get_apartment', $routeOptions, Response::HTTP_CREATED);
        } catch (Exception $ex) {
            throw new Exception('error: ' . $ex);
        }
    }

    /**
     * Edits apartment
     *
     * @param Request $request
     * @param int $id
     * @return View|\Symfony\Component\Form\Form
     */
    public function putAction(Request $request, int $id)
    {
        /**
         * @var $apartment Apartment
         */
        $apartment = $this->getDoctrine()
            ->getRepository('AppBundle:Apartment')
            ->find($id);

        if (!$apartment) {
            throw $this->createNotFoundException(sprintf(
                'No apartment found with id "%s"',
                $id
            ));
        }

        $form = $this->createForm(ApartmentType::class, $apartment, [
            'csrf_protection' => false,
        ]);

        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $routeOptions = [
            'id' => $apartment->getId(),
            '_format' => $request->get('_format'),
        ];

        return $this->routeRedirectView('get_apartment', $routeOptions, Response::HTTP_NO_CONTENT);
    }

    /**
     * Deletes an apartment
     *
     * @param int $id
     * @return object
     */
    public function deleteAction(int $id)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $apartment = $em->getRepository('AppBundle:Apartment')
                ->find($id);

            if (!$apartment) {
                throw $this->createNotFoundException('No apartment of id: ' . $id);
            }

            $em->remove($apartment);
            $em->flush();
        } catch (Exception $ex) {
            throw new HttpException(500, "error: $ex");
        }

    }
}
