<?php
namespace Bin;

use App\Dao\InsertResourceDao;
use App\Entity\ProcessMeasurementEntity;
use App\Helper\InsertConfLoadHelper;

$psMeasurement = new ProcessMeasurementEntity();

try {
    $dao = new InsertResourceDao();
    $psMeasurement->setDbMeasurement($dao->insertBasic(InsertConfLoadHelper::getItemCreateRow()));
}catch (\Exception $e) {
    echo $e->getMessage().PHP_EOL;
    exit(-1);
}

$psMeasurement->printResult('Y/m/d H:i:s');
exit(-1);

