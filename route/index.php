<?php

use Services\Route;

if(!empty($_GET['mode'])) {
    $obj = new Route('game');
    switch ($_GET['mode']) {
        case 'start':
            $obj->getPage('start');
            break;
        default:
            $obj->getPage();
            break;
            break;
    }
}

$obj = new Route('game');
$obj->getPage();