<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\Service\UserModule\Response\RememberedAuthResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

class RememberedAuthService extends AbstractService implements ServiceInterface
{
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $entityManager = $this->getEntityManager();
        $user = $entityManager->getRepository('Entity:User')->findOneByRememberIdentifier($request->getRememberIdentifier());

        $response = new RememberedAuthResponse();

        if($user !== null){
            if(password_verify($request->getRememberToken(), $user->getRememberToken())){
                $response->setSuccess(true);
                $response->setUser($user);
            }
        }

        return $response;
    }
}