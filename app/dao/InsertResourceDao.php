<?php
/**
 * Created by PhpStorm.
 * User: m-park
 * Date: 2019/11/11
 * Time: 13:20
 */

namespace App\Dao;

use App\Entity\DbMeasurementEntity;
use App\Helper\DbConfLoadHelper;
use App\Helper\InsertValuesLoadHelper;
use App\Helper\PdoHelper;

class InsertResourceDao
{
    private $dbh = null;

    /**
     * InsertResourceDao constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->dbh = new PdoHelper();
    }

    /**
     * @param int $insertRowCount
     *
     * @throws \Exception
     *
     * @return DbMeasurementEntity
     */
    public function insertBasic($insertRowCount = 1)
    {
        $result = new DbMeasurementEntity();
        $baseQuery = $this->getInsertBaseQuery();

        for ($i = 0 ; $i < $insertRowCount ; $i++ ) {
            $query = $baseQuery. ' '.InsertValuesLoadHelper::getInsertValuesString(false);
            if ( $this->dbh->exec($query) === 0 ) {
                throw new \Exception('insert row 0');
            }

        }

        $result->setDbEndAt();
        return $result;
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function getInsertBaseQuery()
    {
        $columns = join(',',InsertValuesLoadHelper::getInsertColumn());
        $table = DbConfLoadHelper::getDbConf()->getTableName();
        return <<<__LOAD_DATA_QUERY__
INSERT INTO ${table}(
${columns}
) VALUES
__LOAD_DATA_QUERY__;


    }
}