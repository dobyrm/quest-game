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
     * @return bool
     */
    public function yes(): bool
    {
        $point = $this->storage->getData('current_point');

        // Set bonuses
        if (isset($point->bonus)) {
            $bonuses = $this->storage->getData('bonuses');
            $bonus = $bonuses + $point->bonus;
            $this->storage->setData('bonuses', $bonus);
        }

        // Solution analysis
        if (isset($point->action->yes)) {
            if((isset($point->action->yes->finish)) && ($point->action->yes->finish)) {
                if(isset($point->action->yes->mark)) {
                    $this->storage->setData('your_mark', $point->action->yes->mark);
                }
                $this->storage->setData('current_point', null);

                return true;
            }
            $this->storage->setData('current_point', $point->action->yes);
        } else {
            $this->storage->setData('current_point', null);
        }

        return true;
    }

    /**
     * @return bool
     */
    public function no(): bool
    {
        $point = $this->storage->getData('current_point');

        // Set bonuses
        if (isset($point->bonus)) {
            $bonuses = $this->storage->getData('bonuses');
            $bonus = $bonuses + $point->bonus;
            $this->storage->setData('bonuses', $bonus);
        }

        // Solution analysis
        if (isset($point->action->no)) {
            if((isset($point->action->no->finish)) && ($point->action->no->finish)) {
                if(isset($point->action->no->mark)) {
                    $this->storage->setData('your_mark', $point->action->no->mark);
                }
                $this->storage->setData('current_point', null);

                return true;
            }
            $this->storage->setData('current_point', $point->action->no);
        } else {
            $this->storage->setData('current_point', null);
        }

        return true;
    }

    /**
     * @return bool
     */
    public function finish(): bool
    {
        $point = $this->storage->getData('current_point');

        if((isset($point->action->finish)) && ($point->action->finish)) {
            // Set bonuses
            if (isset($point->bonus)) {
                $bonuses = $this->storage->getData('bonuses');
                $bonus = $bonuses + $point->bonus;
                $this->storage->setData('bonuses', $bonus);
            }

            // Set mark
            if(isset($point->action->mark)) {
                $this->storage->setData('your_mark', $point->action->mark);
            }
            $this->storage->setData('current_point', null);
        }

        return true;
    }
}