<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayWorkInformation extends Model
{
    protected $table = 'day_work_information';

    use HasFactory;

    /**
     * getMonthWorkInfo
     *
     * @param  mixed $code
     * @param  mixed $dateTime
     * @return array $workInfo
     */
    public static function getMonthWorkInfo(string $code, string $dateTime = null)
    {
        if (is_null($dateTime)) {
            $date = date('Y/m');
        } else {
            $date = date('Y/m', strtotime($dateTime));
        }
        $informations = self::query()
            ->where('code', $code)
            ->whereRaw('to_char(day, \'YYYY/MM\')= \'' . $date . '\'')
            ->get();

        $workInfo = [];

        if(empty($informations) === false){
            foreach ($informations as $information) {
                $workInfo[] = [
                    'day' => date('Y/m/d', strtotime($information->day))
                    , 'startTime' => date('H:i', strtotime($information->start_time))
                    , 'endTime' => date('H:i', strtotime($information->end_time))
                    , 'details' => $information->details
                ];
            }
        }

        return $workInfo;
    }
}
