<?php

/**
 * Class GameController
 */
namespace Controller;

use Core\Map\Map;
use Exception;
use Manager\GameManager;
use Services\Template\Template;

class GameController extends Controller
{
    /**
     * @var GameManager $gameManager
     */
    private $gameManager;

    /**
     * @var Map $gameMap
     */
    private $gameMap;

    public function __construct()
    {
        parent::__construct();

        $this->gameManager = new GameManager();
        $this->gameMap = new Map();
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
            $maps = $this->gameMap->getMaps();

            return Template::render('game/index', [
                'message' => $info,
                'maps' => $maps,
            ]);
        } catch(Exception $e) {

            echo $e->getMessage();
        }
    }

    /**
     * Selected map
     */
    public function map()
    {
        try {
            $mapId = $this->request::get('id');
            $map = $this->gameMap->setMap($mapId);

            return Template::render('game/map', [
                'map' => $map,
            ]);
        } catch(Exception $e) {

            echo $e->getMessage();
        }
    }

    /**
     * Game started
     */
    public function playing()
    {
        try {
            if(!$this->storage->getDataByKey('playing')) {
                $this->storage->setData('playing', true);
            }

            return Template::render('game/playing', []);
        } catch(Exception $e) {

            echo $e->getMessage();
        }
    }

    /**
     * Remove all game sessions and redirect to homepage
     */
    public function gameOver()
    {
        $this->storage->destroyData();

        header("Location: /");
        exit();
    }
}
