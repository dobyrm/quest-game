<?php

use Services\Route\Route;

if(!empty($_GET['page'])) {
    $obj = new Route('game');
    switch ($_GET['page']) {
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