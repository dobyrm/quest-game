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

        // Map collection
        $mapping = [];
        $mapping['id'] = $map['id'] ?? null;
        $mapping['title'] = $map['title'] ?? null;
        $mapping['description'] = $map['description'] ?? null;
        $mapping['max_mark'] = $map['max_mark'] ?? 0;
        $this->storage->setData('map', $mapping);

        // Points collections
        $point = json_decode($map['points']) ?? null;
        $this->storage->setData('current_point', $point);
        $this->storage->setData('bonuses', 0);

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
