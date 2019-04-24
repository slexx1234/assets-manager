<?php

namespace Slexx\AssetsManager\Laravel;

use Slexx\AssetsManager\Manager;

class BladeDirectives
{
    /**
     * @var null|string
     */
    protected static $scriptName = null;

    /**
     * @var null|string[]
     */
    protected static $scriptRequires = null;

    /**
     * @param string $name
     * @param string|string[] $href
     * @param string[] $requires
     * @return string
     */
    public static function script(string $name, $href = [], array $requires = [])
    {
        if (is_array($href)) {
            self::$scriptName = $name;
            self::$scriptRequires = $href;
            ob_start();
        } else {
            Manager::getInstance()->location('default')->script($name, $href, $requires);
        }
    }

    /**
     *
     */
    public static function endScript()
    {
        Manager::getInstance()->location('default')->inlineScript(self::$scriptName, ob_get_clean(), self::$scriptRequires);
        self::$scriptName = null;
        self::$scriptRequires = null;
    }

    /**
     * @var null|string
     */
    protected static $styleName = null;

    /**
     * @var null|string[]
     */
    protected static $styleRequires = null;

    /**
     * @param string $name
     * @param string|string[] $href
     * @param string[] $requires
     * @return string
     */
    public static function style(string $name, $href = [], array $requires = [])
    {
        if (is_array($href)) {
            self::$styleName = $name;
            self::$styleRequires = $href;
            ob_start();
        } else {
            Manager::getInstance()->location('default')->style($name, $href, $requires);
        }
    }

    /**
     *
     */
    public static function endStyle()
    {
        Manager::getInstance()->location('default')->inlineStyle(self::$styleName, ob_get_clean(), self::$styleRequires);
        self::$styleName = null;
        self::$styleRequires = null;
    }

    /**
     *
     */
    public static function assets()
    {
        echo Manager::getInstance()->location('default');
    }
}
