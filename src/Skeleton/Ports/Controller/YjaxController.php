<?php

namespace Skeleton\Ports\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Yggdrasil\Core\Controller\ApiController;

/**
 * Class YjaxController
 *
 * Yjax plugin controller
 *
 * @package Skeleton\Ports\Controller
 */
class YjaxController extends ApiController
{
    /**
     * Routes GET action
     * Route: /api/yjax/routes
     *
     * @return JsonResponse|Response
     *
     * @throws \Exception
     */
    public function routesGetAction()
    {
        if (!$this->isYjaxRequest()) {
            return $this->badRequest();
        }

        return $this->json($this->getRouter()->getQueryMap());
    }
}