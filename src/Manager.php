<?php

namespace Slexx\AssetsManager;

class Manager
{
    protected static $instance = null;
    protected function __construct() {}
    protected function __clone() {}

    /**
     * @return Manager|null
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * @var Location[]
     */
    protected $locations = [];

    /**
     * @param string $name
     * @return Location
     */
    public function location(string $name)
    {
        if (!isset($this->locations[$name])) {
            $this->locations[$name] = new Location();
        }

        return $this->locations[$name];
    }

    /**
     * @param string $name
     * @return Location
     */
    public function __get(string $name)
    {
        return $this->location($name);
    }
}

