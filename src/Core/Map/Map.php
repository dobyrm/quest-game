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
        $item['id'] = $map['id'] ?? null;
        $item['title'] = $map['title'] ?? null;
        $item['description'] = $map['description'] ?? null;
        $item['points'] = json_decode($map['points']) ?? null;

        $this->storage->setData('map', $mapping);

        return $item;
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
