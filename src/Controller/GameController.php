<?php

/**
 * Class GameController
 */
namespace Controller;

use Core\Analytics\Analytics;
use Core\Map\Map;
use Exception;
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
            $gameMap = new Map();
            $maps = $gameMap->getMaps();

            return Template::render('game/index', [
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
            if (!$this->storage->getData('playing')) {
                $this->storage->setData('playing', true);
            }
            $point = $this->storage->getData('current_point');
            if (empty($point->action)) {
                $this->redirect('?page=game-result');
            }

            $answer = $this->request::get('answer');
            if (!empty($answer)) {
                $analytics = new Analytics();
                if ($answer == 'yes') {
                    $analytics->yes();
                    $this->redirect('?page=playing');
                } elseif ($answer == 'no') {
                    $analytics->no();
                    $this->redirect('?page=playing');
                } elseif ($answer == 'finish') {
                    $analytics->finish();
                    $this->redirect('?page=game-result');
                }
            }

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
            if (empty($this->storage->checkEmpty())) {
                $this->redirect();
            }
            $maxMark = $this->storage->getElement('map', 'max_mark');
            $yourMark = $this->storage->getData('your_mark');
            $this->storage->destroyData();

            return Template::render('game/result', [
                'max_mark' => $maxMark,
                'your_mark' => $yourMark
            ]);
        } catch(Exception $e) {

            echo $e->getMessage();
        }
    }
}
