<?php

namespace Services\Storage;

class Storage extends BaseStorage
{
    /**
     * @param string $key
     * @param array $data
     */
    public function setData($key = '', $data = [])
    {
        $this->set($key, $data);
    }

    /**
     * @param string $key
     */
    public function destroyData($key = '')
    {
        $this->destroy($key);
    }

    /**
     * @param null $key
     * @return array
     */
    public function getData($key = null)
    {
        if(isset($_SESSION[$key])) {

            return $_SESSION[$key];
        }

        return $_SESSION;
    }
}