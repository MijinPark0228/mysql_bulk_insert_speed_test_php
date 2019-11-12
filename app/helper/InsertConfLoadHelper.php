<?php
/**
 * Created by PhpStorm.
 * User: m-park
 * Date: 2019/11/11
 * Time: 17:25
 */

namespace App\Helper;

class InsertConfLoadHelper
{
    private static $itemCreateRow = 0;
    private static $multipleInsertRow = 0;
    private static $insertConf = null;
    private function __construct()
    {
    }

    /**
     * @return int
     * @throws \Exception
     */
    public static function getItemCreateRow()
    {
        self::loadConfFile();
        return self::$itemCreateRow;
    }

    /**
     * @return int
     * @throws \Exception
     */
    public static function getMultipleInsertRow()
    {
        self::loadConfFile();
        return self::$multipleInsertRow;
    }

    /**
     * @throws \Exception
     */
    private static function loadConfFile()
    {
        if (self::$insertConf instanceof InsertConfLoadHelper) {
            return;
        }

        $path = __DIR__.'/../../conf/insert_setting.json';
        self::$insertConf = json_encode(file_get_contents($path), true);
        if (self::$insertConf === null) {
            throw new \Exception('Fail to open insert_setting.json');
        }

    }
}