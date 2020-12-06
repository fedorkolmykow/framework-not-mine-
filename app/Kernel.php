<?php

declare(strict_types = 1);

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;

class Kernel
{
    /**
     * @var RouteCollection
     */
    protected $routeCollection;

    /**
     * @var ContainerBuilder
     */
    protected $containerBuilder;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->containerBuilder = $containerBuilder;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $cmdRegisterConfig = new \Framework\CmdRegisterConfig($this->containerBuilder);
        $cmdRegisterRoutes = new \Framework\CmdRegisterRoutes($this->containerBuilder);
        $cmdRegisterConfig->execute();
        $this->routeCollection = $cmdRegisterRoutes->execute();

        $cmdProcess = new \Framework\CmdProcess($request, $this->routeCollection);

        return $cmdProcess->execute();
    }
}
