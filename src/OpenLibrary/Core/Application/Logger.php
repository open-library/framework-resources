<?php

    namespace OpenLibrary\Core\Application;

    use Monolog\Handler\StreamHandler;
    use Monolog\Handler\ChromePHPHandler;
    use Monolog\Handler\FirePHPHandler;
    use Monolog\Handler\BrowserConsoleHandler;

    class Logger
    {
        /**
         * @var bool
         */
        private static $initialized = false;
        /**
         * @var \Monolog\Logger
         */
        private static $mLogger;
        /**
         * @var \Monolog\Logger
         */
        private static $cLogger;
        /**
         * @var \Monolog\Logger
         */
        private static $fLogger;
        /**
         * @var \Monolog\Logger
         */
        private static $jLogger;

        /**
         *
         */
        private static function _init()
        {
            if (self::$initialized) return;
            self::$mLogger = new \Monolog\Logger('main');
            self::$cLogger = new \Monolog\Logger('chrome');
            self::$fLogger = new \Monolog\Logger('firebug');
            self::$jLogger = new \Monolog\Logger('javascript');

            self::$mLogger->pushHandler(new StreamHandler('/tmp/logstream.log', \Monolog\Logger::DEBUG));
            self::$cLogger->pushHandler(new ChromePHPHandler());
            self::$fLogger->pushHandler(new FirePHPHandler());
            self::$jLogger->pushHandler(new BrowserConsoleHandler());

            self::$mLogger->addNotice('Loaded MonoLog');
            self::$cLogger->addNotice('- Loaded Chrome Log');
            self::$fLogger->addNotice('Loaded FireBug Log');
            self::$jLogger->addNotice('Loaded JavaScript Console Log');

            self::$initialized = true;
        }

        /**
         * @param $message
         */
        private static function addLogMessage($message){
            error_log($message);
        }

        /**
         * @param $message
         */
        public static function addAlert($message)
        {
            if (!self::$initialized) {
                self::_init();
            }
            self::addLogMessage($message);
            self::$mLogger->addAlert($message);
            self::$cLogger->addAlert('- ' . $message);
            self::$fLogger->addAlert($message);
            self::$jLogger->addAlert($message);
        }

        /**
         * @param $message
         */
        public static function addCritical($message)
        {
            if (!self::$initialized) {
                self::_init();
            }
            self::addLogMessage($message);
            self::$mLogger->addCritical($message);
            self::$cLogger->addCritical('- ' . $message);
            self::$fLogger->addCritical($message);
            self::$jLogger->addCritical($message);
        }

        /**
         * @param $message
         */
        public static function addDebug($message)
        {
            if (!self::$initialized) {
                self::_init();
            }
            self::addLogMessage($message);
            self::$mLogger->addDebug($message);
            self::$cLogger->addDebug('- ' . $message);
            self::$fLogger->addDebug($message);
            self::$jLogger->addDebug($message);
        }

        /**
         * @param $message
         */
        public static function addEmergency($message)
        {
            if (!self::$initialized) {
                self::_init();
            }
            self::addLogMessage($message);
            self::$mLogger->addEmergency($message);
            self::$cLogger->addEmergency('- ' . $message);
            self::$fLogger->addEmergency($message);
            self::$jLogger->addEmergency($message);
        }

        /**
         * @param $message
         */
        public static function addError($message)
        {
            if (!self::$initialized) {
                self::_init();
            }
            self::addLogMessage($message);
            self::$mLogger->addError($message);
            self::$cLogger->addError('- ' . $message);
            self::$fLogger->addError($message);
            self::$jLogger->addError($message);
        }

        /**
         * @param $message
         */
        public static function addInfo($message)
        {
            if (!self::$initialized) {
                self::_init();
            }
            self::addLogMessage($message);
            self::$mLogger->addInfo($message);
            self::$cLogger->addInfo('- ' . $message);
            self::$fLogger->addInfo($message);
            self::$jLogger->addInfo($message);
        }

        /**
         * @param $message
         */
        public static function addNotice($message)
        {
            if (!self::$initialized) {
                self::_init();
            }
            self::addLogMessage($message);
            self::$mLogger->addNotice($message);
            self::$cLogger->addNotice('- ' . $message);
            self::$fLogger->addNotice($message);
            self::$jLogger->addNotice($message);
        }

        /**
         * @param $message
         */
        public static function addWarning($message)
        {
            if (!self::$initialized) {
                self::_init();
            }
            self::addLogMessage($message);
            self::$mLogger->addWarning($message);
            self::$cLogger->addWarning('- ' . $message);
            self::$fLogger->addWarning($message);
            self::$jLogger->addWarning($message);
        }
    }
