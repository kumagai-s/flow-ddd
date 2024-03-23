<?php
declare(strict_types=1);

namespace Vendor\Demo\Domain\Model\Timestamp;

use Neos\Flow\Annotations as Flow;

class Timestamp
{
    public function __construct(
        private TimestampId        $id,
        private TimestampType      $type,
    ) {}

    public function id(): TimestampId
    {
        return $this->id;
    }
    
    public function date(): TimestampType
    {
        return $this->date;
    }
    
    public function inTime(): TimestampTime
    {
        return $this->inTime;
    }
    
    public function outTime(): PunchTimeOutTime
    {
        return $this->outTime;
    }
    
    public function totalTime(): PunchTimeTotalTime
    {
        return $this->totalTime;
    }
}