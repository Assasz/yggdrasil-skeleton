<?php

namespace AppModule\Application\Service;

use AppModule\Application\Service\Response\SignupConfirmationResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

class SignupConfirmationService extends AbstractService implements ServiceInterface
{
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $entityManager = $this->getEntityManager();
        $user = $entityManager->getRepository('Entity:User')->findOneByConfirmationToken($request->getToken());

        $response = new SignupConfirmationResponse();

        if($user !== null){
            if($user->getEnabled() == '1'){
                $response->setAlreadyActive(true);
                return $response;
            }

            $user->setEnabled('1');
            $entityManager->flush();

            $response->setSuccess(true);
        }

        return $response;
    }
}