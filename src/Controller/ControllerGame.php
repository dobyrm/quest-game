<?php

/**
 * Class ControllerGame
 */
namespace Controller;

use Exception;
use Manager\GameManager;
use Services\Template\Template;

class ControllerGame
{
    /**
     * @var GameManager $gameManager
     */
    private $gameManager;

    public function __construct()
    {
        $this->gameManager = new GameManager();
    }

    /**
     * @return string|void
     * @throws Exception
     * @throws Exception
     */
    public function index()
    {
        try {
            $info = $this->gameManager->getInfo();

            return Template::render('game/index', [
                'message' => $info
            ]);
        } catch(Exception $e) {

            echo $e->getMessage();
        }
    }

    public function start()
    {
        //
    }
}
