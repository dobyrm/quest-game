<?php

/**
 * Class GameManager
 */
namespace Manager;

use Exception;

class GameManager
{
    /**
     * @return string
     * @throws Exception
     */
    public function getInfo()
    {
        $template = DIR_ROOT . "README.md";

        if(!file_exists($template)) {
            throw new Exception("Template does not exist");
        }

        return file_get_contents($template);
    }
}
