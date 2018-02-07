<?php

namespace AppModule\Ports\Controller;

use Symfony\Component\HttpFoundation\Response;
use Yggdrasil\Core\AbstractController;

class DefaultController extends AbstractController
{
    public function indexAction()
    {
        //var_dump($this->getRequest()->cookies->has('remember'));
        return $this->render('default/index.html.twig');
    }
}