<?php

namespace Skeleton\Ports\Controller;

use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Yggdrasil\Core\Controller\ErrorControllerInterface;

/**
 * Class ErrorController
 *
 * Executes HTTP errors actions
 * Can be extended with code 4xx and 5xx actions, feel free to customize as needed
 *
 * @package Skeleton\Ports\Controller
 */
class ErrorController extends AbstractController implements ErrorControllerInterface
{
    /**
     * Bad Request action
     *
     * @return Response
     */
    public function code400Action(): Response
    {
        return $this->render('error/400.html.twig', [
            'message' => $this->getResponse()->getContent()
        ]);
    }

    /**
     * Forbidden action
     *
     * @return Response
     */
    public function code403Action(): Response
    {
        return $this->render('error/403.html.twig', [
            'message' => $this->getResponse()->getContent()
        ]);
    }

    /**
     * Not Found action
     *
     * @return Response
     */
    public function code404Action(): Response
    {
        return $this->render('error/404.html.twig', [
            'message' => $this->getResponse()->getContent()
        ]);
    }

    /**
     * Method Not Allowed action
     *
     * @return Response
     */
    public function code405Action(): Response
    {
        return $this->render('error/405.html.twig', [
            'message' => $this->getResponse()->getContent()
        ]);
    }

    /**
     * Default error action
     *
     * @return Response
     */
    public function defaultAction(): Response
    {
        return $this->render('error/default.html.twig', [
            'message' => $this->getResponse()->getContent(),
            'status'  => $this->getResponse()->getStatusCode()
        ]);
    }
}
