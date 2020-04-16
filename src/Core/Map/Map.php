<?php

namespace Core\Map;

use Exception;
use Repository\Map\MapRepository;
use Services\Storage\Storage;

class Map
{
    /**
     * @var MapRepository $mapRepository
     */
    private $mapRepository;

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
        $this->mapRepository = new MapRepository();
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getMaps(): array
    {
        return $this->mapRepository->getMaps();
    }

    /**
     * @param int $mapId
     * @return array
     * @throws Exception
     */
    public function setMap(int $mapId): array
    {
        $map = $this->mapRepository->getMapById($mapId);

        $mapping = [];
        $mapping['id'] = $map['id'] ?? null;
        $mapping['title'] = $map['title'] ?? null;
        $mapping['description'] = $map['description'] ?? null;

        $this->storage->setData('map', $mapping);

        $points = json_decode($map['points']) ?? null;

        $this->storage->setData('points', $points);
        $this->storage->setData('count_points', count($points));
        $this->storage->setData('success_points', 0);

        return $mapping;
    }

    /**
     * @param string $key
     */
    public function setCheckpoint(string $key)
    {
        $this->storage->setData($key);
    }

    /**
     * @param string $key
     */
    public function destroyCheckpoint(string $key)
    {
        $this->storage->destroyData($key);
    }
}
