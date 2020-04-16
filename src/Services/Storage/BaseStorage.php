<?php

namespace Services\Storage;

class BaseStorage implements StorageInterface
{
    /**
     * @param string $key
     * @param $data
     * @return bool
     */
    public function set(string $key = '', $data = null): bool
    {
        if (!empty($key)) {
            $_SESSION[$key] = $data;

            return true;
        }
        $_SESSION[] = $data;

        return true;
    }

    /**
     * @param string $key
     * @param null $index
     * @return bool
     */
    public function destroy(string $key = '', $index = null): bool
    {
        if (!empty($key)) {
            if($index !== null) {
                unset($_SESSION[$key][$index]);

                return true;
            }
            unset($_SESSION[$key]);

            return true;
        }
        session_unset();
        session_destroy();

        return true;
    }
}