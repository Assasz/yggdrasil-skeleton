<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\Service\UserModule\Response\RememberedAuthResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class RememberedAuthService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule
 */
class RememberedAuthService extends AbstractService implements ServiceInterface
{
    /**
     * Authenticates user by remember me cookie
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $entityManager = $this->getEntityManager();
        $user = $entityManager->getRepository('Entity:User')
            ->findOneByRememberIdentifier($request->getRememberIdentifier());

        $response = new RememberedAuthResponse();

        if (!empty($user)) {
            if (password_verify($request->getRememberToken(), $user->getRememberToken())) {
                $response->setSuccess(true);
                $response->setUser($user);
            }
        }

        return $response;
    }
}
