<?php

namespace Core\Analytics;

interface AnalyticsInterface
{
    public function yes(): bool;

    public function no(): bool;

    public function finish(): bool;
}