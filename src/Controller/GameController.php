<?php

/**
 * Class GameController
 */
namespace Controller;

use Core\Analytics\Analytics;
use Core\Map\Map;
use Exception;
use Manager\GameManager;
use Services\Template\Template;

class GameController extends Controller
{
    /**
     * GameController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string|void
     * @throws Exception
     * @throws Exception
     */
    public function index()
    {
        try {
            $gameManager = new GameManager();
            $gameMap = new Map();

            $info = $gameManager->getInfo();
            $maps = $gameMap->getMaps();

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

            $gameMap = new Map();
            $map = $gameMap->setMap($mapId);

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
            $points = $this->storage->getDataByKey('points');
            if(empty($points)) {
                $this->redirect('?page=game-result');
            }

            $pointIndex = array_key_first($points);
            $answer = $this->request::get('answer');
            if(!empty($answer)) {
                $analytics = new Analytics();
                if ($answer == 'yes') {
                    $analytics->yes($pointIndex);
                    $this->redirect('?page=playing');
                } elseif($answer == 'no') {
                    $analytics->no($pointIndex);
                    $this->redirect('?page=playing');
                }
            }
            $point = $this->storage->getElement('points', $pointIndex);

            return Template::render('game/playing', [
                'point' => $point
            ]);
        } catch(Exception $e) {

            echo $e->getMessage();
        }
    }

    /**
     * Remove all game sessions and redirect to result game page
     */
    public function gameResult()
    {
        try {
            if(empty($this->storage->getData())) {
                $this->redirect();
            }
            $countPoints = $this->storage->getData('count_points');
            $successPoints = $this->storage->getData('success_points');
            $this->storage->destroyData();

            return Template::render('game/result', [
                'count_points' => $countPoints,
                'success_points' => $successPoints
            ]);
        } catch(Exception $e) {

            echo $e->getMessage();
        }
    }
}
