<?php

use Services\Route\Route;

if(!empty($_GET['page'])) {
    $obj = new Route('game');
    switch ($_GET['page']) {
        case 'map':
            $obj->getPage('map');
            break;
        case 'playing':
            $obj->getPage('playing');
            break;
        case 'game-over':
            $obj->getPage('game-over');
            break;
        default:
            $obj->getPage();
            break;
    }

    exit();
}

$obj = new Route('game');
$obj->getPage();