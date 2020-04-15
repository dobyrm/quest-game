<?php

/**
 * Class Request
 */
namespace Services\Request;

class Request
{
    /**
     * Collections get params
     *
     * @param string $index
     * @return void
     */
    public static function get(string $index = null)
    {
        $params = [];
        $get = $_GET;
        if(empty($get)) {

            return $params;
        }
        if(!empty($index)) {

            if(isset($get[$index])) {

                return $get[$index];
            }
        }

        foreach($get as $key => $val) {
            $params[$key] = $val;
        }

        return $params;
    }

    /**
     * Collections post params
     *
     * @param string $index
     * @return void
     */
    public static function post(string $index = null)
    {
        $params = [];
        $post = $_POST;
        if(empty($post)) {

            return $params;
        }
        if(!empty($index)) {

            if(isset($post[$index])) {

                return $post[$index];
            }
        }

        foreach($post as $key => $val) {
            $params[$key] = $val;
        }

        return $params;
    }
}