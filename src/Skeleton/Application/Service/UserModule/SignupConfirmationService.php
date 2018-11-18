<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\Service\UserModule\Response\SignupConfirmationResponse;
use Yggdrasil\Core\Service\AbstractService;
use Yggdrasil\Core\Service\ServiceInterface;
use Yggdrasil\Core\Service\ServiceRequestInterface;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class SignupConfirmationService
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package Skeleton\Application\Service\UserModule
 */
class SignupConfirmationService extends AbstractService implements ServiceInterface
{
    /**
     * Activates user account
     *
     * @param ServiceRequestInterface $request
     * @return ServiceResponseInterface
     */
    public function process(ServiceRequestInterface $request): ServiceResponseInterface
    {
        $user = $this
            ->getEntityManager()
            ->getRepository('Entity:User')
            ->findOneBy(['confirmationToken' => $request->getToken()]);

        $response = new SignupConfirmationResponse();

        if (empty($user)) {
            return $response;
        }

        if ($user->isEnabled()) {
            return $response->setAlreadyActive(true);
        }

        $user->setEnabled('1');
        $this->getEntityManager()->flush();

        return $response->setSuccess(true);
    }
}
