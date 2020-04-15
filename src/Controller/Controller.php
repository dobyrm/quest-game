<?php

/**
 * Class Controller
 */
namespace Controller;

use Services\Request\Request;
use Services\Storage\Storage;

class Controller
{
    /**
     * @var Request $request
     */
    protected $request;

    /**
     * @var Storage $storage
     */
    protected $storage;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->storage = new Storage();
    }
}
