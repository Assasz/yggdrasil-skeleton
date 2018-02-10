<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\Service\UserModule\Response\EmailCheckerResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

class EmailCheckerService extends AbstractService implements ServiceInterface
{
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $entityManager = $this->getEntityManager();
        $users = $entityManager->getRepository('Entity:User')->findByEmail($request->getEmail());

        $response = new EmailCheckerResponse();

        if(count($users) < 1){
            $response->setSuccess(true);
        }

        return $response;
    }
}