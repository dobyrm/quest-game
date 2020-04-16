<?php

namespace Services\Storage;

class Storage extends BaseStorage
{
    /**
     * @param string $key
     * @param mixed $data
     */
    public function setData(string $key = '', $data = [])
    {
        $this->set($key, $data);
    }

    /**
     * @param string $key
     * @param null $index
     */
    public function destroyData(string $key = '', $index = null)
    {
        $this->destroy($key, $index);
    }

    /**
     * @return array
     */
    public function checkEmpty()
    {

        return $_SESSION;
    }

    /**
     * @param string $key
     * @return bool|mixed
     */
    public function getData(string $key)
    {
        if (isset($_SESSION[$key])) {

            return $_SESSION[$key];
        }

        return false;
    }

    /**
     * @param string $key
     * @param string $index
     * @return bool
     */
    public function getElement(string $key, string $index)
    {
        if (isset($_SESSION[$key][$index])) {

            return $_SESSION[$key][$index];
        }

        return false;
    }
}