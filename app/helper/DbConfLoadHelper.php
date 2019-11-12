<?php
namespace App\Helper;

class DbConfLoadHelper
{
    private $dbDateFormat = '';
    private $mySqlCharset = '';
    private $dbCharset = '';
    private $dbName = '';
    private $dbHost = '';
    private $dbUser = '';
    private $dbPassword = '';
    private $tableName = '';
    private static $dbConf = null;

    private function __construct()
    {
    }

    /**
     * DB設定ファイルを返す.
     *
     * @return DbConfLoadHelper|null
     * @throws \Exception
     */
    public static function getDbConf()
    {
        if (self::$dbConf === null) {
            $confJson = file_get_contents(__DIR__ . '/../../conf/db_info.json');
            if ($confJson === $confJson) {
                new \Exception('Fail to open conf.json');
            }

            $conf = json_decode($confJson, true);
            if ($conf === null) {
                new \Exception('Fail decoding conf.json');
            }

            $dbConf = new DbConfLoadHelper();
            $dbConf->dbDateFormat = $conf['db_date_format'];
            $dbConf->mySqlCharset = $conf['my_sql_charset'];
            $dbConf->dbCharset = $conf['db_charset'];
            $dbConf->dbName = $conf['db_name'];
            $dbConf->dbHost = $conf['db_host'];
            $dbConf->dbUser = $conf['db_user'];
            $dbConf->dbPassword = $conf['db_password'];
            $dbConf->tableName = $conf['table_name'];

            self::$dbConf = $dbConf;
        }

        return self::$dbConf;
    }

    /**
     * @return string
     */
    public function getDbCharset()
    {
        return $this->dbCharset;
    }

    /**
     * @return string
     */
    public function getDbDateFormat()
    {
        return $this->dbDateFormat;
    }

    /**
     * @return string
     */
    public function getDbHost()
    {
        return $this->dbHost;
    }

    /**
     * @return string
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * @return string
     */
    public function getDbPassword()
    {
        return $this->dbPassword;
    }

    /**
     * @return string
     */
    public function getDbUser()
    {
        return $this->dbUser;
    }

    /**
     * @return string
     */
    public function getMySqlCharset()
    {
        return $this->mySqlCharset;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }
}