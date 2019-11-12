<?php
namespace App\Dao;
use App\Helper\DbConfLoadHelper;

class MySQLPdo
{
    private static $pdo = null;

    private function __construct()
    {
    }

    /**
     * @return \PDO
     * @throws \Exception
     */
    public static function getPdo()
    {
        $dbConf = DbConfLoadHelper::getDbConf();

        if (self::$pdo === null ) {
            $dsn = 'mysql:dbname='.$dbConf->getDbName().';';
            $dsn .= 'host='.$dbConf->getDbHost().';';
            $dsn .= 'charset='.$dbConf->getMySqlCharset().';';

            try {
                self::$pdo = new \PDO($dsn, $dbConf->getDbUser(), $dbConf->getDbPassword(), array(\PDO::MYSQL_ATTR_LOCAL_INFILE => true));
            } catch (\Exception $e) {
                echo $e->getMessage();
                echo "errorが発生しました。".PHP_EOL;
            }
        }

        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return self::$pdo;
    }
}