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
     * @param int $index
     * @return bool
     */
    public function yes(int $index): bool
    {
        $point = $this->storage->getElement('points', $index);
        $this->storage->destroyData('points', $index);

        if($point->action->yes == 'success') {
            $successPoints = $this->storage->getDataByKey('success_points');
            $newPoint = $successPoints + 1;
            $this->storage->setData('success_points', $newPoint);

            return true;
        }

        return false;
    }

    /**
     * @param int $index
     * @return bool
     */
    public function no(int $index): bool
    {
        $point = $this->storage->getElement('points', $index);
        $this->storage->destroyData('points', $index);

        if($point->action->no == 'success') {
            $successPoints = $this->storage->getDataByKey('success_points');
            $newPoint = $successPoints + 1;
            $this->storage->setData('success_points', $newPoint);

            return true;
        }

        return false;
    }
}