<?php
/**
 * Created by PhpStorm.
 * User: Mohsen
 * Date: 4/23/2021
 * Time: 6:42 PM
 */

class Utils
{


    public static function getPersianDate(){
        date_default_timezone_set('Asia/Tehran');
        $now = new DateTime();

        $formatter = new IntlDateFormatter(
            "fa_IR@calendar=persian",
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            'Asia/Tehran',
            IntlDateFormatter::TRADITIONAL,
            "yyyy-MM-dd");
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];
        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $formatter->format($now));
        return str_replace($arabic, $num, $convertedPersianNums);
    }
}