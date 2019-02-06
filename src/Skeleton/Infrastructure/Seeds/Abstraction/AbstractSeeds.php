<?php

namespace Skeleton\Infrastructure\Seeds\Abstraction;

use Skeleton\Infrastructure\Exception\SeedsStorageException;

/**
 * Class AbstractSeeds
 *
 * @package Skeleton\Infrastructure\Seeds\Abstraction
 */
abstract class AbstractSeeds
{
    /**
     * Seeder instance
     *
     * @var SeederInterface
     */
    protected $seeder;

    /**
     * AbstractSeeds constructor.
     *
     * @param SeederInterface $seeder
     */
    public function __construct(SeederInterface $seeder)
    {
        $this->seeder = $seeder;
    }

    /**
     * Persists seeds in database
     */
    public function persist(): void
    {
        foreach ($this->create() as $seed) {
            $this->seeder->persist($seed);
        }

        $this->seeder->flush();
    }

    /**
     * Clears given seeds storage
     *
     * @param string? $storage Storage name, if NULL seeds name will be used to resolve storage name
     *
     * @throws \ReflectionException
     * @throws SeedsStorageException
     */
    protected function clearStorage(string $storage = null): void
    {
        if (empty($storage)) {
            $seedsReflection = new \ReflectionClass(get_class($this));
            $storage = strtolower(str_replace('Seeds', '', $seedsReflection->getShortName()));
        }

        if (!$this->seeder->truncate($storage)) {
            throw new SeedsStorageException("Unable to clear seeds storage: {$storage}");
        }
    }

    /**
     * Creates seeds
     *
     * @return array
     */
    abstract protected function create(): array;
}
