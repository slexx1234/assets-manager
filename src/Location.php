<?php

namespace Slexx\AssetsManager;

/**
 * Class Location
 * @package Slexx\AssetsManager
 * @method $this script(string $name, string $href, array $requires = [])
 * @method $this inlineScript(string $name, string $href, array $requires = [])
 * @method $this style(string $name, string $href, array $requires = [])
 * @method $this inlineStyle(string $name, string $href, array $requires = [])
 */
class Location
{
    /**
     * @var AssetInterface[]
     */
    protected $assets = [];

    /**
     * @var array
     */
    protected static $types = [
        'script' => ScriptAsset::class,
        'inlineScript' => InlineScriptAsset::class,
        'style' => StyleAsset::class,
        'inlineStyle' => InlineStyleAsset::class,
    ];

    /**
     * @param string $name
     * @return bool
     */
    public static function hasType(string $name)
    {
        return isset(self::$types[$name]);
    }

    /**
     * @param string $name
     * @return string|null
     */
    public static function getType(string $name)
    {
        return self::hasType($name) ? self::$types[$name] : null;
    }

    /**
     * @param string $name
     * @param string $class
     */
    public static function setType(string $name, string $class)
    {
        self::$types[$name] = $class;
    }

    /**
     * @param string $name
     */
    public static function removeType(string $name)
    {
        unset(self::$types[$name]);
    }

    /**
     * @param $name
     * @param $arguments
     * @return AssetInterface|object
     * @throws \ReflectionException
     */
    public function __call($name, $arguments)
    {
        $reflection = new \ReflectionClass(self::$types[$name]);
        $instance = $reflection->newInstanceArgs($arguments);
        $this->assets[$arguments[0]] = $instance;
        return $instance;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $loaded = [];
        $errors = [];
        $result = '';

        while(true) {
            foreach($this->assets as $asset) {
                // Если файл загружен или прошёл с ошибкой, пропускаем его
                if (in_array($asset->getName(), array_merge($loaded, $errors))) {
                    continue;
                }

                $requires = $asset->getRequires();
                $load = true;
                foreach($requires as $n) {
                    // Если требуемого файла нет или он получил ошибку
                    if (!isset($this->assets[$n]) || in_array($n, $errors)) {
                        // Запоминаем наш файл как обработанный с ошибкой
                        $errors[] = $asset->getName();
                        $load = false;
                        break;
                    }
                    if (!in_array($n, $loaded)) {
                        $load = false;
                        break;
                    }
                }

                // Если все требуемые файлы загружен
                if ($load) {
                    $result .= $asset->render() . "\n";
                    $loaded[] = $asset->getName();
                }
            }

            // Если обработку прошли все файлы, выходим
            if (count(array_merge($loaded, $errors)) == count($this->assets)) {
                break;
            }
        }

        return $result;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }
}
