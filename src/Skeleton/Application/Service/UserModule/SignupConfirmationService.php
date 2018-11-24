<?php

namespace Skeleton\Application\Service\UserModule;

use Skeleton\Application\DriverInterface\EntityManagerInterface;
use Skeleton\Application\Exception\BrokenContractException;
use Skeleton\Application\RepositoryInterface\UserRepositoryInterface;
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
        $this->validateContracts();

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

    /**
     * Validates contracts between service and external suppliers
     *
     * @throws BrokenContractException
     */
    private function validateContracts(): void
    {
        if (!$this->getEntityManager() instanceof EntityManagerInterface) {
            throw new BrokenContractException(EntityManagerInterface::class);
        }

        if (!$this->getEntityManager()->getRepository('Entity:User') instanceof UserRepositoryInterface) {
            throw new BrokenContractException(UserRepositoryInterface::class);
        }
    }
}
