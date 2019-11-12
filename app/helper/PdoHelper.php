<?php
namespace App\Helper;
use App\Dao\MySQLPdo;

class PdoHelper
{
    private $pdo = null;

    /**
     * QueryHelper constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->pdo = MySQLPdo::getPdo();
    }

    /**
     * @param string $query
     *
     * @throws \Exception
     */
    public function exec($query)
    {
        $result = $this->pdo->exec($query);
        if ($result === false) {
            throw (new \Exception("失敗ｗ"));
        }

        if ($result !== 1) {
            throw (new \Exception("行数が合わない"));
        }
    }
}