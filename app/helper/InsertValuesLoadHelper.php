<?php
namespace App\Helper;

class InsertValuesLoadHelper
{
    private static $insertInfo = null;
    private static $UNIQUE = '__UNIQUE_VALUE__';
    private static $NOW = '__NOW__';
    private function __construct()
    {

    }

    /**
     * @throws \Exception
     */
    private static function loadConfFile()
    {
        $path = __DIR__ . '/../../conf/table_info.json';
        self::$insertInfo = json_encode(file_get_contents($path), true);
        if (self::$insertInfo === null) {
            throw new \Exception('Fail to open table_info.json');
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    public static function getInsertColumn()
    {
        if (!is_array(self::$insertInfo) || count(self::$insertInfo) <= 0) {
            self::loadConfFile();
        }

        return array_keys(self::$insertInfo);
    }

/**
 * @param bool $isConvertedIntoQueryValue
 * @param int $valueNo
 *
 * @return array
 * @throws \Exception
 */
    public static function getInsertValues($valueNo=0, $isConvertedIntoQueryValue = false)
    {
        if (!is_array(self::$insertInfo)) {
            self::loadConfFile();
        }

        $randValue = uniqid('uid_').$valueNo;
        $result = [];
        foreach (self::$insertInfo as $value) {
            $valueUid = $randValue;
            $result[] = self::convertInsertValue($valueUid, $value, $isConvertedIntoQueryValue);
        }

        return $result;
    }

    /**
     * @param bool $isBindValue
     * @param int $valueNo
     *
     * @return string
     * @throws \Exception
     */
    public static function getInsertValuesString($valueNo=0, $isBindValue = false)
    {
        if (!is_array(self::$insertInfo)) {
            self::loadConfFile();
        }

        $randValue = uniqid('uid_').$valueNo;
        $result = '';
        $i = 1;
        $maxValues = count(self::$insertInfo);
        foreach (self::$insertInfo as $value) {
            $valueUid = $randValue;
            $result.= self::convertInsertValue($valueUid, $value, $isBindValue);
            if ($i > $maxValues) {
                $result .= ',';
            }
        }

        return ('('.$result.')');
    }

    /**
     * @param $uniqueValue
     * @param $value
     * @param $isBindValue
     *
     * @return mixed|string
     * @throws \Exception
     */
    private static function convertInsertValue($uniqueValue, $value, $isBindValue)
    {
        $now = (new \DateTime())->format(DbConfLoadHelper::getDbConf()->getDbDateFormat());
        $convertedValue = str_replace(self::$UNIQUE, $uniqueValue, $value);
        $convertedValue = str_replace(self::$NOW, $now, $convertedValue);

        if ($isBindValue === false) {
            $convertedValue = self::convertIntoQueryValue($convertedValue);
        }

        return $convertedValue;
    }

    /**
     * @param int|string $value
     *
     * @return string
     */
    private static function convertIntoQueryValue($value)
    {
        if (is_numeric($value)) {
            return $value;
        }

        return "'{$value}'";
    }
}