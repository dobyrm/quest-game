<?php

namespace Services;

use Controller\ControllerGame;

class Route
{
    /**
     * @var $controller
     */
    private $controller;

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
     * @param $name
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