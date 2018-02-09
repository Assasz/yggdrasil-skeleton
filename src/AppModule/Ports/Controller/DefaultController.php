<?php

namespace AppModule\Ports\Controller;

use Yggdrasil\Core\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
}