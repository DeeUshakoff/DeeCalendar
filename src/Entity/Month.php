<?php

namespace App\Entity;

class Month
{
    public array $Days = [];
    public array $Weeks = [];
    public string $MonthName;
    public int $MonthNumber;
    public int $Year;

    /**
     * @param int $MonthNumber
     * @param int $Year
     */
    public function __construct(int $MonthNumber, int $Year)
    {
        $this->MonthNumber = $MonthNumber;
        $this->Year = $Year;
        $this->MonthName = date('F', mktime(0,0,0,$MonthNumber,1,$Year));
        $daysCount = cal_days_in_month(0, $MonthNumber, $Year);

        for ($dayNumber = 1; $dayNumber <= $daysCount; $dayNumber++){
            $unixDate = mktime(0,0,0,$MonthNumber,$dayNumber,$Year);
            $dayName = date('l', $unixDate);
            $day = new Day($dayNumber, $dayName);
            $this->Days[$dayNumber] = $day;
        }

        $countOfNulls = array_search($this->Days[1]->DayName, Day::DAY_NAMES) - 1;

        $firstWeekDays = array_fill(0,$countOfNulls, null);
        $week = new Week();
        $week->Days = $firstWeekDays;

        foreach ($this->Days as $day){
            $week->Days[] = $day;
            if($day->DayName == Day::DAY_NAMES[7]){
                $this->Weeks[] = $week;
                $week = new Week();
            }
        }

        if(!(end($this->Weeks) === $week)){
            if(count($week->Days) != 0){
                $this->Weeks[] = $week;
            }
        }

        $lastWeek = end($this->Weeks);
        while(count($lastWeek->Days) < 7){
            $lastWeek->Days[] = null;
        }
    }

}