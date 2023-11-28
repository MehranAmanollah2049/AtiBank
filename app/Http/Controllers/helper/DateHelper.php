<?php

namespace App\Http\Controllers\helper;

use DateInterval;
use DateTime;
use IntlDateFormatter;
use Morilog\Jalali\Jalalian;

class DateHelper
{

    // convert to persian
    public static function FaConvert($date)
    {

        return Jalalian::forge($date)->format('Y-m-d');
    }

    // convert to persian
    public static function FaConvert2($date)
    {

        return Jalalian::forge($date)->format('Y-m-d H:i:s');
    }

     // convert to persian
     public static function FaConvert3($date)
     {
 

         return Jalalian::fromCarbon($date)->format('Y/m/d');
     }

    // diff dates
    public static function diffDays($expired_at)
    {


        $Now = new DateTime(now());
        $date = new DateTime($expired_at);

        if($Now <= $date) {

            $diff = $Now->diff($date);

            $days = $diff->format('%a');
            
            if($days == 0) {

                $hour =  $diff->format('%h');

                if($hour == 0) {

                    $mins =  $diff->format('%i');

                    if($mins == 0) {

                        $secs = $diff->format("%s");

                        if($secs == 0) {

                            return 'منقضی شده';
                        }
                        else {

                            return $secs . 'ثانیه';
                        }

                    }
                    else {

                        return $mins . 'دقیقه';
                    }

                }
                else {

                    return $hour . 'ساعت';
                }
            }
            else {

                return $days . 'روز';
            }

        }
        else {

            return 'منقضی شده';
        }
    }

    public static function getExpriredDate($days)
    {

        $dt = now();
        $expired_at_dt = $dt->add(new DateInterval("P" . $days . "D"));
        return $expired_at_dt;
    }

    public static function FaConvert4($date) {
        return jdate($date)->format('Y-m-d');
    }
}
