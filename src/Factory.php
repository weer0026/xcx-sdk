<?php

namespace HangJia\Xcx;

/**
 * Class Factory.
 *
 * @method static \HangJia\Xcx\User         user($config)
 * @method static \HangJia\Xcx\Submit       submit($config)
 * @method static \HangJia\Xcx\Platform     platform($config = [])
 */
class Factory
{
    /**
     * The cache of studly-cased words.
     * @var array
     */
    protected static $studlyCache = [];

    public static function make($name, array $config = [])
    {
        $namespace = self::studly($name);
        $application = "\\HangJia\\Xcx\\{$namespace}";
        return new $application($config);
    }

    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }

    /**
     * Convert a value to studly caps case.
     *
     * @param string $value
     *
     * @return string
     */
    public static function studly($value)
    {
        $key = $value;

        if (isset(static::$studlyCache[$key])) {
            return static::$studlyCache[$key];
        }

        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return static::$studlyCache[$key] = str_replace(' ', '', $value);
    }
}