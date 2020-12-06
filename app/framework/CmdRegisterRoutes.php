<?php


namespace Framework;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Routing\RouteCollection;

class CmdRegisterRoutes implements ICommand
{
    /**
     * @var ContainerBuilder
     */
    private $containerBuilder;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->containerBuilder = $containerBuilder;
    }

    /**
     * @return RouteCollection
     */
    public function execute(): RouteCollection
    {
        $routeCollection = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .'config' . DIRECTORY_SEPARATOR . 'routing.php';
        $this->containerBuilder->set('route_collection', $routeCollection);
        return  $routeCollection;
    }
}