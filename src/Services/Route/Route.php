<?php

namespace Services\Route;

use Controller\GameController;
use Core\Conditions\Conditions;
use Exception;

class Route
{
    /**
     * @var string $controller
     */
    private $controller;

    /**
     * @var Conditions $conditions
     */
    private $conditions;

    /**
     * Route constructor.
     *
     * @param string $controller
     */
    public function __construct($controller)
    {
        $this->conditions = new Conditions();

        switch ($controller) {
            case 'game':
                $this->controller = new GameController();
                break;
        }
    }

    /**
     * Return page
     *
     * @param string $name
     * @throws Exception
     */
    public function getPage($name = '')
    {
        try {
            if ($this->conditions->checkedRules()) {
                if ($name == 'game-over') {
                    $this->controller->gameOver();
                    exit();
                }
                if ($name !== 'playing') {
                    header("Location: ?page=playing");
                    exit();
                }
            }
            switch ($name) {
                case 'map':
                    $this->controller->map();
                    break;
                case 'playing':
                    $this->controller->playing();
                    break;
                case 'game-over':
                    $this->controller->gameOver();
                    break;
                default:
                    $this->controller->index();
                    break;
            }
        } catch (Exception $e) {
            header("Location: /");
            exit();
        }
    }
}