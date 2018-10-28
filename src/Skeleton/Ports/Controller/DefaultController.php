<?php

namespace Skeleton\Ports\Controller;

use Yggdrasil\Core\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 *
 * @package Skeleton\Ports\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * Default index action
     * Routes: /default/index, /default, /
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('default/index.html.twig');
    }
}
