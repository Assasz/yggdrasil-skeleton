<?php

namespace Skeleton\Application\AppInterface;

/**
 * Interface TemplateEngineInterface
 *
 * @package Skeleton\Application\AppInterface
 */
interface TemplateEngineInterface
{
    /**
     * Renders given view
     *
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string;
}