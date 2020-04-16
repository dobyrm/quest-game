<?php

namespace Core\Analytics;

interface AnalyticsInterface
{
    public function yes(int $index): bool;

    public function no(int $index): bool;
}