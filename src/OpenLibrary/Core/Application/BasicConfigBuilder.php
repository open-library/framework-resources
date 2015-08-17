<?php

    namespace OpenLibray\Core\Application;

    /**
     * Class BasicConfigBuilder
     * @description A more basic version of the ConfigurationBuilder.php that isn't dependant on Memcache
     * @package OpenLibray\Core\Application
     */
    class BasicConfigBuilder
    {

        /**
         * @var array
         */
        private static $ini = [];
        /**
         * @var bool
         */
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
        public static function build ($initFilePath){
            $tmp = parse_ini_file ($initFilePath, true);
            if ( !isset($_SERVER['SERVER_NAME'])) {
                $_SERVER['SERVER_NAME'] = 'local';
            }
            foreach ($tmp as $env => $ini) {
                if (isset($ini['apphost']) && $_SERVER['SERVER_NAME'] == $ini['apphost']) {
                    self::set ($env, array_merge ($tmp['all'], $ini));
                    break;
                }
            }
            if ( !self::initialized ()) {
                die('Failed to initialize configuration for server [' . $_SERVER['SERVER_NAME'] . "]\n");
            }
            $config_arr = self::getAll ();
            return $config_arr;
        }
    }
