<?php
namespace App\Entity;
;
class DbMeasurementEntity
{
    private $dbStartAt = null;
    private $dbEndAt = null;
    private $dbStartMicroTime = 0.0;
    private $dbEndMicroTime = 0.0;

    public function __construct()
    {
        $this->setDbStartAt((new \DateTime));
    }

    public function setDbEndAt()
    {
        $this->dbEndAt = new \DateTime();
        $this->dbEndMicroTime = microtime(true);
    }

    public function setDbStartAt($dbStartAt)
    {
        $this->dbStartAt = $dbStartAt;
        $this->dbStartMicroTime = microtime(true);
    }

    /**
     * @return float
     */
    public function getDbProcessTime()
    {
        return ($this->dbEndMicroTime-$this->dbStartMicroTime);
    }

    /**
     * @return \DateTime
     */
    public function getDbEndAt()
    {
        return $this->dbEndAt;
    }

    /**
     * @return \DateTime
     */
    public function getDbStartAt()
    {
        return $this->dbStartAt;
    }



}