<?php

namespace Core\Conditions;

use Services\Storage\Storage;

class Conditions
{
    /**
     * @var Storage $storage
     */
    private $storage;

    /**
     * Map constructor.
     */
    public function __construct()
    {
        $this->storage = new Storage();
    }

    /**
     * @return bool
     */
    public function checkedRules(): bool
    {
        if ($this->storage->getData('playing')) {

            return true;
        }

        return false;
    }
}
