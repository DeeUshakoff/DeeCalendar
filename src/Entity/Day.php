<?php

namespace App\Entity;

class Day{

    public const DAY_NAMES = [1=>'Monday', 2=>'Tuesday', 3=>'Wednesday', 4=>'Thursday', 5=>'Friday', 6=>'Saturday', 7=>'Sunday'];
    public ?int $DayNumber;
    public string $DayName;
    public bool $IsWeekend = false;

    /**
     * @param int $DayNumber
     * @param string $DayName
     */
    public function __construct(int $DayNumber, string $DayName)
    {
        $this->DayNumber = max($DayNumber, 0);
        $this->DayName = $DayName;
        if($DayName ==  self::DAY_NAMES[6] || $DayName == self::DAY_NAMES[7]){
            $this->IsWeekend = true;
        }
    }
}