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
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction(): Response
    {
        return $this->render('default/index.html.twig');
    }
}
