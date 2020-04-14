<?php

namespace Services\Storage;

class BaseStorage implements StorageInterface
{
    /**
     * @param string $key
     * @param array $data
     * @return bool
     */
    public function set(string $key = '', array $data = []): bool
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
     * @return bool
     */
    public function destroy(string $key = ''): bool
    {
        if (!empty($key)) {
            unset($_SESSION[$key]);

            return true;
        }
        session_unset();
        session_destroy();

        return true;
    }
}