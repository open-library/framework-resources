<?php

namespace OpenLibray\Core\Application;

class ConfigurationBuilder
{

    private static $ini = [];
    private static $initialized = false;

    /**
     * @param $env
     * @param $ini
     */
    public static function set ($env, $ini)
    {
        $ini['environment'] = $env;
        self::$ini = $ini;
        self::$initialized = true;
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public static function get ($key, $default = null)
    {
        if (MC::get ('api_config')) {
            //shouldn't be re-parsing ini after first load
            Logger::addInfo ("Config File Loaded to get: {$key} - Why isn't this in memcache etc");
        }
        if (isset(self::$ini[$key])) return self::$ini[$key];

        return $default;
    }

    /**
     * @return array
     */
    public static function getAll ()
    {
        return self::$ini;
    }

    /**
     * @return bool
     */
    public static function initialized ()
    {
        return self::$initialized;
    }

    /**
     * @param $initFilePath
     * @return array
     */
    public static function init ($initFilePath){
        $tmp = parse_ini_file ($initFilePath, true);
        if ( !isset($_SERVER['SERVER_NAME'])) {
            $_SERVER['SERVER_NAME'] = 'local';
        }
        foreach ($tmp as $env => $ini) {
            if (isset($ini['apphost']) && $_SERVER['SERVER_NAME'] == $ini['apphost']) {
                self::set ($env, array_merge ($tmp['all'], $ini));
                $conf = true;
                break;
            }
        }
        if ( !self::initialized ()) {
            die('Failed to initialize configuration for server [' . $_SERVER['SERVER_NAME'] . "]\n");
        }
        if ( !($config_arr = MC::get ($_SERVER['SERVER_NAME']))) {
            if (MC::getResultCode () == \Memcached::RES_NOTFOUND) {
                $config_arr = self::getAll ();
                MC::set ($_SERVER['SERVER_NAME'], $config_arr, 1);
            } else {
                Logger::addCritical("OpenCollectionsApi->_init() => Cannot read/write memcache");
            }
        }
        return $config_arr;
    }
}
