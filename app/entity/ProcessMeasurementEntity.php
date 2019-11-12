<?php
namespace App\Entity;
;
class ProcessMeasurementEntity
{
    /**
     * @var \DateTime
     */
    private $startAt = null;
    /**
     * @var \DateTime
     */
    private $endAt = null;
    private $startMicroTime = 0.0;
    private $endMicroTime = 0.0;
    /**
     * @var DbMeasurementEntity
     */
    private $dbMeasurement = null;

    public function __construct()
    {
        $this->setStartAt((new \DateTime));
    }

    /**
     * @param DbMeasurementEntity $dbMeasurement
     */
    public function setDbMeasurement(DbMeasurementEntity $dbMeasurement)
    {
        $this->dbMeasurement = $dbMeasurement;
    }

    public function setEndAt()
    {
        $this->endAt = new \DateTime();
        $this->endMicroTime = microtime(true);
    }

    /**
     * @param \DateTime $startAt
     */
    public function setStartAt(\DateTime $startAt)
    {
        $this->startAt = $startAt;
        $this->startMicroTime = microtime(true);
    }

    /**
     * @return float
     */
    public function getProcessTime()
    {
        return ($this->endMicroTime-$this->startMicroTime);
    }

    /**
     * @return \DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * @return \DateTime
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    public function printResult($dateFormat)
    {
        echo "----------------------------------------------------------------------------".PHP_EOL;
        echo "All process Start Time : ".$this->startAt->format($dateFormat).PHP_EOL;
        echo "All process End Time : ".$this->endAt->format($dateFormat).PHP_EOL;
        echo "All process Time (sec) : ". $this->getProcessTime().PHP_EOL;
        echo "----------------------------------------------------------------------------".PHP_EOL;
        echo "start DB insert Time: ".$this->dbMeasurement->getDbStartAt()->format($dateFormat).PHP_EOL;
        echo "end DB insert : ".$this->dbMeasurement->getDbEndAt()->format($dateFormat).PHP_EOL;
        echo "DB Processing Time (sec) : ".$this->dbMeasurement->getDbProcessTime().PHP_EOL;
        echo "----------------------------------------------------------------------------".PHP_EOL;

    }
}