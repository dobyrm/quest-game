<?php

namespace Core\Transition;

interface TransitionInterface
{
    public function top(): bool;

    public function bottom(): bool;

    public function left(): bool;

    public function right(): bool;
}