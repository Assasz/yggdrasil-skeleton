<?php

namespace Skeleton\Infrastructure\Seeds;

use Skeleton\Application\DriverInterface\EntityManagerInterface;

/**
 * Class AbstractSeeds
 *
 * @package Skeleton\Infrastructure\Seeds
 */
abstract class AbstractSeeds
{
    /**
     * Entity Manager instance
     *
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * AbstractSeeds constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Persists seeds in database
     */
    public function persist(): void
    {
        foreach ($this->create() as $seed) {
            $this->entityManager->persist($seed);
        }

        $this->entityManager->flush();
    }

    /**
     * Creates seeds
     *
     * @return array
     */
    abstract protected function create(): array;
}
