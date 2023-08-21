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
     * @return DayWorkInformation $workInfo
     */
    public static function getMonthWorkInfo(string $code, string $dateTime = null)
    {
        if (is_null($dateTime)) {
            $date = date('Y/m');
        } else {
            $date = date('Y/m', strtotime($dateTime));
        }
        $workInfo = self::query()
            ->selectRaw(
                'to_char(day, \'YYYY/MM\') as day
                , to_char(start_time, \'HH24:MI\') as start_time
                , to_char(end_time, \'HH24:MI\') as end_time
                , details'
            )
            ->where('code', $code)
            ->whereRaw('to_char(day, \'YYYY/MM\')= \'' . $date . '\'')
            ->paginate(10)
            ->withQueryString();
        return $workInfo;

        $workInfo = [];
    }
}
