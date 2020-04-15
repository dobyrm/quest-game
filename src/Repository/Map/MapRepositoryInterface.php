<?php

namespace Repository\Map;

interface MapRepositoryInterface
{
    public function getMaps(): array;

    public function getMapById(int $id): array;
}