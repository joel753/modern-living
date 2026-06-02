<?php
/**
 * CLASSE LOGGER - Gestion des logs
 */

class Logger
{
    const LOG_ERROR = 'ERROR';
    const LOG_WARNING = 'WARNING';
    const LOG_INFO = 'INFO';
    const LOG_DEBUG = 'DEBUG';

    public static function error($message)
    {
        self::log(self::LOG_ERROR, $message);
    }

    public static function warning($message)
    {
        self::log(self::LOG_WARNING, $message);
    }

    public static function info($message)
    {
        self::log(self::LOG_INFO, $message);
    }

    public static function debug($message)
    {
        if (APP_DEBUG) {
            self::log(self::LOG_DEBUG, $message);
        }
    }

    private static function log($level, $message)
    {
        $logFile = LOG_DIR . '/' . date('Y-m-d') . '.log';
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] [$level] $message" . PHP_EOL;
        
        error_log($logMessage, 3, $logFile);
    }
}
?>