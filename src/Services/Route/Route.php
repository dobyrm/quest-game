<?php

namespace Services\Route;

use Controller\ControllerGame;

class Route
{
    /**
     * @var string $controller
     */
    private $controller;

    /**
     * Route constructor.
     *
     * @param string $controller
     */
    public function __construct($controller)
    {
        switch ($controller) {
            case 'game':
                $this->controller = new ControllerGame();
                break;
        }
    }

    /**
     * Return page
     *
     * @param string $name
     */
    public function getPage($name = '')
    {
        switch ($name) {
            case 'start':
                $this->controller->start();
                break;
            default:
                $this->controller->info();
                break;
        }
    }
}