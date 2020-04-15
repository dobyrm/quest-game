<?php

namespace Repository\Map;

use Exception;
use Services\ORM\ORM;

class MapRepository implements MapRepositoryInterface
{
    /**
     * @return array
     * @throws Exception
     */
    public function getMaps(): array
    {
        return ORM::query('SELECT * FROM maps')->findAll();
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getMapById(int $id): array
    {
        return ORM::query('SELECT * FROM maps WHERE id = ' . $id)->find();
    }
}
