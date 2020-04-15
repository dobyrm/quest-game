<?php
/**
 * Class Template
 */
namespace Services\Template;

use Exception;

class Template
{
    /**
     * Render template
     *
     * @param string $name
     * @param array $response
     * @return void
     * @throws Exception
     */
    public static function render(string $name, array $response = [])
    {
        extract($response, EXTR_SKIP);

        $file = dirname(__DIR__) . "/../../template/" . $name . ".php";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new Exception("$file not found");
        }
    }
}