<?php

namespace Core\Analytics;

use Services\Storage\Storage;

class Analytics implements AnalyticsInterface
{
    /**
     * @var Storage $storage
     */
    private $storage;

    /**
     * Analytics constructor.
     */
    public function __construct()
    {
        $this->storage = new Storage();
    }

    /**
     * @return void
     */
    public function yes()
    {
        $point = $this->storage->getData('current_point');

        if (isset($point->action->yes)) {
            $this->storage->setData('current_point', $point->action->yes);
        } else {
            $this->storage->setData('current_point', null);
        }

        $yourMark = $this->storage->getData('your_mark');
        $newMark = $yourMark + $point->mark;
        $this->storage->setData('your_mark', $newMark);
    }

    /**
     * @return void
     */
    public function no()
    {
        $point = $this->storage->getData('current_point');

        if (isset($point->action->no)) {
            $this->storage->setData('current_point', $point->action->no);
        } else {
            $this->storage->setData('current_point', null);
        }

        $yourMark = $this->storage->getData('your_mark');
        $newMark = $yourMark + $point->mark;
        $this->storage->setData('your_mark', $newMark);
    }

    /**
     * @return void
     */
    public function finish()
    {
        $point = $this->storage->getData('current_point');

        if (isset($point->action->finish)) {
            $this->storage->setData('current_point', $point->action->finish);
        } else {
            $this->storage->setData('current_point', null);
        }

        $yourMark = $this->storage->getData('your_mark');
        $newMark = $yourMark + $point->mark;
        $this->storage->setData('your_mark', $newMark);
    }
}