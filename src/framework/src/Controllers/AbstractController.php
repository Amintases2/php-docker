<?php

namespace PFW\Framework\Controllers;

use League\Container\Container;
use PFW\Framework\Http\Response;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    protected ?ContainerInterface $container = null;

    public function setContainer(Container $container): void
    {
        $this->container = $container;
    }

    public function render(string $view, array $params = [], Response $response = null): Response
    {

        $content = $this->container->get('twig')->render($view, $params);

        $response ??= new Response();

        $response->setContent($content);

        return $response;
    }
}
